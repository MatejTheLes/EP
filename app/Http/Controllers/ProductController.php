<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

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

     ;
        return view('shop.index', ['books' => $books]);
    }
}
