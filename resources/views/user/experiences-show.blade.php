@extends('layouts.user')
@section('content')

<div class="py-4" style="background-image: url('{{ asset('images/categories/' . $category->name . '.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container mx-auto">
        <div class="text-center mt-10 mb-12">
            <div class="mb-4">
                <h2 class="text-2xl sm:text-3xl text-white font-bold mb-4 shadow-black text-shadow">Experiencias</h2>
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold mt-10 sm:mt-20 text-white text-shadow">{{ $category->name }}</h1>
            </div>
            <!-- Botón Volver -->
            <div class="mb-8">
                <a href="{{ route('user.experiences') }}" class="text-white font-bold hover:text-gray-300 text-shadow text-2xl">
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-4 sm:p-8">
    <!-- Grid optimizado para todas las pantallas -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
        @foreach ($experiences as $experience)
        <div class="bg-white shadow-md rounded-lg overflow-hidden relative" style="min-width: 280px;">
            <!-- Imagen de experiencia -->
            <img src="{{ asset('storage/experiences/' . $experience->image) }}" alt="Imagen de experiencia" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-xl sm:text-2xl font-semibold mb-2 capitalize">{{ $experience->name }}</h3>
                <p class="text-gray-600 mb-2">{{ Str::limit($experience->short_description, 50) }}</p>
                <p class="text-gray-500 mb-2">Fecha Inicio: {{ \Carbon\Carbon::parse($experience->start_date)->format('d/m/Y') }}</p>
                <p class="text-gray-500 mb-2">Precio: {{ number_format($experience->price_per_person, 2) }}€</p>
                <p class="text-gray-500 mb-2">Empresa: {{ $experience->company->name }}</p>
                <p class="text-gray-500 mb-2">Web: <br> <a href="{{ $experience->company->website }}" target="_blank" class="text-blue-500 underline">{{ $experience->company->website }}</a></p>
                <div class="mt-4">
                    <x-danger-button href="{{ $experience->company->website }}">
                        Reserva Directa Establecimiento
                    </x-danger-button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
