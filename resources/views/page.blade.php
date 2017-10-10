@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row pages-content testimonials">
        <h3 class="main-heading">{{ @$page->title }}</h3>
           <?php echo @$page->description; ?>
        </div>
    </div>
</div>
@endsection
