@extends('layouts.admin.app')
@section('title', 'Users')
@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">User # {{$users->id}}</h3>

                    <a href="{{url('/admin/user-management')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $users->id }}</td>
                            </tr>
                            @if($users->first_name != null)
                            <tr><th> First Name: </th>
                            <td> {{ $users->first_name}}</td>
                            </tr>
                            @endif
                             @if($users->last_name != null)
                            <tr><th> Last Name: </th>
                            <td> {{ $users->last_name}}</td>
                            </tr>
                            @endif
                            @if($users->email != null)
                            <tr><th> Email: </th>
                            <td> {{ $users->email}}</td>
                            </tr>
                            @endif
                            @if($users->phone != null)
                            <tr><th> Phone: </th>
                            <td> {{ $users->phone}}</td>
                            </tr>
                            @endif
                            @if($users->organization != null)
                            <tr><th> Organization: </th>
                            <td> {{ $users->organization}}</td>
                            </tr>
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

