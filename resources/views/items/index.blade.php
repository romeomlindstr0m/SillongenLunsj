<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | Lunsjmeny</title>
  @vite('resources/css/app.css')
  @vite('resources/js/item-input.js')
</head>
<body class="font-inter">
    <x-navbar />
    @session('status')
      <x-notification-banner :message="session('status')" />
    @endsession
    @if ($errors->any())
      <x-authentication-failure :messages="$errors->all()" />
    @endif
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
          <form action="{{ route('items.store') }}" method="POST">
            @csrf
            @foreach ($grouped_items as $category_id => $items)
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">{{ $items->first()->category->name }}</h2>
                <div class="relative mb-12">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                      <div class="w-full border-t border-gray-300"></div>
                    </div>
                </div>
            
                <div class="mt-20 mb-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($items as $item)
                        <div class="group relative">
                        @if ($item->image_path)
                          <img src="{{ asset('storage/' . $item->image_path) }}" alt="Menu item image"
                        @else
                          <img src="{{ asset('images/item_placeholder.jpg') }}" alt="Menu item image"
                        @endif
                        class="aspect-square w-full rounded-md bg-gray-200 object-cover lg:aspect-auto lg:h-80">
                        <div class="mt-4 flex justify-between">
                            <div>
                            <h3 class="text-sm text-gray-700">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                {{ $item->name }}
                            </h3>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ $item->price }},-</p>
                        </div>
                            <x-number-input :id="$item->id" />
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
      </div>

      <div class="relative isolate bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
          <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
            <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
              <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">
              </div>
              <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Betingselser / levering</h2>
              <ul class="mt-6 text-lg/8 text-gray-600">
                <li>Bestilling innen kl.12.00 dagen i forveien for levering.</li>
                <li>Priser:
                    <ul class="list-disc">
                        <li>Hverdager 08.00 - 17.00: kr. 115,- (avtalekunde)</li>
                        <li>Hverdager etter 17.00: kr. 159,-</li>
                        <li>Ekspresslevering: + kr. 69,-</li>
                        <li>Helger: kr. 305,-</li>
                        <li>Levering utenfor ordinær tid: kr. 235,-</li>
                    </ul>
                </li>
                <li>Brukt service og emballasje settes frem for henting.</li>
              </ul>
            </div>
          </div>
          <div class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
            <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
              <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                  <label for="contact_person" class="block text-sm/6 font-semibold text-gray-900">Kontaktperson</label>
                  <div class="mt-2.5">
                    <input type="text" name="contact_person" id="contact_person" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="email" class="block text-sm/6 font-semibold text-gray-900">E-postaddresse</label>
                  <div class="mt-2.5">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="phone" class="block text-sm/6 font-semibold text-gray-900">Telefon</label>
                  <div class="mt-2.5">
                    <input type="tel" name="phone" id="phone" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="company" class="block text-sm/6 font-semibold text-gray-900">Firma</label>
                  <div class="mt-2.5">
                    <input type="text" name="company" id="company" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="delivery_location" class="block text-sm/6 font-semibold text-gray-900">Leveringssted</label>
                  <div class="mt-2.5">
                    <input type="text" name="delivery_location" id="delivery_location" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="message" class="block text-sm/6 font-semibold text-gray-900">Melding</label>
                  <div class="mt-2.5">
                    <textarea name="message" id="message" rows="4" class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>      

      <div class="bg-white">
        <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">

          <div class="rounded-lg bg-gray-100 px-4 py-6 sm:p-6 lg:p-8">
            <div class="flow-root">
              <dl class="-my-4 divide-y divide-gray-200 text-sm">
                <div class="flex items-center justify-between py-4">
                  <dt class="text-base font-medium text-gray-900">Ordresum</dt>
                  <dd class="text-base font-medium text-gray-900">0,-</dd>
                </div>
              </dl>
            </div>
          </div>
      
          <div class="mt-10 flex gap-3">
            <button class="w-full rounded-md border border-transparent bg-red-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
              Fjern alle felt
            </button>
            <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
              Send ordre
            </button>
          </form>
          </div>
        </div>
      </div>      
</body>
</html>