/**
 * Tabby - admin enhancements for the settings screen and the product metabox.
 *
 * 1. Repeater: clone a <template> row on "Add", renumber field name indexes, and
 *    remove rows. Works without any framework or jQuery. Fully keyboard usable.
 * 2. Tooltips: progressive enhancement for the "?" help affordances (the text is
 *    already exposed via aria-describedby + title with JS disabled).
 *
 * Enqueued deferred / in the footer. No dependencies.
 */
(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    }

    // --- Repeater ---------------------------------------------------------

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

    function initRepeater(repeater) {
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

    // --- Tooltips ---------------------------------------------------------

    function initTooltip(trigger) {
        var tipId = trigger.getAttribute('data-tabby-tip');
        if (!tipId) {
            return;
        }
        var tip = document.getElementById(tipId);
        if (!tip) {
            return;
        }

        // Remove the native title to avoid a duplicate delayed tooltip.
        trigger.removeAttribute('title');

        var show = function () { tip.hidden = false; };
        var hide = function () { tip.hidden = true; };

        hide();

        trigger.addEventListener('mouseenter', show);
        trigger.addEventListener('mouseleave', hide);
        trigger.addEventListener('focus', show);
        trigger.addEventListener('blur', hide);
        trigger.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                hide();
                trigger.blur();
            }
        });
    }

    ready(function () {
        var repeaters = document.querySelectorAll('[data-tabby-repeater]');
        Array.prototype.forEach.call(repeaters, initRepeater);

        var tips = document.querySelectorAll('.tabby-help');
        Array.prototype.forEach.call(tips, initTooltip);
    });
})();
