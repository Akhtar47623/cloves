@extends('layouts.admin.app')
@section('title', 'My Dashboard')
<style type="text/css">
  div.current_month img {
    width: 100px;
    height: 70px;
}

div.current_month {
    border-radius: 5px;
    border:2px dashed white;
    /*background: #3dbac9;*/
    width: 100%;
    height: 90%;
    padding: 10px;
}
.text h5{
  font-size: 17px;
  font-weight: 700;
}
.views {
    padding: 54px;
}
.total{
  background:darkcyan;
}
.current{
  background:#dbc108;
}
.previous{
  background:darkslateblue;
}

</style>
@yield('css')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex m-b-10 no-bpricesk">
                        <h5 class="card-title m-b-0 align-self-center">Analysis</h5>
                        <div class="ml-auto text-light-blue">
                            <ul class="nav nav-tabs customtab default-customtab list-inline text-uppercase lp-5 font-medium font-12" role="tablist">
                                <!-- <li>
                                    <a href="{{url('admin/dashboard/create/')}}" class="btn waves-effect waves-light btn-rounded btn-primary">Add Price</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive m-t-10">
                      <div class="views">
                          <h6>Views <span class="text-primary"><i class="fa fa-eye"></i></span></h6>
                        <div class="row">
                          <div class="col-4">
                            <div class="current_month total">
                              <img src="{{asset('web-assets/images/users.png')}}">
                              <div class="box">
                                <h3 class="text-white float-right"> {{$total_views}} </h3>
                              </div>
                                <br>
                              <div class="text">
                                <h5 class="text-white mx-2">TOTAL</h5>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="current_month current">
                              <img src="{{asset('web-assets/images/users.png')}}">
                              <div class="box">
                                <h3 class="text-white float-right"> {{$crnt_mnth_views}} </h3>
                              </div>
                                <br>
                              <div class="text">
                                <h5 class="text-white mx-2">CURRENT MONTH</h5>
                              </div>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="current_month previous">
                              <img src="{{asset('web-assets/images/users.png')}}">
                              <div class="box">
                                <h3 class="text-white float-right"> {{$pre_mnth_views}} </h3>
                              </div>
                                <br>
                              <div class="text">
                                <h5 class="text-white mx-2">PREVIOUS MONTH</h5>
                              </div>
                            </div>
                          </div>       
                        </div>
                      </div>
                              <div class="row">
                                <div class="col-6">                                
                                    <div id="piechart_3d" style="width:; height: 300px;"></div>
                                </div>
                                <div class="col-6">                                
                                   <div id="donut_single" style="height: 300px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                    <select class="select year" id="select_year" style="margin-left: 825px; position: relative;">
                                        <option class="" selected="" value="current">Current Year</option>
                                        <option value="previous">Previous Year</option>
                                    </select>
                                <div class="col-12">
                                    <div id="chart_div" class="" style="width:100%; height:500px;"></div>
                                </div>
                                <div class="col-12">
                                    <div id="previous_year" class="" style="width:100%; height: 500px;"></div>
                                </div>
                            </div>
                        </div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
    $('#selectViews').on('change',function(){
      if($('#selectViews').val()=='preMonth'){
       $('#pre_month').removeClass('d-none');
       $('#current_month').addClass('d-none');
    }
    else if($('#selectViews').val()=='currentMonth'){
        $('#pre_month').addClass('d-none');
        $('#current_month').removeClass('d-none');
    }
    });

    $('#select_year').on('change',function(){
    if($('#select_year').val()=='previous'){
       $('#previous_year').removeClass('d-none');
       $('#chart_div').addClass('d-none');
    }
    else if($('#select_year').val()=='current'){
        $('#previous_year').addClass('d-none');
        $('#chart_div').removeClass('d-none');
    }
    })
    setTimeout(function(){
        $('#previous_year').addClass('d-none');
    },1000);
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Delivery({{$delivery}})', {{$delivery}}],
          ['Pickup({{$pickup}})', {{$pickup}}],
          ['Task({{$task}})', {{$task}}]
        ]);

        var options = {
          title: 'Order types',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
   // Pie Chart
   // Pie circle Chart
          var data = google.visualization.arrayToDataTable([
          ['Effort', 'Amount given'],
          ['Dispatched({{$dispatched}})',     {{$dispatched}}],
          ['Pending({{$pending}})',     {{$pending}}],
          ['d',     0],
          ['Delivered({{$delivered}})',     {{$delivered}}],
        ]);

        var options = {
          pieHole: 0.5,
          title: 'Order Status',
          pieSliceTextStyle: {
            color: 'black',
          },
          // legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
        chart.draw(data, options);
   // Pie circle Chart  
   }

    // Bar Chart

        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time');
            data.addColumn('number', 'Motivation Level');

            data.addRows([
            [{v: [8, 0, 0], k: '8 am'}, 1],
            [{v: [9, 0, 0], f: '9 am'}, 2],
            [{v: [10, 0, 0], f:'10 am'}, 3],
            [{v: [11, 0, 0], f: '11 am'}, 4],
            [{v: [12, 0, 0], f: '12 pm'}, 5],
            [{v: [13, 0, 0], f: '1 pm'}, 6],
            [{v: [14, 0, 0], f: '2 pm'}, 7],
            [{v: [15, 0, 0], f: '3 pm'}, 8],
            [{v: [16, 0, 0], f: '4 pm'}, 9],
            [{v: [17, 0, 0], f: '5 pm'}, 10],
            ]);

            var options = {
            title: 'Monthly Orders({{now()->year}})',
            hAxis: {
              title: 'Monthly (orders)',
              format: 'Qunatity',
              viewWindow: {
                min: [7, 30, 0],
                max: [17, 30, 0]
              }
            },
            vAxis: {
              title: 'Orders (Qunatity)'
            }
            };
              var data = google.visualization.arrayToDataTable([
            ["Element", "Orders", { role: "style" } ],
            ["Jan", {{$jan}}, "#3366cc"],
            ["Feb", {{$feb}}, "#3366cc"],
            ["March", {{$march}}, "#3366cc"],
            ["April", {{$april}}, "#3366cc"],
            ["May", {{$may}}, "#3366cc"],
            ["Jun", {{$jun}}, "#3366cc"],
            ["July", {{$july}}, "#3366cc"],
            ["Aug", {{$aug}}, "#3366cc"],
            ["Sep", {{$sep}}, "#3366cc"],
            ["Oct", {{$oct}}, "#3366cc"],
            ["Nov", {{$nov}}, "#3366cc"],
            ["Dec", {{$dec}}, "#3366cc"],
            ]);

   

            var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));
            chart.draw(data, options);

            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time');
            data.addColumn('number', 'Motivation Level');

            data.addRows([
            [{v: [8, 0, 0], k: '8 am'}, 1],
            [{v: [9, 0, 0], f: '9 am'}, 2],
            [{v: [10, 0, 0], f:'10 am'}, 3],
            [{v: [11, 0, 0], f: '11 am'}, 4],
            [{v: [12, 0, 0], f: '12 pm'}, 5],
            [{v: [13, 0, 0], f: '1 pm'}, 6],
            [{v: [14, 0, 0], f: '2 pm'}, 7],
            [{v: [15, 0, 0], f: '3 pm'}, 8],
            [{v: [16, 0, 0], f: '4 pm'}, 9],
            [{v: [17, 0, 0], f: '5 pm'}, 10],
            ]);

            var options = {
            title: 'Monthly Orders({{now()->year -1}})',
            hAxis: {
              title: 'Monthly (orders)',
              format: 'Qunatity',
              viewWindow: {
                min: [7, 30, 0],
                max: [17, 30, 0]
              }
            },
            vAxis: {
              title: 'Orders (Qunatity)'
            }
            };
              var data = google.visualization.arrayToDataTable([
            ["Element", "Orders", { role: "style" } ],
            ["Jan", {{$previous_jan}}, "#3366cc"],
            ["Feb", {{$previous_feb}}, "#3366cc"],
            ["March", {{$previous_march}}, "#3366cc"],
            ["April", {{$previous_april}}, "#3366cc"],
            ["May", {{$previous_may}}, "#3366cc"],
            ["Jun", {{$previous_jun}}, "#3366cc"],
            ["July", {{$previous_july}}, "#3366cc"],
            ["Aug", {{$previous_aug}}, "#3366cc"],
            ["Sep", {{$previous_sep}}, "#3366cc"],
            ["Oct", {{$previous_oct}}, "#3366cc"],
            ["Nov", {{$previous_nov}}, "#3366cc"],
            ["Dec", {{$previous_dec}}, "#3366cc"],
            ]);

   

            var chart = new google.visualization.ColumnChart(
            document.getElementById('previous_year'));
            chart.draw(data, options);
        }
    // Previous year Bar Chart

    
</script>
@endpush
