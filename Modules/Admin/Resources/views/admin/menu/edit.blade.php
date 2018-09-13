@extends('admin::admin.master')
@section('title', "Admin Menu List")
@section('css')
 <style>
#featuredimage_preview {
width: 80px;
height: 80px;
background-position: center center;
background-size: cover;
-webkit-box-shadow: 0 0 0px 0px rgba(0, 0, 0, .3);
display: inline-block;
}

</style>
@stop
@section('breadcrumb')
<div class="breadcrumb-line">
<ul class="breadcrumb">
        <li><a href="{{ URL::to('o4k/')}}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ URL::to('o4k/menu')}}"><i class="icon-list position-left"></i>Menu management</a></li>
        <li class="active">Create</li>
</ul>
</div>
@stop
@section('heading')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{URL('/o4k')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{URL('/o4k/menu')}}"><i class="icon-list position-left"></i> Menu management</a></li>
            <li class="active">Edit</li>
        </ul>

    </div>

     <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Menu List <small>Hello, {{Auth::guard('admin')->user()->name}}!</small></h4>
        </div>

    </div>
@stop
@section('content') 
    <div class="panel panel-flat">
        <div class="showalert">
            @if(Session::has('val')) 
                @if(Session::get('val')==0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right:14px;">×</button>
                        <h4><i class="icon fa fa-ban"> Alert!</i></h4> 
                        {{Session::get('msg')}}
                    </div>
                @endif
       
            @endif
        </div>
        <div class="panel-heading">
            <h5 class="panel-title">Edit Menu <a class="heading-elements-toggle"> <i class="icon-more"></i> </a></h5>
        </div>
        <div class="panel-body">
        <!--- Form -->
        <div class="row">
            <div class="col-md-12">
                <form action="#" id="menu_list_update" autocomplete="off" data-id="{{ $menu->id}}"> 
                   
                    <div class="row">
                    <!---Name-->
                        <input type="hidden" name="language_en" value="1">
                          <input type="hidden" name="id" value="{{$menu->id}}">
                        <div class="form-group col-md-6" id="titlebox_en">
                            <label>Title in English</label>
                            <input type="hidden" name="language_en" value="1">
                            <input  id= "title_en" name="title_en" type="text" class="form-control perm_text" placeholder="Enter title" data-lang="en" value="{{$menu->title}}">
                            
                             <span  class="help-block"></span> 
                        </div>
                        <!----/* Name---->
                        <!--- Slug-->
                        <div class="form-group col-md-6" id="slugbox_en">
                            <label>Slug</label>
                                <input id="slug_en"  type="text" name="slug_en"  readonly class="form-control perm_slug" placeholder="Title Slug"  value="{{$menu->slug}}">
                                 <span  class="help-block"></span> 
                        </div>
                </div>
                    @php

                    $ids = $menu->types->pluck('id')->toArray();
                    $lang_ids = $menu->types->pluck('language_id')->toArray();
                    $titles = $menu->types->pluck('title')->toArray();
                    $slugs = $menu->types->pluck('slug')->toArray();

                @endphp
                    @foreach($languages as $language)
                    <div class="row">
                            <?php 
                                if($lang_ids){
                                    $key = array_search($language->language_id,$lang_ids);
                                }
                            ?>
                            <input type="hidden" name="language[]" value="{{$language->language_id}}">
                            <input type="hidden" name="ids[]" value="@if(!empty($menu->types[0])){{$ids[$key]}}@else{{$menu->id}}@endif" >
                            <div class="form-group col-md-6"  id="namebox_{{$language->languages->lang_code}}">
                                <label>Name in {{$language->languages->name}}</label>
                                <input id="title_{{$language->languages->lang_code}}" name="title[]" type="text" class="form-control perm_text" placeholder="Enter title" value="@if(!empty($menu->types[0])){{$titles[$key]}}@endif">
                                <input   name="short_name[]" type="hidden" value='{{$language->languages->lang_code}}' class="form-control" value="@if(!empty($menu->types[0])){{$titles[$key]}}@endif">
                                 <span  class="help-block "></span> 
                            </div>
                            <div class="form-group col-md-6" id="slugbox_{{$language->languages->lang_code}}">
                                <label>Slug</label>
                                <input  type="text" id="slug_{{$language->languages->lang_code}}" name="slug[]" readonly class="form-control perm_slug" placeholder="menu Slug"   value="@if(!empty($menu->types[0])){{$slugs[$key]}}@endif">
                                 <span  class="help-block "></span> 
                            </div>
                        </div>
                        @endforeach

            
                    
                    
                    <div class="row">
                            <!---Property Name-->
                            <div class="form-group col-md-6" id="linkbox">
                                <label>Link</label>
                                <input type="text" class="form-control" id="link" placeholder="Link" name="link"  value="{{ $menu->link}}">
                                 <span  class="help-block"></span> 
                            </div>
                            <!---Property Name-->
                            <div class="form-group col-md-6" id="statusbox">
                                <label>Status</label>
                                <select class="bootstrap-select " data-width="100%"  name="status" id="status">
                                       <option disabled="true">Select Status</option>
                                        <option value="1"  @if($menu->status == '1') selected @endif >Active</option>
                                        <option value="0" @if($menu->status == '0') selected @endif >Inactive</option>
                                </select>
                                <span  class="help-block"></span> 
                            </div>
                            <!----/* Property Name---->

                    </div>

                    <!--Form action-->
                    <div class="row">
                        <div class="col-md-12 text-right">
                           <!-- <button type="reset" class="btn btn-default legitRipple" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
                            <button type="submit" id="menu_list_save" class="btn btn-primary legitRipple">Save Menu<i class="icon-paperplane position-right"></i></button>
                        </div>  
                    </div>
               <!-- /* Form action -->
                </form>
            </div>
            
        </div>
        
    </div>

@stop
  
  
  
@section('js')
   @section('js')

   
  
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/selects/bootstrap_select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/admin/js/pages/moment.min.js')}}"></script>
   <script type="text/javascript" src="{{asset('Modules/Admin/Resources/assets/js/menuControles.js')}}"></script>
    
@stop
  