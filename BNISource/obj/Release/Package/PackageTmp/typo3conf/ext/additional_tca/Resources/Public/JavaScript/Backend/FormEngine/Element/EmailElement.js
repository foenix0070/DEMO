define(['jquery', 'TYPO3/CMS/Core/DocumentService'], function (jQuery, DocumentService) {
    /**
     * @type {{}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/Email
     */
    const Email = {};

    /**
     * Initializes the Email.
     *
     * @param {String} table
     * @param {String} uid
     * @param {String} field
     */
    Email.initialize = (table, uid, field) => {
        DocumentService.ready().then(() => {
            const hiddenField = jQuery('input[name="data[' + table + '][' + uid + '][' + field + ']"');
            const wrapper = hiddenField.closest('.form-group');
            const inputField = wrapper.find('input').first();
            inputField.on('keyup', function() {
                const value = jQuery(this).val();
                if (Email.isValidEmail(value)) {
                    wrapper.removeClass('has-error');
                } else {
                    wrapper.addClass('has-error');
                }
            });
        });
    };

    /**
     * Check whether a string is a valid email address
     * -> https://dev.to/dailydevtips1/vanilla-javascript-email-validation-21b3
     *
     * @param {string} email The string to check
     * @returns {boolean} True or false
     */
    Email.isValidEmail = (email) => {
        const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(String(email).toLowerCase());
    };

    return Email;
});
