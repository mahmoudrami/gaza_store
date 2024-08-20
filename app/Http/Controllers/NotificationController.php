<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderNotifiction;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(){
        $admin = User::find(1);

        // $admins = user::where('type', 'admin')->get();
        // Notification::send($admins, new NewOrderNotifiction());

        $admin->notify(new NewOrderNotifiction());


        return 'Notifiycation Sent';
    }
    public function notifications(){
        $notifications =  Auth::user()->notifications;
        Auth::user()->notifications->markAsRead();
        return view('admins.notifications',compact('notifications'));
    }
}
