@extends('layouts.user')

@section('content')
<div class="py-4 bg-gradient-to-r from-green-300 to-blue-300">
    <div class="mb-8 text-center">
        <h1 class="mt-36 text-6xl font-extrabold text-white text-shadow dark:text-white">EXPERIENCIAS</h1>
    </div>
    <div class="flex justify-center mb-8 text-center">
    </div>
</div>

<div class="container mx-auto p-4 sm:p-6">
    <div class="grid grid-cols-1 gap-4 xl:gap-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3">
        @foreach ($categories as $category)
        <a href="{{ route('user.experiences.show', $category->id) }}" class="shadow block relative">
            <div class="relative pb-[56.25%]">
                <img src="{{ asset('images/categories/' . $category->name . '.jpg') }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover rounded-lg">
                <div class="absolute inset-0 bg-black opacity-60 hover:opacity-0 transition-opacity duration-300 flex items-center justify-center rounded-lg">
                    <h3 class="text-2xl font-semibold text-white p-2 shadow-black">
                        {{ $category->name }}
                    </h3>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
