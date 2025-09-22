@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Bienvendo a la configuración del sistema</h1>
    <hr>
@stop

@section('content')

    <x-adminlte-card theme="lime" theme-mode="outline">
        <div class="card-header">
            <h3 class="card-title">Configuración del Sistema</h3>
        </div>
        <div class="card-body">
            <form action=" {{ url('/admin/configuracion/create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Logo Sistema</label>
                            <div class="input-group-mb-3">
                                <input type="file" class="form-control" value="{{ old('logo', $configuracion->logo ?? '') }}"
                                    name="logo" onchange="mostrarImagen(event)" accept="image/*" required>
                                <br>
                                @if(isset($configuracion) && !empty($configuracion->logo))
                                    <img id="preview" src="{{ url($configuracion->logo) }}" style="max-width: 200px; margin-top: 10px; border-radius:10px">
                                @else
                                    <img id="preview" style="max-width: 200px; margin-top: 10px; border-radius:10px; display:none;">
                                @endif
                            </div>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <script>
                            const mostrarImagen = e =>
                                document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
                        </script>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre botón</label>
                            <input type="text" class="form-control" name="nombre"
                                value="{{ old('nombre', $configuracion->nombre ?? '') }}" required>
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{ route('home') }}" class="btn btn-primary float-right">Cancelar</a>
                            <button type="submit" class="btn btn-success float-right mr-2">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-adminlte-card>
@stop

@section('css')
@stop

@section('js')
    <script>
    </script>
@stop
