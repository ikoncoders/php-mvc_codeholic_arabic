<?php 

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Ikonc\PhpMvc\Validation\Validator;

class RegisterController extends Controller 
{
    public function index()
		{ 
			return view('auth.register');
		}

        public function store()
        {
            $validator = new Validator();
            $validator->setRules([
                'full_name'     => 'required',  //|alnum|between:8,32
                'username' => 'required|unique:users,username',  //alnum|between:8,32|
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|between:6,32|confirmed',  //alnum|
                'password_confirmation' => 'required|between:6,32' //alnum|
            ]);
                
            $validator->setAliases([
                'password_confirmation' => 'Password confirmation'
            ]);
    
            $validator->make(request()->all());
    
            if (!$validator->passes()) {
                app()->session->setFlash('errors', $validator->errors());
                app()->session->setFlash('old', request()->all());
    
                return back();
            }
    
            User::create([
                'full_name' => request('full_name'),
                'username' => request('username'),               
                'email' => request('email'),
                'password' => bcrypt(request('password'))
            ]);
    
            app()->session->setFlash('success', 'Registered sucessfully');
    
            return back();
        }
    
    
}