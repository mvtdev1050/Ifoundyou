@extends('layouts.app')

@section('content')
<?php //echo "<pre>"; print_r($user); echo "</pre>"; 
?>
<div class="container-high">
    <div class="row">
        @include('layouts.dashboardsidebar')
        <div class="col-md-10 profile-area">
            <div class="content">
                <div class="profile-des row">
                    <div class="col-md-2 col-sm-2 col-xs-6 profile_pic">
                    @if($user->profile_image == NULL)
                        <img src="{{ asset('/public/assets/images/users/dummymale.jpg')}}" />
                    @else
                       <img src="{{ asset('/public/assets/images/users/')}}/{{ $user->profile_image }}" />
                    @endif   

                    </div>
                    <div class="col-md-10 col-md-10 col-xs-12 user_details">
                        <h3 class="main-heading">{{ $user->username }}</h3>
                        <div class="chart2">
                            <ul>
                                <li class="col1">Email</li><li class="col2">{{ $user->email }}</li>
                            </ul>
                            <ul>
                                <li class="col1">Date of Birth</li><li class="col2"><?php echo date_format(date_create($user->dob),"m/d/Y")?></li>
                            </ul>
                            <ul>
                                <li class="col1">Gender</li><li class="col2">{{ $user->gender }}</li>
                            </ul>
                        </div>
                        <span><a class="btn btn-primary " href="/edit">Edit</a></span>
                    </div>
                </div>
                <div class="wraper">
                    
                    <h2>About</h2>
                   <div class="description">
                        <p>{{ $user->about }}</p>
                   </div>
                   <div class="chart1">
                    
                       <ul>
                            <li class="col1">Activity</li><li class="col2">{{ $user->activity }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Ethnicity</li><li class="col2">{{ $user->ethnicity }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Body Type</li><li class="col2">{{ $user->body_type }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Height</li><li class="col2">{{ $user->height }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Eye colour</li><li class="col2">{{ $user->eye_color }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Hair colour</li><li class="col2">{{ $user->hair_color }}</li>
                       </ul>
                       <ul>
                            <li class="col1">Friends with</li><li class="col2">{{ $user->friends }}</li>
                       </ul>
                   
                   </div>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
