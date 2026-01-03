@extends('layouts.admin.app')
@section('title','Job Posting')
@section('content')
<style type="text/css">
    tr, td{
        text-transform: capitalize;
    }
</style>
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Job # {{$posting_details->id}}</h3>
                    <a href="{{url('/admin/job-posting')}}" class="btn waves-effect waves-light btn-rounded btn-primary float-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                                <tr>
                                    <th>Title :</th>
                                    <td>{{ $posting_details->title}}</td>
                                </tr>
                                 <tr>
                                    <th>Designation :</th>
                                    <td>{{ $posting_details->designation}}</td>
                                </tr>
                                @php $skill=App\model\Skill::where('job_id',$posting_details->id)->get();
                                @endphp
                                <tr>
                                    <th>Skills :</th>
                                    <td>
                                        @foreach($skill as $skills)
                                        {{ $skills->skills}},
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Experience :</th>
                                    <td>{{ $posting_details->experience }}</td>
                                </tr>
                                <tr>
                                    <th>Industry :</th>
                                    <td>{{ $posting_details->industry }}</td>
                                </tr>
                                 <tr>
                                    <th>Functional Area :</th>
                                    <td>{{ $posting_details->functional_area }}</td>
                                </tr>
                                <tr>
                                    <th>Total Positions :</th>
                                    <td>{{ $posting_details->total_positions }}</td>
                                </tr>
                                 <tr>
                                    <th>Job Typd :</th>
                                    <td>{{ $posting_details->job_type }}</td>
                                </tr>
                                 <tr>
                                    <th>Job Shift :</th>
                                    <td>{{ $posting_details->job_shift }}</td>
                                </tr>
                                 <tr>
                                    <th>Job Location:</th>
                                    <td>{{ $posting_details->job_location }}</td>
                                </tr>
                                 <tr>
                                    <th>Department:</th>
                                    <td>{{ $posting_details->department }}</td>
                                </tr>
                                 <tr>
                                    <th>Minimium Education :</th>
                                    <td>{{ $posting_details->min_education }}</td>
                                </tr>
                                 <tr>
                                    <th>Degree Title:</th>
                                    <td>{{ $posting_details->degree_title }}</td>
                                </tr>
                                <tr>
                                     <th>Short Description:</th>
                                    <td>{{ $posting_details->short_description}}</td>
                                </tr>
                                 <tr>
                                    <th>Job Description:</th>
                                    <td><?=html_entity_decode($posting_details->job_description)?></td>
                                </tr>
                                 <tr>
                                    <th>About Company:</th>
                                    <td><?=html_entity_decode($posting_details->about_company)?></td>
                                </tr>
                                <br>
                                <tr></tr>
                                <td><h5>Image :</h5></td>
                                    <td><img src="{{ asset($posting_details->image_path) }}" style="height: 150px;width: 300px; object-fit: contain;" class="img-responsive"></td>
                                </tr>
                                </table>
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