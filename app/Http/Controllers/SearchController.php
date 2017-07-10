<?php

namespace App\Http\Controllers;

use App\Area;
use App\Canton;
use App\Corp_Areas;
use App\Corporate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{


    public function searchRecipient(Request $request)
    {
        $error = ['error' => 'Aucun résultat :( '];
        if($request->has('q')){
            $query = $request['q'];
            $corporates = Corporate::search($query)->take(10)->get();
            return $corporates;
        }else{
            return $error;
        }
    }


    public function searchArea(Request $request)
    {
        if($request->has('area')){
            $query = $request['area'];
            $areas = Area::search($query)->get();
            return $areas;
        }
    }

    public function searchRegion(Request $request)
    {

        if(Auth::check())
        {

            //return response('okok');
            if($request->has('region')){
                $query = $request['region'];
                $regions = Canton::search($query)->get();
                return $regions;
            }

        }else{
            return response()->json(['code' => 401, "COnnectez vous"], 401);
        }
    }

    public function searchCorporate(Request $request){

            $allCorporates = [];

        if($request->has('region') && $request->has('area') && $request->has('name')){
            $region = $request['region'];
            $thisRegion = Canton::where('name', $region)->first();
            $area = $request['area'];
            //return $area;
            $name = $request['name'];
            $thisArea = Area::search($area)->first();
            //return $thisArea;
            json_encode($thisArea);
            $allRelations = Corp_Areas::where('area_id', $thisArea->id)->get();
            //return $allRelations;
            $corporates = Corporate::search($name)->get();

            foreach ($allRelations as $relation)
            {
                $corporate = Corporate::search($name)->where('id', $relation->corporate_id)->first();
                //json_encode($corporate);
                array_push($allCorporates, $corporate);
            }

            json_encode($allCorporates);
            //$falseResponse = ['ok']; // TODO to delete
            return $allCorporates; // TODO to delete

            //return $allCorporates;
            //return 'ok area & region';

        }

        if($request->has('region') && $request->has('area')){

            $region = $request['region'];
            $area = $request['area'];

            $thisArea = Area::search($area)->get();
            json_encode($thisArea);
            $allRelations = Corp_Areas::where('area_id', $thisArea[0]->id)->get();


            $allCorporates = [];

            foreach ($allRelations as $relation)
            {
                $corporate = Corporate::where('id', $relation->corporate_id)->first();
                json_encode($corporate);
                array_push($allCorporates, $corporate);
            }
            json_encode($allCorporates);
            return $allCorporates;
            //return 'ok area & region';

        }
        /*
        if($request->has('region')){
            $query = $request['region'];
            $regionId = Canton::where('name', $query)->first();

            $corporates = Corporate::where('canton_id', $regionId->id)->get();



            return $corporates;

        }

        if($request->has('name') && strlen($request['name']) > 3)
        {
            $query = $request['name'];
            $corporates = Corporate::search($query)->get();

            return $corporates;
        }
         */

    }
}
