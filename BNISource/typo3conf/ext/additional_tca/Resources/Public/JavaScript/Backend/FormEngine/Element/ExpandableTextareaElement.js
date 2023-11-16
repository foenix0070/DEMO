define(['jquery', 'TYPO3/CMS/Core/DocumentService'], function (jQuery, DocumentService) {
    /**
     * @type {{initialize}}
     * @exports TYPO3/CMS/Backend/FormEngine/Element/ExpandableTextareaElement
     */
    const ExpandableTextareaElement = {};

    /**
     * Initializes the ExpandableTextareaElement.
     */
    ExpandableTextareaElement.initialize = function(id, expandedInitially) {
        DocumentService.ready().then(() => {
            //
            // Add toggle visibility button under expandable-text field
            let $appendableTextarea = jQuery('#'+id);
            if ($appendableTextarea.length) {
                let $wrapper = $appendableTextarea.closest('.formengine-field-item');
                $wrapper.parent().append(
                    '<div class="input-group-append">\n' +
                    '  <button class="btn btn-light" type="button" id="toggle-' + id + '" title="Hide">\n' +
                    '    <span class="t3js-icon icon icon-size-small icon-state-default icon-actions-eye" data-identifier="actions-eye">\n' +
                    '      <span class="icon-markup">\n' +
                    '        <svg class="icon-color">\n' +
                    '          <use xlink:href="/typo3/sysext/core/Resources/Public/Icons/T3Icons/sprites/actions.svg#actions-eye"></use>\n' +
                    '        </svg>\n' +
                    '      </span>\n' +
                    '    </span>\n' +
                    '  </button>\n' +
                    '</div>'
                );
                let $collapse = jQuery('#toggle-' + id);
                $collapse.on('click', function () {
                    if ($wrapper.is(':visible')) {
                        $wrapper.slideUp();
                    } else {
                        $wrapper.slideDown();
                    }
                });
                if (!expandedInitially) {
                    $wrapper.slideUp();
                }
            }

        });

    };

    return ExpandableTextareaElement;
});
