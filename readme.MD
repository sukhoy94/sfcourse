certification - https://thomasberends.github.io/symfony-certification-preparation-list/

### Useful snippets:

## bin/console

```
Maker bundle:
composer require symfony/maker-bundle --dev

Annotations:
composer require doctrine/annotations

Make controller:
php bin/console make:controller MakeController

```

## annotation example:

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

## phpstan

``
vendor\bin\phpstan analyse -l 8 src
``