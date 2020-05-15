<?php

namespace Salyam\Permissions\Controllers;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('salyam.permissions.permissions.index', ['permissions' => \Salyam\Permissions\Models\Permission::all()]);
    }

    public function store()
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        \Salyam\Permissions\Models\Permission::create($fields);

        return redirect('/permissions');
    }

    // TODO: handle when not found
    public function update($id)
    {
        $fields = request()->validate([
            'name' => 'required',
            'label' => 'required',
        ]);

        $permission = \Salyam\Permissions\Models\Permission::find($id);

        $permission->name = $fields['name'];
        $permission->label = $fields['label'];
        $permission->save();

        return redirect('/permissions');
    }

    public function destroy(\Salyam\Permissions\Models\Permission $permission)
    {
        $permission->delete();
        return redirect('/permissions');
    }
}