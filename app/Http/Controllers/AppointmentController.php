<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Appointment;
use App\Client;
use Session;
use App\Http\Controllers\DB;
class AppointmentController extends Controller
{
    /**
     * GET
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointment.index')->with([
            'appointments' => $appointments,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $appointment = Appointment::whereIn('client_id',$client)->get();
        return view('appointment.show')->with([
            'appointment' => $appointment,
            'client'=>$client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        # Possible authors
        $status_for_dropdown =['pending', 'complete', 'no show'];
        return view('appointment.edit')->with(
            [
                'appointments' => $appointment,
                'status_for_dropdown' => $status_for_dropdown,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       

        # Find and update book
        $appointment = Appointment::find($request->id);
        $appointment->visited = $request->status;
        $appointment->save();

        
        // # Finish
        // Session::flash('flash_message', 'Your changes to '.$book->title.' were saved.');
        return redirect('/appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
