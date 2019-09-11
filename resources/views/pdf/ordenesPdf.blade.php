<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>PDF-ORDEN-{{$orden->codigo_or}}</title>
<style>
    body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 13px;
        /*font-family: SourceSansPro;*/
    }

    #logo {
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
    }

    #imagen {
        width: 120px;
        height: 75px;
    }

    #datos {
        float: left;
        margin-top: 0%;
        margin-left: 0%;
        margin-right: 2%;
        /*text-align: justify;*/
    }

    #encabezado {
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 13px;
    }

    #fact {
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
    }

    section {
        clear: left;
    }

    #cliente {
        text-align: left;
    }

    #facliente {
        width: 60%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 12px;
    }

    #fac, #fv, #fa {
        color: #FFFFFF;
        font-size: 12px;
    }

    #facliente thead {
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
    }

    #facvendedor {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    #facvendedor thead {
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    #facarticulo {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }

    #facarticulo thead {
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    #gracias {
        text-align: center;
    }

    #datoOrden {
        text-align: left;
        font-size: 12px;
    }

    #headerOrden {
        text-align: left;
        vertical-align: center;
        font-size: 12px;
        color: white;
    }

    #tableOrdenDetalle {
        width: 100%;
        border: 1px solid #000;
    }

    #thOrdenDetalle, .tdOrdenDetalle {
        text-align: left;
        vertical-align: center;
        border: 1px solid #000;
        border-collapse: collapse;
        padding: 0.3em;
        font-size: 11px;

    }
</style>
<body>

<header>
    <div id="logo">
        <img src="{{asset('img/logoajazul.png')}}" alt="CompartiendoCodigo" id="imagen">
    </div>
    <div id="datos">
        <p id="encabezado">
            <b>AJ - COMPUTACIÓN</b>
            <br>Vicente León - Latacunga - Cotopaxi - Ecuador
            <br>Telefono: 09817539874
            <br>Email: ajcomputacion.gmail.com
        </p>
    </div>
</header>

<br>

<section>
    <div>
        <table id="facliente">
            <thead>
            <tr>
                <th colspan="2" id="fac">Cliente</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <p>
                        Sr(a).
                        <span style="font-weight: normal;">{{$orden->user->nombre_p}} {{$orden->user->apellido_p}}</span>
                    </p>
                    <p id="cliente">

                        cedula:
                        <span style="font-weight: normal;">{{$orden->user->cedula_p}}</span>

                    </p>
                    <p id="cliente">
                        Dirección:
                        <span style="font-weight: normal;">{{$orden->user->direccion_p}}</span>

                    </p>

                </th>
                <th>
                    <p id="cliente">
                        Teléfono:
                        <span style="font-weight: normal;">{{$orden->user->telefono_p}}</span>

                    <p id="cliente">
                        Email:
                        <span style="font-weight: normal;">{{$orden->user->email}}</span>

                    </p>
                    <p><br></p>

                </th>
            </tr>
            </tbody>
        </table>
    </div>
</section>
<section>
    <div>
        <table id="facvendedor">
            <thead>
            <tr id="headerOrden">
                <th class="tdOrdenDetalle">Código orden</th>
                <th class="tdOrdenDetalle">Técnico encargado</th>
                <th class="tdOrdenDetalle">Fecha emisión</th>
                <th class="tdOrdenDetalle">Fecha entrega</th>
                <th class="tdOrdenDetalle">Etapa del servicio</th>
            </tr>
            </thead>
            <tbody>
            <tr id="datoOrden">
                <td class="tdOrdenDetalle">{{$orden->codigo_or}}</td>
                <td class="tdOrdenDetalle">{{$tecnico->user->nombre_p}} {{$tecnico->user->apellido_p}}</td>
                <td class="tdOrdenDetalle">{{\Carbon\Carbon::parse($orden->created_at)->format('Y-m-d') }}</td>
                <td class="tdOrdenDetalle">{{$orden->fecha_salida_or}}</td>
                <td class="tdOrdenDetalle">
                    @if($orden->etapa_servicio_or==3)
                        Terminado
                    @endif
                    @if($orden->etapa_servicio_or==2)
                        Revisión
                    @endif
                    @if($orden->etapa_servicio_or==1)
                        Ingreso
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
<br>
<section>
    <div>
        <table id="facarticulo">
            <thead>
            <tr style="color: black; text-align: center; background-color: white;">
                <th class="tdOrdenDetalle" style="text-align: center;" colspan="6">Detalle de la Orden</th>
            </tr>
            <tr style="text-align: left;" id="fa">
                <th class="tdOrdenDetalle" width="10px">N°</th>
                <th class="tdOrdenDetalle">Datos del equipo</th>
                <th width="50px" class="tdOrdenDetalle">Registrado</th>
                <th class="tdOrdenDetalle">Descripción</th>
                <th class="tdOrdenDetalle">Accesorios</th>
                <th class="tdOrdenDetalle">Problema</th>

            </tr>
            </thead>
            <tbody>
            {{$contador = 1}}
            @foreach($registros as $registro)
                <tr>
                    <td class="tdOrdenDetalle">{{$contador}}</td>
                    <td class="tdOrdenDetalle">
                        <ul style="margin: 0;">
                            <li><b>Serie: </b> <span> {{$registro->equipo->serie_e}}</span></li>
                            <li><b>Marca: </b> <span> {{$registro->equipo->marca_e}}</span></li>
                            <li><b>Modelo: </b> <span> {{$registro->equipo->modelo_t}}</span></li>
                            <li><b>Tipo: </b><span>
                                    @if($registro->equipo->tipo_t==1)
                                        Laptop
                                    @endif
                                    @if($registro->equipo->tipo_t==2)
                                        CPU
                                    @endif
                                    @if($registro->equipo->tipo_t==3)
                                        Monitor
                                    @endif
                                    @if($registro->equipo->tipo_t==4)
                                        Tablet
                                    @endif
                                </span></li>
                        </ul>
                    </td>
                    <td class="tdOrdenDetalle">
                        {{\Carbon\Carbon::parse($registro->equipo->created_at)->format('Y-m-d')}}
                    </td>
                    <td class="tdOrdenDetalle">
                        {{$registro->equipo->descripcion_e}}
                    </td>
                    <td class="tdOrdenDetalle">
                        {{$registro->accesorios_re}}
                    </td>
                    <td class="tdOrdenDetalle">
                        {{$registro->problema_re}}
                    </td>

                </tr>
                {{$contador++}}
            @endforeach
            </tbody>
        </table>
    </div>
</section>
<br>
<section>
    <div>
        <table id="facarticulo">
            <thead>
            <tr style="color: black; text-align: center; background-color: white;">
                <th class="tdOrdenDetalle" style="text-align: center;" colspan="2">Observaciones</th>
            </tr>
            <tr style="text-align: left;" id="fa">

                <th class="tdOrdenDetalle">Problemática de la orden</th>
                <th class="tdOrdenDetalle">Solución Planteada</th>
            </tr>
            </thead>
            <tbody>
            {{----  @foreach ($detalles as $det)--}}
            <tr>


                <td class="tdOrdenDetalle">
                    {{$orden->observacion_problema_or}}
                </td>
                <td class="tdOrdenDetalle">
                    {{$orden->observacion_solucion_or}}
                </td>
            </tr>

            {{----    @endforeach --}}
            </tbody>
        </table>
    </div>
</section>
<br>
<footer>
    <div id="gracias">
        <p><b>Gracias por preferirnos!</b></p>
    </div>
</footer>
</body>
</html>