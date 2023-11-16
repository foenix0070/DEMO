define(['jquery', 'TYPO3/CMS/Core/DocumentService'], function (jQuery, DocumentService) {

    /**
     * @type {{}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/DurationElement
     */
    const DurationElement = {};

    /**
     * Initializes the DurationElement.
     *
     * @param {String} selector
     * @param {Object} options
     */
    DurationElement.initialize = function(selector, options) {
        DocumentService.ready().then(() => {
            const field = jQuery('#' + selector);
            if (field.length > 0) {
                const fieldHidden = jQuery('#' + selector + '_hidden');
                if (fieldHidden.length > 0) {
                    const value = field.val();
                    //
                    const intValue = DurationElement.stringToInt(value, 'from initialize');
                    fieldHidden.val(intValue);
                    //
                    field.on('change', function() {
                        const intValue = DurationElement.stringToInt(jQuery(this).val(), 'from onchange');
                        fieldHidden.val(intValue);
                    });
                    field.on('focus', function() {
                        const field = jQuery(this);
                        const value = field.val();
                        field.val(DurationElement.removeUnitString(value));
                    });
                    field.on('blur', function() {
                        const field = jQuery(this);
                        const value = field.val();
                        field.val(DurationElement.removeUnitString(value) + ' ' + DurationElement.lastUsedUnit);
                    });
                } else {
                    top.TYPO3.Notification.error(
                        'Error',
                        'DurationElement.initialize: fieldHidden #' + selector + '_hidden not found!'
                    );
                }
            } else {
                top.TYPO3.Notification.error(
                    'Error',
                    'DurationElement.initialize: field #' + selector + ' not found!'
                );
            }
        });
    };

    /**
     * Duration to seconds.
     *
     * Example:
     * 1:30 -> 5400
     * 0:01 -> 60
     *
     * @param value
     */
    DurationElement.stringToInt = function(value) {
        if (typeof value === 'undefined') {
            top.TYPO3.Notification.error(
                'Error',
                'DurationElement.stringToInt: value is undefined!'
            );
        }
        value = DurationElement.removeUnitString(value);
        let seconds = 0;
        const parts = value.split(':');
        if (parts.length !== 2) {
            top.TYPO3.Notification.error('Error', 'DurationElement.stringToInt(' + value + ') failed!!');
        } else {
            const hours = parseInt(parts[0], 10);
            const minutes = parseInt(parts[1], 10);
            seconds = (hours * 60 * 60) + (minutes * 60);
        }
        return seconds;
    };

    DurationElement.lastUsedUnit = '';

    /**
     * Removes the unit string after time string
     *
     * Example:
     * 1:30 h -> 1:30
     * 0:01 Std. -> 0:01
     *
     * @param value
     */
    DurationElement.removeUnitString = function(value) {
        let valueParts = value.split(' ');
        if (valueParts.length > 1) {
            DurationElement.lastUsedUnit = valueParts[1];
        }
        return valueParts[0];
    };

    return DurationElement;

});
