<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\AccountCreated;

use Validator;

use App\Role;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->is_admin)
            return view('user_management.users.index');
        else
            return redirect('/not-allowed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $password = $this->random_key();
            $data['password'] = bcrypt($password);
            $save = User::create($data);
            $role = Role::findOrFail($data['role_id']);
            $role->users()->save($save);
            $result['data'] = $save;

            // send email
            $accountData = $save;
            $accountData->password= $password;
            Mail::to($save->email)->send(new AccountCreated($accountData));

            $result['result'] = true;
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $module = User::find($id);
        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role_id' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails() )
        {
            $result['errors'] = $validator->errors()->all();
            $result['result'] = false;
        }
        else
        {
            $update = $module->update($data);
            $role = Role::findOrFail($data['role_id']);
            $role->users()->save($module);
            $result['data'] = $update;
            $result['result'] = true;
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $result ='';
        if($user->user_role == 'Admin' || $user->role_id == 1) {
           $result = "This role cannot be removed.";
       }
       else
       {
        $update = $user->update([
            'status' => 0,
        ]);
        ($update == true) ? $result = "User deactivated!" : $result = "An error occured. Please try again.";
    }
    return $result;
}

public function random_key($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

public function getUsers()
{
    $data = [
        'users' => User::paginate(10),
        'roles' => Role::where('status', 1)->get()
    ];
    return $data;
}
}
