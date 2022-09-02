<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">

            <div class="nav">

                <div class="sb-sidenav-menu-heading text-white" style="font-weight: bold;"> Subscription Manager</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Client Module
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin.clinet-info')}}">Client info</a>
                    </nav>
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('admin.clinet-info-inactive')}}">Inactive Client</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseInvocieHistory" aria-expanded="false"
                    aria-controls="collapseInvocieHistory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Invoice History
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseInvocieHistory" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('invoices') }}">All Invoices</a>
                    </nav>
                </div>
            </div>

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: <b style="color:red;">{{ Auth::user()->name }}</b></div>

        </div>
    </nav>
</div>