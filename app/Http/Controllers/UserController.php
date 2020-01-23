<?php

namespace App\Http\Controllers;

use App\Author;
use App\Order;
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

       return redirect()->route('product.index');
    }

    public function getProfile(){
        $user = Auth::user();
        $uid = $user['id'];
        $orders = Order::where('userId', $uid) -> get();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            //dd($order);
            return $order;
        });
       // dd($orders);

        if(Auth::user()){
            $user = Auth::user();
            $ajdi = $user['vloga'];
        }

        else{
            $ajdi = 4;
        }
        return view('user.profile',['orders' => $orders, 'userid' => $ajdi]);
    }


    public function getChangeCredentials(){
        return view('auth.change-credentials');
    }

    public function updateAccount(Request $request){
        //dd($request->all());  //to check all the datas dumped from the form
        //if your want to get single element,someName in this case
        //$someName = $request->someName;
        $user = Auth::user();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user->save();
    }


}
