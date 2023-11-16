# Field options and validators

## Field options

### Checkbox

| **Field/Validator**   | default | Type    | Description                                   |
|:----------------------|:--------|:--------|:----------------------------------------------|
| **htmlSpecialChars:** | 1       | boolean | If `0` the label HTML won't be escaped.       |
| **excludeFromMail:**  | 0       | boolean | If `1` the field won't be displayed in emails |
| **excludeFromPdf:**   | 0       | boolean | If `1` the field won't be displayed in pdfs   |

### Notice

| **Field/Validator**   | default | Type    | Description                                   |
|:----------------------|:--------|:--------|:----------------------------------------------|
| **htmlSpecialChars:** | 1       | boolean | If `0` the label HTML won't be escaped.       |
| **excludeFromMail:**  | 0       | boolean | If `1` the field won't be displayed in emails |
| **excludeFromPdf:**   | 0       | boolean | If `1` the field won't be displayed in pdfs   |



## Field validators

*	**NotEmpty:** Field must be filled.

	>	**Notice:**
	>
	>	A Select or Radio value is `NotEmpty` too, when it's filled with the keyword `empty`!

*	**MathGuard:** MathGuard Captcha must be solved.
*	**Email:** Field must be filled with a valid email address.
*	**Empty:** Field must be empty.

### Validator overview

| **Field/Validator** | NotEmpty | MathGuard | Email | Empty |
|:--------------------|:---------|:----------|:------|:------|
| **Hidden:**         | x        | -         | -     | x     |
| **Input:**          | x        | -         | x     | x     |
| **Textarea:**       | x        | -         | -     | -     |
| **DateTime:**       | x        | -         | -     | -     |
| **Checkbox:**       | x        | -         | -     | -     |
| **Select:**         | x        | -         | -     | -     |
| **Radio:**          | x        | -         | -     | -     |
| **Captcha:**        | x        | x         | -     | -     |
| **Notice:**         | -        | -         | -     | -     |
| **Submit:**         | -        | -         | -     | -     |
| **Upload:**         | -        | -         | -     | -     |

