@extends('layouts.app')
@section('content')
<div class="container">
			 @if (session('custom_success'))
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Success ! </strong>
                <span>{{ Session::get('custom_success') }}</span>
              </div>
              @endif
               @if (session('custom_error'))
             <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error ! </strong>
                <span>{{ Session::get('custom_error') }}</span>
              </div>
              @endif
				<form id="ContactForm" action="{{ url('/save_contact_us') }}" method="Post" enctype="multipart/form-data">
        <input type="hidden" name="url" value="<?php echo Request::path(); ?>">
				<div class="col-md-12 col-xs-12 col-sm-12 contact-form-data">
        {{csrf_field()}}
					<h2 class="h2_product"><span>Contact Us</span></h2>
					<div style="margin-top:30px" class="col-md-12 col-xs-12 col-sm-12">
					<h4 class="h4_product">Name</h4>
            <div class="form-group">
              <input type="text" value="" name="name" placeholder="Name" class="form-control">       
            </div>
             <h4 class="h4_product">Email</h4>
            <div class="form-group">
              <input type="text" value="" name="email" placeholder="Email" class="form-control">       
            </div>

            <h4 class="h4_product">Contact No.</h4>
            <div class="form-group">
              <input type="text" value="" name="contact_no" placeholder="Contact No." class="form-control">       
            </div>

            <h4 class="h4_product">Message</h4>
            <div class="form-group">
             <!--  <input type="text" value="" name="address" placeholder="Address" class="form-control">   -->  
             <textarea name="message" class="form-control contact-message" placeholder="Message" rows="10"></textarea> 
            </div>

					</div>
						
					<div class="marginBot col-md-12 col-xs-12 col-sm-12">
							<button type="submit" class="btn mw-md btn-primary pull-right">Submit</button>
					</div>
				</div>
				
			</form>

			</div>
      <script>
        $(document).ready(function(){
          $('#ContactForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields:
            {
                 "name": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Field is required'
                            }
                        }
                    },
                "email": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          },
                          emailAddress: {
                            message: 'The value is not a valid email address'
                        },
                      }
                  },
                  "contact_no": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }

                      }
                  },
                   "message": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
            }
        })

        })
    </script>
@endsection
