@extends('layouts.layout_admin')
@section('title')
    Edit Page
@stop
@section('content')
@include('layouts.include_navbar')
@include('layouts.include_admin_sidebar')
<main id="app-main" class="app-main">
  <div class="wrap">
  <section class="app-content">
    <div class="ibp_dashboard_cont_inr">
    <div class="ibp_dashboard_cont">
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

        <form id="ProductForm" action="{{ url('admin/updateCmsPage') }}" method="Post" enctype="multipart/form-data">
        <div class="outr_box_shadow">
        {{csrf_field()}}
          <h2 class="h2_product"><span>Edit Page</span></h2>
          <div style="margin-top:30px" class="box_shadow_inr col-md-12 col-xs-12 col-sm-12">
           <div class="form-group">
            <label class="control-label">Title</label>
            <input type="hidden" name="pageId" value="{{ $data->id }}">
            <input type="hidden" name="slug" value="{{ $data->slug}}">
            <input placeholder="Title" value="{{ $data->title }}" name="title" class="form-control" type="text">
          </div>
             <h4 class="h4_product">Description</h4>
            <div class="form-group">
              <textarea name="description" placeholder="Description"  class="form-control" colspan="10" rowspan="6">{{ $data->description}}</textarea>
            </div> 
            <div class="form-group">
            <label class="control-label">Status</label>
            <select class="form-control" name="publish_the_page">
              <option value="">Please select one option</option>
              <option value="publish" <?php if (isset($data->publish) && $data->publish == 'publish' ) {
               echo 'selected';
              } ?>>Publish</option>
              <option value="unpublish" <?php if (isset($data->publish) && $data->publish == 'unpublish' ) {
               echo 'selected';
              } ?>>Unpublish</option>
            </select>
          </div>
         <!--   <div class="form-group">
            <label class="control-label">Menu</label>
            <select class="form-control" name="menu">
              <option value="">Please select one menu</option>
              <option value="header-menu">Header Menu</option>
              <option value="footer-menu">Footer Menu</option>
            </select>
          </div>
           <div class="form-group">
            <label class="control-label">Order</label>
            <input placeholder="Order" value="{{ old('order') }}" name="order" class="form-control" type="text">
          </div> -->
             <div class="form-group">
            <label class="control-label">Menu</label>
            <ul>
              <li>
               <input type="checkbox" class="menutab" name="menu[]" value="header-menu" {{ (in_array('header-menu',explode(',',$data->menu))) ? 'checked="checked" ' : '' }}/><span class="menutabSpan">Header menu</span>
              </li>
              <li>
                <input type="checkbox" class="menutab" name="menu[]" value="footer-menu" {{ (in_array('footer-menu',explode(',',$data->menu))) ? 'checked="checked" ' : '' }}/><span class="menutabSpan">Footer menu</span>
              </li>
            </ul>
          </div>
           <div class="form-group">
            <label class="control-label">Order</label>
            <input placeholder="Order" value="{{ $data->order_number}}" type="number" name="order_number" class="form-control" min="0" step="1" data-bind="value:replyNumber">
          </div>
            <div class="form-group">
            <label class="control-label">Template</label>
            <select class="form-control" name="template">
              <option value="">Select template option</option>
              @if(!empty($temp))
              @foreach($temp as $value)
              <option value="{{ $value->id }}" @if(isset($data->template_id) && $data->template_id == $value->id) {{'selected'}} @endif >{{ $value->template_name }}</option>
              @endforeach
              @endif
            </select>
          </div>
          </div>
            
          <div class="marginBot col-md-12 col-xs-12 col-sm-12">
              <button type="submit" class="btn mw-md btn-primary pull-right">Update</button>
          </div>
        </div>
        
      </form>

      </div>
      </div>
  </section>
  </div>
</main>

@endsection
@section('css')
<style type="text/css">
  
.box_shadow_inr {
    background-color: #fff;
    border-radius: 3px;
    box-shadow: 3px 9px 9px 2px rgba(0, 0, 0, 0.1);
    margin: 2% 0;
    padding: 15px;
}
.outr_box_shadow {
    float: none;
    margin: 0 auto;
    max-width: 700px;
}
.h2_product {
    font-size: 22px;
    text-align: center;
}
.h2_product span {
    border-bottom: 3px solid #188ae2;
    line-height: 23px;
    padding-bottom: 10px;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.ibp_dashboard_cont_inr {
    float: none;
    margin: 0 auto;
    max-width: 1200px;
    width: 100%;
}
.ibp_dashboard_cont {
    float: left;
    width: 100%;
}
h4, .h4
{
  font-size: 14px;
}
.hoverColor:hover
{
  background-color: #eee;
}
.table tr td select {
  width: 117px;
}
.table tr td select option {
  padding: 5px;
}
.marginBot
{
  margin-top: 30px;
  margin-bottom: 50px;
}
#map {
        height: 100%;
     }
.mapDiv
{
  height: 350px;
  width: 100%;
  margin-bottom: 25px;
}
.hoverColorChecked
{
  background-color: #eee;
}


.edit_serv_img {
    position: relative;
    text-align: center;
}
.padd_5 {
    padding: 5px;
}
.padd_left_right_all_zero {
    padding-left: 0;
    padding-right: 0;
}

.edit_serv_img .del_gal_img {
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
.del_gal_img img {
    position: relative;
    top: calc(50% - 10px);
}
.edit_serv_img:hover .del_gal_img {
    display: block;
}
.floatRight
{
  height:100px;width:100px;float:right;
}
</style>
@endsection
@section('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    //tinymce.init({ selector:'.box_shadow_inr textarea' });
</script>
<script>
  
  $(document).ready(function() {
        tinymce.init({
        selector: '.box_shadow_inr textarea',
        setup: function(editor) {
            editor.on('keyup', function(e) {
                // Revalidate the hobbies field
                $('#ProductForm').formValidation('revalidateField', 'description');
            });
        }
    });
      

        $('#ProductForm').formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            message: 'This value is not valid',
            icon: 
            {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            err: 
            {
                container: 'popover'
            },
            fields:
            {
                 "title": 
                 {
                        validators: 
                        {
                            notEmpty: 
                            {
                                message: 'Field is required'
                            }
                        }
                    },
                 /*  "menu": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },*/
                   "publish_the_page": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },
                /*  "order_number": 
                  {
                      validators: 
                      {
                          notEmpty: 
                          {
                              message: 'Field is required'
                          }
                      }
                  },*/
                   description: {
                    validators: {
                        callback: {
                            message: 'The description must be between 5 and 200 characters long',
                            callback: function(value, validator, $field) {
                                // Get the plain text without HTML
                                var text = tinyMCE.activeEditor.getContent({
                                    format: 'text'
                                });

                                return text.length <= 200000 && text.length >=2;
                            }
                        }
                    }
                  }

            }
        })

  });
</script>

@endsection