@php
$currentRoute = request()->route()->getName();
@endphp
<div class="logo-container">
    <a href="/" class="logo">
        <img src="{{asset('porto-assets/img/logo.png')}}" width="75" height="35" alt="Porto Admin" />
    </a>
    <button class="btn header-btn-collapse-nav d-lg-none" data-bs-toggle="collapse" data-bs-target=".header-nav">
        <i class="fas fa-bars"></i>
    </button>

    <!-- start: header nav menu -->
    <div class="header-nav collapse">
        <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
            <nav>
                <ul class="nav nav-pills" id="mainNav">
                    <li class="{{ $currentRoute == 'home' ? 'active' : ''}}">
                        <a class="nav-link" href="{{route('home')}}">
                            Dashboard
                        </a>
                    </li>
                    <li class="dropdown <?php echo $currentRoute == 'user.index' ? 'active' : '' ?>">
                        <a href="#" class="nav-link dropdown-toggle">User</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="{{route('user.index')}}">
                                    User List
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown <?php echo $currentRoute == 'staff.index' || $currentRoute == 'bank.index' ? 'active' : '' ?>">
                        <a href="#" class="nav-link dropdown-toggle">Setup</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="nav-link" href="{{route('staff.index')}}">
                                    Staff
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('bank.index')}}">
                                    Bank Setup
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
