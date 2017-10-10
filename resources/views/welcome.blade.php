@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
       <div class="search_main">
        <div class="new_body">
            <div class="logo">
                <img src="{{ asset('assets/images/logo_lg.jpg') }}" />
            </div>
            <form method="get" action="{{ url('/search-results') }}" id="search-results">
                <div id="dob">
                    <p><input type="text" class="text_box" name="dob" readonly /></p>
                </div>
            </form>
             <form method="get" action="{{ url('/search-results') }}" id="zip" style="display: none;">
                <div>
                    <p>
                    <input type="text" class="text_box" id="zip_code" name="zip_code" maxlength="5" placeholder="Enter Zip Code" />
                    <small class="help-block" data-fv-validator="notEmpty" data-fv-for="name" data-fv-result="INVALID" style="color:#a94442; display: none;">Zipcode must be 5 letters</small>
                    </p>
                </div>
            </form>
                <div class="operations">
                    <a href="/missing-person" class="button" type="button">Missing Persons</a>
                    <input class="button" type="button" value="Zip Code"  />
                    <button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block">Date of Birth</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>





<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <span class="text-center"><i class="fa fa-calendar" aria-hidden="true"></i></span>
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            <form method="get" action="{{ url('/search-results') }}" id="search-results">
              <div class="form-group">
                <label for="exampleInputday">Day</label>
                <select class="form-control" name="day" required>
                    <option vlaue="">Day</option>
                    <?php for($i=1;$i<32;$i++){ ?>
                    <option value="{{ $i }}">{{ $i }}</option>
                    <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputMonth">Month</label>
                <select class="form-control" name="month" required>
                     <option value="">Month</option>
                    <option value="January">January</option>
                    <option value="Febuary">Febuary</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
              </div>
              <div class="form-group">
               <label for="exampleInputYear">Year</label>
                <select class="form-control" name="year" required>
                    <option value="">Year</option>
                   <?php for($i=1980;$i<2006;$i++){ ?>
                   <option value="{{ $i }}">{{ $i }}</option>
                   <?php }?>
                </select>
              </div>

              <input class="button" type="submit" value="Search" />
            </form>

        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>







<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery('input[name="dob"]').keypress(function(){
            alert('Please first select any button');
        });

       /* var date = new Date();
        var yr = date.getFullYear()-18;
        var mm = date.getMonth();
        var dd = date.getDate();*/

        /*jQuery('#dob input').datepicker({
            format: "dd/mm/yyyy",
            endDate: '31/12/'+yr,
            autoclose: true
        });

        jQuery('#dob input').change(function(){
            var date = jQuery(this).val();
            if(date != '') {
               jQuery('#search-results').submit();
            }
        });*/

        jQuery('.button').click(function() {
            jQuery('.button').removeClass('active');
            jQuery(this).addClass('active');
            if(jQuery(this).val() == 'Date of Birth') {
                jQuery('#dob').show();
                jQuery('#zip').hide();
            }
            if(jQuery(this).val() == 'Zip Code') {
                jQuery('#dob').hide();
                jQuery('#zip').show();
            }
             if(jQuery(this).val() == 'Missing Persons') {
                jQuery('#dob').hide();
                jQuery('#zip').hide();
            }
        });

        /*jQuery('#search').click(function(e) {
            e.preventDefault();
            if(jQuery('#first_name').val() != '' || jQuery('#last_name').val() !='' ) {
                jQuery('#search-results').submit();
            }
        });*/

        jQuery("#zip_code").keyup(function() {
            jQuery("#zip_code").val(this.value.match(/[0-9]*/));
            var zip_code = jQuery("#zip_code").val();
            if(zip_code.length == 5) { 
                jQuery(this).next().hide();
                 jQuery('#zip').submit();
            } else {
                jQuery(this).next().show();
            }
        });
    });
</script>
       
@endsection
