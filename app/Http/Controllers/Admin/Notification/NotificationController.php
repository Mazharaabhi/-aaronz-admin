<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
    //TODO: Getting Notifications Here
    public function get_notifications()
    {
       //TODO: Getting All Notifications 
       $notifications = Notification::join('users', 'users.id', 'notifications.from')->where('notifications.to', 1)->orderBy('notifications.id', 'DESC')->get(
           ['notifications.id as id', 'notifications.*', 'users.name', 'users.company_name', 'users.avatar']
        );
       //TODO: Getting Un Readed 
       $count = Notification::with('users')->where(['to' => 1, 'is_read' => 0])->count();

       //TODO: Creating Notification Data Array    
       $data = ['noti' => $notifications, 'count' => $count];
       return json_encode($data);
    }
}
