@extends('admin/base/base_login')
<div class="container-fluid">
    <div class="row">
        <div class="right-column sisu">
            <div class="row mx-0">
                <div class="col-md-7 order-md-2 signin-right-column px-5 bg-dark">
                    <a class="signin-logo d-sm-block d-md-none" href="#">
                        <img src="{{asset('img/logoaj.png')}}" width="145" height="145" alt="QuillPro">
                    </a>
                    <h1 class="display-4">Inicio de sesión</h1>
                    <p class="lead mb-5">
                        Sistema de incidencias -AJ Computación
                    </p>
                </div>
                <div class="col-md-5 order-md-1 signin-left-column bg-white">
                    <a class="align-content-center signin-logo d-sm-none d-md-block" href="#">
                        <img src="{{asset('img/logoajazul.png')}}" width="200" height="200" alt="QuillPro">
                    </a>
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Ingrese su email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <small id="emailHelp" class="form-text text-muted">Inicie sesión con su email o nombre de
                                usuario
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-gradient btn-block">
                            <i class="batch-icon batch-icon-key"></i>
                            Iniciar sesión
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <hr>
                        <p class="text-center">
                            Olvidaste tu contrseña? <a href="sisu-signup.html">Presiona aquí</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
