## Laravel Permission UI

**Tags:** laravel, spatie, package, permissions, tailwindcss
**Requires at least:** 9.5
**Tested up to:** 12.20
**Stable tag:** 0.1.0
**License:** MIT
**License URI:** https://opensource.org/license/mit

This is a fork of [dfumagalli/laravel-permission-ui](https://github.com/dfumagalli/laravel-permission-ui) which in turn is an updated version of the abandoned [LaravelDaily/laravel-permission-ui](https://github.com/LaravelDaily/laravel-permission-ui) Laravel package.

## Description

Laravel Permission UI is a simple and intuitive dashboard for managing users roles and permissions in a Laravel application.

Its roles and permissions engine is based on the [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.

This Laravel Permission UI package has been ported to Tailwind CSS 4.

---

Original description, from original author Povilas Korop:

This package will create a simple Dashboard for managing roles/permissions based on the [spatie/laravel-permission](https://github.com/spatie/laravel-permission) package.

**Notice**: this is a very early version of the package, may be buggy. Please report issues.

---

## Installation

First, before installing this package, you need to have the `spatie/laravel-permission` installed and configured.

```sh
composer require virlatinus/laravel-permission-ui
```

Go to `yourdomain.com/permissions` and you should see a simple dashboard with three menu items on top: to manage roles, permissions and assign them to users.

![Spatie Permission UI](https://laraveldaily.com/uploads/2022/10/laravel-permission-ui.png)

That dashboard is by default protected by the `auth` middleware, but you can configure it, by publishing the config:

```sh
php artisan vendor:publish --provider="virlatinus\PermissionsUI\PermissionsUIServiceProvider" --tag="config"
```

And then edit the values in `config/permission_ui.php`:

```php
return [
    'middleware'        => ['web', 'auth'],
    'url_prefix'        => 'permissions',
    'route_name_prefix' => 'permission_ui.',
];
```

The visual design is based on Tailwind CSS 4 classes.

---

## Publishing assets

If it's not done automatically during installation, you can publish the blade views using:

```sh
php artisan vendor:publish --provider="virlatinus\PermissionsUI\PermissionsUIServiceProvider" --tag="permission_ui-assets"
```

---

## Publishing translations

If you wish to translate the package, you may publish the language files using:

```sh
php artisan vendor:publish --provider="virlatinus\PermissionsUI\PermissionsUIServiceProvider" --tag="lang"
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

Yes, this package has been completely ported over to Tailwind CSS 4.

### What Laravel versions is this package compatible with?

It should work on Laravel 9 up to 12.

### Is there a video about this package?

Yes, the original author, Povilas Korop, posted a [video on YouTube](https://www.youtube.com/watch?v=tzHP-rSi598) about this package.

