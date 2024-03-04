@extends('layouts.app')

@section('content')
<h1>Eventos Próximos</h1>
@foreach($events as $event)
<div>{{ $event->name }}</div>
@endforeach
@endsection
