@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Editar Sede</h1>
@stop

@section('content')
    <x-adminlte-card theme="lime" theme-mode="outline">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Editar Sede</h3>

        </div>
        <div class="card-body">
            <form action="{{ url('/admin/sedes/' . $sede->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $sede->nombre) }}" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $sede->telefono) }}" required>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ url('admin/sedes/index') }}" class="btn btn-primary float-right">Cancelar</a>
                            <button type="submit" class="btn btn-success float-right mr-2">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-adminlte-card>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
