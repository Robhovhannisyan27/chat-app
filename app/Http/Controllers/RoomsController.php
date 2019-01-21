<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Auth;
use App\Message;
use App\Events\MessageSent;
use App\Http\Requests\RoomRequest;

class RoomsController extends Controller
{
    /**
    * Fetch all messages
    *
    * @return Message
    */
    public function fetchMessages(Request $request)
    {
        return Message::with('user')->where('room_id', $request->room)->get();
    }

    /**
    * Persist message to database
    *
    * @param  Request $request
    * @return Response
    */
    public function sendMessage(Request $request)
    {
        $inputs = $request->all();
        if(Auth::user()) {
            $inputs['user_id'] = Auth::id();
        }
        $message = Message::create($inputs);
        if($message->user_id) {
            $message = Message::with('user')->where('id', $message->id)->first();
        }

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        if($room = Room::create($request->inputs())){
            if($room->protection == 2) {
                $url = $request->url().'/private/'.$room->uuid;
                return redirect('/')->with(['status' => 'success', 'url' => $url]);
            }
            return redirect('/')->with('status', 'success');
        }
        return redirect('/')->with('status', 'error');
    }

    public function getPrivateRoom($uuid) {
        if(\Auth::check()) {
            $rooms = Room::where('uuid', $uuid)->get();
        } else {
            $rooms = Room::where('accessibility', '1')->where('uuid', $uuid)->get();
        }
        return view('welcome', compact('rooms'));
    }
    
}
