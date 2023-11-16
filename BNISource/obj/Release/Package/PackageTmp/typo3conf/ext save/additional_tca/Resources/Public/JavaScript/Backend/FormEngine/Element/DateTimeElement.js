define(['jquery', 'TYPO3/CMS/Core/DocumentService'], function (jQuery, DocumentService) {
    /**
     * @type {{}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/DateTimeElement
     */
    const DateTimeElement = {};

    /**
     * Appends button to date time input element.
     *
     * @param {jQuery} $wrapper
     * @param {Number} step
     * @param {String} id
     * @param {String} icon
     * @param {String} title
     */
    DateTimeElement.insertButton = ($wrapper, step, id, icon, title) => {
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
    DateTimeElement.formatWithZeroes = value => value > 9 ? value : `0${value}`;

    /**
     * Generates string values for inserting to visible and hidden TYPO3 inputs.
     *
     * @param {Date} date
     * @returns {{visible: string, hidden: string}}
     */
    DateTimeElement.generateValues = date => {
        const year      = date.getFullYear();
        const month     = DateTimeElement.formatWithZeroes(date.getMonth() + 1);
        const day       = DateTimeElement.formatWithZeroes(date.getDate());
        const hours     = DateTimeElement.formatWithZeroes(date.getHours());
        const minutes   = DateTimeElement.formatWithZeroes(date.getMinutes());

        return {
            hidden: `${year}-${month}-${day}T${hours}:${minutes}:00Z`,
            visible: `${hours}:${minutes} ${day}-${month}-${year}`
        };
    };

    /**
     * Rounds given date to closest step.
     *
     * @param {Number} step
     * @param {Date} date
     * @returns {Date}
     */
    DateTimeElement.roundDate = (step, date) => {
        const coeff = 1000 * 60 * step;
        return new Date(Math.round(date.getTime() / coeff) * coeff);
    };

    /**
     * Modifies value of the date time input.
     *
     * @param {jQuery} $visible
     * @param {jQuery} $hidden
     * @param {Number} step
     * @param {String} operator
     */
    DateTimeElement.modifyTime = ($visible, $hidden, step, operator) => {
        const parts = new RegExp('(\\d+):(\\d+) (\\d+)-(\\d+)-(\\d+)').exec($visible.val());
        let date = new Date();
        if (parts !== null) {
            date = new Date(parts[5], parts[4]-1, parts[3], parts[1], parts[2], 0);
        }

        if (operator === '+') {
            date.setMinutes(date.getMinutes() + step);
        } else {
            date.setMinutes(date.getMinutes() - step);
        }

        const values = DateTimeElement.generateValues(
            DateTimeElement.roundDate(step, date)
        );

        $hidden.val(values.hidden).change();
        // Set visible date using flatpickr
        $visible[0]._flatpickr.setDate(values.visible, true);
    };

    /**
     * Initializes the DateTimeElement.
     *
     * @param {String} table
     * @param {String} uid
     * @param {String} field
     * @param {Number} step
     */
    DateTimeElement.initialize = (table, uid, field, step) => {
        DocumentService.ready().then(() => {
            if (![5, 10, 15, 30].includes(step)) {
                step = 15;
            }

            const $hidden = jQuery(`input[name="data[${table}][${uid}][${field}]"`);
            const $wrapper = $hidden.closest('.input-group');
            const $visible = $wrapper.find('input').first();

            $wrapper.find('.icon-actions-edit-pick-date').closest('.input-group-btn').remove();

            const idNow = `date-field-${table}-${uid}-${field}-now`;
            const idPlus = `date-field-${table}-${uid}-${field}-plus`;
            const idMinus = `date-field-${table}-${uid}-${field}-minus`;

            DateTimeElement.insertButton($wrapper, step, idNow, 'actions-clock', TYPO3.lang.select_current_day_time);
            DateTimeElement.insertButton($wrapper, step, idPlus, 'actions-add', '+' + step + ' ' + TYPO3.lang.unit_minutes);
            DateTimeElement.insertButton($wrapper, step, idMinus, 'actions-remove', '-' + step + ' ' + TYPO3.lang.unit_minutes);

            jQuery(`#${idNow}`).on('click', () => {
                const values = DateTimeElement.generateValues(
                    DateTimeElement.roundDate(step, new Date())
                );
                $hidden.val(values.hidden);
                // Set visible date using flatpickr
                $visible[0]._flatpickr.setDate(values.visible, true);
            });
            jQuery(`#${idPlus}`).on('click', () => DateTimeElement.modifyTime($visible, $hidden, step, '+'));
            jQuery(`#${idMinus}`).on('click', () => DateTimeElement.modifyTime($visible, $hidden, step, '-'));
        });
    };

    return DateTimeElement;
});
