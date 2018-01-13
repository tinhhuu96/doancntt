@include('templates.admin.header')
@include('templates.admin.slider-bar')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-5" id="messageFlash">
          @if(Session::has('msg-s'))
              <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
          @endif
          @if(Session::has('msg-e'))
              <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
          @endif
        </div>
    </div>
    @yield('content')
  </section>
</div>

@include('templates.admin.footer')
