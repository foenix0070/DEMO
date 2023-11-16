jQuery(document).ready(function () {
    //
    // Display a upload notification
    jQuery('.tx-modules .form-field-files input[type=\'file\']').change(function () {
        var fileInput = jQuery(this);
        var uploadNotification = fileInput.attr('data-upload-notification');
        if (uploadNotification !== '') {
            alert(uploadNotification);
        }
        //
        // Write filenames into upload field
        var filenames = [];
        if (typeof fileInput[0] === 'object') {
            for (var i = 0; i < fileInput[0].files.length; i++) {
                filenames[i] = fileInput[0].files[i].name;
            }
        }
        jQuery('.custom-file-label', fileInput.parent()).text(filenames.join(', '));
    });
    //
    // Add date/time picker
    jQuery.each(jQuery('.tx-modules .input-group.date'), function () {
        var dateTimePicker = jQuery(this);
        var options = {
            format: false,
            locale: 'de'
        };
        var format = dateTimePicker.attr('data-format');
        if (format !== '') {
            options.format = format;
        }
        var locale = dateTimePicker.attr('data-locale');
        if (locale !== '') {
            options.locale = locale;
        }
        //
        // Insert current date
        var timestamp = parseInt(jQuery('input[type=\'hidden\']', dateTimePicker).val(), 10);
        if (timestamp > 0) {
            options.date = moment(timestamp * 1000);
        }
        //
        var dateTimePickerObject = dateTimePicker.datetimepicker(options);
        //
        // Ensure that the hidden field contains still a timestamp
        jQuery('input[type=\'hidden\']', dateTimePicker).val(timestamp);
        //
        // Update hidden field on
        dateTimePicker.on("change.datetimepicker", function (event) {
            var wrapper = jQuery(this);
            console.log('on change:', event);
            if (typeof event.date !== 'undefined') {
                console.log('on change timestamp:', event.date.unix());
                jQuery('input[type=\'hidden\']', wrapper).val(event.date.unix());
            }
        });
    });
    //
    // Select box sorting on load
    jQuery.each(jQuery('.tx-modules .form-field-select select[data-sortby=\'abc\']'), function () {
        var select = jQuery(this);
        var value = jQuery('option[selected=\'selected\']', select).val();
        select.html(select.find('option').sort(function (x, y) {
            // to change to descending order switch "<" for ">"
            return $(x).text() > $(y).text() ? 1 : -1;
        }));
        if (typeof value === 'undefined') {
            select.val(jQuery('option:first', select).val());
        } else {
            select.val(value);
        }
    });
    //
    // Mark invalid tabs and switch to first invalid one
    var tabs = jQuery('.tx-modules .tab-content .tab-pane');
    if(tabs.length > 0) {
        var tabActive = false;
        jQuery(tabs.get().reverse()).each(function () {
            var tabPane = jQuery(this);
            if (jQuery('.is-invalid', tabPane).length > 0) {
                // Mark invalid tab
                var tabSelector = '.nav-link[href=\'#' + tabPane.attr('id') + '\']';
                var tabInvalidClass = jQuery('ul.nav-tabs').attr('data-invalid-tab-class');
                jQuery(tabSelector).parent().addClass(tabInvalidClass);
                // Switch tab
                jQuery(tabSelector).trigger('click');
                tabActive = true;
            }
        });
        if(!tabActive) {
            jQuery('.tx-modules .nav-tabs a[data-toggle=\'tab\']').first().trigger('click');
        }
    }
    //
    // Add percent field
    // EXPERIMENTAL!!!
    jQuery.each(jQuery('.tx-modules .form-field-input-percent input.form-control'), function () {
        var field = jQuery(this);
        var fieldHidden = jQuery('input[name=\'' + field.attr('name').replace('-display', '') + '\']');
        field.val(NumberFormat.percent(fieldHidden.val()));
        field.on('change', function () {
            var intValue = NumberFormat.stringToInt(field.val());
            fieldHidden.val(intValue);
        }).on('focus', function () {
            console.log('percent focus');
            field.val(fieldHidden.val());
        }).on('blur', function () {
            console.log('percent blur');
            fieldHidden.val(NumberFormat.stringToInt(field.val()));
            field.val(NumberFormat.percent(fieldHidden.val()));
        });
    });

});
