@extends('layouts.student')

@section('content')
<!-- Main Sidebar Container -->


<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 ">
                <h1 class="font-weight-bold">Register</h1>
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

<!-- <div class="p-2">
    <a class="btn btn-app bg-success rounded p-2 font-weight-bold" href="{{asset('/activity/createActivity')}}">
        <i class="fas fa-plus"></i> Add New Activity
    </a>
</div> -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex ">
                        <h5 class="mr-auto">{{ $activity->eventname }}</h5>
                        <h6 class="m-0">Posted at {{ Carbon\Carbon::parse($activity->created_at)->format('F d, Y - H:i A') }}</h6>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title pb-3 font-weight-bold">Details:</h2>

                        <p class="card-text">{{ $activity->description }}</p>

                        <div class="d-flex">
                            <p class="card-text font-weight-bold">Event Date:</p>
                            <p class="card-text pl-1">{{ Carbon\Carbon::parse($activity->datetime)->format('F d, Y - H:i A') }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="card-text font-weight-bold">Registration Closing Date:</p>
                            <p class="card-text pl-1">{{ $activity->closingdate }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="card-text font-weight-bold">Venue:</p>
                            <p class="card-text pl-1">{{ $activity->venue }}</p>
                        </div>

                        <div class="d-flex">
                            <p class="card-text font-weight-bold">Capacity:</p>
                            <p class="card-text pl-1">{{ $activity->capacity }}</p>
                        </div>


                        <!-- <p class="card-text d-none">Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American Apparel.</p>

                        <p class="card-text d-none">Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American Apparel.</p> -->

                        <!-- data-card-widget="maximize" -->
                        
                        <form method="post" action="{{ route('storereg') }}">
                            @csrf
                            @if($registered)
                            <p>You are already registered</p>
                            <a class="btn btn-primary" href="{{asset('/activity/viewActivity')}}">Back</a>
                            @elseif(Carbon\Carbon::parse($activity->closingdate)->lt(Carbon\Carbon::now()))
                            <p>Registration is closed</p>
                            <a class="btn btn-primary" href="{{asset('/activity/viewActivity')}}">Back</a>
                            @else
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Your Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Matric ID</label>
                                            <input type="text" name="matricid" id="matricid" class="form-control @error('matricid') is-invalid @enderror" placeholder="Enter Matric ID">
                                            @error('matricid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Faculty</label>
                                            <input type="text" name="faculty" id="faculty" class="form-control @error('faculty') is-invalid @enderror" placeholder="Enter Faculty">
                                            @error('faculty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="activity_record_id" value="{{ $activity->id }}">
                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                    </div>
                                    <!-- col -->

                                    <!-- col -->
                                </div>
                            </div>
                            <!-- row -->
                            <a class="btn btn-primary" href="{{asset('/activity/viewActivity')}}">Back</a>
                            <!-- <a class="btn btn-success ml-4" href="{{asset('/activity/viewActivity')}}">Register</a> -->
                            <button type="submit" class="btn btn-success ml-4">Register</button>

                        </form>
                        @endif









                    </div>
                </div>

            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- /.content-wrapper -->

@endsection

@push('scripts')
    <script src=" {{ asset('/js/activity.js') }} "></script>
@endpush