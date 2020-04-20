<?php

namespace App\Http\Controllers\Manager;

use App\Application;
use App\Events\ApplicationClosedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $applications = Application::latest()->paginate(10);

        return view('manager.application.index', compact('applications'));
    }


    /**
     * @param Application $application
     * @param int $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function action(Application $application, int $status)
    {
        if (!Application::STATUSES[$status]) {
            abort(404);
        }

        $user = auth()->user();

        $application->status = $status;
        $application->manager_id = $user->id;

        if ($status === Application::CLOSED) {
            $application->closed_user_id = $user->id;
        }

        $application->save();

        if ($status === Application::CLOSED) {
            event(new ApplicationClosedEvent($application));
        }

        return redirect()->route('manager.application.index');
    }

    /**
     * @param Application $application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Application $application)
    {
        if (!$application->viewed) {
            $application->update([
                'viewed' => true
            ]);
        }

        $messages = $application->messages()->orderBy('id', 'desc')->paginate(10);

        return view('application.show', compact('application', 'messages'));
    }

    public function filter(string $filter, $type)
    {
        $applications = Application::when($filter === 'viewed', function ($query) use ($type) {
            return $query->where('viewed', $type);
        })->when($filter === 'status', function ($query) use ($type) {
            return $query->where('status', $type);
        })->when($filter === 'messages', function ($query) use ($type) {
            if ($type) {
                return $query->whereHas('messages.user', function ($query) {
                    return $query->where('is_manager', true);
                });
            }

            return $query->whereDoesntHave('messages.user', function ($query) {
                return $query->where('is_manager', true);
            });
        })->latest()->paginate(10);

        return view('manager.application.index', compact('applications'));
    }
}
