<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Emprunter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EmprunterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $emprunter = Emprunter::get();
        return response()->json(
            $emprunter
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
            'dateDebut' =>'required|date',
            'heureDebut'=>'required|time',
            'duree'=>'required|integer',
            'etatEmprunt'=>'required|boolean',
            'ressource_id'=>'required|integer',
            'user_id'=>'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $emprunter = Emprunter::create($request->all());
        return response()->json(
            $emprunter
        ,200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $emprunter =Emprunter::find($id);
        if(is_null($emprunter)){
            return response()->json(['message' =>'emprunt not found'],404);
        }
        return response()->json([$emprunter],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprunter  $emprunter
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprunter $emprunter)
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
        $validator = Validator::make($request->all(),[
            'dateDebut' =>'required|date',
            'heureDebut'=>'required|time',
            'duree'=>'required|integer',
            'etatEmprunt'=>'required|boolean',
            'ressource_id'=>'required|integer',
            'user_id'=>'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $emprunter =Emprunter::find($id);
        if(is_null($emprunter)){
            return response()->json(['message' =>'emprunt not found'],404);
        }

        $emprunter->update($request->all());
        return response()->json(
            $categorie
        ,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $emprunter =Emprunter::find($id);
        if(is_null($emprunter)){
            return response()->json(['message' =>'emprunt not found'],404);
        }
        $copie = $emprunter ;
        $emprunter->delete();
        return response()->json(['message' =>'emprunt deleted',
                                 'data'=>$copie
                                ],404);
    }
}
