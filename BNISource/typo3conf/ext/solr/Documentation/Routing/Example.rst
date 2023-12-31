.. _routing-example:

=======
Example
=======

.. code-block:: yaml

  routeEnhancers:
    Products:
      type: SolrFacetMaskAndCombineEnhancer
      limitToPages:
        - 10
      extensionKey: tx_solr
      solr:
        multiValueSeparator: '+'
        replaceCharacters:
          ' ': '_'
        query:
          # To reduce the amount of parameters you can force Solr to concat the values.
          # For example you have following filter:
          #   tx_solr[filter][0]=taste:sweet&tx_solr[filter][1]=taste:sour&tx_solr[filter][2]=taste:matcha
          #
          # Concat will:
          # 1. collect all filters of the same type
          # 2. will sort all filter values alpha numeric
          # 3. join the values together
          #
          # As a result the query will modified into:
          #   tx_solr[filter][0]=taste:matcha,sour,sweet
          #
          # Note: If you active the mask option, the concat feature turn on automatically
          #
          concat: true
          # valueSeparator: ','

          # You can tell Solr to mask query facets. This feature require the map below
          #
          # For example you have following filter:
          #   tx_solr[filter][0]=taste:sweet&tx_solr[filter][1]=taste:sour&tx_solr[filter][2]=taste:matcha
          # Mask will:
          # 1. implode all values into a single string and sort it -> green,red,yellow
          # 2. replace tx_solr[filter][]=color: with color=
          #
          # As a result the query will modified into:
          # taste=matcha,sour,sweet
          #
          mask: true

          # In order to simplify a filter argument, you have to define a corresponding map value
          # There is no automatically reduction of filter parameters at the moment available.
          # The key is the name of your facet, the value what use instead.
          #
          # Important:
          # There are some restrictions for the values. The use of TYPO3 core parameters is prohibited.
          # This contains at the moment following strings: no_cache, cHash, id, MP, type
          map:
            color: color
            taste: taste
            product: product
      routePath: '/{type}'
      # Note: All arguments inside of namespace tx_solr. See -> extensionKey
      # Example: Argument 'type' define as 'filter-type' will convert into 'tx_solr/filter-type'
      _arguments:
        type: filter-type
      requirements:
        type: '.*'
