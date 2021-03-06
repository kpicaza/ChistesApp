Chistes App - Symfony Standard Edition
======================================

[![Build Status](https://travis-ci.org/kpicaza/ChistesApp.svg?branch=master)](https://travis-ci.org/kpicaza/ChistesApp)
[![Coverage Status](https://coveralls.io/repos/github/kpicaza/ChistesApp/badge.svg?branch=master)](https://coveralls.io/github/kpicaza/ChistesApp?branch=master)

Welcome to the Chistes App - Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

In addition it comes whith a sample CRUD bundle made by TDD and repository pattern, as example.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

To run application foolow installation instructions below.

Insatalation:
-------------

1. Clone this repository:
    
        git clone git@github.com:kpicaza/ChistesApp.git chistesapp

1. Create new database, for example:

        mysql -u root -p
        create database chistesapp;
        \q

1. Install dependencies by composer (After instaling dependencies composer will prompt  some  comfiguration params):

        composer install

1. Update database schema and load data fixtures for testing

        php bin/console doctrine:schema:update --force
        php bin/console doctrine:fixtures:load -n
        php bin/console doctrine:database:create --env=test
        php bin/console doctrine:schema:update --force --env=test
        php bin/console doctrine:fixtures:load -n --env=test

1. Run tests:

        phpunit --coverage-text 

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/3.0/book/installation.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.0/book/doctrine.html
[8]:  https://symfony.com/doc/3.0/book/templating.html
[9]:  https://symfony.com/doc/3.0/book/security.html
[10]: https://symfony.com/doc/3.0/cookbook/email.html
[11]: https://symfony.com/doc/3.0/cookbook/logging/monolog.html
[13]: https://symfony.com/doc/3.0/bundles/SensioGeneratorBundle/index.html
