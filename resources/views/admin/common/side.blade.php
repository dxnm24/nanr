<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('admin.post.index') }}"><i class="fa fa-gamepad"></i> <span>Danh sách posts</span></a></li>
            <li><a href="{{ route('admin.post.create') }}"><i class="fa fa-plus"></i> <span>Thêm post</span></a></li>
            <li><a href="{{ route('admin.posttype.index') }}"><i class="fa fa-list"></i> <span>Thể loại posts</span></a></li>
            <li><a href="{{ route('admin.posttag.index') }}"><i class="fa fa-tags"></i> <span>Tags posts</span></a></li>
            <li><a href="{{ route('admin.page.index') }}"><i class="fa fa-list"></i> <span>Pages</span></a></li>
            <li><a href="{{ route('admin.slider.index') }}"><i class="fa fa-list"></i> <span>Slider</span></a></li>
            @if(Auth::guard('admin')->user()->role_id == ADMIN)
            <li><a href="{{ route('admin.ad.index') }}"><i class="fa fa-picture-o"></i> <span>Quảng cáo</span></a></li>
            <li><a href="{{ route('admin.contact.index') }}"><i class="fa fa-list"></i> <span>Liên hệ</span></a></li>
            @endif
            <li class="header">CONFIG</li>
            <li><a href="{{ route('admin.menu.index') }}"><i class="fa fa-list"></i> <span>Quản lý menu</span></a></li>
            @if(Auth::guard('admin')->user()->role_id == ADMIN)
            <li><a href="{{ route('admin.config.edit', 1) }}"><i class="fa fa-list"></i> <span>Cài đặt chung</span></a></li>
            <li><a href="{{ route('admin.account.index') }}"><i class="fa fa-users"></i> <span>Quản lý tài khoản</span></a></li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>