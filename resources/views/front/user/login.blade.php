@extends('layouts.front')

@section('cssExtras')
@endsection

@section('styleExtras')
@endsection

@section('content')
<div class="container mt-5 mb-5 py-5">
    <div class="row mt-5">
        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 col-9 mx-auto">
            <h1>Iniciar sesión</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signin') }}" method="POST">
                @csrf
                <div class="form-group row mt-2">
                    <div class="col-12 mx-auto">
                        <label for="email" class="fs-5">Correo electronico</label>
                        <input type="text" id="email" name="email" class="form-control fs-5" required>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <div class="col-12 mx-auto">
                        <label for="password" class="fs-5">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control fs-5" required>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <div class="col-6 mx-auto">
                        <button type="submit" class="btn w-100 btn-primary mt-5 fs-5">Entrar a mi cuenta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jsLibExtras2')
@endsection
