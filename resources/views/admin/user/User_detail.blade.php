@extends('templates.admin.template')
@section('content')
	<div class="row">
		<div class="box box-primary">
		    <div class="box-header with-border">
		    	<h3 class="box-title "><i class="fa fa-user"></i>Information Profile</h3>
		    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="col-xs-4" >
				<figure class="figure">
					@if($aruser->picture != "")
	                    <img src="{{ asset('storage/admins/'.$aruser->picture) }}" width="300" height="250"  class="img-ci thumbnail " alt="">
	                @else
	                    <img src="{{ asset('images/logo/avata.png') }}" class="img-ci thumbnail " alt="">
	                @endif
	                <figcaption class="figure-caption text-center">{{ $aruser->name }}</figcaption>
	                <div class="text-center">
	                	<a class="btn btn-success" href="{{route('admin.user.edit',['slug'=>str_slug($aruser->name), 'id'=>$aruser->id])}}">Edit</a> 
	                	@if(Session::get('USERNAME') != 'admin')
	                	<a class="btn btn-danger" href="{{route('admin.user.delete',['id'=>$aruser->id])}}">Delete</a>
	                	@endif 
	                </div>
	                
				</figure>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<label for="">Gmail</label>
					<input type="gmail" class="form-control" value="{{ $aruser->email }}" readonly="" >
				</div>
				<div class="form-group">
					<label for="">Address</label>
					<input type="gmail" class="form-control" value="{{ $aruser->address }}" readonly="" >
				</div>
				<div class="form-group">
					<label for="">Thống kê bài viết đã đăng :</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-offset-6 col-xs-6">
			<div class="col-xs-3">
				<a href="{{ route('admin.users') }}" class="btn btn-default">Cancel</a>
			</div>
			<div class="col-xs-3">
				
			</div>
		</div>
	</div>

@stop