<form method="POST" action="{{ isset($event) ? route('admin.events.update', $event) : route('admin.events.store') }}"
    enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow space-y-6">

    @csrf
    @isset($event)
        @method('PUT')
    @endisset

    {{-- GLOBAL ERRORS --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600
                        rounded-lg p-4 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TITLE --}}
    <div>
        <label class="block text-sm font-medium">Title</label>
        <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}"
            class="input w-full @error('title') border-red-500 @enderror" required>
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- CATEGORY --}}
    <div>
        <label class="block text-sm font-medium">Category</label>
        <select name="category_id" class="input w-full @error('category_id') border-red-500 @enderror" required>
            <option value="">Select category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $event->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- DATES --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label>Start date</label>
            <input type="datetime-local" name="start_date"
                value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d\TH:i') : '') }}"
                class="input w-full @error('start_date') border-red-500 @enderror" required>
            @error('start_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>End date</label>
            <input type="datetime-local" name="end_date"
                value="{{ old('end_date', isset($event) ? $event->end_date->format('Y-m-d\TH:i') : '') }}"
                class="input w-full @error('end_date') border-red-500 @enderror" required>
            @error('end_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- PLACE & CAPACITY --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <input type="text" name="place" placeholder="Place" value="{{ old('place', $event->place ?? '') }}"
                class="input w-full @error('place') border-red-500 @enderror" required>
            @error('place')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="number" name="capacity" placeholder="Capacity"
                value="{{ old('capacity', $event->capacity ?? '') }}"
                class="input w-full @error('capacity') border-red-500 @enderror" required>
            @error('capacity')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- EVENT TYPE --}}
    <div>
        <label class="block text-sm font-medium mb-2">Event Type</label>
        <div class="flex items-center space-x-4">
            <label class="flex items-center">
                <input type="radio" name="is_free" value="1" class="mr-2" {{ old('is_free', $event->is_free ?? 1) == 1 ? 'checked' : '' }}>
                Free Event
            </label>
            <label class="flex items-center">
                <input type="radio" name="is_free" value="0" class="mr-2" {{ old('is_free', $event->is_free ?? '') == 0 ? 'checked' : '' }}>
                Paid Event
            </label>
        </div>
        @error('is_free')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- PRICE --}}
    <div id="priceField" class="{{ old('is_free', $event->is_free ?? 1) == 1 ? 'hidden' : '' }}">
        <label class="block text-sm font-medium">Price (DH)</label>
        <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $event->price ?? '') }}"
            class="input w-full @error('price') border-red-500 @enderror" placeholder="Enter price for paid event">
        @error('price')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- IMAGE --}}
    <div>
        <label>Image</label>
        <input type="file" name="image" class="input w-full @error('image') border-red-500 @enderror">
        @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        @isset($event->image)
            <img src="{{ $event->image_url }}" class="h-28 mt-3 rounded">
        @endisset
    </div>

    {{-- DESCRIPTION --}}
    <div>
        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" rows="4" class="input w-full @error('description') border-red-500 @enderror"
            required>{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- SUBMIT --}}
    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">
        {{ isset($event) ? 'Update Event' : 'Create Event' }}
    </button>
</form>

{{-- JS: TOGGLE PRICE --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const priceField = document.getElementById('priceField');
        const freeRadio = document.querySelector('input[name="is_free"][value="1"]');
        const paidRadio = document.querySelector('input[name="is_free"][value="0"]');

        function togglePriceField() {
            if (paidRadio.checked) {
                priceField.classList.remove('hidden');
                priceField.querySelector('input').required = true;
            } else {
                priceField.classList.add('hidden');
                priceField.querySelector('input').required = false;
            }
        }

        togglePriceField();
        freeRadio.addEventListener('change', togglePriceField);
        paidRadio.addEventListener('change', togglePriceField);
    });
</script>