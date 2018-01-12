<div id=":r1" class="ii gt "><div id=":j4" class="a3s aXjCH m160e2dae5146b1c3"><div class="adM">

</div><div style="font-size:14px;line-height:1.4;font-weight:400;margin:0px;background-color:#eeeeee;padding-top:20px"><div class="adM">
</div><div style="max-width:580px;width:100%;border:0px;margin-right:auto;margin-left:auto;font-weight:500"><div class="adM">
</div><div style="background-color:#ffffff;font-weight:500"><div class="adM">
</div><div style="text-align:center;padding:18px 0"><img alt="E-SHOPPER" src="https://image.ibb.co/mtk7Rm/logo.png" alt="logo" border="0" width="210"></div>

<div style="padding:25px 20px 5px 20px;background-color:#2d82c4;color:white">
<p style="margin:0"><b>Xin chào bạn {{ $order->name }} !</b></p>

<p>Đơn Hàng số {{ $order->id }} của bạn đã được thay đổi trạng thái</p>
</div>

<div style="margin-top:23px">
<p></p><div style="font-size:18px;text-align:center;font-weight:600;color:#2d82c4;margin-bottom:18px">Thông tin đơn hàng số {{$order->id}}</div>
<div style="margin:0px 20px 10px 20px;border-top:1px solid #eeeeee;display:block">
  <h3 style="color: green;">Trạng Thái: {{ $order->status}}</h3>
  <table border="0" style="border-collapse:separate;border-spacing:0;line-height:25px;width:100%">
    <thead>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">
        Tên SP
      </th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">
        Giá
      </th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">
        Số Lượng
      </th>
      <th style="padding:5px 10px;border:1px solid #ccc;background-color:#d9d9d9;font-weight:bold;width:120px">
        Thành Tiền
      </th>
    </thead>
    <tbody>
      <?php  $total = 0; ?>
      @foreach ($order_details as $key => $value)
        <tr style="vertical-align:top">
          <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">
            <?php $product = App\Product::find($value->product_id); ?>
            {{$product['name']}}</td>
          <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">
            {{$value->price}}$
          </td>
          <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">
            {{$value->quantity}}
          </td>
          <td style="padding:5px 10px;border:1px solid #ccc;border-top:none;width:120px">
            <?php echo ($value->price * $value->quantity ."$") ?>
          </td>
        </tr>
        <?php $total+=$value->quantity * $value->price ?>
      @endforeach
    </tbody>
  </table>
  <p style="float: right;"><b>Tổng Tiền: {{$total}}$</b></p>
</div><p></p>

<div style="margin:0px 20px 10px 20px;padding:14px 20px 5px;color:#464646">
<ul style="padding:0px 5px">
  <li style="margin-bottom:10px;margin-left:14px"><span style="color:rgb(70,70,70);font-family:arial,sans-serif;font-size:14px">Chúng tôi luôn lắng nghe sự đóng góp của khách hàng để website có thể hoạt động tốt hơn<a href="{{url('/contact')}}" style="color:#0872d4;text-decoration:none" target="_blank"> Đóng góp ý kiến của bạn ở đây</a></span></li>
  <li style="margin-top:5px;margin-bottom:10px;margin-left:14px">Nếu gặp khó khăn, bạn vui lòng liên hệ qua email: <a href="mailto:shoping.doan96@gmail.com" style="color:#0872d4;font-size:14px;text-decoration:none;font-weight:500" target="_blank">shoping.doan96@gmail.com</a></li>
  <li style="margin-top:5px;margin-bottom:10px;margin-left:14px">Hoặc gọi số hotline &nbsp;<b style="color:red">(024) 7309&nbsp;2828&nbsp;</b>và <b style="color:red"> (028) 7309 2828&nbsp;</b>để được hỗ trợ</li>
</ul>
</div>

<div style="display:block;height:10px;width:100%">&nbsp;</div>
</div>
</div>

<div style="padding:0px 20px 15px 20px;background-color:#fff;margin:20px 0;border:2px solid #2d82c4">
<div style="margin-top:15px">
<div style="width:50px;height:55px;display:table-cell;vertical-align:top"><img alt="thư mục" src="https://ci6.googleusercontent.com/proxy/LabdYXWTa2PjmtmWj8VcUgnUAF1tlss4eF64CVhsHByRuOqE07OgWpStyEq9R3XlJ2YYrwPMxhXIddejMc_vHGC99rm008fpfWW1Jb4JnsZRPmeBXNduchSm=s0-d-e1-ft#http://cdn.timviecnhanh.com/asset/home/img/icon_folder_email_tvn.png" style="vertical-align:middle;border:0;width:48px" class="CToWUd"></div>

<div style="display:table-cell;padding-left:15px;vertical-align:top">
<p style="margin:0;margin-bottom:5px;color:#464646">E-SHOPPER của chung tôi rất hân hạnh được phục vụ quý khách&nbsp;<a href="{{url('/')}}" style="line-height:1.4;font-weight:bold;color:rgb(235,27,34);text-decoration:none">Bấm để đặt hangg ngay hôm nay &gt;&gt;</a></p>
</div>
</div>
</div>

<p style="text-align:center;font-size:12px"><a href="{{url('/')}}">http://eshoper.com.vn/</a></p>
</div>

<div class="yj6qo"></div><div class="adL">
</div></div><div class="adL">
</div>
</div>
</div>
