@extends('layouts.app')

@section('content')
<div class="container-high">
    <div class="row">
        @include('layouts.dashboardsidebar')
        <div class="col-md-10 profile-area subs"> 
          <div class="content">
            <div class="col-md-8 subscriptions">  
              <h3 class="form-heading"><i class="fa fa-plus-square-o fa-lg" aria-hidden="true"></i>Subscription</h3>
            
              <div class="col-md-3 col-sm-4 col-xs-6 subscription_item">
                <div class="image-area" style="background-image: url({{ asset('assets/images/pro-lg.jpg') }})">
                  <span>unsubscription</span>
                </div> 
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 subscription_item">
                <div class="image-area">
                  <span>unsubscription</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 subscription_item">
                <div class="image-area">
                  <span>unsubscription</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 subscription_item">
                <div class="image-area">
                  <span>unsubscription</span>
                </div>
              </div>
              <div class="col-md-3 col-sm-4 col-xs-6 subscription_item">
                <div class="image-area">
                  <span>unsubscription</span>
                </div>
              </div>
            </div>
          </div> 
        </div>
    </div>
</div>
@endsection