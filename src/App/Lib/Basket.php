<?php
namespace Graze;

use RKA\Session;

class Basket
{

    private $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function removeItem(Item $item)
    {
        $pos = array_search($item->id, $this->items);
        if (! $pos){
            unset($this->items[$pos]);
        }
    }

    public function getItems()
    {
        return $this->items;
    }

    /**
     * Persist basket into session
     */
    public function save()
    {
        foreach ($this->items as $item) {
            $items[] = $item->id;
        }

        $itemString = implode(',', $items);

        Session::set('basket', $itemString);
    }
}
