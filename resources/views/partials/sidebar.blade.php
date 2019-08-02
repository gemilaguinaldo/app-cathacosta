<div class="sidebar no-padding">
    <div class="user-container">
        <div class="float-left image">
            <img src="./images/user.png">
        </div>
        <div class="float-left content">
            <h4>{{ auth()->user()->name }}</h4>
            <p class="font-14">{{ auth()->user()->user_role }}</p> 
        </div>
    </div>
    <ul class="menubar">
        <li class="menu">
            <a href="/" class="a-link">
               <span class="i-center">
                <i class="fa fa-tachometer fa-2x"></i>
                </span> 
                <span class="nav-text"> Dashboard</span> 
            </a>
        </li>
        @if(auth()->user()->is_admin)
            @include('partials.sidebar.admin')
        @else
            @include('partials.sidebar.user')
        @endif
    </ul>
</div>