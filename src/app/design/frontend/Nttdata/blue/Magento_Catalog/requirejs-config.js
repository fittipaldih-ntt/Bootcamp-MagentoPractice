var config = {

   paths: {
        'jquery.ui.widget': 'Nttdata/js/jquery.ui.widget'
    },
    shim: {
        'jquery.ui.widget': {
            'deps': ['jquery']
        }
    },

    map: {
        "*": {
            "accordion": "Magento_Catalog/js/accordion"
        }
    }

};
