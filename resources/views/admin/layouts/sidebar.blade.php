<!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
              <a class="nav-link" href="/dashboard">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            @if(Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('thn_ajaran') ? 'active' : '' }}">
              <a class="nav-link" href="/thn_ajaran" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Tahun Ajaran</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            @endif
            @auth
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item {{ request()->is('ppdb') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.ppdb.admin') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">PPDB</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 'orang_tua')
                    <li class="nav-item {{ request()->is('ppdb') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('orang_tua.ppdb.index') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">PPDB</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @endif
            @endauth
            {{-- @if(Auth::user()->role === 'admin' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('ppdb') ? 'active' : '' }}">
              <a class="nav-link" href="/ppdb" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">PPDB</span>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
            </li>
            @endif --}}
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('pembayaran') ? 'active' : '' }}">
              <a class="nav-link" href="/pembayaran" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Pembayaran</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            @endif
            @if(Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('siswa') ? 'active' : '' }}">
              <a class="nav-link" href="/siswa" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Siswa</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            @endif
            @if(Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('guru') ? 'active' : '' }}">
              <a class="nav-link" href="/guru" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Guru</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            @endif
            @if(Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
              <a class="nav-link" href="/user" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">User</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            @endif
            @if(Auth::user()->role === 'admin')
            <li class="nav-item {{ request()->is('fonnte') ? 'active' : '' }}">
              <a class="nav-link" href="/fonnte" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Fonnte</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            @endif
            @auth
                @if (auth()->user()->role == 'guru')
                    <li class="nav-item {{ request()->is('kehadiran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.kehadiran.index') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">kehadiran</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 'orang_tua')
                    <li class="nav-item {{ request()->is('kehadiran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.kehadiran.ortu') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Kehadiran</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @endif
            @endauth
            {{-- @if(Auth::user()->role === 'guru' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('kehadiran') ? 'active' : '' }}">
              <a class="nav-link" href="/kehadiran" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Kehadiran</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            @endif --}}
            @auth
                @if (auth()->user()->role == 'guru')
                    <li class="nav-item {{ request()->is('tabungan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.tabungan.index') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Tabungan</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @elseif (auth()->user()->role == 'orang_tua')
                    <li class="nav-item {{ request()->is('tabungan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.tabungan.ortu') }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Tabungan</span>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                    </li>
                @endif
            @endauth
            {{-- @if(Auth::user()->role === 'guru' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('tabungan') ? 'active' : '' }}">
              <a class="nav-link" href="/tabungan" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Tabungan</span>
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
            </li>
            @endif --}}
            @if(Auth::user()->role === 'guru' || Auth::user()->role === 'orang_tua')
            <li class="nav-item {{ request()->is('rapor') ? 'active' : '' }}">
              <a class="nav-link" href="/rapor" aria-expanded="false">
                <span class="menu-title">Laporan Hasil Belajar</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
              </a>
            </li>
            @endif
          </ul>
        </nav>
<!-- partial -->
