<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notifications = Notification::get();
        return response()->json(
            $notifications
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'content'=>'required|text',
            'emetteur_id'=>'required|integer',
            'recepteur_id'=>'sometimes|integer'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),404);
        }
        $notification =Notification::create($request->all());
        return response()->json(
            $notification
        ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json([
                'message' => 'notification not found'
            ],404);
        }

        return response()->json(
            $notification
        ,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json([
                'message' => 'notification not found'
            ],404);
        }

        $validator = Validator::make($request->all(),[
            'content'=>'required|text',
            'emetteur_id'=>'required|integer',
            'recepteur_id'=>'sometimes|integer'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),404);
        }
        $notification->update($request->all());
        return response()->json(
            $notification
        ,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json([
                'message' => 'notification not found'
            ],404);
        }

        $copie = $notification;
        $notification->delete();
        return response()->json(
            $copie
        );
    }
}
