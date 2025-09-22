@extends('adminlte::page')

@section('content_header')
    <h1>Configuración</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Configuración Inicial</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/alerta/configuracion') }}">
                @csrf
                <div class="mb-3">
                    <label for="sede" class="form-label">Sede</label>
                    <select name="sede_id" class="form-select form-control" required>
                        @foreach($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select name="tipo" class="form-select form-control" required>
                        <option value="Consultorio">Consultorio</option>
                        <option value="Taquilla">Taquilla</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="consultorio" class="form-label">Consultorio o Taquilla</label>
                    <input type="text" name="consultorio" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar Datos</button>
            </form>
        </div>
    </div>
@endsection

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
