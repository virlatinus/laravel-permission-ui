<?php

return [
    'global' => [
        'create'         => 'Insertar',
        'edit'           => 'Editar',
        'delete'         => 'Eliminar',
        'save'           => 'Guardar',
        'no_records'     => 'No hay registros.',
        'confirm_action' => '¿Estás seguro?',
    ],

    'permissions' => [
        'title'  => 'Permisos',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nombre',
            'created_at' => 'Creado en',
            'updated_at' => 'Actualizado en',
        ],
        'title_create' => 'Crear un permiso',
        'title_edit' => 'Editar un permiso'
    ],

    'roles' => [
        'title'  => 'Roles',
        'fields' => [
            'id'          => 'ID',
            'name'        => 'Nombre',
            'permissions' => 'Permisos',
            'created_at'  => 'Creado en',
            'updated_at'  => 'Actualizado en',
        ],
        'title_create' => 'Crear un rol',
        'title_edit' => 'Editar un rol'
    ],

    'users' => [
        'title'  => 'Users',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nombre',
            'email'      => 'Correo',
            'roles'      => 'Roles',
            'created_at' => 'Creado en',
            'updated_at' => 'Actualizado en',
        ],
        'title_edit' => 'Asignar roles al usuario'
    ],
];
