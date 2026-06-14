=== Tabby - Custom Product Tabs for WooCommerce ===
Contributors: wppoland
Tags: woocommerce, product tabs, custom tabs, product page, tabs
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 0.1.0
Requires Plugins: woocommerce
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add custom tabs with your own content to WooCommerce product pages — reusable global tabs and per-product tabs, with safe HTML.

== Description ==

Tabby lets you add your own tabs to the WooCommerce single product page, alongside the native Description, Additional information and Reviews tabs.

There are two kinds of tab:

* **Global tabs** — defined once under WooCommerce → Tabby Tabs and shown on every product. Perfect for shared content like shipping & returns, size guides, care instructions or warranty information.
* **Per-product tabs** — added from the "Custom Product Tabs (Tabby)" box on any product, shown only on that product.

Each tab has a title and a content area that accepts safe, limited HTML (links, lists, bold, headings and more) via WordPress's `wp_kses_post`. You choose whether your custom tabs appear before or after the native WooCommerce tabs.

= Highlights =

* Reusable global tabs rendered on every product page.
* Per-product tabs via a metabox on the product editor.
* Hide specific global tabs on individual products.
* Safe HTML content (sanitised with `wp_kses_post`).
* Control placement: before or after the native WooCommerce tabs.
* Renders through the standard `woocommerce_product_tabs` filter with sensible priorities, so it plays nicely with themes and other plugins.
* Accessible, dark-mode-aware admin UI with inline help. No layout shift on the storefront.
* Graceful empty/disabled states — renders nothing rather than anything broken.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/tabby`, or install via Plugins → Add New.
2. Activate it. WooCommerce must be active.
3. Go to **WooCommerce → Tabby Tabs** to add global tabs, or open any product and use the **Custom Product Tabs (Tabby)** box for per-product tabs.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Yes. Tabby requires an active WooCommerce installation.

= What HTML is allowed in tab content? =

The same safe subset WordPress allows in post content (`wp_kses_post`): links, lists, headings, bold/italic, images, blockquotes and similar. Scripts and unsafe markup are stripped on save and on render.

= Can I hide a global tab on one product? =

Yes. Open the product, find the "Custom Product Tabs (Tabby)" box, and tick the global tabs you want to hide for that product.

= Where do the custom tabs appear? =

On the single product page tab list. You can place them before or after the native WooCommerce tabs from the settings screen.

== Screenshots ==

1. The Tabby settings screen for managing reusable global tabs.
2. The per-product tabs metabox on the product editor.
3. Custom tabs rendered on the single product page.

== Changelog ==

= 0.1.0 =
* Initial release: reusable global tabs, per-product tabs, per-product hiding of global tabs, configurable placement, safe HTML content, and a WooCommerce-submenu settings screen.
