@extends('layouts.user')

@section('content')

<div class="py-48 bg-cover bg-center" style="background-image: url('{{ asset('images/garrucha.avif') }}');">
    <div class="mb-8 mt-40 text-center">
        <x-danger-button a href="/explore" class="button min-h-14 text-shadow uppercase">Qué Visitar</x-danger-button>
    </div>

</div>
<div class="container mx-auto p-4 mt-8">
    <h1 class="text-red-600 font-extrabold text-6xl text-center text-shadow">it's happening</h1>

    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6"> @foreach($events as $event)
        @include('components.index-card', ['event' => $event])
        @endforeach
    </div>
</div>

@endsection
