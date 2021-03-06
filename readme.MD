certification - https://thomasberends.github.io/symfony-certification-preparation-list/

phpstan: https://phpstan.org/

### Useful snippets:

## bin/console

```
Maker bundle:
composer require symfony/maker-bundle --dev

Annotations:
composer require doctrine/annotations

Make controller:
php bin/console make:controller MakeController

Shpw route list
php bin/console debug:router

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

## TWIG

- extend a template
```
{% extends('base.html.twig') %}
```
! Remember that if template extends another template, it should containe {% block %} tag

- generate url to route

```
{{ path($routeName) }}
```

- generate url to route with params

```
{{ path($routeName, {paramnane: paramvalue}) }}
```

## Doctrine

```
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate

$post = new Post();
$post->setTitle('Firts post');
$em = $this->getDoctrine()->getManager();
$em->persist($post);
$em->flush();
```

## Forms
```
php bin/console make:form - create Form class

-------------------- in controller -----------------------------

$post = new Post();
$form = $this->createForm(PostType::class, $post);
$form->handleRequest($request);

if ($form->isSubmitted()) {
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($post);
    $entityManager->flush();
    
    return $this->redirect($this->generateUrl('posts.index'));
}

return $this->render('post/create.html.twig', [
    'form' => $form->createView(),
]);
------------------------------------------------------------------

------------------ iu form class ---------------------------------

public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('title')
        ->add('save', SubmitType::class)
    ;
}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Post::class,
    ]);
}
------------------------------------------------------------------
```