@extends('layouts.admin')
@section('cssExtras')
	<link rel="stylesheet" href="{{asset('css/dropify.css')}}">
@endsection
@section('jsLibExtras')

@endsection
@section('styleExtras')

@endsection
@section('content')
	<div class="row mb-4 px-2">
		<a href="{{ route('config.seccion.index') }}" class="col col-md-2 btn btn-sm grey darken-2 text-white mr-auto"><i class="fa fa-reply"></i> Regresar</a>
	</div>
	
    @foreach ($user as $usu)
        <p>{{ $usu->name }} {{ $usu->lastname }} | {{ $usu->email }}</p>
    @endforeach

    @foreach ($orders as $ord)
        <p>{{ $ord }}</p>
    @endforeach

@endsection
@section('jsLibExtras2')
<script src="{{asset('js/dropify.js')}}" charset="utf-8"></script>
@endsection
@section('jqueryExtra')

@endsection
