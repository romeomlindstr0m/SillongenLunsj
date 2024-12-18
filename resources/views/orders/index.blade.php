<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | Alle bestillinger</title>
  @vite('resources/css/app.css')
</head>
<body class="font-inter">
    @session('status')
      <x-notification-banner :message="session('status')" />
    @endsession
    @if ($errors->any())
      <x-authentication-failure :messages="$errors->all()" />
    @endif
    <x-navbar />
    <div class="px-4 sm:px-6 lg:px-8 w-3/4 mx-auto mt-12">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold text-gray-900">Bestillinger</h1>
            <p class="mt-2 text-sm text-gray-700">En liste over alle bestillinger, inkludert kontaktperson, firma, leveringssted og opprettelsesdato.</p>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full border-separate border-spacing-0">
                <thead>
                  <tr>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Kontaktperson</th>
                    <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Firma</th>
                    <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Leveringssted</th>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">Opprettet</th>
                    <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-white/75 py-3.5 pl-3 pr-4 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="whitespace-nowrap border-b border-gray-200 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $order->contact_person }}</td>
                            <td class="hidden whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $order->company }}</td>
                            <td class="hidden whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $order->delivery_location }}</td>
                            <td class="whitespace-nowrap border-b border-gray-200 px-3 py-4 text-sm text-gray-500">{{ $order->created_at }}</td>
                            <td class="flex justify-end relative whitespace-nowrap border-b border-gray-200 py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-8 lg:pr-8">
                            <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="text-indigo-600 hover:text-indigo-900">Vis</a>
                            <span class="mx-2">|</span>
                              <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800">Marker som fullført</button>
                              </form>
                            </td>
                        </tr>
                    @endforeach
      
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>      
</body>
</html>