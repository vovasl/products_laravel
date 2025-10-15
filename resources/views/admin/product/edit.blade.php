{{-- @var App\Models\Product $model --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product #') . $model->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col-reverse lg:flex-row lg:items-stretch lg:space-x-6 space-y-4 lg:space-y-0">
                <div class="flex-1 order-2 lg:order-1">
                    @include('admin.product.partials._form', [
                        'action' => route('admin.products.update', $model->id),
                        'method' => 'PATCH',
                        'model' => $model,
                    ])
                </div>

                <div class="w-full lg:w-64 bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 order-1 lg:order-2">
                    <form
                        action="{{ route('admin.products.destroy', $model->id) }}"
                        method="POST"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}');"
                        class="h-full flex flex-col justify-end"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-6 py-2 rounded-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            <svg class="w-5 h-5" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
