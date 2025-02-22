<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light" src="{{asset('build/assets/logo/logo.png')}}" alt="" width="80px"></a> 
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="#">
          <div class="icon-box-sidebar"><i data-feather="grid"></i></div></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a>
              <ul class="sidebar-submenu">
                <li><a class="lan-4" href="{{route('admin.dashboard')}}">Default</a></li>
              </ul>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('show.all.drivers')}}"><i data-feather="users"> </i><span>Drivers</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('show.all.advertisement')}}"><i data-feather="upload"> </i><span>Adds</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="settings"></i><span class="">Settings</span></a>
              <ul class="sidebar-submenu">
                <li><a class=""  href="{{route('admin.profile')}}">Edit Profile</a></li>
                <li><a class="" href="{{route('admin.password')}}">Change Password</a></li>
                <li><a class="" href="{{route('admin.privacypolicy')}}">Privacy Policy</a></li>
                <li><a class="" href="{{route('admin.term&condition')}}">Terms and Conditions</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>

