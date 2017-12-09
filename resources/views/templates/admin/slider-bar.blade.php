
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           @if(Session::get('PICTURE') != "")
                <img src="{{ asset('storage/admins/'.Session::get('PICTURE')) }}"  class="user-image" alt="User Image">
              @else
                <img src="{{ asset('images/logo/avata.png') }}"  class="user-image" alt="User Image">
              @endif
        </div>
        <div class="pull-left info">
          <p>
            @if(Session::get('USERNAME') != "")
              {{ Session::get('USERNAME')}}
            @endif
          </p>
          <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" treeview">
          <a href="{{ route('admin.category') }}">
            <i class="fa fa-list"></i> <span>Manage Danh Mục</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="javascript:void(0)">
            <i class="fa fa-dashboard"></i> <span>Manage Sản Phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class=""><a href="{{ route('admin.listproduct') }}"><i class="fa fa-circle-o"></i>Danh sách sản phẩm</a></li>
            <li><a href="{{ route('admin.cate.add.product') }}"><i class="fa fa-circle-o"></i>Thêm sản phẩm</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ route('admin.OrderIn') }}">
            <i class="fa fa-files-o"></i>
            <span>Nhập Đơn Hàng</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('provider.index') }}">
            <i class="fa fa-files-o"></i>
            <span>Manage Provider</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-th"></i> <span>Manage hóa đơn</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.qlhoadon') }}"><i class="fa fa-circle-o"></i>Danh sách hóa đơn</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="{{ route('admin.parameter') }}">
            <i class="fa fa-list"></i> <span>Manage Parameters</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="{{ route('admin.comment') }}">
            <i class="fa fa-list"></i> <span>Manage Comments</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.contact.index') }}">
            <i class="fa fa-envelope"></i> <span>Contacts</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow" id="countcontact"></small>
            </span>
          </a>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">MANAGE USERS</li>
        <li><a href="{{ route('admin.users') }}"><i class="fa fa-circle-o text-red"></i> <span>List User</span></a></li>
        <li><a href="{{ route('admin.usersCreate') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Add Users</span></a></li>
        <li><a href="{{ route('admin.userPermission') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Phân Quyền</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
