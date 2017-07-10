<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactoryTemplateController extends Controller
{

    public function slugToId($slug){
        if(Auth::check())
        {
            $template = \App\FactoryTemplate::where('slug', $slug)->first();
            //return $template;
            if($template->exists())
            {
                return response()->json(['code' => 200, 'id' => $template->id], 200);
            }else{
                return response()->json(['code' => 401, 'message' => "Cette adresse semble fausse"], 401);
            }

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $factoryTemplates = \App\FactoryTemplate::all();
            return response()->json($factoryTemplates, 200);
        }else{
            return response()->json(['code' => 401, 'message' => "Cette adresse semble fausse"], 401);
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factoryTemplate = \App\FactoryTemplate::where('id', $id)->first();
        return response()->json($factoryTemplate, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
