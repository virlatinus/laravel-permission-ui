<?php

return [
    'global' => [
        'create'          => 'Crea',
        'edit'            => 'Modifica',
        'delete'          => 'Elimina',
        'bulk_edit'       => 'Modifica tutti',
        'delete_all'      => 'Elimina tutti',
        'save'            => 'Salva',
        'cancel'          => 'Cancella',
        'no_records'      => 'Nessuna riga.',
        'confirm_action'  => "Si conferma l'operazione?",
        'ignore_password' => "Lascia la password vuota se non vuoi cambiarla",
    ],

    'permissions' => [
        'title'   => 'Permessi',
        'heading' => "Gestire le autorizzazioni dell'applicazione",
        'fields'  => [
            'id'         => 'ID',
            'name'       => 'Permesso',
            'roles'      => 'Ruoli',
            'created_at' => 'Creato il',
            'updated_at' => 'Modificato il',
        ],
        'title_create' => 'Crea un permesso',
        'title_edit'   => 'Modifica un permesso',
        'title_edit_multi'   => 'Assegnare ruoli a più autorizzazioni',
    ],

    'roles' => [
        'title'   => 'Ruoli',
        'heading' => 'Gestisci i ruoli della tua candidatura',
        'fields'  => [
            'id'          => 'ID',
            'name'        => 'Nome',
            'permissions' => 'Permessi',
            'created_at'  => 'Creato il',
            'updated_at'  => 'Modificato il',
        ],
        'title_create' => 'Crea un ruolo',
        'title_edit'   => 'Modifica un ruolo',
        'title_edit_multi'   => 'Assegnare autorizzazioni a più ruoli',
    ],

    'users' => [
        'title'   => 'Utenti',
        'heading' => 'Un elenco di tutti gli utenti nel tuo sistema, inclusi nome, e-mail e ruoli',
        'fields'  => [
            'id'       => 'ID',
            'name'     => 'Nome',
            'email'    => 'Email',
            'password' => 'Password',
            'verify'   => [
                'label'       => 'Verifica utente',
                'description' => "Salta la verifica dell'email al primo accesso",
            ],
            'roles'      => 'Ruoli',
            'created_at' => 'Creato il',
            'updated_at' => 'Modificato il',
        ],
        'title_create' => 'Crea un utente',
        'title_edit'   => "Assegna ruoli all'utente",
        'title_edit_multi'   => 'Assegnare ruoli a più utenti',
    ],
];
