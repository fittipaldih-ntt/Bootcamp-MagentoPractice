define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'mage/translate',
    'Magento_Ui/js/modal/modal'
], function (_, uiRegistry, select, $t, modal) {
    'use strict';

    return select.extend({

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            var field1 = uiRegistry.get('index = idtype');
            var field2 = uiRegistry.get('index = idsector');

            field2.options([]);

            if (value === '1') { // Designer
                field2.options([
                    { label: $t('Please select'), value: '' },
                    { label: $t('Graphic'), value: '1' },
                    { label: 'Web', value: '2' }
                ]);
            }
            else if (value === '2') { // Developer
                field2.options([
                    { label: $t('Please select'), value: '' },
                    { label: 'PHP', value: '3' },
                    { label: 'NET', value: '4' },
                    { label: 'Python', value: '5' }
                ]);
            }

            if (field1.value() === '1' || field1.value() === '2') {
                field2.show();
            } else {
                field2.hide();
            }

            return this._super();
        },
    });
});
