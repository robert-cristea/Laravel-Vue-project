<header class="site-header">
    <a href="#" class="brand-main">
        <img src="{{ asset('assets/admin/img/myghi_logo.png') }}" id="logo-desk" alt="MyGHI" class="d-none d-md-inline" style="height: 45px; padding-top: 0px; margin-top: -8px;" />
        <h3 class="d-none d-md-inline" style="margin-left: 15px; color: white;">MYGHI</h3>
        <img src="{{ asset('assets/admin/img/myghi_logo.png') }}" id="logo-mobile" alt="MyGHI" class="d-md-none" /><span class="d-md-none">MYGHI</span>
    </a>
    <a href="#" class="nav-toggle">
        <div class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </div>
    </a>
    <ul class="action-list">
        <li>
            @if (Auth::user()) 
            <a href="/logout"><i class="icon-fa icon-fa-sign-out"></i>
            </a>
            @endif
        </li>
    </ul>
</header>