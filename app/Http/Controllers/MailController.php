<?php

namespace App\Http\Controllers;

use App\Appendice;
use App\Corporate;
use App\FactoryTemplate;
use App\Improvement;
use App\MailSended;
use App\Template;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class MailController extends Controller
{


    public function sendToRecipient(Request $request)
    {

        if(Auth::check())
        {
                $appel = ["Madame, Monsieur", 'Monsieur','Madame', 'postup-appel-span'];
                $corporate = ["Nom d'entreprise", 'postup-corporate-span'];


                $templateSlug = $request['slug'];
                $template = Template::where('slug', $templateSlug)->first();

                $data['mail_object'] = $request['mail_object'];
                $data['mail_content'] = $request['mail_content'];
                $recipientsList = $request['recipients_list'];
            //return $recipientsList;

            foreach (json_decode($recipientsList) as $prop => $value)
            {
                //$data = [];
                //return $value->name;

                //return gettype($recipientsList);
                $recipient = Corporate::where('email',$value->name)->first();
                $mailAppendices = Appendice::where('template_id', $template->id)->get();
                $data['appendices'] = $mailAppendices;

                if($recipient->sexe != null)
                {
                    if($recipient->sexe == 1) // change for mans
                    {
                        $request['mail_content'] = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$appel[3].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $appel[1].' '.$recipient->contact_lastname, $request['mail_content']);

                    }elseif ($recipient->sexe == 2) // change span for womans
                    {
                        $request['mail_content'] = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$appel[3].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $appel[2].' '.$recipient->contact_lastname, $request['mail_content']);

                    }else{ // for all others put generic appel

                        $request['mail_content'] = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$appel[3].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $appel[0], $request['mail_content']);
                    }

                }else // for all others put generic appel
                {
                    $request['mail_content'] = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$appel[3].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $appel[0], $request['mail_content']);
                }

                $request['mail_content'] = preg_replace('/<(span).*?class="\s*(?:.*\s)?'.$corporate[1].'(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', $recipient->name, $request['mail_content']);


                $data['to'] = $value->name;


                $mailsSended = new MailSended();
                $mailsSended->user_id = Auth::id();
                $mailsSended->template_id = $template->id;
                $mailsSended->corporate_id = $recipient->id;
                $mailsSended->mail_object = $request['mail_object'];
                $mailsSended->test_mail = false; // this sending is one test (destinated to me)
                $mailsSended->save();


                Mail::send('emails.mail', [ 'mailContent' => $request['mail_content']], function ($message) use ($data)
                {
                    $message->from(Auth::user()->email, $data['mail_object']);
                    $message->subject($data['mail_object']); // mail object
                    foreach($data['appendices'] as $appendice)
                    {
                        $file = storage_path('app/'.$appendice->filename);
                        //$message->attach( $file , ['as' => $appendice->name, 'mime' => $appendice->type]);
                    }
                    $message->to($data['to']);
                });

                // store this mail datat


            }



            return response()->json( ['code' => 200, 'message' => "Vos emails ont bien été envoyés"], 200);


        }

    }


    public function sendToMe(Request $request)
    {


        if(Auth::check())
        {
            //return $request['template_slug'];

            $template = Template::where('slug', $request['template_slug'])->first();
            $mailAppendices = Appendice::where('template_id', $template->id)->get();
            $data = [];
            $data['appendices'] = $mailAppendices;
            $data['mail_object'] = $request['mail_object'];
            /*
             *  TODO disable emails sending for testing fase
            Mail::send('emails.mailTest', [ 'mailContent' => $request['mail_content']], function ($message) use ($data)
            {
                $message->from(Auth::user()->email, $data['mail_object']);
                $message->subject($data['mail_object']); // mail object
                foreach($data['appendices'] as $appendice)
                {
                    $file = storage_path('app/'.$appendice->filename);
                    $message->attach( $file , ['as' => $appendice->name, 'mime' => $appendice->type]);
                }
                $message->to(Auth::user()->email);
            });

            */

            $mailsSended = new MailSended();
            $mailsSended->user_id = Auth::id();
            $mailsSended->template_id = $template->id;
            $mailsSended->corporate_id = 0; // 0 for myself
            $mailsSended->test_mail = true; // this sending is one test (destinated to me)
            $mailsSended->save();
            return response()->json( ['code' => 200, 'message' => "Votre email de test a été envoyé avec succès à l'adresse suivante : ".Auth::user()->email], 200);

        }else{
            // TODO add connection refused error
        }
    }
}
