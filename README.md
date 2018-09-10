FrequenceWebContactBundle
=========================

[![Build Status](https://travis-ci.org/yohang/FrequenceWebContactBundle.png?branch=master)](https://travis-ci.org/yohang/FrequenceWebContactBundle)

An event-based Symfony2 Contact Bundle.

Installation
------------

### Install the bundle via composer

```sh
 $ composer require frequence-web/contact-bundle:1.0.*
```

### Add the bundle to your `AppKernel` class

```php

    public function registerBundles()
    {
        return array(
            // ... Your bundles
            new \FrequenceWeb\Bundle\ContactBundle\FrequenceWebContactBundle(),
        );
    }

```

Configuration
-------------

This bundle provides some configuration options :

```yaml

frequence_web_contact:
    send_mails: true                # True to use the bundle EmailListener that send emails when contact form is submited
    to:         null                # The contact mail recipient
    from:       null                # The contact mail sender
    subject:    contact.message.new # The contact mail subject translation key

```

Also yo can create a fixed select to split emails via multiple departaments

```yaml

frequence_web_contact:
    send_mails: true                # True to use the bundle EmailListener that send emails when contact form is submited
    from:       null                # The contact mail sender
    fixed_to_and_subject:
      - { title: "Departarment 1", email:  "departament1@example.com" }
      - { title: "Departarment 2", email:  "departament2@example.com" }
      - { title: "Departarment 3", email:  "departament3@example.com" }
```

Routing
-------

If you want to use the default bundle urls, just import the routing file in your application routing:

```yaml
    _frequence_web_contact:
        resource: '@FrequenceWebContactBundle/Resources/config/routing.xml'
```

This will create 2 routes, with the same URL (/contact.html), one for displaying the contact
form (GET), the other to submit data (POST)

Creating Listener
-----------------

If you want to make a more featured mail listener, or any other listener, you have to define your own.
The dispatched event on success contact form submit is `contact.submit`, and receive a
`FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent`.

If you need an example, juste have a look to
`FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Listener\EmailContactListener`.

Extending
---------

If you need more datas that the few ones provided by the `Contact` class and the `ContactType` form type, just
override the `frequence_web_contact.type.class` and `frequence_web_contact.model.class` configuration parameters,
they are used to instantiate services and can be extended without any limit.
