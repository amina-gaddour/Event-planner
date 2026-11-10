@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-6">
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="max-w-4xl mx-auto px-6 py-12">

        <h1 class="text-2xl font-semibold mb-8">
            My Profile
        </h1>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 p-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="bg-white p-8 rounded-xl shadow space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input w-full" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input w-full" required>
            </div>

            <button class="bg-purple-600 hover:bg-purple-700
                               text-white px-6 py-2 rounded-lg">
                Update Profile
            </button>
        </form>

    </div>
@endsection