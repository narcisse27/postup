<?php

namespace App\Http\Controllers;

use App\Appendice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tempsfiles;
use App\Template;
use Illuminate\Support\Facades\Storage;
use PDF;

class PdfController extends Controller
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


    public function generatePdf($id) // generate temporary pdf for template preview
    {
        if(Auth::check())
        {
            $tempsFilesExist = Tempsfiles::where('template_id', $id)->where('user_id', Auth::id())->get();
            // TODO DELETE OLD TEMP PDF
            $data = Template::where('id', $id)->first();

            // replace automatic vars
            $corporate = ["Nom d'entreprise", 'postup-corporate-span'];
            $appel = ["Madame, Monsieur", 'postup-appel-span'];
            str_replace($appel[1], $appel[0], $data->content);
            $data->content = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$appel[1].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $appel[0], $data->content);
            $data->content = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$corporate[1].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $corporate[0], $data->content);
            //return $data;
            $appendices = Appendice::where('template_id', $id)->get();

            $user = Auth::user();
            $temps = str_random(30);
            $tempsName = $temps.'.pdf';
            $path = 'temp/'.$tempsName;
            PDF::setOptions(['dpi' => 150]);
            $html = view('letters.default-letter', ['data' => $data, 'appendices' => $appendices, 'user' => $user]);
            Storage::disk('local')->put($temps.'.html', $html);
            $contents = Storage::get($temps.'.html');
            PDF::loadHTML($contents)->save($path);

            return response()->json(['code' => 200, 'message' => 'pdf temp bien crée', 'pdf_name' => $tempsName], 200);

        }else{
            return response()->json(['code' => 401, 'message' => "Vous n'êtes pas authorisé à effectuer cette requête"], 401);
        }
    }

    public function generateSeriousPdf($id)
    {

    }

}
