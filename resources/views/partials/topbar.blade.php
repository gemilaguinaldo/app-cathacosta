<header class="top-nav">
    <div class="company-container">
        <img src="./images/logo.png" class="img-logo">
        <i class="fa fa-bars menu-icon" aria-hidden="true"></i>
    </div>
    <div class="float-right user-container">
      <div class="d-inline user">
        <img src="./images/user.png">
        <h5 class="name">{{ auth()->user()->firstname }}</h5>
    
      </div>
      <!-- <div class="user-dropdown"> -->
        <a href="javascript:void(0);" class="user-dropdown">
            <i class="fa fa-caret-down " aria-hidden="true"></i>
        </a>
        <ul class="user-dropdown-menu">
          <li><a href="/profile">Profile Settings</a></li>
          <li><a href="/logout">Logout</a></li>
        </ul>
      <!-- </div> -->
    </div>
</header>