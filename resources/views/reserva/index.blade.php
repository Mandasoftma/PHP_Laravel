@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Reservas:
                <p class="pull-right">
                   <a class="btn btn-primary btn-sm" href="{{ route('Reservas.create')}}">+ Reservar</a>
                </p>
                </div>
               
                <div class="panel-body">
                    @include('alertas.success')
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col"># Personas</th>
                                <th scope="col">opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservas as $res)
                                <tr>
                                    <th scope="row">{{ $res->id }}</th>
                                    <td>{{ $res->Names }}</td>
                                    <td>{{ $res->LastName }}</td>
                                    <td>{{ $res->NoPersonas }}</td>
                                    <td>                                        
                                        <a class="btn btn btn-link btn-sm" href="{{ route('Reservas.edit',$res->id )}}" style="float: left">Editar</a>
                                        <form action="{{ route('Reservas.destroy',$res->id ) }}" method="POST" style="float: left">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn btn-link btn-sm" onclick="return confirm('Estas seguro eliminar la reserva del cliente: {{ $res->Names }} {{ $res->LastName }}?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach                        
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection