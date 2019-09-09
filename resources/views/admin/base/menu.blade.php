<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="logo-nav-item">
            <a class="navbar-brand" href="#">
               {{--  <img src="{{asset('assets/img/logo-white.png')}}" width="145" height="32.3" alt="QuillPro">
          --}}
                Sistemas de gestíon de incidencias
            </a>
        </li>
        <li>
            <h6 class="nav-header">General</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.html">
                <i class="batch-icon batch-icon-browser-alt"></i>
                Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-layout-content-left"></i>
                Usuarios
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.index')}}">Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="layout-top-menu-fixed.html">Técnicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="layout-top-menu-normal.html">Clientes</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="starter-kit.html">
                <i class="batch-icon batch-icon-star"></i>
                Starter Kit
            </a>
        </li>
    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header">Apps</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-store"></i>
                eCommerce
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-dashboard.html">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-product-page.html">Product Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-category-page.html">Category Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-cart.html">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-checkout-page.html">Checkout Page</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-search"></i>
                Search Results
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="search-results-normal.html">Normal Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search-results-media.html">Media Search</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-mail"></i>
                Mail
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="mail-inbox.html">Inbox</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mail-message.html">Message</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mail-compose.html">Compose</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="calendar.html">
                <i class="batch-icon batch-icon-calendar"></i>
                Calendar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-list"></i>
                Tasks
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="task-list.html">Task List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="task-manager.html">Task Manager</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="timeline.html">
                <i class="batch-icon batch-icon-timeline"></i>
                Timeline
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="gallery.html">
                <i class="batch-icon batch-icon-image"></i>
                Gallery <span class="badge badge-danger">New *</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="price-list.html">
                <i class="batch-icon batch-icon-tag-alt-2"></i>
                Price List
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="invoice.html">
                <i class="batch-icon batch-icon-list-alt"></i>
                Invoice
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-browser-alt-close"></i>
                Error Pages
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="error-pages-404.html">404 Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="error-pages-500.html">500 Page</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-locked"></i>
                Sign In &amp; Sign Up
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="sisu-signin.html">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-signin-2.html">Sign In 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-signup.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-signup-2.html">Sign Up 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-forgot-password.html">Forgot Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-forgot-password-2.html">Forgot Password 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-lock-screen.html">Lock Screen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sisu-lock-screen-2.html">Lock Screen 2</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profiles-member-profile.html">
                <i class="batch-icon batch-icon-users"></i>
                Profile
            </a>
        </li>
    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header">Components</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-unite"></i>
                UI Kit <span class="badge badge-danger">New *</span>
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="ui-cards.html">Cards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-cards-special.html">Special Cards</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-filterizr.html">Filterizr (Filter &amp; Sort) <span
                                class="badge badge-danger">*</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-charts.html">Charts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-buttons.html">Buttons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-typography.html">Typography</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-tabs-accordions.html">Tabs &amp; Accordions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-tooltips-popovers.html">Tooltips &amp; Popovers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-modal-boxes.html">Modal Boxes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-notifications.html">Notifications (Toastr)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-parent" href="#">Icons</a>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="ui-icons-batch-icons.html">Batch Icons</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ui-other-bootstrap-elements.html">Other Bootstrap 4 Elements</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Forms
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="forms.html">Form Elements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms-extras.html">Form Extras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms-validation.html">Form Validation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms-wizard.html">Form Wizard</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="batch-icon batch-icon-layout-center-column"></i>
                Tables
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-menu"></i>
                Menu Levels
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Level 1 - Item 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-parent" href="#">Level 1 - Item 2</a>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Level 2 - Item 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Level 2 - Item 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-parent" href="#">Level 2 - Item 3</a>
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 3 - Item 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 3 - Item 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 3 - Item 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Level 3 - Item 4</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Level 2 - Item 4</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Level 1 - Item 3</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Level 1 - Item 4</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>