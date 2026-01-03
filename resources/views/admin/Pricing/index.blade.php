@extends('layouts.admin.app')
@section('title', 'Pricing')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-bpricesk">
                        <h5 class="card-title m-b-0 align-self-center">Pricing</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a href="{{url('admin/pricing/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Price</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($prices)
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Image</th> -->
                                    <th>Source Location</th>
                                    <th>Destination Location</th>
                                    <th>Distance</th>
                                    <th>Price per Kilometer</th>
                                    <th>Total Amount</th>
                                    <!-- <th>Status</th> -->
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($prices as $key => $prices)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <!-- <td><?= date_format($prices->created_at,"d-M-Y") ?></td> -->
                                        <td>{{ $prices->source_location }}</td>
                                        <td>{{ $prices->destination_location }}</td>
                                        <td>{{ $prices->total_distance }}</td>
                                        <td>$ {{ $prices->shipping_price }}</td>
                                        <td>{{ $prices->total_amount }}</td>
                                      <!--   @if($prices->status == 1)
                                        <td><span class="badge-success p-2">Active</span></td>
                                        @elseif($prices->status == 0)
                                        <td><span class="badge-danger p-2">Inactive</span></td>
                                        @endif -->
                                        <td class="text-center">
                                            <a href="{{ url('/admin/pricing/'.$prices->id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                             <form style="display: inline-bpricesk;" method="POST" action="{{ url('/admin/pricing',$prices->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
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
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script>
    $(function () {
        $('#myTable').DataTable();
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 18,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
</script>
@endpush
