# Bootstrap4 Migration

Folge den nächsten Migrations-Schritten um zu Bootstrap 4 zu migrieren.

1.  **Label CSS-Klassen**

    Alt:
    ```typo3_typoscript
    css {
        class {
            label = control-label
        }
    }
    ```
    Neu:
    ```typo3_typoscript
    css {
        class {
            label = col-form-label
        }
    }
    ```

2.  **Fieldset ohne row-Klasse**

    Alt:
    ```xml
    <fieldset class="{fieldset.css.class.fieldset}" style="{fieldset.css.style.fieldset}">
    ...
    </fieldset>
    ```

    ```typo3_typoscript
    fieldset.css.class.fieldset = row
    ```

    Neu:
    ```xml
    <fieldset class="{fieldset.css.class.fieldset}" style="{fieldset.css.style.fieldset}">
        <div class="{fieldset.css.class.fieldsetInner}" style="{fieldset.css.style.fieldsetInner}">
        ...
        </div>
    </fieldset>
    ```

    ```typo3_typoscript
    fieldset.css.class.fieldset =
    fieldset.css.class.fieldsetInner = row
    ```

3.  **Input groups**

    Alt:
    ```xml
    <span class="input-group-addon">
        <i class="{field.css.class.icon.calendar}"></i>
    </span>
    ```

    Neu:
    ```xml
    <div class="input-group-append">
        <div class="input-group-text">
            <i class="{field.css.class.icon.calendar}"></i>
        </div>
    </div>
    ```

4.  **Checkboxen**

    Alt:
    ```xml
    <label for="form-{formUid}-{fieldsetKey}-{fieldKey}">
        <f:form.checkbox value="{field.value}"
                         name="form-{formUid}-{fieldsetKey}-{fieldKey}" id="form-{formUid}-{fieldsetKey}-{fieldKey}"
                         class="{field.css.class.field}" style="{field.css.style.field}" />
        <span class="{field.css.class.notice}" style="{field.css.style.notice}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-notice"><f:format.raw>{field.notice}</f:format.raw></span>
        <span class="{field.css.class.message}" style="{field.css.style.message}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-message"></span>
    </label>
    ```

    Neu:
    ```xml
    <div class="{field.css.class.fieldWrapper}" style="{field.css.style.fieldWrapper}">
        <f:form.checkbox value="{field.value}"
                         name="form-{formUid}-{fieldsetKey}-{fieldKey}" id="form-{formUid}-{fieldsetKey}-{fieldKey}"
                         class="{field.css.class.field}" style="{field.css.style.field}" />
        <label class="{field.css.class.checkboxLabel}" style="{field.css.style.checkboxLabel}" for="form-{formUid}-{fieldsetKey}-{fieldKey}">
            <f:format.raw>{field.checkboxLabel}</f:format.raw>
        </label>
        <span class="{field.css.class.notice}" style="{field.css.style.notice}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-notice"><f:format.raw>{field.notice}</f:format.raw></span>
        <span class="{field.css.class.message}" style="{field.css.style.message}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-message"></span>
    </div>
    ```

5.  **Hilfe-Text**

    Alt:
    ```xml
    <span class="{field.css.class.notice}" style="{field.css.style.notice}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-notice"><f:format.raw>{field.notice}</f:format.raw></span>
    ```

    ```typo3_typoscript
    css.class.notice = help-block
    ```

    Neu:
    ```xml
    <small class="{field.css.class.notice}" style="{field.css.style.notice}" id="form-{formUid}-{fieldsetKey}-{fieldKey}-notice"><f:format.raw>{field.notice}</f:format.raw></small>
    ```

    ```typo3_typoscript
    css.class.notice = form-text
    ```




