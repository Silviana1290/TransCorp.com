<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'TransLog Corp System')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow mb-5">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-600">TransLog Corp</a>

      <div class="flex gap-3">
        <a href="{{ route('dashboard') }}" 
           class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
           Dashboard
        </a>
        <a href="{{ route('items.index') }}" 
            class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->is('items*') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
            Items
        </a>
        <a href="{{ route('receipts.index') }}" 
           class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->is('receipts*') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
           Receipts
        </a>
        <a href="{{ route('shipments.index') }}" 
           class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->is('shipments*') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
           Shipments
        </a>
        <a href="{{ route('vendors.index') }}" 
           class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->is('vendors*') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
           Vendors
        </a>
        <a href="{{ route('warehouses.index') }}" class="px-3 py-2 rounded text-sm font-medium hover:bg-blue-100 {{ request()->is('warehouses*') ? 'bg-blue-600 text-white' : 'text-blue-600' }}">
            Warehouses
        </a>
      </div>
    </div>
  </nav>

  <main class="container mx-auto px-6 py-4">
    @if (session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300">
        {{ session('success') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 border border-red-300">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>

  <footer class="text-center py-4 text-sm text-gray-500">
    <hr class="mb-3">
    <p>© {{ date('Y') }} TransLog System — Developed by <strong>Rofi Barbie Silviana Putri</strong></p>
  </footer>
  @include('components.alert')
</body>
</html>