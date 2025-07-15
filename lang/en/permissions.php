<?php

return [
    'global' => [
        'create'          => 'Create',
        'edit'            => 'Edit',
        'delete'          => 'Delete',
        'bulk_edit'       => 'Bulk edit',
        'delete_all'      => 'Delete all',
        'save'            => 'Save',
        'cancel'          => 'Cancel',
        'no_records'      => 'No records.',
        'confirm_action'  => 'Are you sure?',
        'ignore_password' => "Leave password empty if you don't want to change it",
    ],

    'permissions' => [
        'title'   => 'Permissions',
        'heading' => 'Manage your application permissions',
        'fields'  => [
            'id'         => 'ID',
            'name'       => 'Permission',
            'roles'      => 'Roles',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'title_create' => 'Create a permission',
        'title_edit'   => 'Edit a permission',
        'title_edit_multi'   => 'Assign roles to multiple permissions',
    ],

    'roles' => [
        'title'   => 'Roles',
        'heading' => 'Manage your application roles',
        'fields'  => [
            'id'          => 'ID',
            'name'        => 'Name',
            'permissions' => 'Permissions',
            'created_at'  => 'Created at',
            'updated_at'  => 'Updated at',
        ],
        'title_create' => 'Create a role',
        'title_edit'   => 'Edit a role',
        'title_edit_multi'   => 'Assign permissions to multiple roles',
    ],

    'users' => [
        'title'   => 'Users',
        'heading' => 'A list of all the users in your system including their name, email and roles',
        'fields'  => [
            'id'       => 'ID',
            'name'     => 'Name',
            'email'    => 'Email',
            'password' => 'Password',
            'verify'   => [
                'label'       => 'Verify user',
                'description' => 'Skip email verification on their first login',
                ],
            'roles'      => 'Roles',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
        ],
        'title_create' => 'Create a user',
        'title_edit'   => 'Assign roles to user',
        'title_edit_multi'   => 'Assign roles to multiple users',
    ],
];
