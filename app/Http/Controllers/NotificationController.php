<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    /**
     * Create a new LikeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function index()
    {
        return [
            'read' => auth()->user()->readNotifications,
            'unRead' => auth()->user()->unreadNotifications,
            'unReadCount' => auth()->user()
                ->unreadNotifications->count(),
        ];
    }

    public function markAsRead(Request $request)
    {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
        return response("done", Response::HTTP_OK);
    }
}