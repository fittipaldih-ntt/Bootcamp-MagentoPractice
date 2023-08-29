define([
    'jquery',
    'Magento_Ui/js/form/element/date'
], function ($, DateElement) {
    'use strict';

    return DateElement.extend({
        initialize: function () {
            this._super();
            if (this.initialValue) {
                this.disable();
            }
            this.observe(['value']);
        },

        onUpdate: function () {
            if (this.value()) {
                this.disable();
            }
        },

        disable: function () {
            this.disabled(true);
        }
    });
});
