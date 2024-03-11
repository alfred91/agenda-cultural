@extends('layouts.user')

@section('content')

<div class="py-4 bg-gradient-to-r from-cyan-600 to-blue-500 ">
    <div class="mb-8 mt-36 text-center">
        <h1 class=" mt-12 text-6xl font-bold text-white text-shadow">agenda</h1>
        <div class="mb-8 text-center ml-96 pl-96">

            <a href="{{ route('user.agenda') }}" class="mx-auto text-white font-bold hover:text-gray-300 text-shadow text-2xl">
                Volver
            </a>
        </div>
    </div>


    <div class="flex justify-center mb-8 text-center ">
        <div class="w-full sm:w-2/3 lg:w-1/2 xl:w-1/3">
            <select onchange="window.location.href = this.value" class="w-64 px-6 py-2 border-2 rounded-lg bg-blue-500 border-white text-white text-xl">
                <option value="{{ route('user.agenda') }}">Categoría</option>
                @foreach ($categories as $category)
                <option value="{{ route('user.agenda', ['category' => $category->id]) }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex justify-center mb-0 text-shadow">
        <div class="w-full sm:w-2/3 lg:w-1/2 xl:w-1/3">
            <div class="flex justify-between items-center">
                <a href="{{ route('user.agenda', ['category' => request('category'), 'period' => 'all']) }}" class="text-white hover:underline">Todos</a>
                <a href="{{ route('user.agenda', ['category' => request('category'), 'period' => 'week']) }}" class="text-white hover:underline">Esta Semana</a>
                <a href="{{ route('user.agenda', ['category' => request('category'), 'period' => 'month']) }}" class="text-white hover:underline">Este Mes</a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-0 sm:p-0">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8 mt-10">
        @foreach ($events as $event)
        <x-event-card :event="$event" />
        @endforeach
    </div>
    <div class="flex justify-center mt-8">
        {{ $events->links() }}
    </div>
</div>
@endsection
