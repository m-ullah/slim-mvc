<?php
namespace Graze;

use Graze\Item;
use Illuminate\Database\Query\Builder;

class ItemRepository
{

    protected $table;

    function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function getItems()
    {
//        $items = [];
//        $rows = $this->table->get()->toArray();
//
//        foreach ($rows as $id => $item) {
//            $items[] = new Item($item->id, $item->name, $item->price, $item->image_url);
//        }
//
//        return $items;
        return Item::all();
    }

    public function getItem($id)
    {
        
//        var_dump("id: ", $id);
//        $item = $this->table->find((int)$id);
//        var_dump("found this: ", $item);
//        $itemObj = new Item($item->id, $item->name, $item->price, $item->image_url);
//        var_dump("item obj: ", $itemObj);
//        return $itemObj;
        
        return Item::find($id);
    }
}
