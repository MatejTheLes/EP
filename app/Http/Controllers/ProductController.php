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
        $books = $books2; //moramo ustvariti novo kopijo for some reason
        $count = 0;
        foreach ($books2 as $kng){
            $ajdiAvtorja = $kng['IDAVTORJA']; //pridobimo id avtorja od knjige s tabele knjih
            $idAvtorja = Author::where('idAvtorja', $ajdiAvtorja) -> get(); //dobimo objekt avtor z tem id
            $imeAvt = ($idAvtorja[0]['IMEAVTORJA']); //uzamemo ime in ga dodamo objektu Book
            $books[$count]->IMEAVTOR = $imeAvt;
            $count++;
        }



        return view('shop.index', ['books' => $books]);
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
}
