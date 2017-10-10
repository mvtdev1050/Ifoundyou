@extends('layouts.app')

@section('content')
<div class="container-high">
    <div class="row">
        @include('layouts.dashboardsidebar')
        <div class="col-md-10 profile-area min-heiii"> 
            <div class="short-page">
            	<h3 class="form-heading"><i class="fa fa-star fa-lg" aria-hidden="true"></i>Bookmark</h3>
            	<div class="row">
				@foreach ($data as $profile)
                      <div class="col-md-2">
                        <a href="{{ url('/profile/'.$profile->getUser->id) }}">
                             @if($profile->getUser->profile_image == '') 
                             <img src="{{ asset('public/assets/images/users/dummymale.jpg') }}"/>
                             @else 
                             <img src="{{ asset('public/assets/images/users/'.$profile->getUser->profile_image) }}"/>
                             @endif 
                             <div class="user-profile-name">{{ ucfirst($profile->getUser->first_name)." ".ucfirst($profile->getUser->last_name) }}</div>
                        </a>
                     </div>
            	@endforeach
            	</div>
            </div>
        </div>
    </div>
</div>

@endsection