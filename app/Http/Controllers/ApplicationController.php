<?php

namespace App\Http\Controllers;

use App\Application;
use App\Events\ApplicationClosedEvent;
use App\Events\ApplicationCreatedEvent;
use App\Http\Requests\Application\StoreApplication;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $isSendApplication = $user->isSendApplication();
        $applications = $user->applications()->orderBy('id', 'desc')
            ->paginate(10);

        return view('application.index', compact('applications', 'isSendApplication'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreApplication $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $application = $user->applications()->create([
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'file' =>  $request->file('file')->storePublicly('public/images/index')
        ]);

        event(new ApplicationCreatedEvent($application));

        return redirect()->route('application.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        $messages = $application->messages()->orderBy('id', 'desc')
            ->paginate(10);

        return view('application.show', [
            'application' => $application,
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function closed(Application $application)
    {
        $application->update([
            'status' => Application::CLOSED,
            'closed_user_id' => auth()->user()->id,
        ]);

        event(new ApplicationClosedEvent($application));

        return redirect()->route('application.index');
    }
}
