<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Auth;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.manageuser')->with([ //dari foldernya.namafilenya
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //
    public function create(){
        return view('user.addmanageuser');
    }
    
    public function view($id){
        $profile = User::find($id);

        $data = [
            'users' => $profile
        ];
        return view('profiles')->with($data);
    }

    public function store(Request $request){
        $arr = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required',
            'role' => 'required',
            'gender' => 'required|in:Male,Female',
            'DOB' => 'required|date',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        
        if($request->hasfile('avatar')){
            $avatarUploaded = $request->file('avatar');
            $avatarName = time().'.'.$avatarUploaded->getClientOriginalExtension();
            $avatarPath = public_path('/storage/avatars/');
            $avatarUploaded->move($avatarPath, $avatarName);
            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'role'=> $request->role,
                'address' => $request->address,
                'password' => bcrypt($request->password),
                'DOB' => $request->DOB,
                'avatar' => $avatarName,
            ]);
            $user->avatar = '/storage/avatars/'.$avatarName;
        }
        $user->save();
        return redirect('/user')->with([
            'Success'=>'User has been added!'
        ]);
    }

    public function edit($id)
    {
      $user=User::find($id);
      return view('user.editmanageuser')->with([
          'user'=>$user
      ]);
    }
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $arr = [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required',
            'role' => 'required',
            'gender' => 'required|in:Male,Female',
            'DOB' => 'required|date',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        if($request->hasfile('avatar')){
            $avatarUploaded = $request->file('avatar');
            $avatarName = time().'.'.$avatarUploaded->getClientOriginalExtension();
            $avatarPath = public_path('/storage/avatars/');
            $avatarUploaded->move($avatarPath, $avatarName);  
            DB::table('users')->where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'role' =>$request->role,
                'address' => $request->address,
                'DOB' => $request->DOB,
                'avatar' => $avatarName,
            ]);
            $user->avatar = '/storage/avatars/'.$avatarName;
        }
        $user->save();
        return redirect('/user')->with([
            'Success'=>'Profile has been updated!'
        ]);
    }
    public function destroy($id)
    {
        $user=User::find($id);
            
        $user->delete();
            
        return redirect('/user');
    }
    public function sendMessage(Request $request, $to_id){
        $arr = [
            'messages' => 'required',
        ];
        $val = Validator::make($request->all(), $arr);
        if($val->fails()){
            return back()->withErrors($val);
        }
        Message::create([
            'from_userid' => Auth::id(),
            'to_userid' => $to_id,
            'message' => $request->messages,
        ]);
        return back()->with([
            'messageSent' => 'Message has been sent!'
        ]);
    }

    public function viewInbox($id){
        $data =[
            'messages' => Message::where('to_userid', 'like', '%'.$id.'%')->paginate(10),
        ];
        return view('inbox', $data);
    }
    public function deleteMessage($id){
        $message = Message::find($id);

        $message->delete();

        return back()->with([
            'DeleteSuccess' => 'Message has been deleted!'
        ]);
    }
}