define(['jquery', 'TYPO3/CMS/Backend/Modal'], function (jQuery, BackendModal) {

    function Modal() {
        jQuery('a[data-modules-modal-iframe]').click(function (event) {
            var button = jQuery(this);
            var configuration = {
                id: 'modules-modal',
                type: BackendModal.types.iframe,
                title: button.data('modules-modal-iframe-title'),
                content: button.data('modules-modal-iframe-url'),
                size: BackendModal.sizes.full
            };
            BackendModal.advanced(configuration);
            event.preventDefault();
            return false;
        });
    }

    return new Modal();

});
