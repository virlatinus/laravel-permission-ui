<?php

return [
    'global' => [
        'create'          => 'Insertar',
        'edit'            => 'Editar',
        'delete'          => 'Eliminar',
        'bulk_edit'       => 'Editar todos',
        'delete_all'      => 'Eliminar todos',
        'save'            => 'Guardar',
        'cancel'          => 'Cancelar',
        'no_records'      => 'No hay registros.',
        'confirm_action'  => '¿Estás seguro?',
        'ignore_password' => "Deje la contraseña vacía si no desea cambiarla",
    ],

    'permissions' => [
        'title'   => 'Permisos',
        'heading' => 'Administra los permisos de la aplicación',
        'fields'  => [
            'id'         => 'ID',
            'name'       => 'Permiso',
            'roles'      => 'Roles',
            'created_at' => 'Creado en',
            'updated_at' => 'Actualizado en',
        ],
        'title_create' => 'Crear un permiso',
        'title_edit'   => 'Editar un permiso',
        'title_edit_multi'   => 'Asignar roles a múltiples permisos',
    ],

    'roles' => [
        'title'   => 'Roles',
        'heading' => 'Administra los roles de la aplicación',
        'fields'  => [
            'id'          => 'ID',
            'name'        => 'Nombre',
            'permissions' => 'Permisos',
            'created_at'  => 'Creado en',
            'updated_at'  => 'Actualizado en',
        ],
        'title_create' => 'Crear un rol',
        'title_edit'   => 'Editar un rol',
        'title_edit_multi'   => 'Asignar permisos a múltiples roles',
    ],

    'users' => [
        'title'   => 'Usuarios',
        'heading' => 'Administra los usuarios del sistema',
        'fields'  => [
            'id'       => 'ID',
            'name'     => 'Nombre',
            'email'    => 'Correo',
            'password' => 'Password',
            'verify'   => [
                'label'       => 'Verificar usuario',
                'description' => 'No verificar el email al primer login del usuario',
            ],
            'roles'      => 'Roles',
            'created_at' => 'Creado en',
            'updated_at' => 'Actualizado en',
        ],
        'title_create' => 'Crear un usuario',
        'title_edit'   => 'Asignar roles al usuario',
        'title_edit_multi'   => 'Asignar roles a múltiples usuarios',
    ],
];
