@extends('layouts.student')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 ">
                <h1 class="font-weight-bold">All Activities</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Activity</a></li>
                    <li class="breadcrumb-item active">View Activity</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>

<div class="p-2">
    <a class="btn btn-app bg-success rounded p-2 font-weight-bold" href="{{asset('/activity/createActivity')}}">
        <i class="fas fa-plus"></i> Add New Activity
    </a>
</div>

<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active ml-3" data-toggle="tab" href="#tab1">View All Activities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab2">View My Activities</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane container active" id="tab1">
            @foreach($activities as $activity)

            <div class="content">

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card card-primary card-outline">
                            <div class="card-header d-flex ">
                                <h5 class="mr-auto font-weight-bold">{{ $activity->eventname }}</h5>
                                <h6 class="m-0">Posted at {{ Carbon\Carbon::parse($activity->created_at)->format('F d, Y - H:i A') }}</h6>
                            </div>
                            <div class="card-body">

                                <div class="d-flex">
                                    <p class="card-text font-weight-bold">Event Date:</p>
                                    <p class="card-text pl-1">{{ Carbon\Carbon::parse($activity->datetime)->format('F d, Y - H:i A') }}</p>
                                </div>

                                <div class="d-flex">
                                    <p class="card-text font-weight-bold">Registration Closing Date:</p>
                                    <p class="card-text pl-1">{{ Carbon\Carbon::parse($activity->closingdate)->format('F d, Y - H:i A') }}</p>
                                </div>

                                <div class="d-flex">
                                    <p class="card-text font-weight-bold">Venue:</p>
                                    <p class="card-text pl-1">{{ $activity->venue }}</p>
                                </div>

                                <button class="btn btn-primary" id="{{ $activity->id }}" onclick="viewData(this.id)">View Details</button>

                            </div>
                        </div>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->

            </div>
            @endforeach
        </div>
        @php
        use Carbon\Carbon;
        @endphp
        <div class="tab-pane container" id="tab2">
            <div class="container">


                @if(Auth::check())
                @php
                $i = 1;
                @endphp
                @foreach(Auth::user()->activityrecord as $activity)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card card-primary card-outline">
                                <div class="card-header d-flex ">
                                    <h5 class="mr-auto font-weight-bold">{{ $activity->eventname }}</h5>
                                    <h6 class="m-0">Posted at {{ Carbon::parse($activity->created_at)->format('F d, Y - H:i A') }}</h6>
                                </div>
                                <div class="card-body">

                                    <div class="d-flex">
                                        <p class="card-text font-weight-bold">Event Date:</p>
                                        <p class="card-text pl-1">{{ Carbon::parse($activity->datetime)->format('F d, Y - H:i A') }}</p>
                                    </div>

                                    <div class="d-flex">
                                        <p class="card-text font-weight-bold">Registration Closing Date:</p>
                                        <p class="card-text pl-1">{{ $activity->closingdate }}</p>
                                    </div>

                                    <div class="d-flex">
                                        <p class="card-text font-weight-bold">Venue:</p>
                                        <p class="card-text pl-1">{{ $activity->venue }}</p>
                                    </div>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$i}}">
                                        View More Details
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ $activity->eventname }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h2 class="card-title pb-3 font-weight-bold">Details:</h2>

                                                    <p class="card-text">{{ $activity->description }}</p>

                                                    <div class="d-flex">
                                                        <p class="card-text font-weight-bold">Event Date:</p>
                                                        <p class="card-text pl-1">{{ $activity->datetime }}</p>
                                                    </div>

                                                    <div class="d-flex">
                                                        <p class="card-text font-weight-bold">Registration Closing Date:</p>
                                                        <p class="card-text pl-1">{{ $activity->closingdate }}</p>
                                                    </div>
                                                    @if($activity->eventstatus == 0)
                                                    <p>Application Approval: <span class="badge badge-warning ml-2">Pending</span></p>
                                                    @elseif($activity->eventstatus == 1)
                                                    <p>Application Status:<span class="badge badge-success ml-2">Approved</span></p>
                                                    @elseif($activity->eventstatus == 2)
                                                    <p>Application Status:<span class="badge badge-danger ml-2">Rejected</span></p>
                                                    @endif
                                                    @php
                                                    $current_time = Carbon::now();
                                                    if($current_time->gt(Carbon::parse($activity->datetime))){
                                                    $status = 'Completed';
                                                    }else{
                                                    $status = 'Ongoing';
                                                    }
                                                    @endphp

                                                    <p>Activity Status: <span class="badge badge-primary ml-2">{{$status}}</span></p>


                                                    <div class="d-flex">
                                                        <p class="card-text font-weight-bold">Venue:</p>
                                                        <p class="card-text pl-1">{{ $activity->venue }}</p>
                                                    </div>

                                                    <div class="d-flex">
                                                        <p class="card-text font-weight-bold">Capacity:</p>
                                                        <p class="card-text pl-1">{{ $activity->capacity }}</p>
                                                    </div>

                                                    <h4>Registered Users</h4>
                                                    <ul>
                                                        @foreach($activity->registrations as $registration)
                                                        <li>{{ $registration->name }} ({{ $registration->matricid }}) - {{ $registration->faculty }}</li>
                                                        @endforeach
                                                    </ul>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                @php
                $i++;
                @endphp


                @endforeach
            </div>
            @else
            <p>Please login to view your activities.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src=" {{ asset('/js/activity.js') }} "></script>
@endpush