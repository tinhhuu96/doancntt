
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" treeview">
          <a href="{{ route('admin.category') }}">
            <i class="fa fa-list"></i> <span>Categories management</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="javascript:void(0)">
            <i class="fa fa-dashboard"></i> <span>Products management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  class=""><a href="{{ route('admin.listproduct') }}"><i class="fa fa-circle-o"></i>List of products</a></li>
            <li><a href="{{ route('admin.cate.add.product') }}"><i class="fa fa-circle-o"></i>import new products</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="{{ route('promotion.index') }}">
            <i class="fa fa-files-o"></i>
            <span>Promotions management</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('admin.OrderIn') }}">
            <i class="fa fa-files-o"></i>
            <span>Import orders Products</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{ route('provider.index') }}">
            <i class="fa fa-files-o"></i>
            <span>Providers management</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-th"></i> <span>Bill managements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.qlhoadon') }}"><i class="fa fa-circle-o"></i>List of bill</a></li>
          </ul>
        </li>
        <li class=" treeview">
          <a href="{{ route('admin.parameter') }}">
            <i class="fa fa-list"></i> <span>Parameters management</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="{{ route('admin.comment') }}">
            <i class="fa fa-list"></i> <span>Comments management</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.contact.index') }}">
            <i class="fa fa-envelope"></i> <span>Contacts management</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow" id="countcontact"></small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="{{ url('adminpc/orders')}}"><i class="fa fa-circle-o"></i> List đơn hàng</a></li>
            <li><a href="{{ url('adminpc/orders/summary')}}"><i class="fa fa-circle-o"></i> Tổng kết</a></li>
          </ul>
        </li>
        <li class="header">MANAGE USERS</li>
        <li><a href="{{ route('admin.users') }}"><i class="fa fa-circle-o text-red"></i> <span>List User</span></a></li>
        <li><a href="{{ route('admin.usersCreate') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Add Users</span></a></li>
        <li><a href="{{ route('admin.userPermission') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Permission</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
