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
            "accordionJS": "Magento_Catalog/js/accordion",
        }
    }

};
