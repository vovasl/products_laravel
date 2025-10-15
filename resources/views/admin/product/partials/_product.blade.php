<a href="{{ route('admin.products.edit', $product) }}"
   class="block bg-white dark:bg-gray-900 rounded-lg shadow-md p-4 hover:shadow-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition">

    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
        {{ $product->name }}
    </h3>

    @if($product->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $product->image) }}"
             alt="{{ $product->name }}"
             class="w-full h-40 object-cover rounded">
    </div>
    @else
    <div class="mb-3 w-full h-40 bg-gray-100 dark:bg-gray-700 rounded flex items-center justify-center text-gray-400">
        {{ __('No Image') }}
    </div>
    @endif

    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
        <strong>{{ __('Price') }}:</strong> ${{ number_format($product->price, 2) }}
    </p>

    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
        <strong>{{ __('Created') }}:</strong>
        {{ $product->created_at?->format('d.m.Y H:i') ?? __('N/A') }}
    </p>
</a>
