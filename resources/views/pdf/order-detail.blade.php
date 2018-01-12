<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head><!--/head-->
<body>
<h1>Order Detail</h1>
	<table border="0" style="border-collapse:separate;border-spacing:0;line-height:25px;width:100%">
  	<thead>
  	<tr>
  		<th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">ID Order</th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">Quanlity</th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">Price</th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">Subtotal</th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">Product Name</th>
  	</tr>
  	</thead>
  	<tbody>
  	<?php  $total = 0; ?>
      @foreach ($items as $item)
       <tr style="vertical-align:top">
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">{{ $item ->id}}</td>
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">{{ $item ->quantity}}</td>
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">{{ $item ->price}}$</td>
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">{{ $item ->quantity * $item ->price}}$</td>
            <?php $product = App\Product::find($item->product_id); ?>
            @if (empty($product))
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px"> Product deleted or stopped business</td>
            @else
            <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">{{ $product->name}}</td>
            @endif
      </tr>
      <?php $total+=$item->quantity * $item->price ?>
      @endforeach
  	</tbody>
	</table>
	<p style="float: right;"><b>Total: {{ $total }}$</b></p>
</body>
</html>
