@php
$user = auth()->user();
@endphp

@if ($user && $user->role === 'administrador')
<!-- Logo para administradores -->
<img src="{{ asset('images/admin.svg') }}" alt="Logo Admin" class="block h-10 w-auto">
@elseif ($user && $user->role === 'creador_eventos')

<!-- Logo para creadores de eventos -->
<img src="{{ asset('images/creator.svg') }}" alt="Logo Creator" class="block h-10 w-auto">
@else
<!-- Logo estándar para usuarios -->
<img src="{{ asset('images/users.svg') }}" alt="Logo" class="block h-10 w-auto">
@endif
