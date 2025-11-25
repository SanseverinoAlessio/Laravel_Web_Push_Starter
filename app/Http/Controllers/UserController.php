<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }

    public function subscribeNotification(Request $request){
        Validator::validate($request->all(),[
            "endpoint"=>'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);

        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = Auth::user();

        $user->updatePushSubscription(
            request()->endpoint,
            $key,
            $token
        );

        return response()->json(['success'=>1],200);
    }

}
