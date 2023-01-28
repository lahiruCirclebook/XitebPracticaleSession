@php
    $id = session('id');
    $name = session('name');
@endphp

<header id="page-topbar">

    <div class="navbar-header">
        <div class="d-flex">
            <div class="dropdown d-inline-block" style="margin-left: 1000%">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                    <span class="d-none d-xl-inline-block ms-1"
                        key="t-henry">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ url('logout') }}"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>

         

        </div>
    </div>
</header>
