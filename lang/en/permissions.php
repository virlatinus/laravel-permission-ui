<?php

return [
    'global' => [
        'create'         => 'Create',
        'edit'           => 'Edit',
        'delete'         => 'Delete',
        'save'           => 'Save',
        'no_records'     => 'No records.',
        'confirm_action' => 'Are you sure?',
    ],

    'permissions' => [
        'title'  => 'Permissions',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Name',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'title_create' => 'Create a permission',
        'title_edit' => 'Edit a permission'
    ],

    'roles' => [
        'title'  => 'Roles',
        'fields' => [
            'id'          => 'ID',
            'name'        => 'Name',
            'permissions' => 'Permissions',
            'created_at'  => 'Created at',
            'updated_at'  => 'Updated at',
        ],
        'title_create' => 'Create a role',
        'title_edit' => 'Edit a role'
    ],

    'users' => [
        'title'  => 'Users',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Name',
            'email'      => 'Email',
            'roles'      => 'Roles',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'title_edit' => 'Assign roles to user'
    ],
];
