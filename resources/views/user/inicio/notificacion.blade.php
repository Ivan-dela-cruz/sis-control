<div class="col-md-3 clearfix">
    <div class="header-ctn">
        <!-- Cart -->
        <div id="divNoti"  class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-desktop"></i>
                <span>Tus ordenes</span>
                @if ($finalizadas!=0)
                    <div class="qty">{{$finalizadas}}</div>
                @endif

            </a>

            @if ($finalizadas!=0)
                <div class="cart-dropdown">
                    <div class="cart-list">
                        <div class="product-widget">


                            <div class="product-img">
                                <img src="./img/product01.png" alt="">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name">orden-{{$ordenFin->codigo_or}}</h3>
                                <h4 class="product-price"><a href="#">Elije una acción</a></h4>
                            </div>
                            <button class="delete"><i class="fa fa-close"></i></button>


                        </div>

                    </div>
                    <div class="cart-btns">
                        <a href="{{route('orden-pdf',$ordenFin->id)}}">Imprimir</a>
                        <a href="{{route('ver-orden-cliente',$ordenFin->id)}}">Ver detalles <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif

        </div>
        <!-- /Cart -->

        <!-- Menu Toogle -->
        <div class="menu-toggle">
            <a href="#">
                <i class="fa fa-bars"></i>
                <span>Menu</span>
            </a>
        </div>
        <!-- /Menu Toogle -->
    </div>
</div>