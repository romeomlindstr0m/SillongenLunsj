<!doctype html>
<html class="h-full bg-white">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | Rediger en menyvare</title>
  @vite('resources/css/app.css')
  @vite('resources/js/select-menu.js')
</head>
<body class="h-full font-inter">
<x-navbar />

@session('status')
  <x-notification-banner :message="session('status')" />
@endsession
@if ($errors->any())
  <x-authentication-failure :messages="$errors->all()" />
@endif

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Rediger en menyvare</h2>
    </div>
  
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{ route('items.update', ['id' => $item->id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">Navn</label>
          <div class="mt-2">
            <input type="text" value="{{ $item->name }}" name="name" id="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>

        <div>
            <label for="price" class="block text-sm/6 font-medium text-gray-900">Pris</label>
            <div class="mt-2">
              <input type="number" value="{{ $item->price }}" name="price" id="price" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
        </div>
        
        <div>
            <label for="sku" class="block text-sm/6 font-medium text-gray-900">Varenummer</label>
            <div class="mt-2">
              <input type="text" value="{{ $item->sku }}" name="sku" id="sku" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
        </div>
  
        <div>
          <label id="listbox-label" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
          <div class="relative mt-2">
            <button type="button" class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pl-3 pr-2 text-left text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
              <span class="col-start-1 row-start-1 truncate pr-6">{{ $item->category->name }}</span>
              <svg class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
              </svg>
            </button>
        
            <ul class="hidden absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">

              @foreach ($categories as $category)
                <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" id="listbox-option-{{ $category->id }}" role="option" data-value="{{ $category->id }}">

                  <span class="block truncate font-normal">{{ $category->name }}</span>
                </li>
              @endforeach
        
            </ul>
          </div>
          <input type="hidden" class="select-input" name="category_id" value="{{ $item->category->id }}">
        </div>

        <div>
          <label class="block text-sm/6 font-medium text-gray-900">Bilde</label>
          <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" />
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-gray-900 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Fortsett</button>
        </div>
      </form>
    </div>
</div>  
</body>
</html>