@extends('layouts.app')

@section('content')
<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery('#accordion .panel-heading').click(function(){
       jQuery(this).toggleClass('active');
       jQuery(this).parent().siblings().find('.panel-heading').removeClass('active');
    });

    jQuery('#accordion .panel-collapse.collapse.in').siblings().addClass('active');
});
</script>
<div class="container">
    <div class="row pages-content faq">
        <h3 class="main-heading">FAQ</h3>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            <div class="active" style="display: none;"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="inactive"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
                            How much do Friends cost per hour?
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">Friends start at just $10 per hour, but many are willing to waive their fee depending on the activity. (If you have tickets to a sporting event or concert, there are many Friends who will waive their fee if you take them).  Just contact a Friend and ask!</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <div class="active" style="display: none;"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="inactive"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
                            I think this is a great/stupid/horrible/awesome idea.
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit ametpurus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. Insuscipit faucibus urna.</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            <div class="active" style="display: none;"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="inactive"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
                            What is the difference between a Friend account and Member account?
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac liberoac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            <div class="active" style="display: none;"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="inactive"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
                            Are background checks done on the Friends?
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.</div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection
