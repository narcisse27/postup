<?php

namespace App\Http\Controllers;

use App\Appendice;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AppendiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(Auth::check())
        {
            $maxAppendices = 8;

            $templateAppendices = Appendice::where('template_id', $request->templateId)->get();
            if(count($templateAppendices) >= 8)
            {
                return response()->json(['code' => 409, 'message' => "Seulement 8 pièces jointes par modèle."], 409);
            }
            $exploded = explode(',', $request->appendice);
            $decoded = base64_decode($exploded[1]);
            $entireExt = $request->extension; // entire extension

            if(str_contains($entireExt, 'jpeg'))
            {
                $extension = 'jpeg';

            }elseif(str_contains($entireExt, 'jpg'))
            {

                $extension = 'jpg';

            }elseif(str_contains($entireExt, 'pdf'))
            {
                $extension = 'pdf';

            }elseif(str_contains($entireExt, 'png'))
            {

                $extension = 'png';

            }elseif(str_contains($entireExt, 'doc'))
            {

                $extension = 'doc'; // word

            }elseif(str_contains($entireExt, 'docx'))
            {

                $extension = 'docx'; // word

            }elseif(str_contains($entireExt, 'rtf'))
            {

                $extension = 'rtf'; // extension open office, word  viewer

            }elseif(str_contains($entireExt, 'ppt'))
            {

                $extension = 'ppt'; // power point

            }elseif(str_contains($entireExt, 'pps'))
            {

                $extension = 'pps';

            }else{

                return response()->json(['code' => '', 'message' => 'le format '.$exploded[1].", n'est pas accepté"], 200);

            }

            if(preg_match('('.Auth::user()->lastname.'|'.Auth::user()->firstname.'|'.strtolower(Auth::user()->lastname).'|'.strtolower(Auth::user()->firstname).')', $request->name) === 0)
            {

                // if filename dont contain already user lastname or firstname put it at end
                $str = str_replace('.'.$extension, '', $request->name);
                $newName = $str.'_'.Auth::user()->lastname.'_'.Auth::user()->firstname.'.'.$extension; // new filename

            }else{
                $newName = $request->name;
            }
            $filename = str_random(20).'.'.$extension;
            $appendice = new Appendice();
            $appendice->filename = $filename;
            $appendice->user_id = Auth::id();
            $appendice->template_id = $request->templateId;
            $appendice->name = $newName;
            $appendice->type = $entireExt; // put here entire extension
            $appendice->extension = $extension;

            $appendice->save();
            Storage::put($filename, $decoded);
            return response()->json(
                ['code' => 201, 'message' => 'la piéce jointe a bien été ajoutée']
                ,201);

        }else{

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appendicies = Appendice::where('template_id', $id)->get();
        return response()->json($appendicies, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appendice = Appendice::find($id);
        $appendice->name = $request['name'];
        $appendice->save();
        return response()->json(['code' => 200, 'message' => "La piéce jointe a bien éte mise à jour"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appendice = Appendice::find($id);
        $appendices = Appendice::where('filename', $appendice->filename)->get();
        if(count($appendices) > 0)// if another appendice use this file
        {
            // delete file with appendice
            if( Appendice::where('filename', $appendice->filename)->count() === 1)
            {
                Storage::delete($appendice->filename); // destroy this file if only one appendice use it
            }
            $appendice->delete();
            return response()->json(['code'=> 200, 'message' => "La pièce jointe a bien été supprimée"], 200);

        }else{
            $appendice->delete();
            return response()->json(['code'=> 200, 'message' => "La pièce jointe a bien été supprimée"], 200);

        }
    }
}
