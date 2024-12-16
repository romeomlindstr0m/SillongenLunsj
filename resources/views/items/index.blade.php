<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | All Items</title>
  @vite('resources/css/app.css')
  @vite('resources/js/item-input.js')
</head>
<body class="font-inter">
    <x-navbar />
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
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
                        <img src="https://tailwindui.com/plus/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="aspect-square w-full rounded-md bg-gray-200 object-cover lg:aspect-auto lg:h-80">
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

      <div class="bg-white">
        <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">

          <div class="rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:p-8">
            <div class="flow-root">
              <dl class="-my-4 divide-y divide-gray-200 text-sm">
                <div class="flex items-center justify-between py-4">
                  <dt class="text-base font-medium text-gray-900">Order total</dt>
                  <dd class="text-base font-medium text-gray-900">0,-</dd>
                </div>
              </dl>
            </div>
          </div>
      
          <div class="mt-10 flex gap-3">
            <button type="submit" class="w-full rounded-md border border-transparent bg-red-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                Reset form
            </button>
            <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                Checkout
            </button>
          </div>
        </div>
      </div>      
</body>
</html>