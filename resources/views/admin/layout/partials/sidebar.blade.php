<style>
    .dropdown {
        background-color: transparent !important;
    }

    .dropdown-menu {
        margin-top: 40px !important;


    }

    .sidebar-menu>ul>li {
        margin-bottom: 3px;
        position: relative;
        list-style: none;
    }

    .sidebar-menu ul {
        list-style: none;
    }

    .sidebar-menu>ul>li>a {
        align-items: center;
        border-radius: 3px;
        display: flex;
        justify-content: flex-start;
        padding: 8px 15px;
        position: relative;
        transition: all 0.2s ease-in-out 0s;
        color: #f1f1f1;
    }

    .sidebar-menu li a {
        color: #8A9199;
        display: block;
        font-size: 15px;
        height: auto;
        padding: 0 20px;
    }

    .submenu a:hover {
        text-decoration: none !important;
        /* background-color: #25354C; */
        /* width:100%; */
    }

    #drop-down li a:hover {
        color: rgb(0, 191, 255);
    }

    #sett-drop-down li a:hover {
        color: rgb(0, 191, 255);

    }

    .sidebar-menu>ul>li>a span {
        transition: all 0.2s ease-in-out 0s;
        display: inline-block;
        margin-left: 10px;
        white-space: nowrap;
    }



    .submenu::marker {
        display: :none !important;
    }
</style>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <?php
            $setting = DB::table('settings')
                ->where('id', 1)
                ->first();
            ?>
            <img style="max-width:50%;display:block" src="{{ URL::to('/') }}/media/settings/{{ $setting->logo }}"
                alt=""></a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            @if (Auth::guard('web')->user()->can('dashboard'))
                <li class="sidebar-item {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                    <a class="sidebar-link" href=" {{ route('dashboard') }}  ">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                    </a>
                </li>
            @endif

            <li class="sidebar-item {{ 'profiles' == request()->path() ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="submenu">
                        <a href="#" class="subdrop me-4" style="color:#8A9199;
                      "
                            id="sett_menu_arrow"> <i class="fa fa-assistive-listening-systems" aria-hidden="true"
                                style="margin-left:-18px"></i>
                            <span class="ms-3">System</span> <span> <i
                                    class="fa fa-chevron-circle-down ms-5"></i></span></a>
                        <ul id="sett-drop-down">
                            @if (Auth::guard('web')->user()->can('color'))
                                <li>
                                    <a href="{{ route('admins.index') }}" class="mb-2"style="margin-left:-20px;">
                                        <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span
                                            class="align-middle">Admins</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('web')->user()->can('size'))
                                <li>
                                    <a href="{{ route('roles.index') }}" class="mb-2"style="margin-left:-20px;">
                                        <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span
                                            class="align-middle">Role</span>
                                    </a>
                                </li>
                            @endif


                    </li>
                </ul>
            </div>
            @if (Auth::guard('web')->user()->can('categories'))
                <li class="sidebar-item {{ 'categories' == request()->path() ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('category.index') }}">
                        <i class="fa fa-object-group" aria-hidden="true"></i> <span class="align-middle">Category</span>
                    </a>
                </li>
            @endif


            @if (Auth::guard('web')->user()->can('product'))
                <li class="sidebar-item {{ 'product' == request()->path() ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('product.index') }}">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="align-middle">Product</span>
                    </a>
                </li>
            @endif

            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="submenu">
                        <a href="#" class="subdrop me-4" style="color:#8A9199;
                      "
                            id="menu_arrow"> <i class="fa fa-asterisk" aria-hidden="true" style="margin-left:-18px"></i>
                            <span class="ms-3">Master Setup </span> <span> <i
                                    class="fa fa-chevron-circle-down ms-5"></i></span></a>
                        <ul id="drop-down">
                            @if (Auth::guard('web')->user()->can('color'))
                                <li>
                                    <a href="{{ route('color.index') }}" class="mb-2"style="margin-left:-20px;">
                                        <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span
                                            class="align-middle">Color</span>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::guard('web')->user()->can('size'))
                                <li>
                                    <a href="{{ route('size.index') }}" class="mb-2"style="margin-left:-20px;">
                                        <i class="fa fa-bars mr-2" aria-hidden="true"></i> <span
                                            class="align-middle">Size</span>
                                    </a>
                                </li>
                            @endif


                    </li>
                </ul>
            </div>
            <li class="sidebar-item {{ 'settings' == request()->path() ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('setting.index') }}">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span class="align-middle">Settings</span>
                </a>
            </li>
            @if(Auth::guard('web')->user()->can('recyclebin'))
            <li class="sidebar-item {{'recylebin' == request()->path() ? 'active' : ''}}">
                <a class="sidebar-link" href="{{ route('recyclebin.index') }}">
                    <i class="fa fa-recycle" aria-hidden="true"></i> <span class="align-middle">Recylebin</span>
                </a>
            </li>
            @endif

            <li class="sidebar-item {{ 'activity' == request()->path() ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('activity.index') }}">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <span class="align-middle">Activity Log</span>
                </a>
            </li>




        </ul>


    </div>
</nav>
