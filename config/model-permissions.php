<?php

declare(strict_types=1);

use App\Models\User;

return [
    'guard_name' => 'web',
    'models'     => [
        User::class
    ],
    'abilities' => [
        'viewAny',
        'view',
        'create',
        'update',
        'delete',
        'restore',
        'forceDelete',
        'replicate',
        'deleteAny',
        'forceDeleteAny',
        'restoreAny',
        'attach',
        'attachAny',
        'detach',
        'add',
    ],
    'super_admin_role' => 'Super Admin',
    'roles'            => [
        [
            'name'       => 'Manager',
            'guard_name' => 'web',
            'models'     => ['*'],
            'abilities'  => ['viewAny', 'view', 'create', 'update', 'delete'],
        ],
        [
            'name'       => 'Viewer',
            'guard_name' => 'web',
            'models'     => ['*'],
            'abilities'  => ['viewAny', 'view'],
        ],
        [
            'name'       => 'User',
            'guard_name' => 'web',
            'models'     => ['*'],
            'abilities'  => ['viewAny', 'view'],
        ],
    ],
    'modules' => [
        'discover'          => true,
        'model_directories' => ['Entities', 'Models'],
        'policy_directory'  => 'Policies',
        'models'            => [],
    ],
];
