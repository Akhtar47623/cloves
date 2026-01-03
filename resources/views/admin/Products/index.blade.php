@extends('layouts.admin.app')
@section('title', 'Product')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">Products</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a href="{{url('admin/product/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Product</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($products)
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <!-- <th>Cost</th> -->
                                    <!-- <th>Sales Price</th> -->
                                    <th>Qty</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $product) 
                                    @if(isset($product->Active) && $product->Active == 'true' && $product->Type == 'Inventory')
                                    <tr>
                                        <td>{{ $key +1 }}</td>

                                        @if(isset($product->Name))
                                        <td>{{ $product->Name }}</td>
                                        @else
                                        <td>NA</td>
                                        @endif

                                        @if(isset($product->Name) && $product->SubItem == 'true' && $product->Active == 'true')
                                        <td>{{ substr($product->FullyQualifiedName, 0, strpos($product->FullyQualifiedName, ":"))}}</td>
                                        @else
                                        <td>NA</td>
                                        @endif
                                        <!-- @if($product->PurchaseCost != '0')
                                        <td>{{ $product->PurchaseCost }}</td>
                                        @else
                                        <td>Not Set</td>
                                        @endif -->

                                      <!--   @if(isset($product->UnitPrice))
                                        <td>{{ $product->UnitPrice }}</td>
                                        @else
                                        <td>Not Set</td>
                                        @endif -->

                                        @if(isset($product->QtyOnHand))
                                        <td>{{ $product->QtyOnHand }}</td>
                                        @else
                                        <td>NA</td>
                                        @endif
                                        <td class="text-center">
                                         <a href="{{ url('/admin/product',$product->Id) }}"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('admin/product/'.$product->Id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                            <form style="display: inline-block;" method="POST" action="{{ url('/admin/product',$product->Id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="SyncToken" value="{{$product->SyncToken}}">
                                                <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.includes.templates.footer')
</div>
@endsection
@push('js')
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>

<script>

    $(function () {

        $('#myTable').DataTable();
    });
</script>
@endpush
