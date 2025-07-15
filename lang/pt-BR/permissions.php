<?php

return [
    'global' => [
        'create'          => 'Criar',
        'edit'            => 'Editar',
        'delete'          => 'Excluir',
        'bulk_edit'       => 'Editar todos',
        'delete_all'      => 'Excluir todos',
        'save'            => 'Salvar',
        'cancel'          => 'Cancelar',
        'no_records'      => 'Nenhum registro encontrado.',
        'confirm_action'  => 'Tem certeza?',
        'ignore_password' => "Deixe a senha em branco se não quiser alterá-la",
    ],

    'permissions' => [
        'title'   => 'Permissões',
        'heading' => 'Gerenciar as permissões do aplicativo',
        'fields'  => [
            'id'         => 'ID',
            'name'       => 'Permissão',
            'roles'      => 'Funções',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ],
        'title_create' => 'Criar uma permissão',
        'title_edit'   => 'Editar uma permissão',
        'title_edit_multi'   => 'Atribuir funções a várias permissões',
    ],

    'roles' => [
        'title'   => 'Funções',
        'heading' => 'Gerencie suas funções de aplicativo',
        'fields'  => [
            'id'          => 'ID',
            'name'        => 'Nome',
            'permissions' => 'Permissões',
            'created_at'  => 'Criado em',
            'updated_at'  => 'Atualizado em',
        ],
        'title_create' => 'Criar um papel',
        'title_edit'   => 'Editar um papel',
        'title_edit_multi'   => 'Atribuir permissões a várias funções',
    ],

    'users' => [
        'title'   => 'Usuários',
        'heading' => 'Uma lista de todos os usuários em seu sistema, incluindo seus nomes, e-mails e funções',
        'fields'  => [
            'id'       => 'ID',
            'name'     => 'Nome',
            'email'    => 'E-mail',
            'password' => 'Password',
            'verify'   => [
                'label'       => 'Verificar usuário',
                'description' => 'Pular verificação de e-mail no primeiro login',
            ],
            'roles'      => 'Funções',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ],
        'title_create' => 'Criar um usuário',
        'title_edit'   => 'Atribuir funções ao usuário',
        'title_edit_multi'   => 'Atribuir funções a vários usuários',
    ],
];
