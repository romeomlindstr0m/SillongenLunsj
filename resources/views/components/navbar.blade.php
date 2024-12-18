@vite('resources/js/navbar.js')
<nav class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex shrink-0 items-center">
            <img class="h-8 w-auto" src="{{ asset('SILLONGEN_logo2011_CMYK_2.png') }}" alt="Sillongen Catering">
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <a href="{{ route('home') }}"
            @if (Route::currentRouteName() === 'home')
              class="inline-flex items-center border-b-2 border-lime-600 px-1 pt-1 text-sm font-medium text-gray-900"
            @else
              class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            @endif
            >Home</a>

            <a href="{{ route('items.index') }}"
            @if (Route::currentRouteName() === 'items.index')
              class="inline-flex items-center border-b-2 border-lime-600 px-1 pt-1 text-sm font-medium text-gray-900"
            @else
              class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            @endif
            >Lunchmenu</a>

            @auth
              @if (auth()->user()->hasRole('admin'))
                <a href="{{ route('orders.index') }}"
                @if (Route::currentRouteName() === 'orders.index')
                  class="inline-flex items-center border-b-2 border-lime-600 px-1 pt-1 text-sm font-medium text-gray-900"
                @else
                  class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                @endif
                >Orders</a>
              @endif
            @endauth

            @auth
              @if (auth()->user()->hasRole('admin'))
                <a href="{{ route('dashboard') }}" 
                @if (Route::currentRouteName() === 'dashboard')
                    class="inline-flex items-center border-b-2 border-lime-600 px-1 pt-1 text-sm font-medium text-gray-900"
                  @else
                    class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                @endif
                >Dashboard</a>
              @endif
            @endauth
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
  
          <div class="relative ml-3">
            <div>
              <button type="button" class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>                
              </button>
            </div>

            <div id="user-menu-dropdown" class="hidden relative text-left">
              <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" tabindex="-1">
                <div class="px-4 py-3" role="none">
                  @auth
                    <p class="text-sm" role="none">Signed in as</p>
                    <p class="truncate text-sm font-medium text-gray-900" role="none">{{ auth()->user()->email }}</p>
                  @endauth
                  @guest
                    <p class="text-sm" role="none">You are not signed in</p>
                  @endguest
                </div>
                <div class="py-1" role="none">
                  @auth
                    <form method="POST" action="{{ route('logout') }}" role="none">
                      @csrf
                      <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">Sign out</button>
                    </form>
                  @endauth
                  @guest
                    <a href="{{ route('login') }}" class="block w-full px-4 py-2 text-left text-sm text-gray-700">Sign in</a>
                  @endguest
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="-mr-2 flex items-center sm:hidden">

          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>

            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 pb-3 pt-2">
        
        <a href="#" class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700">Dashboard</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Team</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Projects</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Calendar</a>
      </div>
      <div class="border-t border-gray-200 pb-3 pt-4">
        <div class="flex items-center px-4">
          <div class="shrink-0">
            <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">Tom Cook</div>
            <div class="text-sm font-medium text-gray-500">tom@example.com</div>
          </div>
          <button type="button" class="relative ml-auto shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1">
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Your Profile</a>
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Settings</a>
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Sign out</a>
        </div>
      </div>
    </div>
  </nav>  