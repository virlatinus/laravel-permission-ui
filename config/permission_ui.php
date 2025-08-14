<?php

return [
    'middleware'        => ['web', 'auth'],
    'url_prefix'        => 'permissions',
    'route_name_prefix' => 'permission_ui.',
    'base_url'          => config('app.url', 'http://localhost'),
    'use_https'         => true, // whether to force HTTPS for URLs

    'pagination_page_size'  => 10,

    // The following are only necessary if the package "spatie/laravel-multitenant" is installed
    'enable_tenants_admin'  => false, // whether to show the Tenants menu

    'enable_user_permissions' => true, // whether to manage permissions per user

    // Add this column to the User model and to the fillable array
    'tenant_id_column'       => 'tenant_id',
    'tenant_id_relationship' => 'tenant',
];
