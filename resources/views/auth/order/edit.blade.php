@extends('templates.admin.template')
@section('content')
@section('content')
  {!! Form::model($order,['url' => 'adminpc/orders/'. $order->id, 'method' => 'put' ]) !!}
    @include('auth.partials.forms.order')
  {!! Form::close() !!}
@stop
