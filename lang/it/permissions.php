<?php

return [
    'global' => [
        'create'         => 'Crea',
        'edit'           => 'Modifica',
        'delete'         => 'Elimina',
        'save'           => 'Salva',
        'no_records'     => 'Nessuna riga.',
        'confirm_action' => "Si conferma l'operazione?",
    ],

    'permissions' => [
        'title'  => 'Permessi',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'created_at' => 'Creato il',
            'updated_at' => 'Modificato il',
        ],
        'title_create' => 'Crea un permesso',
        'title_edit' => 'Modifica un permesso'
    ],

    'roles' => [
        'title'  => 'Ruoli',
        'fields' => [
            'id'          => 'ID',
            'name'        => 'Nome',
            'permissions' => 'Permessi',
            'created_at'  => 'Creato il',
            'updated_at'  => 'Modificato il',
        ],
        'title_create' => 'Crea un ruolo',
        'title_edit' => 'Modifica un ruolo'
    ],

    'users' => [
        'title'  => 'Utenti',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'email'      => 'Email',
            'roles'      => 'Ruoli',
            'created_at' => 'Creato il',
            'updated_at' => 'Modificato il',
        ],
        'title_edit' => "Assegna ruoli all'utente"
    ],
];
