@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')

<div class="align-items-right">
<h1>Sedes</h1>
    <a href="{{ url('/admin/sedes/create') }}" class="btn btn-success ms-auto align-items-right">
                <i class="fas fa-plus me-2"></i> Nueva Sede
            </a>
    <hr>
</div>
    
@stop

@section('content')
    <x-adminlte-card theme="lime" theme-mode="outline">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Lista de Sedes</h3>
            
        </div>
        <div class="card-body">
            <table id="sedes-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sedes as $index => $sede)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sede->nombre }}</td>
                            <td>{{ $sede->telefono }}</td>
                            <td>
                                <!-- Aquí puedes poner botones de editar/eliminar -->
                                <a href="{{ url('/admin/sedes/edit', $sede->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ url('/admin/sedes/delete/' . $sede->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta sede?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-adminlte-card>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>  </script>
@stop