<?php use Carbon\Carbon; ?>
@extends('templates.admin.template')
@section('content')
             <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tổng Kết Đơn Hàng</h3>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
              <div class="form-inline" style="margin-bottom: 10px; float: left;">
              {!! Form::open(['url' => 'adminpc/orders/summary/search', 'enctype' => 'multipart/form-data', 'method' => 'GET']) !!}
              {!! Form::date('date_start', null, ['class' => 'form-control']) !!}
              {!! Form::date('date_end', null, ['class' => 'form-control']) !!}
              {!! Form::submit('Search ', ['class' => 'btn btn-primary'])!!}
              {!! Form::close() !!}

             </div>
              <table  id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID Order</th>
                  <th>Order Date</th>
                  <th>Status</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Recipient Name</th>
                  <th>Recipient Email</th>
                  <th>Sender Name</th>
                  <th>View Details</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                @foreach ($orders as $order)
                 <tr>
                  <td>{{ $order ->id}}</td>
                  <td><?php  $date = Carbon::parse($order['created_at']); ?>
                  {{ $date->format('d-m-Y')}}</td>
                  <td><span class="label label-success">{{ $order ->status }}</span></td>
                  <td>{{ $order ->address}}</td>
                  <td>{{ $order ->phone}}</td>
                  <td>{{ $order ->name}}</td>
                  <td>{{ $order ->email}}</td>
                  <td><?php $user = App\User::find($order->user_id); ?>
                    @if ($user)
                      {{ $user['name'] }}
                    @else
                      undefind
                    @endif
                  </td>
                  <td><a href="{{ url('adminpc/' . $order->id .'/orderdetails') }}">Xem chi tiết</a></td>
                  <?php

                    $orderdetails = App\OrderDetail::where('order_id', '=', $order->id)->get();
                    foreach ($orderdetails as $orderdetail) {
                      $total = $total + ($orderdetail->price * $orderdetail->quantity);
                    }
                   ?>
                </tr>
                @endforeach
                </tbody>
              </table>
               <p style="float: right; margin-top: 10px;"><b>Order Total: {{ $orders->count() }}</b>&nbsp;&nbsp;</p>
               <p style="float: right; clear: both;"><b>Total: {{ $total}}$</b>&nbsp;&nbsp;</p>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
         <a href="{{ url('adminpc/orders/export_order_summary?date_start='. $date_start . '&date_end='. $date_end)}}" class="btn btn-success" style="float: right;margin-right: 16px;"> Export Ecel</a>
@stop
