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
    @yield('content')
  </section>
</div>

@include('templates.admin.footer')
