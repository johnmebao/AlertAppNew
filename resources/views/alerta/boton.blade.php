@extends('adminlte::page')

@section('content_header')
    
@stop

@section('content')
    <style>
.card {
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.card-header {
    background-color: #276197;
    color: white;
    text-align: center;
    display: flex;
    justify-content: center;
    padding-top: 15px;
    padding: 15px;
    border-radius: 15px;
    width: 100%;
}
.card-body {
    padding: 15px;
}
.alert {
    color: rgb(0, 0, 0);
    font-size: 30px;
    margin-top: 10px;
    width: 100%;
    text-align: center;
}

.alert-panic {
    color: rgb(15, 91, 206);
    font-size: 30px;
    margin-top: 10px;
    width: 100%;
    text-align: center;
}
.boton-alerta {
    width: 250px;
    height: 250px;
    padding: 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 30px;
    cursor: pointer;
}
</style>
@php
    $configuracion = \App\Models\Configuracion::first();
    $nombreBoton = $configuracion ? $configuracion->nombre : 'Botón de Emergencia';
@endphp

<div class="card" style="display: flex; flex-direction: column; align-items: center;">
    <div class="card-header text-center">
        <h3>Botón de Emergencia</h3>
    </div>
    <div class="card-body" style="display: flex; flex-direction: column; align-items: center; width: 100%;">
        <form method="POST" action="{{ url('alerta/boton-panico') }}" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
            @csrf
            @if(isset($configuracion) && !empty($configuracion->nombre))
                <button type="submit" class="boton-alerta">🚨 <br> <hr>{{ $nombreBoton }}</button>
            @else
                <button type="submit" class="boton-alerta">🚨 <br> <hr>Presionar en caso de emergencia</button>
            @endif
        </form>
        @if(session('status'))
            <div class="alert-panic" >{{ session('status') }}</div>
        @endif
        
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop

