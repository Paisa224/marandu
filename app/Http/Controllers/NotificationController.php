<?php

namespace App\Http\Controllers;
class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('notifications', compact('notifications'));
    }
}
