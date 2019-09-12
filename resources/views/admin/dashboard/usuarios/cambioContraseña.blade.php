<div class="change-pass">
    <div class="form-group">
        <label for="password1" class="active">Contraseña actual</label>
        <input type="password" class="form-control" id="password1"
               name="password1"
               data-validation="password"
               placeholder="Ingresa tu contraseña actual"
        >
        @if($errors->has('password'))
            <label class="text-danger">{{$errors->first('password')}} </label>
        @endif
        <label for="password2" class="active">Nueva Contraseña (minímo 8
            caracteres)</label>
        <input type="password" class="form-control" id="password"
               name="password"
               data-validation="password"
               placeholder="Ingresa tu nueva contraseña"
        >
        @if($errors->has('password'))
            <label class="text-danger">{{$errors->first('password')}} </label>
        @endif
        <label for="password3" class="active">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="password3"
               name="password3"
               data-validation="password"
               placeholder="Ingresa nuevamente tu nueva contraseña"
        >
        @if($errors->has('password'))
            <label class="text-danger">{{$errors->first('password')}} </label>
        @endif
    </div>
</div>