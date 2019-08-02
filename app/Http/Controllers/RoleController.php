<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        if(!auth()->user()->is_admin)
            return view('user_management.roles.index');
        else
            return redirect('/not-allowed');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles',
            'display_name' => 'required|string|max:255',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $save = Role::create($data);
            $result['data'] = $save;
            $save->permissions()->attach(5);
            $result['result'] = true;
        }
        return $result;
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $module = Role::findOrFail($id);
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles,name,'.$id,
            'display_name' => 'required|string|max:255',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $update = $module->update($data);
            $result['data'] = $update;
            $result['result'] = true;
        }
        return $result;
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $result = '';
        if($role->name == 'Administrator' || $role->id == 1) {
            $result = "This role cannot be removed.";
        }
        else {
            $update = $role->update([
                'status' => 0
            ]);
            if ($update == true)
                $result = "Role set as inactive";
            else
                $result = "An error occured. Please try again.";
        }
        return $result;
    }

    public function getRoles()
    {
        $data = [
            'roles' => Role::paginate(10)
        ];

        return $data;
    }
}
