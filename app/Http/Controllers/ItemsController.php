<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Item;
use App\Models\Category;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    public function index(): View
    {
        $items = Item::with('category')->get();
        $grouped_items = $items->groupBy('category_id');
        return view('items.index')->with('grouped_items', $grouped_items);
    }

    public function table(): View
    {
        $items = Item::all();
        return view('items.table')->with('items', $items);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('items.create')->with('categories', $categories);
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'sku' => ['required', 'max:255', 'string', 'unique:items,sku'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];

        $messages = [
            'required' => 'Vennligst fyll ut alle feltene.',
        
            'name.string' => 'Navn må være en tekststreng.',
            'name.max' => 'Navn kan ikke overstige 255 tegn.',
        
            'price.numeric' => 'Pris må være et tall.',
        
            'sku.string' => 'Varenummer må være en tekststreng.',
            'sku.max' => 'Varenummer kan ikke overstige 255 tegn.',
            'sku.unique' => 'Dette varenummeret er allerede i bruk.',
        
            'category_id.integer' => 'Kategori må være et heltall.',
            'category_id.exists' => 'Valgt kategori finnes ikke.',
        ];

        $validator = Validator::make($request->only(['name', 'price', 'sku', 'category_id']), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $item = new Item;
        
        $item->name = $request->name;
        $item->price = $request->price;
        $item->sku = $request->sku;
        $item->category_id = $request->category_id;

        $item->save();

        return back()->with('status', 'En ny menyvare ble opprettet.');
    }
}
