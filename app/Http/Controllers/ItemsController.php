<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index(): View
    {
        $items = Item::with('category')->get();
        $grouped_items = $items->groupBy('category_id');
        return view('items.index')->with('grouped_items', $grouped_items);
    }
}
