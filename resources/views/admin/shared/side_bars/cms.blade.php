<li class="nav-item  "> <a href="javascript:;"
        class="nav-link nav-toggle  {{ request()->routeIs('list.cms') || request()->routeIs('create.cms') || request()->routeIs('list.cmsContent') || request()->routeIs('create.cmsContent') ? 'active-menu' : '' }}">
        <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="title fw-bold">manage page content</span> <span
            class="arrow"></span> </a>
    <ul class="sub-menu">
        <li class="nav-item  "> <a href="{{ route('list.cms') }}" class="nav-link "> <span class="title">List seo
                    Pages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.cms') }}" class="nav-link "> <span class="title">Add new seo
                    Page</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('list.cmsContent') }}" class="nav-link "> <span class="title">List
                    Pages</span> </a> </li>
        <li class="nav-item  "> <a href="{{ route('create.cmsContent') }}" class="nav-link "> <span class="title">edit
                    content Page</span> </a> </li>
    </ul>
</li>
