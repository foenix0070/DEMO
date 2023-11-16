define([
        'jquery',
        'bootstrap',
        'TYPO3/CMS/Core/DocumentService'
    ],
    function (
        jQuery,
        bootstrap,
        DocumentService
    ) {

    return new class {
        constructor() {

            this.initialize = function () {
                //
                // Ensure the bootstrap element available
                window.bootstrap = bootstrap;
                window.Dropdown = bootstrap.Dropdown;
                // Load the bootstrap selects
                require(['jquery', 'bootstrap', 'bootstrap-select'], function () {
                    jQuery.fn.selectpicker.Constructor.BootstrapVersion = '5';
                    //
                    // Use data-display=static
                    // See: https://github.com/snapappointments/bootstrap-select/issues/2262
                    jQuery('select[data-select=\'search\']').data('data-dropup-auto', false).data('display', 'static').data('live-search', true).selectpicker('render');
                    jQuery('select[data-select=\'default\']').data('data-dropup-auto', false).data('display', 'static').selectpicker('render');
                });
            };

            top.TYPO3.Select = this;

            DocumentService.ready().then(() => {
                top.TYPO3.Select.initialize();
            });

        }
    };

});
