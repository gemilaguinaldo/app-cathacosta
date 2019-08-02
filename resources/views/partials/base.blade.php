@include('partials.header')
<div class="loading-div">
	<img src="./images/loading.svg">
</div>
<div class="container">
  @include('partials.topbar')
  @include('partials.sidebar')
  
  <div class="main-container">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>  
</div>
@include('partials.footer')
