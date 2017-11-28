@extends('templates.admin.template')
@section('content')
<?php 
	use App\Contact;
  $countall = count(Contact::all());
	$countallstar = count(Contact::where('star','=',1)->get());
?>
<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">View Messages</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col-md-6">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="name"  readonly="">
        </div>
        <div class="form-group col-md-6">
            <label for="">Gmail</label>
            <input type="text" name="name" class="form-control" placeholder="Name" id="email" readonly="">
        </div>
        <div class="form-group">
          <label for="">Messages</label><br />
          <textarea name="" id="content" class="form-control" readonly="">ukm àasfasfsaf</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{ route('admin.contact.index') }}"><button type="button" onclick="" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5">
      @if(Session::has('msg-s'))
          <div class="alert alert-success alert-dismissable">{{ Session::get('msg-s') }}</div>
      @endif
      @if(Session::has('msg-e'))
          <div class="alert alert-danger alert-dismissable">{{ Session::get('msg-e') }}</div>
      @endif
    </div>
</div>
<div class="row">
    <div class="col-md-3">
      <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Messager</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="active" ><a href="javascript:void(0)" onclick="changerDisplaymes()"><i class="fa fa-inbox"></i> Inbox
              <span class="label label-primary pull-right">{{ $countall }}</span></a></li>
            <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
            <li  class="active"><a href="javascript:void(0)" onclick="changerDisplayStar()" ><i class="fa fa-star"></i>Star <span class="label bg-yellow pull-right">{{ $countallstar }}</span></a></li>
            <li class="active"><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9" id="listmes" >
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Inbox List</h3>
          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
        	<form action="{{ route('admin.destroy.contact') }}" method="post">
            		{{ csrf_field() }}
	          <div class="mailbox-controls">
	          	<div class="btn-group btn btn-default btn-sm">
	          		<input type="checkbox" class="btn btn-default btn-sm" id="check_all">
	          	</div>
	            <div class="btn-group">
	              <button onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return true;}else{return false;};" type="submit" name="delete" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
	              
	            </div>
	            <!-- /.btn-group -->
	            <a href="{{ route('admin.contact.index') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
	            <!-- /.pull-right -->
	          </div>
	          <div class="table-responsive mailbox-messages">
	            <table class="table table-hover table-striped">
		            <tbody>
		            	@foreach( $contacts as $value)
		            	@if( $value->view == 1 )
			            <tr style="cursor: pointer;">
			                <td><input type="checkbox"></td>
			                <td class="mailbox-star" id="setStar-{{ $value->id }}">
			                	@if( $value->star == 1 )
			                	<a href="javascript:void(0)" onclick="setStar({{$value->id}},1)" ><i class="fa fa-star text-yellow"></i></a>
			                	@else
								<a href="javascript:void(0)" onclick="setStar({{$value->id}},0)"><i class="fa fa-star text-black"></i></a>
			                	@endif
			                </td>
			                <td class="mailbox-name" onclick="modalView({{ $value->id }})"><a href="javascript:void(0)">{{ $value->name }}</a></td>
			                <td class="mailbox-subject"><b>{{ $value->content }}</b>
			                </td>
			                <td class="mailbox-attachment"></td>
			                <td class="mailbox-date">{{ $value->created_at}}</td>
			            </tr>
			            @else
        						<tr  style="cursor: pointer;">
        			                <td>
        			                	<input type="checkbox" id="" class="check" name="checkall[]" value="{{$value->id}}"/>
        			                </td>
        			                <td class="mailbox-star" id="setStar-{{ $value->id }}">
        			                	@if( $value->star == 1 )
        			                	<a href="javascript:void(0)" onclick="setStar({{$value->id}},1)"><i class="fa fa-star text-yellow"></i></a>
        			                	@else
        								<a href="javascript:void(0)" onclick="setStar({{$value->id}},0)"><i class="fa fa-star text-black"></i></a>
        			                	@endif
        			                </td>
        			                <td onclick="modalView({{ $value->id }})" class="mailbox-name text-danger"><a href="" class="text-danger">{{ $value->name }}</a></td>
        			                <td class="mailbox-subject text-danger"><b>{{ $value->content }}</b>
        			                </td>
        			                <td class="mailbox-attachment text-danger"></td>
        			                <td class="mailbox-date text-danger">{{ $value->created_at}}</td>
        			            </tr>
        						@endif
			            @endforeach
		            </tbody>
	            </table>
	            <!-- /.table -->
	          </div>
          </form>
          <!-- /.mail-box-messages -->
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-------------------- -->
    <div class="col-md-9" id="liststar" style="display: none;">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Messages Starred </h3>
          <div class="box-tools pull-right">
            <div class="has-feedback">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <form action="{{ route('admin.destroy.contact') }}" method="post">
                {{ csrf_field() }}
            <div class="mailbox-controls">
              <div class="btn-group btn btn-default btn-sm">
                <input type="checkbox" class="btn btn-default btn-sm" id="check_all">
              </div>
              <div class="btn-group">
                <button onclick="var tb=confirm('Bạn có muốn xóa không ?');if(tb==true){return true;}else{return false;};" type="submit" name="delete" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                
              </div>
              <!-- /.btn-group -->
              <a href="{{ route('admin.contact.index') }}"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
              <!-- /.pull-right -->
            </div>
            <div class="table-responsive mailbox-messages">
              <table class="table table-hover table-striped">
                <tbody>
                  @foreach( $contacts as $value)
                  @if( $value->star == 1 )
                  <tr style="cursor: pointer;">
                      <td><input type="checkbox"></td>
                      <td class="mailbox-star" id="setStar-{{ $value->id }}">
                        <a href="javascript:void(0)" onclick="setStar({{$value->id}},1)" ><i class="fa fa-star text-yellow"></i></a>
                      </td>
                      <td class="mailbox-name" onclick="modalView({{ $value->id }})"><a href="read-mail.html">{{ $value->name }}</a></td>
                      <td class="mailbox-subject"><b>{{ $value->content }}</b>
                      </td>
                      <td class="mailbox-attachment"></td>
                      <td class="mailbox-date">{{ $value->created_at}}</td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              <!-- /.table -->
            </div>
          </form>
          <!-- /.mail-box-messages -->
        </div>
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
</div>

  <!-- /.row -->
  @section('script')
    <script type="text/javascript">
      function modalView(a)
      {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: "{{route('admin.ajax.Viewcontact')}}",
          type: 'post',
          cache: false,
          data: {aid: a },
          success: function(data){
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#content').val(data.content);
            $('.modal').css({display:'block', transition:'0.3 all'});
          },
          error: function (){
            alert('Có lỗi xảy ra');
          }
        });
        
      }
    </script>
  @stop
  @stop
