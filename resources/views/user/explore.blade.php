@extends('layouts.user')

@section('content')

<div class="py-72 bg-cover bg-center" style="background-image: url('{{ asset('images/garrucha.avif') }}');">
    <div class="mb-8 text-center mt-36"></div>
</div>

<div class="container mx-auto px-4 py-8 ">
    <h1 class="text-red-500 font-extrabold text-6xl text-center text-shadow">Garrucha</h1>

    <section class="mt-8 mb-8">
        <h2 class="text-4xl text-center text-black font-bold">Instalaciones</h2>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/parque.jpg') }}" alt="Parque de Garrucha">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Parque de Garrucha</h3>
                    <p class="text-gray-600">Paseo del malecón</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/ayto.jpg') }}" alt="Ayuntamiento de Garrucha">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Ayuntamiento de Garrucha</h3>
                    <p class="text-gray-600">Breve descripción del ayuntamiento.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/sanjuan.jpg') }}" alt="Playa el Canela">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Playa el Canela</h3>
                    <p class="text-gray-600">Fiestas de San Juan en Garrucha</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/plaza.jpg') }}" alt="Plaza de Pedro Egea">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Plaza de Pedro Egea</h3>
                    <p class="text-gray-600">Plaza Ayuntamiento Pedro Egea</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/empleo.png') }}" alt="Oficina de Empleo">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">Oficina de Empleo</h3>
                    <p class="text-gray-600">Oficina de Empleo en Garrucha</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                <img class="w-full h-48 object-cover" src="{{ asset('images/coto.png') }}" alt="Merendero el Coto de Garrucha">
                <div class="p-6">
                    <h3 class="text-lg font-semibold">El Coto de Garrucha</h3>
                    <p class="text-gray-600">Merendero el Coto de Garrucha</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
