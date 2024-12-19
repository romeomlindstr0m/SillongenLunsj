<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::all();
        return view('orders.index')->with('orders', $orders);
    }

    public function show($id): View
    {
        $order = Order::findOrFail($id);
        return view('orders.show')->with('order', $order);
    }

    public function destroy($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('status', 'Bestillingen har blitt slettet.');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'company' => 'nullable|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ];

        foreach ($request->input('items', []) as $itemId => $quantity) {
            $rules["items.$itemId"] = 'required|integer|min:0';
        }

        $messages = [
            'required' => 'Vennligst fyll ut alle feltene.',
        
            'contact_person.string' => 'Kontaktperson må være en gyldig tekst.',
            'contact_person.max' => 'Kontaktperson kan ikke være lengre enn 255 tegn.',
        
            'email.email' => 'Vennligst oppgi en gyldig e-postadresse.',
            'email.max' => 'E-postadresse kan ikke være lengre enn 255 tegn.',
        
            'phone.string' => 'Telefonnummer må være en gyldig tekst.',
        
            'company.string' => 'Firma må være en gyldig tekst.',
            'company.max' => 'Firma kan ikke være lengre enn 255 tegn.',
        
            'delivery_location.string' => 'Leveringssted må være en gyldig tekst.',
            'delivery_location.max' => 'Leveringssted kan ikke være lengre enn 255 tegn.',
        
            'message.string' => 'Melding må være en gyldig tekst.',
            'message.max' => 'Melding kan ikke være lengre enn 1000 tegn.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $items_json = json_encode($request->input('items'));

        $order = new Order;

        $order->contact_person = $request->contact_person;
        $order->customer_email = $request->email;
        $order->customer_phone = $request->phone;
        $order->company = $request->company;
        $order->delivery_location = $request->delivery_location;
        $order->message = $request->message;
        $order->items = $items_json;

        $order->save();

        return redirect()->back()->with('status', 'Bestillingen din er registrert og vil bli behandlet innen kort tid.');
    }
}
