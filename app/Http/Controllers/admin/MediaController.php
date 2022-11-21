<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $media = Media::get();
        return response()->json(
            $media
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
        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,doc,docx,pdf|max:2048'
        ]);

        if($request->hasfile('files')) {
            foreach($request->file('files') as $file)
            {

                $fileName = time().'_'.$file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $fileModal = new Media();
                $fileModal->fileName = json_encode($fileName);
                $fileModal->filePath = json_encode($filePath);
                $fileModal->extension = json_encode($extension);



                if(isset($request->ressource_id)){
                    $fileModal->ressource_id = $request->ressource_id;
                }

                $fileModal->save();
            }




            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $request->files,
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $file=Media::findOrFail($id);
        if (File::exists(public_path("storage/uploads/".$file->fileName))) {

            return response()->json($file);
        }else{
            return response()->json('not found');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
        ]);
        $files=Media::findOrFail($id);
        if (File::exists("storage/uploads/".$files->fileName)) {
            File::delete("storage/uploads/".$files->fileName);

            Media::find($id)->delete();


            $fileModel = new Media;

            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $extension = $request->file->getClientOriginalExtension();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->fileName = time().'_'.$request->file->getClientOriginalName();
                $fileModel->filePath = '/storage/' . $filePath;
                $fileModel->extension = $extension;

                if($request->ressource_id)   $fileModel->ressource_id = $request->ressource_id;


                $fileModel->save();

                return response()->json([
                    "success" => true,
                    "message" => "File successfully uploaded",
                    "file" => $fileName,
                ]);
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "File required",
                    "file" => 'null',
                ],404);
            }
        }else{
            return response()->json([
                "success" => false,
                "message" => "File not found",
                "file" => 'null',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $files=Media::findOrFail($id);
        if (File::exists(public_path("storage/uploads/".$files->fileName))) {
            File::delete(public_path("storage/uploads/".$files->fileName));
            Media::find($id)->delete();
            return response()->json('file deleted');
        }else{
            return response()->json('not found');

        }
    }
}
