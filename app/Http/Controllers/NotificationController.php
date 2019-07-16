<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotification(){
        $notification=DB::table('notifications')
                      ->where('notifiable_id', auth()->id())
                      ->get();
        return response()->json($notification);     
        // $notifications=json_decode($notification,true);      
        //  foreach ($datas as $k => $data){
        //         $datas[$k]['data'] = json_decode($data['data']);    
        //  }
        //  foreach ($notifications as $notification){
        //     $datas = json_decode($notification->data, true);
        //  }
        // $data=DB::table('notifications')
        //       ->where('notifiable_id', auth()->id())
        //       ->select('data')
        //       ->get();
        // $datas=json_decode($data,true);      

        //  return array('datas' => $datas, 'notifications' => $notifications);
    }
}
