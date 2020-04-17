<?php

declare(strict_types=1);

    # arquivo de configuração de acesso às rotas
    # accessallowed = [rotas que não necessitam de autenticação do token]
    # accessdenied = [rotas que necessitam de autenticação do token]
return [

    'routes' => [
        'login' => [
            'authentication.post_login'
        ],
        'accessallowed' => [

        ],
        'accessdenied' => [
            'users.post_users',
            'users.get_all_users',
            'users.get_user_by_id',
            'users.put_users',
        ]
    ]
];
