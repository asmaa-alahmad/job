<li class="nav-item  "> <a href="javascript:;"
        class="nav-link nav-toggle {{ request()->routeIs('edit.site.setting') ? 'active-menu' : '' }}"> <i
            class="icon-wrench"></i> <span class="title fw-bold">Site Settings</span> <span class="arrow"></span> </a>
    <ul class="sub-menu">
        <li class="nav-item  {{ request()->routeIs('edit.site.setting') ? 'active-menu' : '' }} "> <a
                href="{{ route('edit.site.setting') }}" class="nav-link "> <span class="title">Manage Site
                    Settings</span> </a> </li>


    </ul>
</li>
