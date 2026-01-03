@extends('layouts.admin.app')
@section('title', 'why_choose_us')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-block">
                        <h5 class="card-title m-b-0 align-self-center">why_choose_us</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <li>
                                    <a href="{{url('admin/why-choose-us/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($why_choose_us)
                        <div class="table-responsive m-t-10">
                            <table id="myTable" class="table color-table table-bordered product-table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($why_choose_us as $key => $choose)
                                    <tr>
                                        <td>{{ $key +1 }}</td>
                                        <td>{{ $choose->title }}</td>
                                        @if($choose->status == 1)
                                        <td><span class="badge-success p-2">Active</span></td>
                                        @elseif($choose->status == 0)
                                        <td><span class="badge-danger p-2">Inactive</span></td>
                                        @endif
                                        <td class="text-center">
                                            <a href="{{ url('/admin/why-choose-us',$choose->id) }}"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('admin/why-choose-us/'.$choose->id.'/edit/') }}"><i class="fas fa-edit"></i></a>
                                            <form style="display: inline-block;" method="POST" action="{{ url('/admin/why-choose-us',$choose->id) }}">
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
<script src="{{asset('plugins/vendors/datatables/jquery.dataTables.min.js')}}"></script>

<script>

    $(function () {

        $('#myTable').DataTable();
    });
</script>
@endpush
