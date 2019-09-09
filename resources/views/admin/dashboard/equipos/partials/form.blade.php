
<div class="row pb-1">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('serie_e', 'Número de serie') }}
            {{ Form::text('serie_e', null, ['class' => 'form-control', 'id' => 'serie_e']) }}
        </div>
        @if($errors->has('serie_e'))
            <label class="text-danger">{{$errors->first('serie_e')}} </label>
        @endif
        <div class="form-group">
            {{ Form::label('marca_e', 'Marca del equipo') }}
            {{ Form::text('marca_e', null, ['class' => 'form-control', 'id' => 'marca_e']) }}
        </div>
        @if($errors->has('marca_e'))
            <label class="text-danger">{{$errors->first('marca_e')}} </label>
        @endif

    </div>
    <div class="col-md-6">

        <div class="form-group">
            {{ Form::label('modelo_t', 'Modelo dle equipo') }}
            {{ Form::text('modelo_t', null, ['class' => 'form-control', 'id' => 'modelo_t']) }}
        </div>
        @if($errors->has('modelo_t'))
            <label class="text-danger">{{$errors->first('modelo_t')}} </label>
        @endif
        <div class="form-group">
            {{ Form::label('tipo_t', 'Tipo de Equipo') }}
            {{Form::select('tipo_t',array(
               '1' => 'Laptop',
               '2' => 'CPU',
               '3' => 'Monitor',
               '4' => 'Tablet'
               ),null,['class'=>'form-control','id'=>'tipo_p'])}}
        </div>


    </div>
</div>
<div class="row pb-5">
    <div class="col-md-12">

        <div class="form-group">
            {{ Form::label('descripcion_e', 'Descripción') }}
            {{ Form::textarea('descripcion_e', null, ['class' => 'form-control']) }}
        </div>
        @if($errors->has('descripcion_e'))
            <label class="text-danger">{{$errors->first('descripcion_e')}} </label>
        @endif
        <div class="form-group">
            <button class="btn btn-success pull-right mx-1" type="submit">Guardar</button>
            <a href="{{route('equipos.index')}}" class="btn btn-danger pull-right">Cancelar</a>


        </div>

    </div>
</div>

