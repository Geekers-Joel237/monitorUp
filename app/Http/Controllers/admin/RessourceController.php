<?php

namespace App\Http\Controllers\admin;

use App\Models\Ressource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
       $ressources = Ressource::get();
       return response()->json(
           $ressources
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
        $validated = Validator::make($req->all(),[
            'nomRessource'=> 'required|unique:Ressources',
            'description'=>'sometimes',
            'isDisponible'=>'boolean|required',
            'categorie_id'=>'required',
            'organisation_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $ressource = Ressource::create($req->all());

        return response()->json(
            $ressource
        ,201);
    }

     /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ressource = Ressource::find($id);
        if (is_null($ressource)) {
            return response()->json([
                'message' => 'ressource not found'
            ],404);
        }
        return response()->json(
          $ressource
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $ressource = Ressource::find($id);
        if (is_null($ressource)) {
            return response()->json([
                'message' => 'ressource not found'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomRessource'=> 'required|unique:Ressources',
            'description'=>'sometimes',
            'isDisponible'=>'boolean|required',
            'categorie_id'=>'required',
            'organisation_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $ressource -> update($req->all());
        return response()->json(
            $ressource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ressource = Ressource::find($id);
        if (is_null($ressource)) {
            return response()->json([
                'message'=>'ressource not found'
            ],404);
        }
        $copieressource = $ressource;
        $ressource->delete();
        return response()->json(
           $copieressource
        );
    }
}
