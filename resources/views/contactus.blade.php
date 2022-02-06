@extends('layouts.master')
@section('content')

<section class="pro-content">
    <!-- contact Content -->
    <section class="contact-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="">
                        <h4 class="text-uppercase mb-4">Get in touch with us</h4>
                        <p>Got a question? We'd love to hear from you. To get in touch with us, please call your neaest showroom fill out the form below and we will response as soon as possible.</p>
                        <div class="mt-4 pt-4">
                            <ul class="contact-info pl-0 mb-0">
                                <li> <i class="fas fa-mobile-alt"></i><span><a href="javascript:void(0)">Phone</a><br> <a
                                            href="javascript:void(0)">888-9636-6000</a></span> </li>
                                <li> <i class="fas fa-map-marker"></i><span><a href="javascript:void(0)">Address<br>Demo Store
                                            3654123</a></span> </li>
                                <li> <i class="fas fa-envelope"></i><span> <a
                                            href="javascript:void(0)">Email</a><br><a href="javascript:void(0)">info@ecommerce.com</a>
                                    </span> </li>
                                {{-- <li> <i class="fas fa-tty"></i><span> <a href="javascript:void(0)">23456789</a><br><a
                                            href="javascript:void(0)">123456</a> </span> </li> --}}
                            </ul>
                        </div>
                        
                    </div>

                </div>
                <div class="col-12 col-sm-6">
                    <div id="map" style="height:400px; margin-top: 5px;">
                    </div>
                    <p class="info">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat.
                    </p>
                </div>

                <div class="col-12 mt-4 pt-4">
                    <form id="contactusForm">
                        <div class="row">
                            <div class="col-12 form-group text-center mb-4">
                                <h4 class="text-uppercase">Contact Form</h4>
                                <p>Complete the form below, then click the "SUBMIT" button.</p>
                            </div>
                            <div class="col-6 form-group">
                                <label class="first-label" for="email">First Name *</label>
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="first_name" 
                                        name="first_name"
                                        placeholder="Enter Your First Name" 
                                        aria-describedby="inputGroupPrepend" 
                                        required>
                                    <div class="invalid-feedback">Please choose a first name.</div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <label class="first-label" for="email">Last Name *</label>
                                <div class="input-group">
                                    <input 
                                        type="text"
                                        class="form-control"
                                        id="last_name"
                                        name="last_name"
                                        placeholder="Enter Your Last Name" 
                                        aria-describedby="inputGroupPrepend" 
                                        required>
                                    <div class="invalid-feedback">Please choose a last name.</div>
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="email">Email *</label>
                                <div class="input-group">
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        id="email"
                                        name="email"
                                        placeholder="Enter Email here.." 
                                        aria-describedby="inputGroupPrepend"
                                        required>

                                    <div class="invalid-feedback">Please choose a email.</div>
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <label for="phone">Phone *</label>
                                <div class="input-group">
                                    <input 
                                        type="text" 
                                        class="form-control textbox" 
                                        id="phone"
                                        name="phone"
                                        placeholder="Enter Your Phone"
                                        aria-describedby="inputGroupPrepend"
                                        required>

                                    <div class="invalid-feedback">Please choose a phone.</div>
                                </div>
                            </div>
                            
                            <div class="col-12 form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" placeholder="write..." rows="5" class="form-control"></textarea>
                            </div>

                            <div class="col-12 form-group text-center">
                                <button type="submit" class="btn btn-secondary swipe-to-top" style="background-color: #ef5f4b">
                                    SUBMIT <i class="fas fa-location-arrow"></i>
                                </button>
                            </div>
                          
                        </div>
                        
                    </form>
                </div>


            </div>
        </div>
    </section>

</section>


@endsection
@section('script')

<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 8
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>

<script>

    $("#contactusForm").submit(function(e){
        e.preventDefault();
        $('.invalid-feedback').css('display','none')
        first_name = $.trim($("#first_name").val());
        last_name = $.trim($("#last_name").val());
        email = $.trim($("#email").val());
        phone = $.trim($("#phone").val());
        message = $.trim($("#message").val());

        $.ajax({
        type: 'post',
        url: "{{ url('') }}" + '/api/client/contact-us',
        data:{
            first_name:first_name,
            last_name:last_name,
            email:email,
            phone:phone,
            message:message
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            clientid: "{{isset(getSetting()['client_id']) ? getSetting()['client_id'] : ''}}",
            clientsecret: "{{isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : ''}}",
        },
        beforeSend: function() {},
        success: function(data) {
            if (data.status == 'Success') {
                toastr.error('{{ trans("response.contact-form-success") }}');
            }
            else{
                toastr.error('{{ trans("response.some_thing_went_wrong") }}');
            }
        },
        error: function(data) {
            // console.log(data);
            if(data.status == 422){
                jQuery.each(data.responseJSON.errors, function(index, item) {
                    $("#"+index).parent().find('.invalid-feedback').css('display','block');
                    $("#"+index).parent().find('.invalid-feedback').html(item);
                });
            }
            else{
                toastr.error('{{ trans("response.some_thing_went_wrong") }}');;
            }

        },
        });
    });
</script>
@endsection
