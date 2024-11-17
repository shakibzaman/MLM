<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {

        $customerId = Auth::guard('customer')->user()->id;
        $customer = Customer::find($customerId);
        // Retrieve all notifications for the customer
        $notifications = $customer->notifications;
        $type = 'All';
        return view('notification.customer.notifications', compact('notifications', 'type'));

        // Alternatively, you can use:
        $notifications = $customer->unreadNotifications; // To get only unread notifications
    }
    public function adminNotification()
    {

        $userId = Auth::user()->id;
        $user = User::find($userId);
        // Retrieve all notifications for the customer
        $notifications = $user->notifications;
        $type = 'All';
        return view('notification.customer.notifications', compact('notifications', 'type'));

        // Alternatively, you can use:
        $notifications = $customer->unreadNotifications; // To get only unread notifications
    }
}
