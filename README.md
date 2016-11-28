Yii 2 shop example project
==========================

This is example project implementing a shop created to help people learn Yii 2.0. It was created during 8 hours workshop performed in Ekaterinburg, Russia. The idea was to show how to deal with Gii, grids, filtering and other Yii 2.0 usage. It is by no means a complete shop script. It may contain bugs, shortcuts etc.

> If you want to take over the project and develop it further, let @samdark know and you'll be granted permissions required.

There are slides from the workshop in Russian: http://slides.rmcreative.ru/2014/yii2-master/

It is built on top of advanced template which includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
git clone https://github.com/samdark/yii2-shop.git
composer self-update
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd yii2-shop
composer install
~~~


GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/yii2shop/frontend/web/` and using the URL `http://shop.local/`
- for backend `/path/to/yii2shop/backend/web/` and using the URL `http://admin.shop.local/`

To login into the application, you need to first sign up, with any of your email address, username and password.
Then, you can login into the application with same email address and password at any time.
