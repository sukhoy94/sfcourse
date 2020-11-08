### Useful snippets:

## bin/console

```
Maker bundle:
composer require symfony/maker-bundle --dev

annotations:
composer require doctrine/annotations

Make controller:
php bin/console make:controller MakeController
```

###annotation example:

```
without parameters:

/**
 * @Route("/", name="main")
 */

================================

with parameter:

/**
 * @Route("/custom/{id}", name="main")
 */

```