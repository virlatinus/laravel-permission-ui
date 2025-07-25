<?php

return [
    'middleware'        => ['web', 'auth'],
    'url_prefix'        => 'permissions',
    'route_name_prefix' => 'permission_ui.',
    // Only necessary if the package "spatie/laravel-multitenant" is installed
    'tenant_id_column'  => 'tenant_id.',
];
