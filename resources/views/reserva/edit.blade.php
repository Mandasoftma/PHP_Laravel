@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Editar reserva</div>

                <div class="panel-body">
                    <form name="edit" class="form-horizontal" method="POST" action="{{ route('Reservas.update',$reserva->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('Names') ? ' has-error' : '' }}">
                            <label for="Names" class="col-md-4 control-label">Nombres</label>

                            <div class="col-md-6">
                                <input id="Names" type="text" class="form-control" name="Names" value="{{ $reserva->Names }}" autofocus>

                                @if ($errors->has('Names'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Names') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('LastName') ? ' has-error' : '' }}">
                            <label for="LastName" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="LastName" type="text" class="form-control" name="LastName" value="{{ $reserva->LastName }}" autofocus>

                                @if ($errors->has('LastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('NoPersonas') ? ' has-error' : '' }}">
                            <label for="NoPersonas" class="col-md-4 control-label">Numero de personas</label>

                            <div class="col-md-6">
                                <input id="NoPersonas" type="text" class="form-control" name="NoPersonas" value="{{ $reserva->NoPersonas }}" autofocus>

                                @if ($errors->has('NoPersonas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('NoPersonas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="NBut" style="display:none">{{ $reserva->NoPersonas }}</div>
                        <div class="form-group{{ $errors->has('Butacas') ? ' has-error' : '' }}">
                            <label for="Butacas" class="col-md-4 control-label">Butacas libres:</label>

                            <div class="col-md-6">
                                <div id="sala" class="col-md-12">
                                    <table class="table sala">
                                        <tbody>
                                            <tr>
                                            <th scope="row">A</th>
                                                @for ($i = 1; $i < 11; $i++)
                                                    <td><input class="form-check-input" type="checkbox" name="Butacas[]" onchange="validaCheck('{{$i}}A')" value="{{$i}}A" id="Check{{$i}}A">{{$i}}A</td>
                                                @endfor
                                            </tr>
                                            <tr>
                                            <th scope="row">B</th>
                                                @for ($i = 1; $i < 11; $i++)
                                                <td><input class="form-check-input" type="checkbox" name="Butacas[]" onchange="validaCheck('{{$i}}A')" value="{{$i}}B" id="Check{{$i}}B">{{$i}}B</td>
                                                @endfor
                                            </tr>
                                            <tr>
                                            <th scope="row">C</th>
                                                @for ($i = 1; $i < 11; $i++)
                                                <td><input class="form-check-input" type="checkbox" name="Butacas[]" onchange="validaCheck('{{$i}}C')" value="{{$i}}C" id="Check{{$i}}C">{{$i}}C</td>
                                                @endfor
                                            </tr>
                                            <th scope="row">D</th>
                                                @for ($i = 1; $i < 11; $i++)
                                                <td><input class="form-check-input" type="checkbox" name="Butacas[]" onchange="validaCheck('{{$i}}D')" value="{{$i}}D" id="Check{{$i}}D">{{$i}}D</td>
                                                @endfor
                                            </tr>
                                            <tr>
                                            <th scope="row">E</th>
                                                @for ($i = 1; $i < 11; $i++)
                                                <td><input class="form-check-input" type="checkbox" name="Butacas[]" onchange="validaCheck('{{$i}}E')" value="{{$i}}E" id="Check{{$i}}E">{{$i}}E</td>
                                                @endfor
                                            </tr>                                             
                                        </tbody>
                                    </table>                                                   
                                </div>

                                @if ($errors->has('Butacas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Butacas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        

                         <div class="panel-footer clearfix">
                            <p class="pull-right">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a class="btn btn-primary" href="{{ route('home') }}">Cancelar</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            dehabilitarCheckbox();
            validanroperonas();
        });

        function dehabilitarCheckbox(){
            var all = {!! json_encode($allreservas) !!};
            todos=document.edit.getElementsByTagName('input');
            all.forEach(element => {
                for(x=0;x<todos.length;x++){
                    if(document.edit.elements[x].type == "checkbox"){                                          
                        if (element.Butacas.indexOf(todos[x].value)>-1){
                            document.edit.elements[x].checked=1;
                            document.edit.elements[x].disabled = true;
                        }
                    }
                }            				
            });

            var butas ={!! json_encode($butacas)!!};
            butas.forEach(element => {
                for(x=0;x<todos.length;x++){
                    if(document.edit.elements[x].type == "checkbox"){                                          
                        if (element.indexOf(todos[x].value)>-1){
                            document.edit.elements[x].disabled = false;
                            console.log("check: ",todos[x].value);
                        }
                    }
                }
            });
        }

        function validaCheck(Check){
            var checkbox = document.getElementById('Check'+Check);
            var checked = checkbox.checked;
            var cont = document.getElementById("NBut").innerHTML;
            var nro = document.getElementById('NoPersonas');
            
                if(checked){
                    if(parseInt(cont)<parseInt(nro.value))
                        document.getElementById("NBut").innerHTML = parseInt(cont)+1;
                    else{
                        checkbox.checked=0;
                        if(parseInt(nro.value)==0)
                            alert("El número de personas no puede ser menor de 1.");
                        else
                            alert("El número de butacas seleccionadas no puede ser mayor a " + nro.value);
                    }
                }
                else
                    document.getElementById("NBut").innerHTML = parseInt(cont)-1;
            
       }

       function validanroperonas(){
           var campo = document.getElementById('NoPersonas');
           if(campo.value != ''){
                $('#sala *').attr("disabled", false);                 
           }else{                
                $('#sala *').attr("disabled", true);                
           }
           dehabilitarCheckbox();   
           if(parseInt(campo.value) >50){
               alert("El número de personas no puede ser mayor de 50.");
               campo.value = '0';
           }   
       }   
    </script>
@stop