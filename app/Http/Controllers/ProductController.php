<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Order;

class ProductController extends Controller
{
    public function getIndex(){
        $books2 = Book::all();
        $usr = Auth::user();
        $vlogauser = $usr['vloga'];
        $books = $books2; //moramo ustvariti novo kopijo for some reason
        $count = 0;
        foreach ($books2 as $kng){
            $ajdiAvtorja = $kng['IDAVTORJA']; //pridobimo id avtorja od knjige s tabele knjih
            $idAvtorja = Author::where('idAvtorja', $ajdiAvtorja) -> get(); //dobimo objekt avtor z tem id
            $imeAvt = ($idAvtorja[0]['IMEAVTORJA']); //uzamemo ime in ga dodamo objektu Book
            $books[$count]->IMEAVTOR = $imeAvt;
            $count++;
        }
        var_dump($vlogauser);
        return view('shop.index', ['books' => $books, 'vloga' => $vlogauser]);
    }


    public function getAddToCart(Request $request, $id){

        $product = Book::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);

        $request->session()->put('cart', $cart);

        //$user = Auth::user();
        //dd($user['id']);
        //dd($request -> session()->get('cart'));

        return redirect()->route('product.index');
    }


    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart ->totalPrice]);
    }


    public function getReduceByOne($id){
        $product = Book::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeOne($id);


        if(count($cart ->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');

    }

    public function getRemoveItem($id){
        $product = Book::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart ->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');

    }


    public function getCheckout(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        $cena = $cart->totalPrice;
        if($cena>0){

        }
        $user = Auth::user();
        $uid = $user['id'];
        $date = date('m/d/Y h:i:s', time());
        //dd($cena);
        //dd($uid);
        //dd($date);


        $order = new Order();
        $order->cart = serialize($cart);
        //$order->date = date('m/d/Y h:i:s', time());
        $order->userId = $uid;
        $order->status = 0;

        //dd($order);
        $order -> save();


        Session::forget('cart');
        return view('shop.checkout', ['total'=>$total]);
    }


    public function updateSales($id, Request $request){
        //return view('auth.change-sales-credentials',['id' => $id]);
        $user = User::where('id', $id) -> first();
        $newMail = $request['new_email'];
        $newPw = $request['new_password'];
        $user['email'] = $newMail;
        $user['password'] = bcrypt($newPw);
        $user->save();
        return redirect()->route('user.profile');
    }



    public function confirmOrder($id){
        //return view('auth.change-sales-credentials',['id' => $id]);
        $order = Order::where('id', $id) -> first();
        $order['status'] = 2;
        $order->save();
        return redirect()->route('user.profile');
    }

    public function declineOrder($id){
        //return view('auth.change-sales-credentials',['id' => $id]);
        $order = Order::where('id', $id) -> first();
        $order['status'] = 1;
        $order->save();
        return redirect()->route('user.profile');
    }


    public function getCreateProduct(){
        return view('shop.create-product');
    }




    public function createProduct(Request $request){

        //return view('auth.change-sales-credentials',['id' => $id]);
        if($this->validate($request,[
            'Author' => 'required',
            'Description' => 'required',
            'Price' => 'required|numeric|between:0.00,999.99',
            'Title' => 'required|min:4'
        ])){
            $data = ($request->all());
            $author = $data['Author'];
            $desc = $data['Description'];
            $price = $data['Price'];
            $title = $data['Title'];
            $avt = Author::where('imeAvtorja', $author) -> first();
            if($avt){// smo našli avtorja !
                $idAvtorja = $avt['IDAVTORJA'];
                //dd($idAvtorja);
                $newBook = new Book();
                $newBook['idAvtorja'] = $idAvtorja;
                $newBook['opisKnjige'] = $desc;
                $newBook['cena'] = $price;
                $newBook['naslov'] = $title;
                $newBook -> save();
                return redirect()->route('user.profile');
            }
            else{ // ni avtorja
                $newAvtor = new Author();
                $newAvtor['imeAvtorja'] = $author;
                $newAvtor -> save();
                $avt2 = Author::where('imeAvtorja', $author) -> first();
                $idAvtorja = $avt2['IDAVTORJA'];
                $newBook = new Book();
                $newBook['idAvtorja'] = $idAvtorja;
                $newBook['opisKnjige'] = $desc;
                $newBook['cena'] = $price;
                $newBook['naslov'] = $title;
                $newBook -> save();
                return redirect()->route('user.profile');
            }

        }

        else{
            Redirect::back()->withErrors(['msg', 'The Message']);
        }

    }


    public function deleteItem($id){
        Book::where('id', $id) -> delete();
        return redirect()->route('product.index');
    }


    public function getEditProduct($id){
        return view('shop.edit-product',['id' => $id]);
    }


    public function editProduct($id, Request $request){

        //return view('auth.change-sales-credentials',['id' => $id]);
        if($this->validate($request,[
            'Author' => 'required',
            'Description' => 'required',
            'Price' => 'required|numeric|between:0.00,999.99',
            'Title' => 'required|min:4'
        ])){
            $data = ($request->all());
            $author = $data['Author'];
            $desc = $data['Description'];
            $price = $data['Price'];
            $title = $data['Title'];
            $avt = Author::where('imeAvtorja', $author) -> first();
            if($avt){// smo našli avtorja !
                $idAvtorja = $avt['IDAVTORJA'];
                Book::where('id','=',$id)->update(array('IDAVTORJA'=> $idAvtorja, 'OPISKNJIGE' => $desc, 'CENA' => $price, 'NASLOV' => $title));
                //dd($baba);
                return redirect()->route('product.index');
            }
            else{ // ni avtorja
                $newAvtor = new Author();
                $newAvtor['imeAvtorja'] = $author;
                $newAvtor -> save();
                $avt2 = Author::where('imeAvtorja', $author) -> first();
                $idAvtorja = $avt2['IDAVTORJA'];
                Book::where('id','=',$id)->update(array('IDAVTORJA'=> $idAvtorja, 'OPISKNJIGE' => $desc, 'CENA' => $price, 'NASLOV' => $title));
                return redirect()->route('product.index');
            }

        }

        else{
            Redirect::back()->withErrors(['msg', 'The Message']);
        }

    }


}
