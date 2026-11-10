@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-6">

        <h1 class="text-2xl font-semibold text-center mb-12">
            Create Event
        </h1>

        @include('admin.events._form')

    </div>
@endsection