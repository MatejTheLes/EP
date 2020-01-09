<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request,[
            'email' => 'email|required',
            'username' => 'required',
            'password' => 'required|min:4'
        ]);
        $data = ($request->all());
        $un = $data['username'];
        $pw = $data['password'];
        $em = $data['email'];
       // var_dump($un);

        $user = new User([
            'username' => $un,
            'password' => bcrypt($pw),
            'email' => $em,
            'vloga' => 1,
            'idUser' => NULL
        ]);
        $user -> save();
        return redirect()->route('product.index');
       //var_dump($user);

    }

    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required|min:4'
        ]);
        $data = ($request->all());
        $un = $data['username'];
        $pw = $data['password'];
       if(Auth::attempt(['username' => $un, 'password' => $pw])){
           echo("stima");
            return redirect()->route('user.profile');
        }
       echo("hajme");
       return redirect()->route('product.index');
    }

    public function getProfile(){

        return view('user.profile');
    }
}
