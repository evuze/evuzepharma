        <!-- Aside Start-->
        <aside class="left-panel">
            <!-- brand -->
            <div class="logo">
                <a href="#" class="logo-expanded">
                <?php $admin_logo_img = Voyager::setting('admin_icon_image', ''); ?>
                @if($admin_logo_img == '')
                <img class="img-responsive pull-left logo hidden-xs animated fadeIn" src="{{ voyager_asset('images/logo-icon-light.png') }}" alt="Logo Icon"  width="25" height="25">
                @else
                <img class="img-responsive pull-left logo hidden-xs animated fadeIn" src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon"  width="25" height="25">
                @endif
                    <span class="nav-label" style="text-decoration:none;">Tiba</span>
                </a>
            </div>
            <!-- / brand -->
            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
                <li class="active"><a href="#"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
            
                <li class="has-submenu"><a href="#"><i class="ion-person-stalker"></i> <span class="nav-label">others</span></a>
                <ul class="list-unstyled">
                <li><a href="#">Orders</a></li>
                </ul>
                </li>
                </ul>
            </nav>         
        </aside>
        <!-- Aside Ends-->