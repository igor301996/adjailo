<?php

namespace App\Http\Controllers;

use App\Application;
use App\Events\MessageCreatedEvent;
use App\Http\Requests\Message\StoreMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Application $application)
    {

        return view('message.create', [
            'application' => $application
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessage $request
     * @param Application $application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMessage $request, Application $application)
    {
        $user = auth()->user();
        $application->messages()->create([
            'message' => $request->input('message'),
            'user_id' => $user->id
        ]);

        event(new MessageCreatedEvent($user, $application));

        return redirect()->route('application.show', $application);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
