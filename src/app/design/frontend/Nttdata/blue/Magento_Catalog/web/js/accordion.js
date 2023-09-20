define([
    "jquery",
    "jquery/ui"
], function ($) {
    "use strict";

    $.widget("custom.accordionWidget", {
        options: {
            "accordion": {
                "active": [0, 1, 2],
                "collapsible": true,
                "openedState": "active",
                "multipleCollapsible": true
            }
        },

        _create: function () {
            this.element.accordion(this.options["accordion"]);
        }
    });

    return $.custom.accordionWidget;
});
