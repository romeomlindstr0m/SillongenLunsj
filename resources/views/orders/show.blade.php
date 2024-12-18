<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | Bestilling</title>
  @vite('resources/css/app.css')
</head>
<body class="font-inter">
    <x-navbar />
    <div class="w-3/4 mx-auto mt-12">
        <div class="px-4 sm:px-0">
          <h3 class="text-base/7 font-semibold text-gray-900">Bestillingsinformasjon</h3>
          <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Vis alle detaljer om en spesifikk bestilling</p>
        </div>
        <div class="mt-6">
          <dl class="grid grid-cols-1 sm:grid-cols-2">
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm/6 font-medium text-gray-900">Kontaktperson</dt>
              <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">{{ $order->contact_person }}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm/6 font-medium text-gray-900">Kunde-e-post</dt>
              <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">{{ $order->customer_email }}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm/6 font-medium text-gray-900">Kundetelefon</dt>
              <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">{{ $order->customer_phone }}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
              <dt class="text-sm/6 font-medium text-gray-900">Firma</dt>
              <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">{{ $order->company }}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
              <dt class="text-sm/6 font-medium text-gray-900">Melding</dt>
              <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">{{ $order->message }}</dd>
            </div>
            <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                <dt class="text-sm/6 font-medium text-gray-900">Bestilte Varer</dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:mt-2">
                    <ul>
                    @foreach ($order->items as $item)
                        <li>{{ $item['sku'] }}</li>
                    @endforeach
                    </ul>
                </dd>
            </div>
          </dl>
        </div>
      </div>      
</body>
</html>