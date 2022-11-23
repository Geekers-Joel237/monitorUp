<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Reserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReserverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservers = Reserver::get();
        return response()->json(
            $reservers
        ,200);
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
            'dateDebut' =>'required|date',
            'heureDebut'=>'required',
            'duree'=>'required|integer',
            'etatReservation'=>'sometimes|boolean',
            'ressource_id'=>'required|integer',
            'user_id'=>'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),404);
        }

        $reserver = Reserver::create($request->all());
        return response()->json(
            $reserver
        ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $reserver = Reserver::find($id);
        if(is_null($reserver)){
            return response()->json(['message' =>'reserver not found'],404);
        }

        return response()->json($reserver,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserver  $reserver
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserver $reserver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'dateDebut' =>'required|date',
            'heureDebut'=>'required',
            'duree'=>'required|integer',
            'etatReservation'=>'required|boolean',
            'ressource_id'=>'required|integer',
            'user_id'=>'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),404);
        }
        $reserver = Reserver::find($id);
        if(is_null($reserver)){
            return response()->json(['message' =>'reserver not found'],404);
        }

        $reserver->update($request->all());
        return response()->json(
            $reserver
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
        $reserver = Reserver::find($id);
        if(is_null($reserver)){
            return response()->json(['message' =>'reserver not found'],404);
        }
        $copie = $reserver ;
        $reserver->delete();
        return response()->json(
            [
             'message'=>'reserver delete',
             'data'=>$copie
            ],200);
    }
}
