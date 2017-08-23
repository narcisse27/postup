<?php

namespace App\Http\Controllers;

use App\Appendice;
use App\Template;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slugToId($slug){
        if(Auth::check())
        {
            $template = Template::where('slug', $slug)->first();
            if($template->exists())
            {
                return response()->json([$template->id], 200);
            }else{
                return response()->json(['code' => 401, 'message' => "Cette adresse semble fausse"], 401);
            }

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
        }
    }

    public function index()
    {
        if(Auth::check())
        {
            $templates =  Template::where('user_id', Auth::id())->get();

            if(!empty($templates)){
                $allTemplates = [];
                foreach ($templates as $template)
                {
                    $appendice = Appendice::where('template_id', $template->id)->get();
                    $obj = (object) ['appendice'=> $appendice];

                    $collection = collect($template);
                    $collection->put('appendices', $appendice);

                    //$allTemplates->push(json_encode($template));
                    array_push($allTemplates, $collection);
                    //array_push($allTemplates, $template);
                }
                return response()->json(['message' => 'okok morray', $allTemplates], 200);
            }else{
                return response()->json(['code' => 401, 'message' => "Nous n'avons pas pu trouver vos templates"], 401);
            }
        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(Auth::check())
        {
            $name = $request['name'];
            $existTemplate = Template::where('name', $name)->where('user_id', Auth::id())->first();
            if($existTemplate)
            {
                return response()->json(
                    [
                        'code' =>  403,
                        'message' => 'un template porte déjà ce nom.',
                        'type' => 'alreadyexist'
                    ]
                    , 403);
            }else {

                $id = $request['user_id'];
                $user = User::where('id', $id);
                $adresse = $request['adresse'];
                $npa = $request['npa'];
                $city = $request['city'];
                $phone = $request['phone'];
                $salutation = $request['salutation'];
                $emailer_object = $request['email_object'];
                $emailer_content = $request['email_content'];
                // update user data adresse
                if($user){
                    User::where('id', $id)->update([
                        'adresse' => $adresse,
                        'npa' => $npa,
                        'city' => $city,
                        'phone' => $phone
                    ]);
                }else{
                    // TODO error if cannot change user adresse
                }
                $object = $request['object'];
                $content = $request['content'];

                $random = str_random(16);
                $slug = str_slug('tmp-'.$random, '-');

                $template = new Template();
                $template->name = $name;
                $template->slug = $slug;
                $template->object = $object;
                $template->content = $content;
                $template->salutation = $salutation;
                $template->email_object = $emailer_object;
                $template->email_content = $emailer_content;
                $template->user_id = $id;
                $template->save();
                return new JsonResponse(
                    [
                        'code' =>  201,
                        'message' => 'Votre template '.$template->name." a a bien été crée!",
                        'type' => 'success'
                    ]
                    , 201);

            }

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
        }
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
            $name = $request['name'];
            $existTemplate = Template::where('name', $name)->where('user_id', Auth::id())->first();
            if($existTemplate)
            {
                return response()->json(
                    [
                        'code' =>  403,
                        'message' => 'un de vos modèles porte déjà ce nom.',
                        'type' => 'alreadyexist'
                    ]
                    , 403);
            }else {

                $id = Auth::id();
                $user = User::where('id', $id);
                $adresse = $request['adresse'];
                $npa = $request['npa'];
                $city = $request['city'];
                $phone = $request['phone'];
                // update user data adresse
                if($user){
                    User::where('id', $id)->update([
                        'adresse' => $adresse,
                        'npa' => $npa,
                        'city' => $city,
                        'phone' => $phone,
                    ]);
                }else{
                    // TODO error if cannot change user adresse
                }

                $object = $request['object'];
                $content = $request['content'];
                $salutation = $request['salutation'];
                $emailer_object = $request['email_object'];
                $emailer_content = $request['email_content'];

                $random = str_random(16);
                $slug = str_slug('tmp-'.$random, '-');

                $template = new Template();
                $template->name = $name;
                $template->slug = $slug;
                $template->object = $object;
                $template->content = $content;
                $template->salutation = $salutation;
                $template->user_id = $id;
                $template->email_object = $emailer_object;
                $template->email_content = $emailer_content;
                $template->save();
                return response()->json(
                    [
                        'code' =>  201,
                        'message' => 'Votre template '.$template->name." a a bien été crée!",
                        'type' => 'success'
                    ]
                    , 201);

            }

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
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
            $template = Template::where('id', $id)->where('user_id', Auth::guard('api')->id())->first();
            return response()->json($template, 200);

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
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
        if(Auth::check()) {
            //$id = $request['id'];
            $name = $request['name'];
            $object = $request['object'];
            $content = $request['content'];
            $salutation = $request['salutation'];
            $emailer_object = $request['email_object'];
            $emailer_content = $request['email_content'];
            $random = str_random(16);
            $slug = str_slug($name . '-' . $random, '-');
            Template::where('id', $id)->update(
                [
                    'name' => $name,
                    'object' => $object,
                    'content' => $content,
                    'salutation' => $salutation,
                    'email_object' => $emailer_object,
                    'email_content' => $emailer_content
                ]
            );
            $template = Template::where('id', $id)->first();

            return response()->json($template, 201);
        }else
        {

            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check())
        {
            $template = Template::find($id);
            if($template)
            {
                $appendices = Appendice::where('template_id', $template->id)->get();
                if($appendices)
                {

                    foreach ($appendices as $appendice)
                    {

                        if( Appendice::where('filename', $appendice->filename)->count() === 1) // if not empty go delete this file
                        {
                            Storage::delete($appendice->filename);
                        }
                        $appendice->delete();


                    }
                }
                $templateName = $template->name;
                $template->delete();
                return response()->json(['code' => 201, 'message' => "Le template ".$templateName." a bien été supprimé"], 201);
            }else{

            }
        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);

        }
    }

    public function duplicate(Request $request)
    {

        if(Auth::check())
        {
            $id = $request['id'];
            $oldTemplate = Template::where('id', $id)->first();
            $r = preg_match("/.*?(\d+)$/", $oldTemplate->name, $matches); // check if last chars is number

            if(!empty($r))
            {
                $int = $matches[1];
                $int = $int+1;
                $rest = substr($oldTemplate->name, 0, -1);
                $newName = $rest.''.$int;

            }else
            {
                $int = 1;
                $newName = $oldTemplate->name.''.$int;
            }

            $random = str_random(16);
            $slug = str_slug('tmp-'.$random, '-');
            $template = new Template();
            $template->name = $newName;
            $template->slug = $slug;
            $template->object = $oldTemplate->object;
            $template->content = $oldTemplate->content;
            $template->user_id = Auth::id();
            $template->email_object = $oldTemplate->email_object;
            $template->email_content = $oldTemplate->email_content;
            $template->save();


            $appendices = Appendice::where('template_id', $oldTemplate->id)->get();
            if(!empty($appendices))
            {
                foreach ($appendices as $appendice)
                {

                    $newAppendice = $appendice->replicate();
                    $newAppendice->template_id = $template->id; // add new template id for this appendice
                    $newAppendice->push();

                }

            }

            return response()->json(['code' => 201, 'message' => 'le modèle a bien été dupliqué'], 201);


        }else
        {

            return response()->json(['code' => 401, 'message' => "Vous n'avez pas accès à cette requête"], 401);

        }



    }
}
