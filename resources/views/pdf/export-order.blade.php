<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head><!--/head-->
<body>
<h1>Xuất báo cáo nhập đơn hàng</h1>
	<table class="table table-bordered table-hover text-center">
  	<thead>
    	<tr>
    		<th>Code</th>
    		<th>Name</th>
    		<th>Quantity</th>
    		<th>Price</th>
    		<th>Total</th>
    	</tr>
  	</thead>
  	<tbody>
      @foreach ($items as $item)
       <tr>
            <td>{{ $item->code}}</td>
            <td>{{ $item->name}}</td>
            <td>{{ $item->quantity}}</td>
            <td>{{ number_format($item->price, '0', ',', '.') . ' VND'}}</td>
            <td>{{ $item->total}}</td>
      </tr>
      @endforeach
  	</tbody>
	</table>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>