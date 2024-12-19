<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Item;
use App\Models\Category;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

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
            'image' => ['file', 'mimes:jpg,png,jpeg', 'max:20480'],
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

            'image.file' => 'Den opplastede bilden er ugyldig.',
            'image.mimes' => 'Kun bilder av typen JPG, PNG eller JPEG er tillatt.',
            'image.max' => 'Filen må ikke være større enn 20MB.',
        ];

        $validator = Validator::make($request->only(['name', 'price', 'sku', 'category_id', 'image']), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $item = new Item;
        
        $item->name = $request->name;
        $item->price = $request->price;
        $item->sku = $request->sku;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('items_images', 'public');
            $item->image_path = $image_path;
        }

        $item->save();

        return back()->with('status', 'En ny menyvare ble opprettet.');
    }

    public function edit($id): View
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit')->with(['item' => $item, 'categories' => $categories]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'sku' => ['required', 'max:255', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image' => ['file', 'mimes:jpg,png,jpeg', 'max:20480'],
        ];

        $messages = [
            'required' => 'Vennligst fyll ut alle feltene.',
        
            'name.string' => 'Navn må være en tekststreng.',
            'name.max' => 'Navn kan ikke overstige 255 tegn.',
        
            'price.numeric' => 'Pris må være et tall.',
        
            'sku.string' => 'Varenummer må være en tekststreng.',
            'sku.max' => 'Varenummer kan ikke overstige 255 tegn.',
        
            'category_id.integer' => 'Kategori må være et heltall.',
            'category_id.exists' => 'Valgt kategori finnes ikke.',

            'image.file' => 'Den opplastede bilden er ugyldig.',
            'image.mimes' => 'Kun bilder av typen JPG, PNG eller JPEG er tillatt.',
            'image.max' => 'Filen må ikke være større enn 20MB.',
        ];

        $validator = Validator::make($request->only(['name', 'price', 'sku', 'category_id', 'image']), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $item = Item::find($id);
        
        $item->name = $request->name;
        $item->price = $request->price;
        $item->sku = $request->sku;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('items_images', 'public');
            $item->image_path = $image_path;
        }

        $item->save();

        return back()->with('status', 'Menyvaren ble oppdatert.');
    }

    public function destroy($id): RedirectResponse
    {
        $target_item = Item::findOrFail($id);

        if (!empty($target_item->image_path)) {
            Storage::disk('public')->delete($target_item->image_path);
        }

        $target_item->delete();

        return back()->with('session', 'Menyvaren ble fjernet.');
    }
}
