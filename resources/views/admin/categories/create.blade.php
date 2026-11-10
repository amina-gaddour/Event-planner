@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-10">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">
            Create Category
        </h1>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-gray-600 mb-1">
                    Category name
                </label>

                <input type="text" name="name" value="{{ old('name') }}" class="input w-full" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 mt-6">
                <button class="bg-purple-600 hover:bg-purple-700
                               text-white px-5 py-2 rounded-lg transition">
                    Create
                </button>

                <a href="{{ route('admin.categories.index') }}"
                    class="px-5 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Cancel
                </a>
            </div>
        </form>

    </div>
@endsection