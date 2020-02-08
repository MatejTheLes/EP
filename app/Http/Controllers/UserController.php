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
           //echo("stima");

            return redirect()->route('user.profile');
        }

       return redirect()->route('product.index');
    }

    public function getProfile(){

        $user = Auth::user();
        $vloga = $user['vloga'];
        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
               // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }
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


        if($ajdi == 3){ //če smo administrator ni potrebe pošiljati naročil okoli, le seznam vseh prodajalcev
            $seznamProdajalcev = User::where('vloga', 2) -> get();
            return view('user.profile',['prodajalci' => $seznamProdajalcev, 'userid' => $ajdi]);

        }
        if($ajdi == 2){ //če smo administrator ni potrebe pošiljati naročil okoli, le seznam vseh prodajalcev
            $seznamNarocil = Order::all();
            $seznamStrank = User::where('vloga', 1) -> get();
            $seznamNarocil->transform(function($order, $key){
                $order->cart = unserialize($order->cart);
                //dd($order);
                return $order;
            });
           // dd($seznamNarocil);
            return view('user.profile',['narocila' => $seznamNarocil, 'userid' => $ajdi, 'stranke' => $seznamStrank]);

        }
        $userAddress=$user['address'];
        $userCity=$user['city'];
        $phone=$user['phone'];
        return view('user.profile',['orders' => $orders, 'userid' => $ajdi, 'address' => $userAddress, 'city'=>$userCity, 'phone' =>$phone]);
    }


    public function getChangeCredentials(){
        return view('auth.change-credentials');
    }

    public function updateAccount(Request $request){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];
        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }

        //dd($request->all());  //to check all the datas dumped from the form
        //if your want to get single element,someName in this case
        //$someName = $request->someName;
        $user = Auth::user();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $newCity = $request['new_city'];
        $newAddress = $request['new_address'];
        $newPhone = $request['new_phone'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user['address'] = $newAddress;
        $user['city'] = $newCity;
        $user['phone'] = $newPhone;
        $user->save();
        return redirect()->route('product.index');

    }


    public function deleteUser($id){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1 ){
            return redirect()->route('product.index');
        }

        if($vloga == 3 || $vloga == 2) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        User::where('id', $id) -> delete();
        return redirect()->route('user.profile');
    }

    public function getUpdateSales($id, $vloga2){
        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1){
            return redirect()->route('product.index');
        }

        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        return view('auth.change-sales-credentials',['id' => $id, 'vloga'=>$vloga2]);
    }
    public function getCreateSales(){
        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1 || $vloga == 2){
            return redirect()->route('product.index');
        }

        if($vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        return view('auth.create-sales');
    }
    public function getCreateCustomer(){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1){
            return redirect()->route('product.index');
        }

        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        return view('auth.create-customer');
    }


    public function updateSales($id, Request $request){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1){
            return redirect()->route('product.index');
        }

        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        //return view('auth.change-sales-credentials',['id' => $id]);
        $user = User::where('id', $id) -> first();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $newCity = $request['new_city'];
        $newAddress = $request['new_address'];
        $newPhone = $request['new_phone'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user['address'] = $newAddress;
        $user['city'] = $newCity;
        $user['phone'] = $newPhone;
        $user->save();
        return redirect()->route('user.profile');
    }

    public function createSales(Request $request){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1 || $vloga == 2 ){
            return redirect()->route('product.index');
        }

        if($vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        //return view('auth.change-sales-credentials',['id' => $id]);
        if($this->validate($request,[
            'sales_email' => 'email|required',
            'sales_name' => 'required',
            'sales_password' => 'required|min:4'
        ])){
            $data = ($request->all());
            $un = $data['sales_name'];
            $pw = $data['sales_password'];
            $em = $data['sales_email'];
            $user = new User();
            $user['name'] = $un;
            $user['password'] = bcrypt($pw);
            $user['email'] = $em;
            $user['vloga'] = 2;
            $user->save();
            return redirect()->route('user.profile');
        }

       else{
           Redirect::back()->withErrors(['msg', 'The Message']);
       }




       $user = new User();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user->save();
        return redirect()->route('user.profile');
    }



    public function createCustomer(Request $request){

        $user2 = Auth::user();
        $vloga = $user2['vloga'];

        if($vloga == 1){
            return redirect()->route('product.index');
        }

        if($vloga == 2 || $vloga == 3) {
            if ($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE') {
                // var_dump($_SERVER['SSL_CLIENT_VERIFY']);

                if ($user2['email'] != $_SERVER['SSL_CLIENT_S_DN_Email']) {
                    Auth::logout();
                    return redirect()->route('product.index');
                }
            }

            else{
                Auth::logout();
                return redirect()->route('product.index');
            }
        }


        //return view('auth.change-sales-credentials',['id' => $id]);
        if($this->validate($request,[
            'sales_email' => 'email|required',
            'sales_name' => 'required',
            'sales_password' => 'required|min:4'
        ])){
            $data = ($request->all());
            $un = $data['sales_name'];
            $pw = $data['sales_password'];
            $em = $data['sales_email'];
            $user = new User();
            $user['name'] = $un;
            $user['password'] = bcrypt($pw);
            $user['email'] = $em;
            $user['vloga'] = 1;
            $user->save();
            return redirect()->route('user.profile');
        }

        else{
            Redirect::back()->withErrors(['msg', 'The Message']);
        }




        $user = new User();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user->save();
        return redirect()->route('user.profile');
    }

}
