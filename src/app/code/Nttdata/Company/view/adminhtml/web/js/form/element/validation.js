require(
    [
        'Magento_Ui/js/lib/validation/validator',
        'jquery',
        'mage/translate'
    ], function (validator, $) {
        validator.addRule(
            'letters',
            function (value) {
                return /^[A-Za-z]+$/.test(value);
            },
            $.mage.__('Only letters (uppercase and lowercase) are allowed.')
        );
    });
