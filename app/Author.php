<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {

    protected $fillable = ['idAvtorja', 'imeAvtorja'];
    protected $table = 'AVTOR'; // tukaj določimo dejansko ime tabele po kateri iscemo
    public $timestamps = false;
}
