@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="text-center">
        <h3>Configuración del sistema</h3>
    </div>

    @if(Session::has('status_ok'))
        <p class="alert alert-success">{{Session::get('status_ok')}}</p>

    @endif

        @if(Session::has('status_error'))
        <p class="alert alert-danger">{{Session::get('status_error')}}</p>

    @endif
    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 panel-informacion-admin">
           
            
            


            {{ Form::model($configuracion,['route'=>'guardar.configuracion', 'method'=>'POST', 'role'=>'form', 'novalidate', 'id'=>'configuracion']) }} 
                <div class="row linea-separadora espacio-superior-peq">
                    <div class="col-xs-12 col-sm-10 ">
                        {{ Form::label('anunciosadministrador','Anuncios permitidos para un administrador:') }}
                    </div>
               
                    <div class="col-xs-12 col-sm-2">
                           <input name="anunciosadministrador" type="number" min="3" max="100" data-validation="number" data-validation-allowing="range[3;100]"
                                        data-validation-error-msg-number="Valor de 3 a 100" size="2" value="{{$configuracion->anunciosadministrador}}" >
                    </div>
                    

                </div>
                {{ $errors->first('anunciosadministrador', '<p class="alert alert-danger errores">:message</p>')}} 



                 <div class="row linea-separadora espacio-superior-peq">
                    <div class="col-xs-12 col-sm-10">
                        {{ Form::label('anunciosusuario','Anuncios permitidos para un usuario:') }}
                    </div>
               
                    <div class="col-xs-12 col-sm-2">
                           <input name="anunciosusuario" type="number" min="3" max="50" data-validation="number" data-validation-allowing="range[3;50]"
                                        data-validation-error-msg-number="Valor de 3 a 50" size="2" value="{{$configuracion->anunciosusuario}}">
                    </div> 
                </div>
                {{ $errors->first('anunciosusuario', '<p class="alert alert-danger errores">:message</p>')}} 

                  <div class="row linea-separadora espacio-superior-peq">
                    <div class="col-xs-12 col-sm-10">
                        {{ Form::label('anunciosbloqueados','Máximo de anuncios bloqueados:') }}
                    </div>
               
                    <div class="col-xs-12 col-sm-2">
                           <input  name="anunciosbloqueados"type="number" min="3" max="20" data-validation="number" data-validation-allowing="range[3;20]"
                                        data-validation-error-msg-number="Valor de 3 a 20" size="2" size="2" value="{{$configuracion->anunciosbloqueados}}">
                    </div> 
                </div>
                {{ $errors->first('anunciosbloqueados', '<p class="alert alert-danger errores">:message</p>')}} 

                  <div class="row linea-separadora espacio-superior-peq">
                    <div class="col-xs-12 col-sm-10">
                        {{ Form::label('comentariosbloqueados','Comentarios bloqueados:') }}
                    </div>
               
                    <div class="col-xs-12 col-sm-2">
                        <input name="comentariosbloqueados"  type="number" min="3" max="20" data-validation="number" data-validation-allowing="range[3;20]"
                                        data-validation-error-msg-number="Valor de 3 a 20" size="2" size="2" value="{{$configuracion->comentariosbloqueados}}">

                    </div> 
                </div>
                {{ $errors->first('comentariosbloqueados', '<p class="alert alert-danger errores">:message</p>')}} 


                <div class="row linea-separadora espacio-superior-peq espacio-inferior-peq">
                    <div class="col-xs-12 col-sm-10">
                        {{ Form::label('contadordedenuncias','Contador de denuncias:') }}
                    </div>
               
                    <div class="col-xs-12 col-sm-2">
                         <input name="contadordedenuncias" type="number" min="3" max="50" data-validation="number" data-validation-allowing="range[3;50]"
                                        data-validation-error-msg-number="Valor de 3 a 50" size="2" value="{{$configuracion->contadordedenuncias}}">

                    </div> 
                </div>
               {{ $errors->first('contadordedenuncias', '<p class="alert alert-danger errores">:message</p>')}} 
            

               <div class="row espacio-superior-peq espacio-inferior-peq">
                    <div class="col-xs-12 col-sm-10">
                        {{ Form::label('permitirsolicitud','Permitir solicitudes para administrador:') }}
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <select name="solicitudes" data-validation="required" required>
                                @if($configuracion->solicitudes =='NO')
                        
                                    <option value= 'NO' selected> NO </option>
                                    <option value= 'SI' > SI </option>
                                @elseif($configuracion->solicitudes == 'SI')
                                
                                    <option value= 'NO' > NO </option>
                                    <option value= 'SI' selected> SI </option>
                                @endif
                              
                        </select>
                    </div> 
                </div>


        </div>

        <div class="col-xs-12  col-sm-offset-5 col-sm-2 espacio-superior-peq">
                            <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-espacio">
                    Guardar
                </button>
        </div>

        {{ Form::close() }}
            
        
    </div> 
</div><!--fin contenedor interno-->

@include('modales.modalguardarconfiguraciones')

@stop

@section('scripts')
    <script>

    
       $.validate({
            form : '#configuracion',
            //modules : 'file',
            borderColorOnError : '#A52A2A',
            addValidClassOnAll : true,

            onSuccess : function() {

                $('#configuracion').find('[type="submit"]').text('Guardando...').addClass('disabled');
                
            },


        });
    </script>

@stop