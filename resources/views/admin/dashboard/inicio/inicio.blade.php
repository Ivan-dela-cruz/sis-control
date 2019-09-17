@extends('admin/base/base_dashboard')
@section('title')
    Inicio
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-primary bg-gradient text-center">
                <div class="card-body p-4">
                    <!-- Accepts .invisible: Makes the items. Use this only when you want to have an animation called on it later -->
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-list-alt batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{count($ordenesNuevas)}}</div>
                        <div class="tile-description"><p class="font-bold">Ordenes nuevas</p></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-danger bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-tag-alt-2 batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{count($ordenesAsignadas)}}</div>
                        <div class="tile-description"><p class="font-bold">Ordenes en revisión</p></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-4 mb-5">
            <div class="card card-tile card-xs bg-success bg-gradient text-center">
                <div class="card-body p-4">
                    <div class="tile-left">
                        <i class="batch-icon batch-icon-print batch-icon-xxl"></i>
                    </div>
                    <div class="tile-right">
                        <div class="tile-number">{{count($ordenesFinalizadas)}}</div>
                        <div class="tile-description"><p class="font-bold">Ordenes terminadas</p></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-xl-4 mb-5">
            <div class="card card-task card-md">
                <div class="card-header">
                    Ordenes finalizadas
                    <p class="task-list-stats">
                        <span class="task-list-completed">0</span> de <span class="task-list-total">0</span>
                        ordenes teminadas
                    </p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-sm bg-gradient" role="progressbar"
                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                             style="width: 0%"></div>
                    </div>
                    <div class="header-btn-block">
                        <a href="{{route('listar-ordenes-finalizadas-admin')}}" class="btn btn-primary">
                            <i class="batch-icon batch-icon-database"></i>
                        </a>
                    </div>
                </div>
                <div class="card-task-list">
                    <ul class="task-list">

                        @foreach($ordenesFinalizadas as $orden)
                            <li class="task-list-item">
                                <div class="custom-control custom-checkbox">
                                    <input checked type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        orden - {{$orden->codigo_or}}
                                        |cliente: {{$orden->user->nombre_p}} {{$orden->user->apellido_p}}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5 col-xl-3 mb-5">
            <div class="card card-md card-team-members">
                <div class="card-header">
                    Revisión
                </div>
                <div class="card-media-list">

                    @foreach($ordenesAsignadas as $orden)
                        <div class="media clickable" data-qp-link="profiles-member-profile.html">
                            <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                <img src="{{asset('img/teccolor.png')}}" width="44" height="44">
                            </div>
                            <div class="media-body">
                                @foreach($tecnicos as $tecnico)
                                    @if($orden->id_tec == $tecnico->id)
                                        <div class="heading mt-1">
                                            {{$tecnico->nombre_p}} {{$tecnico->apellido_p}}
                                        </div>
                                        <div class="subtext">{{$tecnico->profesion_t}}</div>
                                    @endif
                                @endforeach
                                <div class="subtext">Revisa la orden - {{$orden->codigo_or}}</div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-xl-5 mb-5">

            <div class="card card-activity card-md">
                <div class="card-header">
                    Ordenes recientes
                </div>
                <div class="card-media-list">
                    @foreach($ordenesNuevas as $orden)
                        <div class="media clickable" data-qp-link="{{route('ordenes.show',$orden->id)}}">
                            <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                <img src="{{asset('img/orden.png')}}" width="44" height="44">
                            </div>
                            <div class="media-body">
                                <div class="heading mt-1">
                                    {{$orden->observacion_problema_or}}
                                </div>
                                <div class="subtext"> orden - {{$orden->codigo_or}}
                                    | {{$orden->user->nombre_p}} {{$orden->user->apellido_p}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-md-12">
            <footer>
                Desarrollado por - <a href="#"
                                      target="_blank"
                                      style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">De<span
                            style="color:#ffa733;font-weight:bold">Sof</span>Si</a>
            </footer>
        </div>
    </div>
@endsection