<?php

namespace Salyam\Permissions\Controllers;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('salyam.permissions.roles.index', ['roles' => \Salyam\Permissions\Models\Role::all()]);
    }

    public function store()
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        \Salyam\Permissions\Models\Role::create($fields);

        return redirect('/roles');
    }

    // TODO: handle when not found
    public function update($id)
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        $role = \Salyam\Permissions\Models\Role::find($id);

        $role->name = $fields['name'];
        $role->label = $fields['label'];
        $role->save();

        return redirect('/roles');
    }

    public function destroy(\Salyam\Permissions\Models\Role $role)
    {
        $role->delete();
        return redirect('/roles');
    }
}