<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserNotification;

class NotificationController extends Controller
{
    public function sendNotification()
    {
        $user = User::find(1); // Find the user you want to notify
        $user->notify(new UserNotification());
    }
}
