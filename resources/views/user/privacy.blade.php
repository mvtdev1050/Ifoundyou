@extends('layouts.app')

@section('content')
<div class="container-high" id="privacy">
    <div class="row">
      {{ Session::get('custom_message') }}
        @include('layouts.dashboardsidebar')
          @if(Session::has('ecode'))
          @if(Session::get('ecode') == 2)
          <?php $class = 'alert-info';  ?>
          @elseif(Session::get('ecode') == 0)
          <?php $class = 'alert-danger';  ?>
          @else
          <?php $class = 'alert-success';  ?>
          @endif
          @endif
          @if(Session::has('custom_success'))
          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <span>{{ Session::get('custom_success') }}</span>
          </div>
          @endif
        <div class="col-md-10 profile-area min-heiii" id="{{ @$custom_message }}"> 
            <div class="short-page privacy">
            	<h3 class="form-heading"><i class="fa fa-lock fa-lg" aria-hidden="true"></i>Privacy</h3>
            	<form method="post" action="{{ url('/user/privacy')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                              <label for="email-privacy" class="col-md-8 control-label">Who can view your email on profile page ?</label> 
                              <div class="col-md-4 privacy-radio"> 
                                    <select name="email_privacy" id="email-privacy" class="form-control">
                                          <option @if(@$data->email_privacy == 'Public') {{ 'selected' }} @endif>Public</option>
                                          <option @if(@$data->email_privacy == 'Friends') {{ 'selected' }} @endif>Friends</option>
                                          <option @if(@$data->email_privacy == 'Only Me') {{ 'selected' }} @endif>Only Me</option>
                                    </select>
                              </div>                    
                        </div>
                        <div class="form-group">
                              <label for="photos-privacy" class="col-md-8 control-label">Who can view your phone number on profile page ?</label> 
                              <div class="col-md-4 privacy-radio"> 
                                    <select name="phone_privacy" id="phone-privacy" class="form-control">
                                          <option @if(@$data->phone_privacy == 'Public') {{ 'selected' }} @endif>Public</option>
                                          <option @if(@$data->phone_privacy == 'Friends') {{ 'selected' }} @endif>Friends</option>
                                          <option @if(@$data->phone_privacy == 'Only Me') {{ 'selected' }} @endif>Only Me</option>
                                    </select>
                              </div>                    
                        </div>
                        <div class="form-group">
                              <label for="photos-privacy" class="col-md-8 control-label">Who can view your photos on profile page ?</label> 
                              <div class="col-md-4 privacy-radio"> 
                                    <select name="photos_privacy" id="phone-privacy" class="form-control">
                                          <option @if(@$data->photos_privacy == 'Public') {{ 'selected' }} @endif>Public</option>
                                          <option @if(@$data->photos_privacy == 'Friends') {{ 'selected' }} @endif>Friends</option>
                                          <option @if(@$data->photos_privacy == 'Only Me') {{ 'selected' }} @endif>Only Me</option>
                                    </select>
                              </div>                    
                        </div>
                        <div class="form-group">
                        <label for="photos-privacy" class="col-md-8 control-label">Who can view your friends list on profile page ?</label> 
                              <div class="col-md-4 privacy-radio"> 
                                    <select name="friends_privacy" id="phone-privacy" class="form-control">
                                          <option @if(@$data->phone_privacy == 'Public') {{ 'selected' }} @endif>Public</option>
                                          <option @if(@$data->phone_privacy == 'Friends') {{ 'selected' }} @endif>Friends</option>
                                          <option @if(@$data->phone_privacy == 'Only Me') {{ 'selected' }} @endif>Only Me</option>
                                    </select>
                              </div>                    
                        </div>
                        <div class="form-group">
                              <label for="photos-privacy" class="col-md-8 control-label"></label> 
                              <div class="col-md-4 privacy-radio"> 
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <button class="btn btn-default" type="reset">Reset</button>
                              </div>                    
                        </div>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection