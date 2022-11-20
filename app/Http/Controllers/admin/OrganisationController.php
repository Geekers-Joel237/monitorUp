<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $organisations = Organisation::get();
        return response()->json(
            $organisations
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
        $validated = Validator::make($request->all(),[
            'nomOrganisation'=> 'required|unique:Organisations',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        $organisation = Organisation::create($request->all());

        return response()->json(
            $organisation
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
        $organisation = Organisation::find($id);
        if (is_null($organisation)) {
            return response()->json([
                'message' => 'organisation not found'
            ],404);
        }
        return response()->json(
          $organisation
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
        $organisation = Organisation::find($id);
        if (is_null($organisation)) {
            return response()->json([
                'message' => 'organisation not found'
            ],404);
        }
        $validated = Validator::make($request->all(),[
            'nomOrganisation'=> 'required|unique:Organisations',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $organisation -> update($request->all());
        return response()->json(
            $organisation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organisation = Organisation::find($id);
        if (is_null($organisation)) {
            return response()->json([
                'message'=>'organisation not found'
            ],404);
        }
        $copieorganisation = $organisation;
        $organisation->delete();
        return response()->json(
           $copieorganisation
        );
    }
}
