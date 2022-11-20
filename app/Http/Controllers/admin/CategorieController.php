<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categorie::get();
        return response()->json(
            $categories
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
        $validated = Validator::make($request->all(),[
            'titre'=> 'required|unique:Categories',
            'organisation_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $categorie = Categorie::create($request->all());

        return response()->json(
            $categories
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
        $categorie = Categorie::find($id);
        if (is_null($categorie)) {
            return response()->json([
                'message' => 'categorie not found'
            ],404);
        }
        return response()->json(
          $categorie
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
        $categorie = Categorie::find($id);
        if (is_null($categorie)) {
            return response()->json([
                'message' => 'categorie not found'
            ],404);
        }
        $validated = Validator::make($request->all(),[
            'titre'=> 'required|unique:Categories',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $categorie -> update($request->all());
        return response()->json(
            $categorie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if (is_null($categorie)) {
            return response()->json([
                'message'=>'categorie not found'
            ],404);
        }
        $copiecategorie = $categorie;
        $categorie->delete();
        return response()->json(
           $copiecategorie
        );
    }
}
