# Sprechende URLs

```yaml
routeEnhancers:
  ModulesPlugin:
    type: Plugin
    limitToPages:
      - 46
      - 102
      - 103
    routePath: '/{hash}'
    requirements:
      hash: '^[a-zA-Z0-9\|]{43}$'
```
