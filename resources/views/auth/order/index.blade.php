  @extends('templates.admin.template')
  @section('content')
  <?php use Carbon\Carbon; ?>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Danh Sách Đơn Hàng</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="form-inline" style="margin-bottom: 10px; float: left;">
        {!! Form::open(['url' => 'adminpc/orders/search', 'enctype' => 'multipart/form-data', 'method' => 'GET']) !!}
          {!! Form::select('status', array('all' => 'All', 'pending' => 'Pending',
          'processing' => 'Processing','shipping' =>'Shipping', 'shipped' => 'Shipped',
          'delivered' => 'Delivered'),['class' => 'form-control'],['class' => 'form-control']) !!}
          {!! Form::date('date_start', null, ['class' => 'form-control']) !!}
          {!! Form::date('date_end', null, ['class' => 'form-control']) !!}
          {!! Form::submit('Search ', ['class' => 'btn btn-primary'])!!}
        {!! Form::close() !!}

       </div>
         @if(isset($date_start) and isset($date_end) or isset($status))
         <a href="{{url('/adminpc/orders/export?status='. $status .'&date_start='. $date_start . '&date_end='. $date_end)}}" class="btn btn-success" style="float: right;"> Export Order</a>
         @else
         <a href="{{url('/adminpc/orders/export?status=2')}}" class="btn btn-success" style="float: right;"> Export Order</a>
         @endif

          <table class="table table-striped">
            <thead>
            <tr>
              <th>ID Order</th>
              <th>Order Date</th>
              <th>Status</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Recipient Name</th>
              <th>Sender Name</th>
              <th>Action</th>
              <th>View Details</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
               <tr>
                <td>{{ $order ->id}}</td>
                <td><?php  $date = Carbon::parse($order['created_at']); ?>
                  {{ $date->format('d-m-Y')}}
                </td>
                <td>@if ($order->status == 'pending' || $order->status == 'processing')
                  <span class="label label-warning">{{ $order ->status }}</span>
                @elseif ($order->status == 'shipping')
                  <span class="label label-primary">{{ $order ->status }}</span>
                @elseif ($order->status == 'shipped')
                  <span class="label label-success">{{ $order ->status }}</span>
                @else
                  <span class="label label-danger">{{ $order ->status }}</span>
                @endif</td>
                <td>{{ $order ->address}}</td>
                <td>{{ $order ->phone}}</td>
                <td>{{ $order ->name}}</td>
                <td><?php $user = App\User::find($order->user_id); ?>
                  @if ($user)
                    {{ $user['name'] }}
                  @else
                    undefind
                  @endif
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ url('adminpc/orders/'. $order->id . '/edit')}}"
                      class="btn btn-warning btn-xs">
                      <i class="fa fa-pencil"></i></a></td>
                  </div>
                <td><a href="{{ url('adminpc/' . $order->id .'/orderdetails') }}">View Details</a></td>

              </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  @stop

