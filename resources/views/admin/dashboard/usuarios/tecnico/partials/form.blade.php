<h3>Datos personales</h3>
<div class="row pb-5">
    <div class="col-md-6">
        <div class="form-group">
            <label for="cedula_p" class="active">Cédula</label>
            <input type="text" class="form-control" id="cedula_p" name="cedula_p"
                   data-validation="numeric"
                   data-validation-length="9-10"
                   data-validation-error-msg="El número debe tener(10 dígitos)"
                   placeholder="Ingrese su numero de cédula"
                   value="{{ old('cedula_p') }}"
            >
            @if($errors->has('cedula_p'))
                <label class="text-danger">{{$errors->first('cedula_p')}} </label>
            @endif

        </div>
        <div class="form-group">
            <label for="nombre_p" class="active">Nombres</label>
            <input type="text" class="form-control" id="nombre_p" name="nombre_p"
                   data-validation="alphabet" placeholder="Ingrese sus nombres"
                   value="{{old('nombre_p')}}">
            @if($errors->has('nombre_p'))
                <label class="text-danger">{{$errors->first('nombre_p')}} </label>
            @endif
        </div>
        <div class="form-group">
            <label for="apellido_p" class="active">Apellidos</label>
            <input type="text" class="form-control" id="apellido_p" name="apellido_p"
                   data-validation="alphabet" placeholder="Ingrese sus apellidos"
                   value="{{old('apellido_p')}}">
            @if($errors->has('apellido_p'))
                <label class="text-danger">{{$errors->first('apellido_p')}} </label>
            @endif
        </div>
        <div class="form-group">
            <label for="telefono_p" class="active">Teléfono</label>
            <input type="text" class="form-control" id="telefono_p" name="telefono_p"
                   data-validation="numeric"
                   placeholder="Ingrese su numero de teléfono"
                   value="{{old('telefono_p')}}">
            @if($errors->has('telefono_p'))
                <label class="text-danger">{{$errors->first('telefono_p')}} </label>
            @endif
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="direccion_p" class="active">Dirección</label>
            <input type="text" class="form-control" name="direccion_p" id="direccion_p"
                   data-validation="alphanumeric"
                   placeholder="Ingrese su dirección" value="{{old('direccion_p')}}">
            @if($errors->has('direccion_p'))
                <label class="text-danger">{{$errors->first('direccion_p')}} </label>
            @endif
        </div>
        <div class="form-group">
            <label for="direccion_p" class="active">Tipo de usuario</label>
            <select disabled class="form-control" name="tipo_p" id="tipo_p">
                <option selected value="2">Cliente</option>
                <option  value="0">Administrador</option>
                <option value="1">Técnico</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="active">Nombre de usuario(3-12 carácteres)</label>
            <input type="text" class="form-control" name="name" id="name"
                   data-validation="length alphanumeric"
                   data-validation-length="3-12"
                   data-validation-error-msg="Username has to be an alphanumeric value (3-12 chars)"
                   placeholder="Ingrese el nombre de usuario" value=" {{old('name')}}">
            @if($errors->has('name'))
                <label class="text-danger">{{$errors->first('name')}} </label>
            @endif
        </div>
        <div class="form-group">
            <label for="email" class="active">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   data-validation="email" placeholder="Enter Email"
                   value="{{old('email')}}"
            >
            @if($errors->has('email'))
                <label class="text-danger">{{$errors->first('email')}} </label>
            @endif
        </div>
    </div>
</div>
<hr>
<h3>Perfil profesional</h3>
<div class="row pb-5">
    <div class="col-md-6">
        <div class="form-group">
            <label for="especialidad_t" class="active">Especialidad</label>
            <input type="text" class="form-control" id="especialidad_t" name="especialidad_t"
                   data-validation="alphabet" placeholder="Ingrese una especialidad"
                   value="{{old('especialidad_t')}}">
            @if($errors->has('especialidad_t'))
                <label class="text-danger">{{$errors->first('especialidad_t')}} </label>
            @endif
        </div>
        <div class="form-group">
            <label for="profesion_t" class="active">Profesión</label>
            <input type="text" class="form-control" id="profesion_t" name="profesion_t"
                   data-validation="alphabet" placeholder="Ingrese una profesión"
                   value="{{old('profesion_t')}}">
            @if($errors->has('profesion_t'))
                <label class="text-danger">{{$errors->first('profesion_t')}} </label>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tipo_t" class="active">Tipo de técnico</label>
            <select class="form-control" name="tipo_t" id="tipo_t">
                <option value="0">Principal</option>
                <option value="1">Secundario</option>
            </select>
        </div>
    </div>

</div>
<hr>
<div class="col-md-12">
    <div class="form-group">
        <button class="btn btn-success pull-right" type="submit">Guardar</button>
        <a href="{{url()->previous()}}" class="btn btn-danger pull-right">Cancelar</a>

    </div>
</div>


@section('script')

    <script type="text/javascript">

    </script>
@endsection