<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{

    public function notifications()
    {
        //$this->user->notifications()->update(['read_at' => null]);

        $notifications = Auth::user()->notifications;
        $ret =  view('notifications.index', compact('notifications'));
        Auth::user()->unreadNotifications->markAsRead();
        return $ret;
    }
}
