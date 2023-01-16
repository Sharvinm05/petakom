<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\ProposalRecord;
use \App\Models\Report;
use Carbon\Carbon;

class ProposalController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    
  public function index()
  {
    $user = Auth::user();
    $proposals = $user->proposals;

    return view('proposal.index', compact('proposals'));
  }

  public function create()
  {
    return view('proposal.create');
  }

  public function store()
  {
    $data = request()->validate([
      'eventname' => 'required',
      'capacity'  => 'required',
      'venue' => 'required',
      'datetime' => 'required',
      'budget' => 'required',
      'closingdate' => 'required',
      'description' => 'required',
    ]);

    auth()->user()->proposals()->create($data);

    return redirect('/proposal');
  }

  public function view($id)
  {
    $proposal = ProposalRecord::findOrFail($id);
    
    if(now()->gt(Carbon::parse($proposal->datetime)) && $proposal->coordinatorstatus == 1 && $proposal->deanstatus == 1){
      $status = 'Completed';
    }else{
      $status = 'Incomplete';
    }

    $report = Report::where('proposal_id', $id)->first();
    
    return view('proposal.view', [
      'proposal' => $proposal,
      'status' => $status,
      'report' => $report,
    ]);
  }

  public function createreport($id)
  {
    $proposal = ProposalRecord::findOrFail($id);
    return view('proposal.createreport', compact('proposal'));
  }

  public function storereport(Request $request)
  {
    $data = request()->validate([
      'attendance' => 'required',
      'status'  => 'required',
      'report' => 'required',
    ]);
    
    $report = new Report;
    $report->attendance = $request->attendance;
    $report->status = $request->status;
    $report->report = $request->report;
    $report->proposal_id = $request->proposal_id;

    $report->save();


    return redirect('/proposal/report/'.$report->id.'');
  }

  public function viewreport($id)
  {
    $report = Report::findOrFail($id);
    
    return view('proposal.viewreport', [
      'report' => $report,
    ]);
  }

  public function viewcapproval()
  {
    $proposals = ProposalRecord::all();
    return view('proposal.capproval', compact('proposals'));
  }

  public function viewcproposal($id)
  {
    $proposal = ProposalRecord::findOrFail($id);

    return view('proposal.capprovalview', compact('proposal'));
  }

  public function storecoordinatorstatus(Request $request){
    $coordinatorstatus = $request->coordinatorstatus;
    $id = $request->id;

    $proposal = ProposalRecord::findOrFail($id);

    $proposal->coordinatorstatus = $coordinatorstatus;
    $proposal->save(); 

    if($proposal->deanstatus == 1 && $proposal->coordinatorstatus == 1){
      auth()->user()->activityrecord()->create([
        'eventname' =>  $proposal->eventname,
        'capacity'  =>  $proposal->capacity,
        'venue' =>  $proposal->venue,
        'datetime' =>  $proposal->datetime,
        'closingdate' =>  $proposal->closingdate,
        'description' =>  $proposal->description,
        'user_id' =>  $proposal->user_id,
        'eventstatus' => 1
      ]);
    }

    return redirect()->back()->with('success', 'Data has been updated');
  }

  public function viewdapproval()
  {
    $proposals = ProposalRecord::all();
    return view('proposal.dapproval', compact('proposals'));
  }

  public function viewdproposal($id)
  {
    $proposal = ProposalRecord::findOrFail($id);

    return view('proposal.dapprovalview', compact('proposal'));
  }

  public function storedeanstatus(Request $request){
    $deanstatus = $request->deanstatus;
    $id = $request->id;

    $proposal = ProposalRecord::findOrFail($id);

    $proposal->deanstatus = $deanstatus;
    $proposal->save(); 

    if($proposal->deanstatus == 1 && $proposal->coordinatorstatus == 1){
      auth()->user()->activityrecord()->create([
        'eventname' =>  $proposal->eventname,
        'capacity'  =>  $proposal->capacity,
        'venue' =>  $proposal->venue,
        'datetime' =>  $proposal->datetime,
        'closingdate' =>  $proposal->closingdate,
        'description' =>  $proposal->description,
        'user_id' =>  $proposal->user_id,
        'eventstatus' => 1
      ]);
    }

    return redirect()->back()->with('success', 'Data has been updated');
  }
}
