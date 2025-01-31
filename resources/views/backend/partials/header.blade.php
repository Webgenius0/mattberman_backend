<div class="header-wrapper row m-0">
    <div class="header-logo-wrapper col-auto p-0">
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      <div class="logo-header-main"><a href="#"><img class="img-fluid for-light img-100" src="{{asset('build/assets/logo/logo.png')}}" alt=""></a></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <div class="left-menu-header">
        {{-- <ul class="app-list">
          <li class="onhover-dropdown">
            <div class="app-menu"> <i data-feather="folder-plus"></i></div>
            <ul class="onhover-show-div left-dropdown">
              <li> <a href="file-manager.html">File Manager</a></li>
              <li> <a href="kanban.html"> Kanban board</a></li>
              <li> <a href="social-app.html"> Social App</a></li>
              <li> <a href="bookmark.html"> Bookmark</a></li>
            </ul>
          </li> 
        </ul> --}}
        <ul class="header-left">
          <li class="onhover-dropdown"><span class="f-w-600">Dashboard</span><span><i class="middle" data-feather="chevron-down"></i></span>
            <ul class="onhover-show-div left-dropdown">
              <li> <a href="{{route('admin.dashboard')}}">Default</a></li>
            </ul> 
          </li>
        </ul>
      </div>
    </div>
    <div class="nav-right col-6 pull-right right-header p-0">
      <ul class="nav-menus">
        <li class="profile-nav onhover-dropdown">
          <div class="account-user"><i data-feather="user"></i></div>
          <ul class="profile-dropdown onhover-show-div">
            <li><i data-feather="user"></i><span>{{Auth::user()->name}}</span></li>
            {{-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li> --}}
            {{-- <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li> --}}
            <form action="{{route('logout')}}" method="post">
              @csrf
              <li><button><i data-feather="log-in"> </i><span>Log out</span></button></li>
            </form>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      {{-- <div class="ProfileCard-realName">{{name}}</div> --}}
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
