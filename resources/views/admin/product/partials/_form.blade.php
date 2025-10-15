@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md space-y-6">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Name') }}
            </label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $model->name ?? '') }}"
                class="block w-full border border-gray-300 rounded-md px-4 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('name') border-red-500 ring-red-500 focus:ring-red-500 @enderror"
                placeholder="{{ __('Enter product name') }}"
                required
            >
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('SKU') }}
            </label>
            <input
                type="text"
                name="sku"
                id="sku"
                value="{{ old('sku', $model->sku ?? '') }}"
                class="block w-full border border-gray-300 rounded-md px-4 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('sku') border-red-500 ring-red-500 focus:ring-red-500 @enderror"
                placeholder="{{ __('Enter SKU') }}"
                required
            >
            @error('sku')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Price') }}
            </label>
            <input
                type="number"
                step="0.01"
                name="price"
                id="price"
                value="{{ old('price', $model->price ?? '') }}"
                class="block w-full border border-gray-300 rounded-md px-4 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('price') border-red-500 ring-red-500 focus:ring-red-500 @enderror"
                placeholder="{{ __('Enter price') }}"
                required
            >
            @error('price')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Quantity') }}
            </label>
            <input
                type="number"
                name="quantity"
                id="quantity"
                value="{{ old('quantity', $model->quantity ?? '') }}"
                class="block w-full border border-gray-300 rounded-md px-4 py-2 text-gray-900 dark:text-white bg-white dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('quantity') border-red-500 ring-red-500 focus:ring-red-500 @enderror"
                placeholder="{{ __('Enter quantity') }}"
                required
            >
            @error('quantity')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div x-data="{
        fileName: '',
        previewUrl: '{{ isset($model) && !empty($model->image) ? asset('storage/' . $model->image) : '' }}',
        hasInitialPhoto: {{ isset($model) && !empty($model->image) ? 'true' : 'false' }},
        get displayText() {
            if (this.fileName || this.hasInitialPhoto) return '';
            return 'No file chosen';
        },
        updatePreview(event) {
            const file = event.target.files[0];
            if (!file) {
                this.fileName = '';
                this.previewUrl = '{{ isset($model) && !empty($model->image) ? asset('storage/' . $model->image) : '' }}';
                this.hasInitialPhoto = !!this.previewUrl;
                return;
            }
            this.fileName = file.name;
            this.hasInitialPhoto = true;
            const reader = new FileReader();
            reader.onload = e => {
                this.previewUrl = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }"
        >
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Image') }}
            </label>

            <div class="flex items-center gap-4 mb-4">
                <label for="image"
                       class="cursor-pointer inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md">
                    {{ __('Choose file') }}
                </label>

                <span x-text="displayText" class="text-sm text-gray-500"></span>
            </div>

            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                class="hidden"
                x-on:change="updatePreview($event)"
            >

            <template x-if="previewUrl">
                <img :src="previewUrl" alt="Product Image" class="w-32 h-32 object-cover rounded border" />
            </template>

            @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="flex justify-end">
        <button
            type="submit"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-2 rounded-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
            <svg class="w-5 h-5" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>
            </svg>
            {{ __('Save') }}
        </button>
    </div>
</form>
