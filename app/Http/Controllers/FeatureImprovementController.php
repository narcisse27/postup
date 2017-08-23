<?php

namespace App\Http\Controllers;

use App\FeatureImprovement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeatureImprovementController extends Controller
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

            $object = $request['object'];
            $content = $request['content'];
            $userId = Auth::id();

            $imporvement = new \App\FeatureImprovement();
            $imporvement->object = $object;
            $imporvement->content = $content;
            $imporvement->user_id = $userId;
            $imporvement->save();


            return response()->json("La proposition a bien été envoyé à nos équipes. Merci", 200);


        }else{
            return response()->json("Vous n'êtes pas autorisés!", 401);
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

        if(Auth::check())
        {
            $feature = FeatureImprovement::where('id', $id)->first();
            if($feature != "" && $feature != null)
            {

                $user = User::where('id', $feature->user_id)->first();

                return view('admin.improvements.improvement-index', ['user' => $user, 'feature' => $feature]);
            }


        }
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

    public function listAll()
    {
        if(Auth::check())
        {

            $features = FeatureImprovement::all();

            return view('admin.improvements.improvements', ['features' => $features]);

        }
    }
}
