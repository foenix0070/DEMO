# TYPO3 Paginated DatabaseQuery Processor

## What does it do?

Basically, it's a DatabaseQueryProcessor of TYPO3 with added pagination.

## Installation

`composer require spooner-web/paginated-processor`

## Usage

1. Include static templates named "TYPO3 PaginatedDatabaseQueryProcessor"
2. Use the DataProcessor in TypoScript with pagination settings (see [Configuration section](#Configuration))
3. Enrich your Listing Fluid template  

### <a id="Configuration">Configuration in TypoScript</a>

```typo3_typoscript
dataProcessing {
  10 = SpoonerWeb\PaginatedProcessor\DataProcessing\PaginatedDatabaseQueryProcessor
  10 {
    # Basic settings you use in DatabaseQueryProcessor
    # Additionally you need this section:
    paginate {
      activate = 1
      itemsPerPage = 5
      insertAbove = 1
      insertBelow = 0
      parameterIndex = tx_myrecords
    }
  }
}
```

### Add partials in your listing template

```html
<f:render partial="Pagination" arguments="{pagination: pagination, parameter: 'tx_myrecords', above: 1}" />
<ol>
    <f:for each="{records}" as="item">
        ...
    </f:for>
</ol>
<f:render partial="Pagination" arguments="{pagination: pagination, parameter: 'tx_myrecords', below: 1}" />
``` 

### What to care about?

* The partial is included for Fluid Styled Content elements with the integration of static template
* You need to add the path to the partial when you want to use it in your own extension
