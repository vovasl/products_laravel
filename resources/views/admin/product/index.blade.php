<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('admin.products.create') }}"
                   class="inline-flex items-center mb-6 px-4 py-2 bg-blue-100 border border-blue-300 rounded-md font-semibold text-sm text-blue-600 uppercase tracking-widest hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                    {{ __('Add Product') }}
                </a>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($paginator as $product)
                        @include('admin.product.partials._product', [
                            'product' => $product,
                        ])
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $paginator->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
