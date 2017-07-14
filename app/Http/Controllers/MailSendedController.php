<?php

namespace App\Http\Controllers;

use App\Corporate;
use App\MailSended;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailSendedController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {

            $mailsSended = MailSended::where('user_id', Auth::id())->get();


            $data = [];

            foreach ($mailsSended as $mail)
            {

                $corporate = Corporate::where('id', $mail->corporate_id)->first();
                $template = Template::where('id', $mail->template_id)->first();
                $mail->corporate = $corporate;
                $mail->template = $template;
                array_push($data, $mail);

            }

            return response()->json($data, 200);

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
}
