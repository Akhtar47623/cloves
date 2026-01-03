@extends('layouts.admin.app')
@section('title', 'Product')
@push('before-css')
<link href="{{asset('plugins/vendors/morrisjs/morris.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/c3-master/c3.min.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
<link href="{{asset('plugins/vendors/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
<link href="{{asset('plugins/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/css/pages/google-vector-map.css')}}" rel="stylesheet">
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Update Product</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <!--
                                <li>
                                    <a href="{{url('ecommerce-add-new')}}"
                                       class="btn waves-effect waves-light btn-rounded btn-primary">Add Product</a>
                                </li>
                                -->
                            </ul>
                        </div>
                    </div>
                    <form action="{{url('/admin/product/'.$products->Id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="text" name="SyncToken" value="{{$products->SyncToken}}" hidden="">
                        <div class="form-group">
                            <label for="category">Item:</label>
                            <input type="text" class="form-control" id="Name" name="Name" value="{{ $products->Name }}">
                            @error('Name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="ParentRef" class="form-control">
                              @foreach($categories as $key => $category)
                              <option value="{{ $category->Id }}" {{($products->ParentRef == $category->Id)?'Selected':''}}>{{$category->Name}}</option>
                              @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                              <label for="cost">Cost:</label>
                              <input type="number" class="form-control" id="PurchaseCost" name="PurchaseCost" value="{{ $products->PurchaseCost }}">
                              @error('PurchaseCost')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          @if(isset($products->UnitPrice))
                          <div class="col-4">
                              <label for="UnitPrice">Sales Price:</label>
                              <input type="number" class="form-control" id="UnitPrice" name="UnitPrice" value="{{ $products->UnitPrice }}">
                              @error('UnitPrice')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          @endif
                          @if(isset($products->QtyOnHand))
                          <div class="col-4">
                              <label for="QtyOnHand">Qty:</label>
                              <input type="number" class="form-control" id="QtyOnHand" name="QtyOnHand" value="{{ $products->QtyOnHand }}">
                              @error('QtyOnHand')
                              <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          @endif
                        </div>
                        <div class="form-group">
                            <label for="Description">Description:</label>
                            <input type="text" class="form-control" id="Description" name="Description" value="{{ $products->Description }}">
                            @error('Description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         <!-- <div class="form-group">
                           <label for="occupation">Status:</label>
                            @if($products->status == 0)
                            <select class="form-select form-control" aria-label="Default select example" name="status" >
                              <option value="0" selected class="form-control">Inactive</option>
                              <option value="1" class="form-control">Active</option>
                            </select>
                            @elseif($products->status == 1)
                            <select class="form-control" aria-label="Default select example" name="status">
                              <option value="1" selected class="form-control">Active</option>
                              <option value="0" class="form-control">InActive</option>
                            </select>
                             @endif
                          </div> -->
                        <button class="btn btn-success pull-center" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection
@push('js')
<script src="{{asset('plugins/vendors/d3/d3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/c3-master/c3.min.js')}}"></script>
<script src="{{asset('plugins/vendors/knob/jquery.knob.js')}}"></script>
<script src="{{asset('plugins/vendors/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('plugins/vendors/raphael/raphael-min.js')}}"></script>
<script src="{{asset('plugins/vendors/morrisjs/morris.js')}}"></script>
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready(function(){

             $(".btn-add-more").click(function(){ 
          var html = $(".clone").html();
          $(".img_div").after(html);
      });
 
      $("body").on("click",".btn-remove",function(){ 
          $(this).parents(".control-group").remove();
      });
  $('#description').summernote({
    placeholder: 'Type Services Detail ....',
    tabsize: 2,
    height: 100
  });
  $('#long_description').summernote({
    placeholder: 'Type hear ....',
    tabsize: 2,
    height: 100
  });
  });

</script>
<script type="text/javascript">
    //Script To Generate slug
  $('#title').on('keyup',function(e) {
    $.get('{{ route('check_slug') }}', 
      { 'title': $(this).val() },
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
<!-- slug scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- endslug scripts -->
<script src="{{asset('plugins/vendors/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
@endpush
    