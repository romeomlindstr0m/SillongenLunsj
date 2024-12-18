<!doctype html>
<html class="h-full bg-white">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sillongen | Logg inn</title>
  @vite('resources/css/app.css')
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
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Logg inn på kontoen din</h2>
    </div>
  
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="{{ route('login.process') }}" method="POST">
        @csrf
        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">E-postadresse</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>
  
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Passord</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
          </div>
        </div>
  
        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-gray-900 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Logg inn</button>
        </div>
      </form>
  
      <p class="mt-10 text-center text-sm/6 text-gray-500">
        Ikke medlem?
        <a href="{{ route('register') }}" class="font-semibold text-lime-600 hover:text-lime-700 underline decoration-solid">Opprett en konto</a>
      </p>
    </div>
</div>
</body>
</html>