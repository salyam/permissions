# Permissions #

# Table of Contents #

1. [Permissions](#pobaltblue)
2. [Installation](#installation)
2. [Usage](#usage)

# Installation #

Installing Permissions should be pretty simple:
1. Download via Composer:

        composer require salyam/permissions
2. Include the following line in app/User.php:

        use \Salyam\Permissions\Traits\User;
3. Run the following command to publish available views:

        php artisan vendor:publish
    After everything is published, the available views can be changed under views/salyam/permissions folder.


# Usage #
- Creating a role

        use \Salyam\Permissions\Models\Role;

        $fields = [
                'name' => 'admin',
                'label' => 'Administrator'
        ];
        Role::create($fields);

- Creating a permission

        use \Salyam\Permissions\Models\Permission;

        $fields = [
                'name' => 'articles.view',
                'label' => 'View artiacles'
        ];
        Permission::create($fields);

- Granting a role to the current user

        Auth::user()->GrantRole(1);
        Auth::user()->GrantRole('admin');
- Revoking a role from the current user

        Auth::user()->RevokeRole(1);
        Auth::user()->RevokeRole('admin');

- Granting a permission to the current user

        Auth::user()->GrantPermission(3);
        Auth::user()->GrantPermission('articles.edit');

- Revoking a permission from the current user

        Auth::user()->RevokePermission(3);
        Auth::user()->RevokePermission('articles.edit');

- Checking if a user has a role

        if(Auth::user()->HasRole('editor')) {}
        if(Auth::user()->HasRole(2)) {}

- Checking if a user has one role of from array of roles

        if(Auth::user()->HasAnyRole(['editor', 'admin', 'superadmin'])) { ... }
        if(Auth::user()->HasAnyRole(1, 2, 3)) { ... }

- Checking if a user has every role of fom array of roles

        if(Auth::user()->HasEveryRole(['editor', 'admin', 'superadmin'])) { ... }
        if(Auth::user()->HasEveryRole(1, 2, 3)) { ... }