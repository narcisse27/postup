<?php

namespace App\Http\Controllers;

use App\Area;
use App\Canton;
use App\Corp_Areas;
use App\Corporate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    public function indexAddManually(){
        $cantons = Canton::get();
        $areas = Area::get();
        return view('admin.corporates.add-corporate', ['cantons' => $cantons, 'areas' => $areas]);
    }

    public function addManually(Request $request)
    {
        if(Auth::check())
        {

            if($request['canton'] != null  && $request['canton_id'] == null)
            {
                $thisCanton = Canton::where('name', $request['canton'])->first();
                $cantonId = $thisCanton->id;
                $cantonAbbrev = $thisCanton->abbreviation;

            }elseif($request['canton'] == null && $request['canton_id'] != null)
            {

                $thisCanton = Canton::where('id', $request['canton_id'])->first();
                $cantonId = $request['canton_id'];
                $cantonAbbrev = $thisCanton->abbreviation;

            }else{

                $thisCanton = null;
                $cantonId = null;
                $cantonAbbrev = null;
            }
            //return $thisCanton;

            $corporate = new Corporate();
            $corporate->name = $request['name'];
            $corporate->contact_firstname = $request['contact_firstname'];
            $corporate->contact_lastname = $request['contact_lastname'];
            $corporate->sexe = $request['contact_sexe'];
            $corporate->adresse = $request['adresse'];
            $corporate->npa = $request['npa'];
            $corporate->city = $request['city'];
            $corporate->canton_id = $cantonId;
            $corporate->email = $request['email'];
            $corporate->canton_abbreviation = $cantonAbbrev;
            $corporate->save();

            $areas = $request['area_id'];
            if($areas != null)
            {

                foreach ($areas as $area)
                {

                    $relation = new Corp_Areas();
                    $relation->corporate_id = $corporate->id;
                    $relation->area_id = $area;
                    $relation->save();
                }

            }

            return response()->json(['message' => 'mails sended and added if nedded'], 200);
        }

    }

    public function addManuallyByUser(Request $request)
    {
        if(Auth::check())
        {

            if($request['canton'] != null  && $request['canton_id'] == null)
            {
                $thisCanton = Canton::where('name', $request['canton'])->first();
                $cantonId = $thisCanton->id;
                $cantonAbbrev = $thisCanton->abbreviation;

            }elseif($request['canton'] == null && $request['canton_id'] != null)
            {

                $thisCanton = Canton::where('id', $request['canton_id'])->first();
                $cantonId = $request['canton_id'];
                $cantonAbbrev = $thisCanton->abbreviation;

            }else{

                $thisCanton = null;
                $cantonId = null;
                $cantonAbbrev = null;
            }
            //return $thisCanton;

            $corporate = new Corporate();
            $corporate->name = $request['name'];
            $corporate->contact_firstname = $request['contact_firstname'];
            $corporate->contact_lastname = $request['contact_lastname'];
            $corporate->sexe = $request['contact_sexe'];
            $corporate->adresse = $request['adresse'];
            $corporate->npa = $request['npa'];
            $corporate->city = $request['city'];
            $corporate->canton_id = $cantonId;
            $corporate->email = $request['email'];
            $corporate->canton_abbreviation = $cantonAbbrev;
            $corporate->save();

            $areas = $request['area_id'];
            if($areas != null)
            {

                foreach ($areas as $area)
                {

                    $relation = new Corp_Areas();
                    $relation->corporate_id = $corporate->id;
                    $relation->area_id = $area;
                    $relation->save();
                }

            }

            return response()->json(['message' => 'mails sended and added if nedded'], 200);
        }

    }
}
