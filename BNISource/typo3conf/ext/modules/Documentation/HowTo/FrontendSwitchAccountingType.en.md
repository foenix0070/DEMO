# Manage banking details at registration

If you want to display bank data fields during *registration* or *edit profile* only if direct debit is selected, use JavaScript as follows:

```javascript
jQuery(function() {
    var accountingTypeSelect = jQuery('#registration_accounting_type');
    if(accountingTypeSelect.length > 0) {
        switchUserAccountingType(accountingTypeSelect.val());
        accountingTypeSelect.on('change', function() {
            switchUserAccountingType(jQuery(this).val());
        });
    }
});

function switchUserAccountingType(accountingType) {
    if(accountingType === 'accounting') {
        jQuery('#registration_bank_account_owner_name').parent().hide();
        jQuery('#registration_bank_account_bank_name').parent().hide();
        jQuery('#registration_bank_account_bic').parent().hide();
        jQuery('#registration_bank_account_iban').parent().hide();
        jQuery('#profile_bank_account_owner_name').parent().hide();
        jQuery('#profile_bank_account_bank_name').parent().hide();
        jQuery('#profile_bank_account_bic').parent().hide();
        jQuery('#profile_bank_account_iban').parent().hide();
    }
    else {
        jQuery('#registration_bank_account_owner_name').parent().show();
        jQuery('#registration_bank_account_bank_name').parent().show();
        jQuery('#registration_bank_account_bic').parent().show();
        jQuery('#registration_bank_account_iban').parent().show();
        jQuery('#profile_bank_account_owner_name').parent().show();
        jQuery('#profile_bank_account_bank_name').parent().show();
        jQuery('#profile_bank_account_bic').parent().show();
        jQuery('#profile_bank_account_iban').parent().show();
    }
}
```
