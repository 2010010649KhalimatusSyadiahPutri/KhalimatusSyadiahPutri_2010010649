<li class="menu-header">Babinsa</li>
    <li class="nav-item dropdown {{ isset($type_menu) === 'dashboard' ? 'active' : '' }}">

        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-fire"></i>
            <span>Keanggotaan</span>
        </a>

        <ul class="dropdown-menu">
            <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                <a class="nav-link"
                    href="{{ url('danramil/anggota') }}">
                    Daftar Anggota
                </a>
            </li>
            <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('danramil/penugasan-anggota') }}">
                    Jadikan Babinsa
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item dropdown">
        <a href="{{ url('danramil/penugasan') }}" class="nav-link">
            <i class="fas fa-fire"></i>
            <span>Penugasan Anggota</span>
        </a>
    </li>
