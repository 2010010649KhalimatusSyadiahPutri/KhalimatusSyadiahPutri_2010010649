<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="pt-4 pb-4 sidebar-brand" style="height: auto;">
            <img src="{{ asset('img/Lambang_Kodam_Tanjungpura.png') }}" alt="logo kodam tanjung pura" style="width: 40%;">
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url(auth()->user()->position->name ?? '') }}">St</a>
        </div>
        <ul class="sidebar-menu mb-5">

            <li class="menu-header">Dashboard</li>

            <li class="nav-item dropdown">
                <a href="{{ url(auth()->user()->position->name ?? '') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard {{ Str::ucfirst(auth()->user()->position->name ?? '') }}</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{ url(auth()->user()->position->name ?? '') }}/absensi" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Absensi {{ Str::ucfirst(auth()->user()->position->name ?? '') }}</span>
                </a>
            </li>

            @if (in_array(auth()->user()->position_id,
                    \App\Models\Position::select('id')->where('name', 'admin')->pluck('id')->toArray()))
                <li class="menu-header">Master Data</li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/rank') }}"
                        class="nav-link {{ URL::current() == 'admin/rank' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Master Pangkat</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/position') }}"
                        class="nav-link {{ URL::current() == 'admin/position' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Master Jabatan</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/branching') }}"
                        class="nav-link {{ URL::current() == 'admin/branching' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Master Kecabangan</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/anggota') }}"
                        class="nav-link {{ URL::current() == 'admin/anggota' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Master Anggota</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/lokasi') }}"
                        class="nav-link {{ URL::current() == 'admin/lokasi' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Master Daerah</span>
                    </a>
                </li>
            @endif

            @if (in_array(auth()->user()->position_id,
                    \App\Models\Position::select('id')->where('name', 'admin')->orwhere('name', 'danramil')->pluck('id')->toArray()))
                <li class="menu-header">Danramil Menu</li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/assignment-area') }}"
                        class="nav-link {{ URL::current() == 'admin/assignment-area' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Penugasan Petugas</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/facility-officer') }}"
                        class="nav-link {{ URL::current() == 'admin/facility-officer' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Fasilitas Petugas</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/incoming-letter') }}"
                        class="nav-link {{ URL::current() == 'admin/incoming-letter' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Kelola Surat Masuk</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/outcoming-letter') }}"
                        class="nav-link {{ URL::current() == 'admin/outcoming-letter' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Kelola Surat Keluar</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/absensi') }}"
                        class="nav-link {{ URL::current() == 'admin/absensi' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Absensi Petugas</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/pendataan-kegiatan') }}"
                        class="nav-link {{ URL::current() == 'admin/pendataan-kegiatan' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Pendataan Kegiatan</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/pengelolaan-dana') }}"
                        class="nav-link {{ URL::current() == 'admin/pengelolaan-dana' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Pengelolaan Dana</span>
                    </a>
                </li>
            @endif

            @if (in_array(auth()->user()->position_id,
                    \App\Models\Position::select('id')->where('name', 'admin')->orwhere('name', 'babinsa')->pluck('id')->toArray()))
                <li class="menu-header">Babinsa Menu</li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/public-activity') }}"
                        class="nav-link {{ URL::current() == 'admin/public-activity' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Kegiatan Masyarakat</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ url(auth()->user()->position->name . '/natural-disaster') }}"
                        class="nav-link {{ URL::current() == 'admin/natural-disaster' ? 'active' : '' }}">
                        <i class="fas fa-fire"></i>
                        <span>Bencana Alam</span>
                    </a>
                </li>
            @endif

            <li class="menu-header">Keuangan</li>

            <li class="nav-item dropdown">
                <a href="{{ url(auth()->user()->position->name . '/keuangan/operasional') }}"
                    class="nav-link {{ URL::current() == auth()->user()->position->name . '/keuangan/operasional' ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    <span>Anggaran operasional</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{ url(auth()->user()->position->name . '/keuangan/pengeluaran') }}"
                    class="nav-link {{ URL::current() == auth()->user()->position->name . '/keuangan/pengeluaran' ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    <span>Pengeluaran</span>
                </a>
            </li>

            <li class="menu-header">Laporan</li>
            <li class="nav-item dropdown">
                <a href="{{ url(auth()->user()->position->name . '/outcoming-letter') }}"
                    class="nav-link {{ URL::current() == 'admin/outcoming-letter' ? 'active' : '' }}">
                    <i class="fas fa-fire"></i>
                    <span>Laporan</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
