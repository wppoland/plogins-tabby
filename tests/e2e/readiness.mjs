// Live checks for the 2026-10-05 readiness fixes. Needs the e2e wp-env running
// with this build of tabvera active.
//   node tests/e2e/readiness.mjs
// Env: BASE (default http://localhost:8991), CLI (wp-cli container name),
// PW (path to playwright index.mjs), BROWSER (chromium-family executable).
import { execFileSync } from 'node:child_process';
import { readFileSync } from 'node:fs';
import assert from 'node:assert/strict';

const BASE = process.env.BASE || 'http://localhost:8991';
const CLI = process.env.CLI || 'wp-env-e2e-live-33280819-cli-1';
const PW = process.env.PW || '/Users/mariuszszatkowskipromax/local/plogins/scripts/screenshots/node_modules/playwright/index.mjs';
const BROWSER = process.env.BROWSER || '/Applications/Brave Browser.app/Contents/MacOS/Brave Browser';
const ROOT = new URL('../../', import.meta.url);
const { chromium } = await import(PW);

const wp = (...a) => execFileSync('docker', ['exec', CLI, 'wp', ...a], { encoding: 'utf8' }).trim();
const original = wp('option', 'get', 'tabby_settings', '--format=json');
const failures = [];
const check = async (name, fn) => {
    try { await fn(); console.log('PASS', name); } catch (e) { failures.push(name); console.log('FAIL', name, e.message); }
};

// Static: the upsell no longer sells a FREE feature, the readme no longer
// promises kses on output unconditionally.
await check('upsell card does not sell rich content', () => {
    const cfg = readFileSync(new URL('config/pro-upsell.php', ROOT), 'utf8');
    assert.doesNotMatch(cfg, /Rich content|rich content|Shortcodes and blocks/);
});
await check('readme qualifies the kses-on-output claim', () => {
    const rm = readFileSync(new URL('readme.txt', ROOT), 'utf8');
    assert.doesNotMatch(rm, /both on save and again on output|on save and on output;/);
    assert.match(rm, /Shortcodes and blocks in tabs\*\* setting/);
});

const browser = await chromium.launch({ executablePath: BROWSER, headless: true });
try {
    wp('option', 'update', 'tabby_settings', '--format=json', JSON.stringify({
        enabled: true, rich_content: false,
        global_tabs: [{ id: 'ship', title: 'Shipping', content: 'Wysylka w 24h.', enabled: true }],
    }));

    for (const width of [1280, 390]) {
        await check(`spine clears the text at ${width}px`, async () => {
            const page = await browser.newPage({ viewport: { width, height: 900 } });
            await page.goto(`${BASE}/?p=10`, { waitUntil: 'networkidle' });
            await page.click('a[href^="#tab-tabby_"]');
            const m = await page.evaluate(() => {
                const panel = document.querySelector('.panel[id^="tab-tabby_"]');
                const spine = parseFloat(getComputedStyle(panel, '::after').width) || 0;
                const left = panel.getBoundingClientRect().left;
                const textLeft = (el) => {
                    const r = document.createRange();
                    r.selectNodeContents(el);
                    return r.getClientRects()[0].left;
                };
                return {
                    spineRight: left + spine,
                    title: textLeft(panel.querySelector('.tabby-tab__title')),
                    body: textLeft(panel.querySelector('.tabby-tab__content p')),
                };
            });
            assert.ok(m.title >= m.spineRight, `title text at ${m.title}, spine ends ${m.spineRight}`);
            assert.ok(m.body >= m.spineRight, `body text at ${m.body}, spine ends ${m.spineRight}`);
            await page.close();
        });
    }

    await check('saving settings shows Settings saved', async () => {
        const page = await browser.newPage();
        await page.goto(`${BASE}/wp-login.php`);
        await page.fill('#user_login', 'admin');
        await page.fill('#user_pass', 'password');
        await page.click('#wp-submit');
        await page.waitForLoadState('networkidle');
        await page.goto(`${BASE}/wp-admin/admin.php?page=tabby-settings`, { waitUntil: 'networkidle' });
        assert.equal(await page.getByText('Shortcodes and blocks inside tab content').count(), 0, 'rich content card still on screen');
        await Promise.all([
            page.waitForURL(/settings-updated=true/),
            page.click('form[action="options.php"] [type="submit"]'),
        ]);
        assert.ok(await page.locator('.notice, .updated').filter({ hasText: 'Settings saved' }).count() > 0, 'no Settings saved notice');
        await page.close();
    });
} finally {
    await browser.close();
    wp('option', 'update', 'tabby_settings', '--format=json', original);
}

console.log(failures.length ? `${failures.length} failed` : 'all passed');
process.exit(failures.length ? 1 : 0);
