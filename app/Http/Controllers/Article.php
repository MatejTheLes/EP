<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Article extends ResourceCollection
{
    public function toArray($request){
       // return parent::toArray($request);
        $kurac = parent::toArray($request);
    }
}