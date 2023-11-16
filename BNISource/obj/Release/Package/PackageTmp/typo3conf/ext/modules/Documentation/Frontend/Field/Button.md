# Button Form-Element

Action-Button bspw. um einen *zurück* Button zu realisieren.



```typo3_typoscript
cancelAndBackToListButton {
    label = Cancel
    type = Button
    section = Default
    title = Cancel and back to list
    # Action on controller
    action = list
    # Controller for the action
    controller = Frontend\Immobilie
    css {
        class {
            wrapper = form-group form-input-button pull-left mr-1
            label =
            fieldWrapper =
            field = btn btn-primary
            notice = form-text
        }
    }
}
```
