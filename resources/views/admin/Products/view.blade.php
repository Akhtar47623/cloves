@extends('layouts.admin.app')
@section('title', 'Product')
@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Product # {{$products->Id}}</h3>

                    <a href="{{url('/admin/product')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                @if($products->Active='true')
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $products->Id }}</td>
                                    </tr>
                                    @if(isset($products->Name))
                                        <tr>
                                            <th>Item</th>
                                            @if(isset($products->Name))
                                            <td>{{ $products->Name }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                     @if(isset($products->PurchaseCost))
                                        <tr>
                                            <th>Cost</th>
                                            @if(isset($products->PurchaseCost))
                                            <td>{{ $products->PurchaseCost }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if(isset($products->UnitPrice))
                                        <tr>
                                            <th>Sales Price</th>
                                            @if(isset($products->UnitPrice))
                                            <td>{{ $products->UnitPrice }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if(isset($products->QtyOnHand))
                                        <tr>
                                            <th>Qty</th>
                                            @if(isset($products->QtyOnHand))
                                            <td>{{ $products->QtyOnHand }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if(isset($products->Description))
                                        <tr>
                                            <th>Description</th>
                                            @if(isset($products->Description))
                                            <td>{{ $products->Description }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if(isset($products->Type))
                                        <tr>
                                            <th>Item Type</th>
                                            @if(isset($products->Type))
                                            <td>{{ $products->Type }}</td>
                                            @else
                                            <td>Not Found</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection

