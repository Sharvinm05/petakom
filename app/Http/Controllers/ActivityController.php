<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\activityRecord;
use \App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('activity/viewActivity');
    }

    public function createAct()
    {
        return view('activity/createActivity');
    }

    public function viewDetails()
    {
        return view('activity/viewDetails');
    }

    public function registerActivity()
    {
        return view('activity/registerActivity');
    }

    public function activityApproval()
    {
        return view('activity/activityApproval');
    }

    //store new activity
    public function store()
    {
        $data = request()->validate([
            'eventname' => 'required',
            'capacity'  => 'required',
            'venue' => 'required',
            'datetime' => 'required',
            'closingdate' => 'required',
            'description' => 'required',
        ]);

        auth()->user()->activityrecord()->create($data);

        return redirect('/activity/viewActivity');
    }

    //view list for activity for approval
    public function view()
    {
        // $user = Auth::user();
        // $activities = $user->activities;
        $current_time = Carbon::now();
        // $activities = activityRecord::whereNull('eventstatus')->get();

        $activities = activityRecord::whereNull('eventstatus')
            ->where('datetime', '>', $current_time)
            ->get();


        return view('activity.activityApproval', ['activities' => $activities]);
    }

    //edit event status for activity approval
    public function updateData(Request $request)
    {
        $eventstatus = $request->eventstatus;
        $id = $request->id;
        switch ($eventstatus) {
            case 'approved':
                $eventstatus = 1;
                break;
            case 'rejected':
                $eventstatus = 2;
                break;
            case 'pending':
                $eventstatus = 0;
                break;
        }
        // find the data by id
        $data = activityRecord::findOrFail($id);

        // update the data
        $data->eventstatus = $eventstatus;
        $data->save();

        // redirect the user to the previous page
        return redirect()->back()->with('success', 'Data has been updated');
    }

    //display all activities
    public function viewall()
    {
        $current_time = Carbon::now();

        //get activitites with event status 1/approved
        $activities = activityRecord::where('eventstatus', 1)
            ->where('datetime', '>', $current_time)
            ->get();

        $newactivity = activityRecord::all();
        
        //validation for null value
        if (!$newactivity->isEmpty()) {
            foreach ($newactivity as $activity) {
                if (now()->gt(Carbon::parse($activity->datetime))) {
                    $status = 'Completed';
                } else {
                    $status = 'Ongoing';
                }
            }
        } else {
            $status = null;
        }
        return view('activity.viewActivity', ['activities' => $activities, 'status' => $status]);
    }

    //display all activitites
    public function viewactivity($id)
    {
        $activity = activityRecord::find($id);
        return view('activity.viewDetails', ['activity' => $activity]);
    }

    //save registration data
    public function storereg(Request $request)
    {
        $user_id =Auth::id();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'matricid' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
        ]);

        $registration = new Registration;
        $registration->name = $request->name;
        $registration->matricid = $request->matricid;
        $registration->faculty = $request->faculty;
        $registration->user_id = $request->user_id;
        $registration->activity_record_id = $request->activity_record_id;
        $registration->save();

        return redirect()->route('storereg')->with('success', 'Registration Successful!');
    }

    //view registration data
    public function viewreg($id)
    {
        $activity = activityRecord::find($id);
        $user = Auth::user();
        if ($activity) {
            $registered = Registration::where('activity_record_id', $id)
                ->where('user_id', $user->id)
                ->first();
            if ($registered) {
                $registered = true;
            } else {
                $registered = false;
            }
        } else {
            return redirect()->back()->with('error', 'No Activity Found');
        }
        return view('activity.registerActivity', ['activity' => $activity, 'registered' => $registered]);
    }
}
