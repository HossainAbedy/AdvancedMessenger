<?php

namespace App\Http\Controllers;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Events\ChatEvent;
use App\Events\NewMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //globalpart
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chat(){
        return view('chat');
    }

    public function sendG(Request $request){
        // return $request->all();
        $user=User::find(Auth::id());
        $this->saveTosession($request);
        event(new ChatEvent($request->message,$user));
    }

    public function saveTosession(Request $request){
        session()->put('chat',$request->chat);
    }
    public function getOldMessages(){
        return session('chat');
    }
    public function deleteSession(){
        session()->forget('chat');
    }
}
