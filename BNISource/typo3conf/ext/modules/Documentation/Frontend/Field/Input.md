# Textfeld Form-Element

## Eigenschaften

| Eigenschaft  | dgfsdf |
| ------------ | ------ |
| label        | Bezeichner am Eingabefeld  |
| placeholder  | Platzhalter im Eingabefeld |
| type         | In diesem Fall *Input* - Fluid-Partial `Field/Input.html` |
| inputType    | Typ des HTML-Inputs, bspw. *text, email, integer, float, tel* |
| section      | Section im Fluid-Partial, bspw. *Default* |
| required     |
| readonly     |
| validation   | Liste mit Validatoren |
| css          | Liste mit CSS-Klassen und Styles |


## Vorlagen

```typo3_typoscript
title < plugin.tx_modules.presets.fields.input
title {
    label = Title
    placeholder = Title...
    required = 1
    validation {
        NotEmpty = Please enter a title
    }
}
```

### plugin.tx_modules.presets.fields.input



