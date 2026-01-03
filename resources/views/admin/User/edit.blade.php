@extends('layouts.admin.app')
@section('title', 'Users')
<style type="text/css">
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
body{ margin: 0px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
  padding-left: 25px;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 0px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}
span.error {
    font-size: 15px;
    padding-left: 13px;
    color:red;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
.jumbotron {padding-top: -4px;
}
</style>
@push('before-css')
<style type="text/css">
    p.error-message {
        color: #df0a0a;
        font-weight: 500;
        font-size: 14px;
    }
</style>
@push('before-css')
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex m-b-10 no-block">
                            <h5 class="card-title m-b-0 align-self-center">Update User</h5>
                        </div>
                        <form action="{{url('/admin/user-management/'.$customer->Id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="form-group row">
                                  @if($user->first_name != null)
                                <div class="form-group col">
                                    <label for="last name">Full Name :</label>
                                    <input type="text" class="form-control" id="last_name" name="first_name" value="{{$user->first_name}}"> 
                                </div>
                                @endif
                                 @if($user->last_name != null)
                                <div class="form-group col">
                                    <label for="last name">Full Name :</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                                </div>
                                @endif
                            </div>
                             @if(isset($customer->PrimaryEmailAddr->Address))
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="text" class="form-control" id="desc" name="email" value="{{ $customer->PrimaryEmailAddr->Address}}">
                            </div>
                            @endif
                            @if(isset($customer->PrimaryPhone))
                            <div class="form-group">
                                <label for="sub_text">Phone :</label>
                                <input class="form-control" id="Phone" name="phone" rows="2" value="{{$customer->PrimaryPhone->FreeFormNumber}}">
                            </div>
                            @endif
                              @if(isset($customer->CompanyName))
                            <div class="form-group">
                                <label for="sub_text">Organization :</label>
                                <input type="text" class="form-control" id="organization" name="organization" value="{{$customer->CompanyName}}">
                            </div>
                            @endif
                            @if(isset($customer->BillAddr->Country))
                            <div class="form-group">
                                <label for="sub_text">Country :</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{$customer->BillAddr->Country}}">
                            </div>
                            @endif
                              @if(isset($customer->BillAddr->City))
                            <div class="form-group">
                                <label for="sub_text">City :</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{$customer->BillAddr->City}}">
                            </div>
                            @endif
                            <br>
                            <br>
                            <button class="btn btn-success pull-center" type="submit">Update</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.includes.templates.footer')
    </div>
@endsection
@push('js')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#description').summernote({
            tabsize: 2,
            height: 100
        });
    });
</script>
@endpush
