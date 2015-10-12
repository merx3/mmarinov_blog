
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="{!! route('admin.index') !!}" class="site_title"><span>Marian's Blog Admin</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Anthony Fernando</h2>
            </div>
        </div>

        <div class='clearfix'></div>

        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-users"></i> Users </a></li>
                    <li><a href="{!! route('admin.articles.index') !!}"><i class="fa fa-newspaper-o"></i> Articles </a></li>
                    <li><a><i class="fa fa-file"></i> Pages Content </a></li>
                    <li><a><i class="fa fa-comments-o"></i> Comments </a></li>
                    <li><a><i class="fa fa-folder-open"></i> File Manager</a></li>
                    <li><a><i class="fa fa-key"></i> Security </a></li>
                </ul>
            </div>

        </div>

    </div>
</div>