@extends('templates.public.templates_order')
@section('title')
    Contacts
@stop
@section('content')
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thông báo</h5>
      </div>
      <div class="modal-body bg-success">
        <p></p>
      </div>
    </div>
  </div>
</div>

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Get In Touch</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form action="javascript:void(0)" id="" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control"  placeholder="Name" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            @if (Auth::check())
                                <input type="email" name="email" class="form-control"  placeholder="Email" id="email" value="{!! Auth::user()->email !!}">
                            @else
                                <input type="email" name="email" class="form-control"  placeholder="Email" id="email">
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary pull-right"  onclick="createContact()">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Contact Info</h2>
                    <address>
                        <p>E-Shopper Inc.</p>
                        <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                        <p>Newyork USA</p>
                        <p>Mobile: +2346 17 38 93</p>
                        <p>Fax: 1-714-252-0026</p>
                        <p>Email: info@e-shopper.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Social Networking</h2>
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->
@section('script')
    <script type="text/javascript">

        function createContact()
        {
            var $contact = {};
            $contact.name = $('#name').val();
            $contact.email = $('#email').val();
            $contact.content = $('#message').val();
            if ($contact.name == "") {
                return alert('name is not empty !');
            }
            if ($contact.emai == "") {
                return alert('email is not empty !');
            }
            if ($contact.content == "") {
                return alert('message is not empty !');
            }
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('public.create.contact')}}",
                type: 'post',
                data: $contact,
                success: function(data){
                    $('.modal-body').html(data);
                    $('.modal').css({display:'block', transition:'0.3 all'});
                    setTimeout(function(){ $('.modal').fadeOut() }, 1000);
                    $('#content').val("");
                    $('#email').val("");
                    $('#name').val("");
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });

        }

    </script>
@stop
@stop
