## Laravel Permission UI

**Contributors:** Povilas Korop, Dario Fumagalli
**Tags:** laravel, spatie, package, permissions, bootstrap
**Requires at least:** 9.5
**Tested up to:** 10.1
**Stable tag:** 0.3.1
**License:** MIT
**License URI:** https://opensource.org/license/mit

This is an updated version of the abandoned [LaravelDaily/laravel-permission-ui](https://github.com/LaravelDaily/laravel-permission-ui) Laravel package.

## Description

Laravel Permission UI is a simple and intuitive dashboard for managing users roles and permissions in a Laravel application.

Its roles and permissions engine is based on the [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.

This Laravel Permission UI package has been forked from the [original](https://github.com/LaravelDaily/laravel-permission-ui) and has been ported to Bootstrap 4.

This fork is also an upgrade, featuring:

* A number of bug fixes, especially in the permissions editors.
* It comes with some additional settings.
* It comes with Italian and Spanish translations.
* It is compatible with [Laravel Admin LTE](https://github.com/jeroennoten/Laravel-AdminLTE). In a future version it will support integration with existing menus.

---

Original description, from original author Povilas Korop:

This package will create a simple Dashboard for managing roles/permissions based on the [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.

**Notice**: this is a very early version of the package, may be buggy. Please report issues.

---

## Installation

First, before installing this package, you need to have the `spatie/laravel-permission` installed and configured.

```sh
composer require dfumagalli/laravel-permission-ui
```

Go to `yourdomain.com/permissions` and you should see a simple dashboard with three menu items on top: to manage roles, permissions and assign them to users.

![Spatie Permission UI](https://laraveldaily.com/uploads/2022/10/laravel-permission-ui.png)

That dashboard is by default protected by the `auth` middleware, but you can configure it, by publishing the config:

```sh
php artisan vendor:publish --provider="dfumagalli\PermissionsUI\PermissionsUIServiceProvider" --tag="config"
```

And then edit the values in `config/permission_ui.php`:

```php
return [
    'middleware'        => ['web', 'auth'],
    'url_prefix'        => 'permissions',
    'route_name_prefix' => 'permission_ui.',
    'create_button_classes' => 'btn-primary',
    'edit_button_classes' => 'btn-primary',
    'save_button_classes' =>  'btn-primary',
    'delete_button_classes' => 'btn-danger',
];
```

The visual design is based on simple Bootstrap 4 classes.
At the moment, only button color customization options are available, but we may add them in the future, based on your ideas and feedback.

---

## Publishing translations

If you wish to translate the package, you may publish the language files using:

```sh
php artisan vendor:publish --provider="dfumagalli\PermissionsUI\PermissionsUIServiceProvider" --tag="lang"
```

---

## Testing

To run the package's unit tests, run the following command:

```sh
vendor/bin/phpunit
```

## FAQ

### What is this package about?

This package is a simple user roles and permissions editor. It is a front-end for the excellent [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.

### Does it work with Tailwind?

No, this package has been completely ported over to Bootstrap 4 / 5.

### What Laravel versions is this package compatible with?

It should work on Laravel 9 and 10.

### Is there a video about this package?

Yes, the original author, Povilas Korop, posted a [video on Youtube](https://www.youtube.com/watch?v=tzHP-rSi598) about this package.

