<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product: ') . $model->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col-reverse lg:flex-row lg:items-start lg:space-x-6 space-y-4 lg:space-y-0">
                <div class="flex-1 order-2 lg:order-1">
                    @include('admin.product.partials._form', [
                        'action' => route('admin.products.update', $model->id),
                        'method' => 'PATCH',
                        'model' => $model,
                    ])
                </div>

                <div class="w-full lg:max-w-52 bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 order-1 lg:order-2 flex flex-col space-y-4">

                    <div class="text-sm text-gray-600 dark:text-gray-400 space-y-4">

                        <div class="mb-4 flex items-center">
                            <label class="block text-gray-700 font-bold mr-2">{{ __('ID') }}:</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $model->id }}</p>
                        </div>

                        <div class="mb-4 flex sm:flex-col sm:items-start">
                            <label class="block text-gray-700 font-bold mr-2 sm:mb-1">{{ __('Created') }}:</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $model->created_at?->format('d.m.Y H:i') ?? __('N/A') }}</p>
                        </div>

                        <div class="mb-4 flex sm:flex-col sm:items-start">
                            <label class="block text-gray-700 font-bold mb-1">{{ __('Updated') }}:</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $model->updated_at?->format('d.m.Y H:i') ?? __('N/A') }}</p>
                        </div>

                    </div>

                    <form
                        action="{{ route('admin.products.destroy', $model->id) }}"
                        method="POST"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}');"
                        class="flex flex-col mb-4"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-6 py-2 rounded-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            {{ __('Delete') }}
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
