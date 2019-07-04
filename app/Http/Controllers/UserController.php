<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use Image;
// use Session;
class UserController extends Controller
{
    //
    public function profile(){
    	return view('profile', array('user' => Auth::user()) );
	}
	public function viewprofile($id){
		$userprofile=User::where('id', $id)->get();
    	return view('viewprofile')->with('userprofile',$userprofile);
    }
    public function update_avatar(Request $request){
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
    		$user = Auth::user();
			$user->avatar = $filename;
			$user->phone = $request->phone;
    		$user->save();
    	}else{
			$user = Auth::user();
			$user->phone = $request->phone;
    		$user->save();
		}
		// Session::put('message','Profile Updated');
    	return view('profile', array('user' => Auth::user()) );
    }
}