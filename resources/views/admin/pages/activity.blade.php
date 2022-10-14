@extends('admin.layout.master')
@section('content')
<style>
    .partyy .dropdown-menu{
       min-width: 80px!important;
       margin-top:40px!important;
       margin-left:-20px!important;
   }
   table, th, td {
        border: 1px solid black;
        border-collapse: collapse; 
        }
        thead{
            background-color:rgba(128, 128, 128, 0.144);
        }
    .dataTables_length label{
        margin-bottom:30px;
    }
   .swal2-cancel{
            margin-right:30px!important;
        }
 </style>
<main class="content">
    <div class="container-fluid p-0">
        <h3><strong>Activity Log</strong></h3>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title ms-4 mb-2">Activity Log</h4>

                                    </div>
                                   <br>
                                  
                                <div class="card-body" style="margin-top:-40px!important;">
                                    @include('sweetalert::alert')

                                    <table class="table table-data">
                                        <thead>
                                            <tr style="margin-top:20px!important">
                                               <th>SL</th>
                                               <th>Log name</th>
                                               <th>Description</th>
                                               <th>Subject Type</th>
                                               <th>Event</th>
                                               <th>Subject Id</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activity_logs as $activity )
                                               <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$activity->log_name}}</td>
                                                <td>{{$activity->description}}</td>
                                                <td>{{$activity->subject_type}}</td>
                                                <td>{{$activity->event}}</td>
                                                <td>{{$activity->subject_id}}</td>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</main>  
@endsection
