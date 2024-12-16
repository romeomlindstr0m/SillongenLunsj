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
</body>
</html>