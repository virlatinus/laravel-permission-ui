<?php

return [
    'global' => [
        'create'         => 'Criar',
        'edit'           => 'Editar',
        'delete'         => 'Excluir',
        'save'           => 'Salvar',
        'no_records'     => 'Nenhum registro encontrado.',
        'confirm_action' => 'Tem certeza?',
    ],

    'permissions' => [
        'title'  => 'Permissões',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ],
        'title_create' => 'Criar uma permissão',
        'title_edit' => 'Editar uma permissão'
    ],

    'roles' => [
        'title'  => 'Funções',
        'fields' => [
            'id'          => 'ID',
            'name'        => 'Nome',
            'permissions' => 'Permissões',
            'created_at'  => 'Criado em',
            'updated_at'  => 'Atualizado em',
        ],
        'title_create' => 'Criar um papel',
        'title_edit' => 'Editar um papel'
    ],

    'users' => [
        'title'  => 'Usuários',
        'fields' => [
            'id'         => 'ID',
            'name'       => 'Nome',
            'email'      => 'E-mail',
            'roles'      => 'Funções',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ],
        'title_edit' => 'Atribuir funções ao usuário'
    ],
];
