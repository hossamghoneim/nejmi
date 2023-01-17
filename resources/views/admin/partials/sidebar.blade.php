<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
{{--        <div class="sidebar-brand-icon rotate-n-15">--}}
{{--            <i class="fas fa-laugh-wink"></i>--}}
{{--        </div>--}}
        <div class="sidebar-brand-text mx-3">لوحة التحكم</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('home')">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>الرئيسية</span>
        </a>
    </li>


    @can('reports')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('reports')">
        <a class="nav-link" href="{{ route('admin.reports.index') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>التقارير</span>
        </a>
    </li>
    @endcan

    @can('reports')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('reports')">
        <a class="nav-link" href="{{ route('admin.sliders') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>الصور المتحركة</span>
        </a>
    </li>
    @endcan


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        أساسي
    </div>

    @can('orders')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @yield('orders')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-bars"></i>
            <span>الطلبات</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">الطلبات</h6>
                <a class="collapse-item" href="/admin/orders">كل الطلبات</a>
                <a class="collapse-item" href="/admin/orders?status=pending">الطلبات المعلقة</a>
                <a class="collapse-item" href="/admin/orders?status=approved">الطلبات المقبولة</a>
                <a class="collapse-item" href="/admin/orders?status=rejected">الطلبات المرفوضة</a>
                <a class="collapse-item" href="{{ route('admin.orders.incomplete') }}">الطلبات غير المكتملة</a>
                <a class="collapse-item" href="/admin/orders?status=under_process">طلبات تحت التنفيذ</a>
            </div>
        </div>
    </li>
    @endcan


    @can('users')
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @yield('freelancers')">
            <a class="nav-link" href="{{ route('admin.users.freelancers') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>المشاهير</span>
            </a>
        </li>
    @endcan
    @can('users')
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @yield('users')">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>المستخدمين</span>
            </a>
        </li>
    @endcan



    @can('categories')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('categories')">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>التصنيفات</span>
        </a>
    </li>
    @endcan

    @can('coupons')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('coupons')">
        <a class="nav-link" href="{{ route('admin.coupons.index') }}">
            <i class="fas fa-fw fa-percent"></i>
            <span>الكوبونات</span>
        </a>
    </li>
    @endcan



    @can('send_money_page')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('send_money_page')">
        <a class="nav-link" href="{{ route('admin.users.send_money_page') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>محاسبة المشاهير</span>
        </a>
    </li>
    @endcan

    @can('affiliates')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('affiliates')">
        <a class="nav-link" href="{{ route('admin.affiliates.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>الوسطاء</span>
        </a>
    </li>
    @endcan

    @can('activations')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('activations')">
        <a class="nav-link" href="{{ route('admin.activations.index') }}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>طلبات التوثيق</span>
        </a>
    </li>
    @endcan

    @can('alerts')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('alerts')">
        <a class="nav-link" href="{{ route('admin.alerts.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>التنبيهات</span>
        </a>
    </li>
    @endcan

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('featured_users')">
        <a class="nav-link" href="{{ route('admin.featured_users.index') }}">
            <i class="fas fa-fw fa-star"></i>
            <span>مشاهير مميزين</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    @if(Gate::check('settings') || Gate::check('ads'))
    <!-- Heading -->
    <div class="sidebar-heading">
        إعدادات الموقع
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('settings')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
           aria-expanded="true" aria-controls="collapseSettings">
            <i class="fas fa-fw fa-cog"></i>
            <span>إعدادات عامة</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('settings')
                <a class="collapse-item" href="{{ route('admin.settings.index') }}">عام</a>
                @endcan
                @can('ads')
                <a class="collapse-item" href="{{ route('admin.ads.index') }}">الإعلانات</a>
                @endcan
            </div>
        </div>
    </li>
    @endif

    @can('pages')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('pages')">
        <a class="nav-link" href="{{ route('admin.pages.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>الصفحات</span>
        </a>
    </li>
    @endcan

    @can('special_videos')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('special_videos')">
        <a class="nav-link" href="{{ route('admin.special_videos.index') }}">
            <i class="fas fa-fw fa-video"></i>
            <span>فيديوهات مختارة</span>
        </a>
    </li>
    @endcan


    @can('gifts')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('gifts')">
        <a class="nav-link" href="{{ route('admin.gifts.index') }}">
            <i class="fas fa-fw fa-gift"></i>
            <span>الإهداء</span>
        </a>
    </li>
    @endcan

    @if(auth()->user()->role_id == 1)
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @yield('supervisors')">
            <a class="nav-link" href="{{ route('admin.supervisors.index') }}">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>المشرفين</span>
            </a>
        </li>
    @endif

    @if(auth()->user()->role_id == 1)
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @yield('roles')">
            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>الصلاحيات</span>
            </a>
        </li>
    @endif


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
