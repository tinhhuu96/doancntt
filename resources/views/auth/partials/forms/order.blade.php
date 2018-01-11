    <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Order</h3>
            </div>
            <!-- /.box-header -->
           <div class="box-body">
             <div class="form-group">
              {!! Form::label('address', 'Address')!!}
              {!! Form::text('address', null, ['class' => 'form-control']) !!}
             </div>
             <div class="form-group">
                {!! Form::label('status', 'Status')!!}
                {!! Form::select('status', array('pending' => 'Pending', 'processing' => 'Processing', 'shipping' =>'Shipping', 'shipped' => 'Shipped', 'delivered' => 'Delivered'), null, ['class' => 'form-control'], ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
              {!! Form::label('phone', 'Phone')!!}
              {!! Form::text('phone', null, ['class' => 'form-control']) !!}
             </div>
             <div class="form-group">
              {!! Form::label('name', 'Recipient Name')!!}
              {!! Form::text('name', null, ['class' => 'form-control']) !!}
             </div>
           {!! Form::submit('Save', ['class' => 'btn btn-primary'])!!}
            </div>
            <!-- /.box-body -->
          </div>
         </div>
