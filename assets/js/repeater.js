/**
 * Tabby - repeater for the settings screen.
 *
 * Clones a <template> row on "Add", renumbers field name indexes, and removes
 * rows. Works without any framework or jQuery. Fully keyboard usable. Enqueued
 * deferred / in the footer. No dependencies.
 *
 * Also keeps every tab body badged with the pass it will get on the storefront,
 * because "Shortcodes and blocks in tabs" is one switch that changes all of
 * them. That badge is rendered server-side from the saved option, so it is
 * already right with JavaScript off; this only keeps it in step before a save.
 */
(function () {
    'use strict';

    var STILL = window.matchMedia
        ? window.matchMedia('(prefers-reduced-motion: reduce)')
        : null;

    /** Show or hide an element, letting CSS ease it if motion is welcome. */
    function reveal(el, show, immediate) {
        if (!el) {
            return;
        }

        if (immediate) {
            el.hidden = !show;
            el.classList.toggle('is-shown', show);
            return;
        }

        if (show) {
            el.hidden = false;
            window.requestAnimationFrame(function () {
                el.classList.add('is-shown');
            });
            return;
        }

        el.classList.remove('is-shown');

        if (STILL && STILL.matches) {
            el.hidden = true;
            return;
        }

        window.setTimeout(function () {
            if (!el.classList.contains('is-shown')) {
                el.hidden = true;
            }
        }, 200);
    }

    /**
     * Wire the rich-content switch to the per-tab badges.
     *
     * @return {function(boolean):void|null} Re-sync callback, or null when the
     *                                       switch is not on this screen.
     */
    function initRichPass() {
        var toggle = document.querySelector('[data-tabby-rich-toggle]');
        var admin = document.querySelector('.tabby-admin');

        if (!toggle || !admin) {
            return null;
        }

        // Hands the stylesheet permission to animate. Without it (no JS) every
        // badge is painted flat and visible, which is the honest fallback.
        admin.classList.add('is-enhanced');

        var sync = function (immediate) {
            var notes = admin.querySelectorAll('[data-tabby-rich-note]');
            Array.prototype.forEach.call(notes, function (note) {
                reveal(note, toggle.checked, immediate);
            });
        };

        toggle.addEventListener('change', function () {
            sync(false);
        });

        sync(true);

        return sync;
    }

    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    function reindex(rowsContainer) {
        var rows = rowsContainer.querySelectorAll('[data-tabby-row]');
        Array.prototype.forEach.call(rows, function (row, index) {
            var fields = row.querySelectorAll('[name]');
            Array.prototype.forEach.call(fields, function (field) {
                var name = field.getAttribute('name');
                if (!name) {
                    return;
                }
                field.setAttribute(
                    'name',
                    name.replace(/\[(?:__index__|\d+)\]/, '[' + index + ']')
                );
            });
        });
    }

    function initRepeater(repeater, syncRichPass) {
        var rowsContainer = repeater.querySelector('[data-tabby-rows]');
        var template = repeater.querySelector('[data-tabby-template]');
        var addButton = repeater.querySelector('[data-tabby-add]');

        if (!rowsContainer || !template || !addButton) {
            return;
        }

        addButton.addEventListener('click', function () {
            var clone = template.content
                ? template.content.firstElementChild.cloneNode(true)
                : null;

            // Fallback for browsers without <template>.content (very old).
            if (!clone) {
                var wrapper = document.createElement('div');
                wrapper.innerHTML = template.innerHTML;
                clone = wrapper.firstElementChild;
            }

            if (!clone) {
                return;
            }

            rowsContainer.appendChild(clone);
            reindex(rowsContainer);

            // A brand-new row must show the same pass as its neighbours.
            if (syncRichPass) {
                syncRichPass(true);
            }

            var firstInput = clone.querySelector('input[type="text"], textarea');
            if (firstInput) {
                firstInput.focus();
            }
        });

        rowsContainer.addEventListener('click', function (event) {
            var trigger = event.target.closest('[data-tabby-remove]');
            if (!trigger) {
                return;
            }
            event.preventDefault();
            var row = trigger.closest('[data-tabby-row]');
            if (!row) {
                return;
            }
            row.parentNode.removeChild(row);
            reindex(rowsContainer);
        });

        reindex(rowsContainer);
    }

    ready(function () {
        var syncRichPass = initRichPass();
        var repeaters = document.querySelectorAll('[data-tabby-repeater]');
        Array.prototype.forEach.call(repeaters, function (repeater) {
            initRepeater(repeater, syncRichPass);
        });
    });
})();
