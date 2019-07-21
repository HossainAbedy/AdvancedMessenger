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
                      ->orderBy('created_at', 'DESC')
                      ->paginate(5);
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

    public function updateNotyIncoming(){
        $unreadRequestIds = DB::table('notifications')
        ->where('notifiable_id', auth()->id())
        ->where('read', false)
        ->update(['read' => true]);
        // dd($unreadRequestIds);
        return response()->json($unreadRequestIds);
    }

    public function getNotyUnread(){
        $unreadIds = DB::table('notifications')
        ->select('id','created_at')
        ->where('notifiable_id', auth()->id())
        ->where('read', false)
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($unreadIds);
        return response()->json($unreadIds);
    }


    public function getIncoming(){
        $users = array();
		
		$friendships = Friendship::where('status', 0)
					->where('user_requested', auth()->id())
					->get();

		foreach($friendships as $friendship):
			array_push($users, \App\User::find($friendship->requester));
		endforeach;
		
        
        
        $unreadRequestIds = Friendship::select(\DB::raw('`requester` as sender_id, count(`requester`) as requester_count'))
        ->where('user_requested', auth()->id())
        ->where('status', 0)
        ->groupBy('requester')
        ->get();

        $users = collect($users);
        $users = $users->map(function($user) use ($unreadRequestIds) {
        $userUnread = $unreadRequestIds->where('sender_id', $user->id)->first();
        $user->unread = $userUnread ? $userUnread->requester_count : 0;
        return $user;
        });

        return response()->json($users);
    }

    public function updateIncoming(){
        $unreadRequestIds = Friendship::select(\DB::raw('`requester` as sender_id, count(`requester`) as requester_count'))
        ->where('user_requested', auth()->id())
        ->where('status', 0)
        ->where('read', false)
        ->update(['read' => true]);
        return response()->json($unreadRequestIds);
    }

    public function getUnread(){
        $unreadIds = Friendship::select(\DB::raw('`requester` as sender_id, count(`requester`) as requester_count'))
        ->where('user_requested', auth()->id())
        ->where('status', 0)
        ->where('read', false)
        ->groupBy('requester')
        ->get();
        return response()->json($unreadIds);
    }
}
