<?php

namespace App;

class Cart{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }

        else{
            $this->items=null;
        }
    }

    public function add($item, $id){

        $nasl = $item['NASLOV'];

        $storedItem = ['id' => $id,'qty' => 0, 'price'=>$item->price, 'item' => $item, 'naslov' => $nasl];
        if($this -> items){
            if(array_key_exists($id, $this -> items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->CENA * $storedItem['qty'];

        $this -> items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->CENA;
    }

    public function removeOne($id){
        $this->items[$id]['qty']--;

        $this->items[$id]['price'] -= $this->items[$id]['item']['CENA'];

        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['CENA'];

        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }
    }

    public function removeItem($id){


        $this->totalPrice -= $this->items[$id]['item']['CENA'] * $this->items[$id]['qty']; ;
        $this->totalQty -= $this->items[$id]['qty'];
        unset($this->items[$id]);


    }

}
