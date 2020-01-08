<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    protected $fillable = ['idKnjige', 'idAvtorja','opisKnjige','cena','naslov'];
    protected $table = 'KNJIGA'; // tukaj določimo dejansko ime tabele po kateri iscemo
}
