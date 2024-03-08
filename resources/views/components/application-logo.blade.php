@php
$user = auth()->user();
@endphp

@if ($user && $user->role === 'administrador')
<img src="{{ asset('images/admin.svg') }}" alt="Logo Admin" class="block h-10 w-auto">

@elseif ($user && $user->role === 'creador_eventos')
<img src="{{ asset('images/creator.svg') }}" alt="Logo Creator" class="block h-10 w-auto">

@else
<img src="{{ asset('images/prawn.svg') }}" alt="Logo" class="block h-14 mt-4 w-auto">
@endif
