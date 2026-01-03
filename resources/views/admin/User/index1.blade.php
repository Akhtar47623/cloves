@extends('layouts.admin.app')
@section('title', 'Users')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">User Management</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                             <!--    <li>
                                    <a href="{{url('admin/user-management/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add New Banner</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    @if(auth()->user()->hasRole('admin'))
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Org</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @if(is_array($customers) || is_object($customers)) 
                                    @foreach($customers as $key => $customer)
                                        @if(isset($customer->PrimaryEmailAddr->Address))
                                            @php $user = \App\Model\User::where('email',$customer->PrimaryEmailAddr->Address)->first();@endphp
                                        @if(isset($user))
                                        <tr>
                                            <td>{{ $key +1 }}</td>
                                            <!-- <td>{{ $customer->Id }}</td> -->

                                            <td>{{ $customer->DisplayName }}</td>
                                            @if(isset($customer->PrimaryEmailAddr->Address))
                                            <td>{{ $customer->PrimaryEmailAddr->Address}}</td>
                                            @else
                                            <td>Email Not Found</td>
                                            @endif
                                            @if(isset($customer->PrimaryPhone))
                                            <td>{{$customer->PrimaryPhone->FreeFormNumber}}</td>
                                            @else
                                            <td>NA</td>
                                            @endif
                                             @if(isset($customer->CompanyName))
                                            <td>{{$customer->CompanyName}}</td>
                                            @else
                                            <td>NA</td>
                                            @endif
                                              @if(isset($customer->BillAddr->Country))
                                            <td>{{$customer->BillAddr->Country}}</td>
                                            @else
                                            <td>NA</td>
                                            @endif
                                              @if(isset($customer->BillAddr->City))
                                            <td>{{$customer->BillAddr->City}}</td>
                                            @else
                                            <td>NA</td>
                                            @endif
                                            @foreach($contact_inquiry as $inquiry)
                                            @endforeach
                                             <td class="text-center">
                                                <!-- <a href="{{ url('/admin/customer-pdf/'.$user->id) }}" target="_blank"><i class="fas fa-file"></i></a> -->
                                              <!--   <a href="{{ url('/admin/inquiry/'.$inquiry->id) }}"><i class="fas fa-envelope"></i></a> -->
                                                 <form style="display: inline-block;" method="POST" action="{{ url('/admin/user-management',$customer->Id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick='return confirm("Confirm delete?")' style="border: none;outline: none;padding:0;background: #fff;" type="submit"><i class="fas fa-trash-alt text-danger"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                      @else
                                        <!-- <td>Email Not Found</td> -->
                                    @endif
                                        @endforeach
                                @endif
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
