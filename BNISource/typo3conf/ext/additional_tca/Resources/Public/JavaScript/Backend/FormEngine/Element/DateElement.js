define(['jquery', 'TYPO3/CMS/Core/DocumentService'], function (jQuery, DocumentService) {
    /**
     * @type {{}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/DateElement
     */
    const DateElement = {};

    /**
     * Appends button to date time input element.
     *
     * @param {jQuery} $wrapper
     * @param {String} id
     * @param {String} icon
     * @param {String} title
     */
    DateElement.insertButton = ($wrapper, id, icon, title) => {
        $wrapper.append(
            '<div class="input-group-append">\n' +
            '  <button style="padding: 6px 7px" class="btn btn-default" type="button" id="' + id + '" title="' + title + '">\n' +
            '    <span class="t3js-icon icon icon-size-small icon-state-default icon-actions-redo" data-identifier="' + icon + '">\n' +
            '      <span class="icon-markup">\n' +
            '        <svg class="icon-color">\n' +
            '          <use xlink:href="/typo3/sysext/core/Resources/Public/Icons/T3Icons/sprites/actions.svg#' + icon + '"></use>\n' +
            '        </svg>\n' +
            '      </span>\n' +
            '    </span>\n' +
            '  </button>\n' +
            '</div>'
        );
    };

    /**
     * Prepends 0 to the numbers that are less 10.
     *
     * @param {Number} value
     * @returns {String}
     */
    DateElement.formatWithZeroes = value => value > 9 ? value : `0${value}`;

    /**
     * Generates string values for inserting to visible and hidden TYPO3 inputs.
     *
     * @param {Date} date
     * @returns {{visible: string, hidden: string}}
     */
    DateElement.generateValues = date => {
        const year      = date.getFullYear();
        const month     = DateElement.formatWithZeroes(date.getMonth() + 1);
        const day       = DateElement.formatWithZeroes(date.getDate());

        return {
            hidden: `${year}-${month}-${day}`,
            visible: `${day}-${month}-${year}`
        };
    };

    /**
     * Modifies value of the date time input.
     *
     * @param {jQuery} $visible
     * @param {jQuery} $hidden
     * @param {String} operator
     */
    DateElement.modifyTime = ($visible, $hidden, operator) => {
        const parts = new RegExp('(\\d+)-(\\d+)-(\\d+)').exec($visible.val());
        let date = new Date();
        if (parts !== null) {
            date = new Date(parts[3], parts[2]-1, parts[1]);
        }

        if (operator === '+') {
            date.setDate(date.getDate() + 1);
        } else {
            date.setDate(date.getDate() - 1);
        }

        const values = DateElement.generateValues(date);

        $hidden.val(values.hidden);
        // Set visible date using flatpickr
        $visible[0]._flatpickr.setDate(values.visible, true);
    };

    /**
     * Initializes the DateElement.
     *
     * @param {String} table
     * @param {String} uid
     * @param {String} field
     */
    DateElement.initialize = (table, uid, field) => {
        DocumentService.ready().then(() => {
            const $hidden = jQuery(`input[name="data[${table}][${uid}][${field}]"`);
            const $wrapper = $hidden.closest('.input-group');
            const $visible = $wrapper.find('input').first();

            $wrapper.find('.icon-actions-edit-pick-date').closest('.input-group-btn').remove();

            const idNow = `date-field-${table}-${uid}-${field}-now`;
            const idPlus = `date-field-${table}-${uid}-${field}-plus`;
            const idMinus = `date-field-${table}-${uid}-${field}-minus`;

            DateElement.insertButton($wrapper, idNow, 'actions-clock', TYPO3.lang.select_current_day);
            DateElement.insertButton($wrapper, idPlus, 'actions-add', '+1 ' + TYPO3.lang.unit_day);
            DateElement.insertButton($wrapper, idMinus, 'actions-remove', '-1 ' + TYPO3.lang.unit_day);

            jQuery(`#${idNow}`).on('click', () => {
                const values = DateElement.generateValues(new Date());
                $hidden.val(values.hidden);
                // Set visible date using flatpickr
                $visible[0]._flatpickr.setDate(values.visible, true);
            });
            jQuery(`#${idPlus}`).on('click', () => DateElement.modifyTime($visible, $hidden, '+'));
            jQuery(`#${idMinus}`).on('click', () => DateElement.modifyTime($visible, $hidden, '-'));
        });
    };

    return DateElement;
});
