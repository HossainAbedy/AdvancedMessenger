<?php

namespace App\Http\Controllers;
use App\User;
use App\Friendship;
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
    public function getIncoming(){
        $users = array();
		
		$friendships = Friendship::where('status', 0)
					->where('user_requested', auth()->id())
					->get();

		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->requester));
		endforeach;
		
		return $users;
    }
}
