@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Reserva numero: {{ $reserva->id }}</div>

                <div class="panel-body">
                    <strong>De:</strong>
                    <span>{{ $reserva->Names }} {{ $reserva->LastName }}</span>
                    <br/>
                    <strong>Numero de personas:</strong>
                    <span>{{ $reserva->NoPersonas }}</span>
                    <br/>
                    <strong>Puestos tomados:</strong>
                    <!-- <span>{{ $reserva->Butacas }}</span> -->                     
                     <br/>
                    <div id="sala">
                        @if(!empty($butacas))
                            <table class="table sala">
                                <tbody>
                                    <tr>
                                    <th scope="row">A</th>
                                        @for ($i = 1; $i < 11; $i++)
                                            <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}A" id="Check{{$i}}A" @if (in_array($i."A", $butacas)) checked="checked" @endif>{{$i}}A</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">B</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}B" id="Check{{$i}}B" @if (in_array($i."B", $butacas)) checked="checked" @endif>{{$i}}B</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">C</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}C" id="Check{{$i}}C" @if (in_array($i."C", $butacas)) checked="checked" @endif>{{$i}}C</td>
                                        @endfor
                                    </tr>
                                    <th scope="row">D</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}D" id="Check{{$i}}D" @if (in_array($i."D", $butacas)) checked="checked" @endif>{{$i}}D</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">E</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}E" id="Check{{$i}}E" @if (in_array($i."E", $butacas)) checked="checked" @endif>{{$i}}E</td>
                                        @endfor
                                    </tr>                                             
                                </tbody>
                            </table>
                        @else
                            <table class="table sala">
                                <tbody>
                                    <tr>
                                    <th scope="row">A</th>
                                        @for ($i = 1; $i < 11; $i++)
                                            <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}A" id="Check{{$i}}A">{{$i}}A</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">B</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}B" id="Check{{$i}}B">{{$i}}B</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">C</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}C" id="Check{{$i}}C">{{$i}}C</td>
                                        @endfor
                                    </tr>
                                    <th scope="row">D</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}D" id="Check{{$i}}D">{{$i}}D</td>
                                        @endfor
                                    </tr>
                                    <tr>
                                    <th scope="row">E</th>
                                        @for ($i = 1; $i < 11; $i++)
                                        <td><input class="form-check-input" type="checkbox" name="Butacas[]" value="{{$i}}E" id="Check{{$i}}E">{{$i}}E</td>
                                        @endfor
                                    </tr>                                             
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="panel-footer clearfix">
                        <p class="pull-right">
                            <a class="btn btn-primary" href="{{ route('Reservas.edit',$reserva->id )}}">Editar</a>
                            <a class="btn btn-primary" href="{{ route('home') }}">Cancelar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection