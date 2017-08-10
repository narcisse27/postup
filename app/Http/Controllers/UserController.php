<?php

namespace App\Http\Controllers;

use App\Area;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image; // Image manager , resizer

class UserController extends Controller
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
        //
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
    public function update(Request $request)
    {
        $id = $request['id'];
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $adresse = $request['adresse'];
        $canton = $request['canton'];
        $npa = $request['npa'];
        $city = $request['city'];
        $phone = $request['phone'];
        User::where('id', $id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'adresse' => $adresse, 'npa' => $npa, 'phone' => $phone, 'city' => $city, 'canton' => $canton]);
        return response()->json('User updated', 200);
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

    public function updateAdresse(Request $request){
        if(Auth::check())
        {

            User::where('id', Auth::id())->update([
               'adresse' => $request['adresse'],
                'npa' => $request['npa'],
                'city' => $request['city'],
                'phone' => $request['phone'],
                'canton' => $request['canton']
            ]);

            return response()->json('update user success', 200);

        }
    }

    public function updatePicture(Request $request){
        if(Auth::check())
        {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);
            $entireExt = $request->extension; // entire extension

            if(str_contains($entireExt, 'jpeg'))
            {
                $extension = 'jpeg';

            }elseif(str_contains($entireExt, 'jpg'))
            {

                $extension = 'jpg';

            }elseif(str_contains($entireExt, 'png'))
            {

                $extension = 'png';

            }else{

                return response()->json(['code' => '', 'message' => 'le format '.$exploded[1]." ,n'est pas accepté"], 200);

            }
            $filename = 'avatar_'.str_random(30).'.'.$extension;
            //Image::configure(array('driver' => 'imagick'));
            //$image = Image::make($decoded)->resize(300, 200);
            $oldPicture = User::where('id', Auth::id())->first();
            if($oldPicture->picture_name != null)
            {
                Storage::delete('public/'.$oldPicture->picture_name);

            }
            Storage::put('public/'.$filename, $decoded); // before $decoded as $image
            User::where('id', Auth::id())->update(['picture_name' =>  $filename]);
            return response()->json(['message' => "La photo d'utilisateur a bien été mise à jour", 'picture' => $filename], 201);

        }
    }

    public function checkMailReserve(Request $request)
    {
        if(Auth::check())
        {

            return strtotime('-7 day');


        }
    }

    public function getUserArea()
    {
        if(Auth::check())
        {

            $user = Auth::user();
            $area = Area::where('id', $user->area_id)->first();
            return response()->json($area, 200);


        }else{
            return response()->json(401);
        }
    }
}
