require(
    [
        'Magento_Ui/js/lib/validation/validator',
        'jquery',
        'mage/translate'
], function(validator, $){
        validator.addRule(
            'letters',
            function (value) {
                return /^[A-Za-z]+$/.test(value);
            },
            $.mage.__('Only letters (uppercase and lowercase) are allowed.')
        );

        validator.addRule(
            'minimum-age',
            function (value) {
                if (!value) {
                    return true;
                }

                var selectedDate = new Date(value);
                var currentDate = new Date();
                var minimumAge = 18;

                var ageDifference = currentDate.getFullYear() - selectedDate.getFullYear();

                if (
                    currentDate.getMonth() < selectedDate.getMonth() ||
                    (currentDate.getMonth() === selectedDate.getMonth() &&
                        currentDate.getDate() < selectedDate.getDate())
                ) {
                    ageDifference--;
                }

                return ageDifference >= minimumAge;
            },
            $.mage.__('You must be at least 18 years old.')
        );
});