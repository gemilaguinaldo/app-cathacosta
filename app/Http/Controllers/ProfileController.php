<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Validator;
class ProfileController extends Controller
{
    public function index()
    {
    	return view('profile.index');
    }

    public function postProfile(Request $request)
    {
    	$data = $request->except('_token');
    	$user = auth()->user();

    	$validator = Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
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
            $update = $user->update($data);
            $result['data'] = $update;
            $result['result'] = true;
        }
        return json_encode($result);
    }

    public function postChangePassword(Request $request)
    {
        $data = $request->except('_token');
        $user = auth()->user();
        // dd($data);

        $validator = Validator::make($data, [
            'password' => 'required',
            'new_password' => ['required', 'min:6','regex:/^[0-9a-zA-Z]{8,}$/', 'different:password'],
            'password_confirmation' => 'required_with:new_password|same:new_password',
        ]);

        if($validator->fails() )
        {
           	$result['errors'] = $validator->errors()->all();
            $result['result'] = false; 
        }
        else
        {
            if(Hash::check($data['password'], $user->password)){
                $update = $user->update([
                    'password' => Hash::make($data['new_password']),
                ]);
                $result['data'] = $update;
            	$result['result'] = true;
            }
            else
            {
            	$result['errors'] = ["Old password doesn't match."];
	            $result['result'] = false; 
            }
        }
        return $result;

    }

}
