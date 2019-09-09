<div class="row pb-5">
    <div class="col-md-12">

        {{--
        <div class="form-group">
            {{ Form::label('id_p', 'Clientes') }}
            {{ Form::select('id_p', $users, null, ['class' => 'form-control']) }}
        </div>
         --}}
        <div class="form-group">
            {{ Form::label('id_e', 'Equipo') }}
            {{ Form::select('id_e', $equipos, null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('problema_re', 'Indique el problema') }}
            {{ Form::textarea('problema_re', null, ['class' => 'form-control', 'id' => 'problema_re']) }}
        </div>
        @if($errors->has('problema_re'))
            <label class="text-danger">{{$errors->first('problema_re')}} </label>
        @endif

        <div class="form-group">
            {{ Form::label('fecha_salida_re', 'Fecha de entrega') }}
            {{ Form::date('fecha_salida_re', null, ['class' => 'form-control', 'id' => 'fecha_salida_re']) }}
        </div>
        @if($errors->has('fecha_salida_re'))
            <label class="text-danger">{{$errors->first('fecha_salida_re')}} </label>
        @endif

        <div class="form-group">
            {{ Form::label('accesorios_re', 'Accesorios') }}
            {{ Form::textarea('accesorios_re', null, ['class' => 'form-control', 'id' => 'accesorios_re']) }}
        </div>
        @if($errors->has('accesorios_re'))
            <label class="text-danger">{{$errors->first('accesorios_re')}} </label>
        @endif
    </div>
</div>

<div class="row pb-5">
    <div class="col-md-12">

        <div class="form-group">
            {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
        </div>

    </div>
</div>

@section('script')

    <script type="text/javascript">

    </script>
@endsection