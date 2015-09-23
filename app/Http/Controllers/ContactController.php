<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ContactController extends Controller
{
    /**
     * Display the contact me page.
     *
     * @return Response
     */
    public function index()
    {
        $data = [
            'title' => 'Marian Marinov - Contact Me',
            'header_type' => 'contact',
            'header_content' => '<h1>Contact me</h1>',

        ];

        \JavaScript::put([
            'sendEmailUrl' => route('contact.store')
        ]);

        \Session::put('currentTime', new \DateTime());
        return view('contact', $data);
    }

    /**
     * Send an email containing the data in the Contact me form after checking for bot spamming.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $spamMinTime = 10; // estimated minimum time(in seconds) needed to fill the form by a human
        $client = new Client([
            'base_uri' => 'https://www.google.com',
            'timeout'  => 2.0,
        ]);
        $recaptchaRequestContent = [
            'secret' => env('RECAPTCHA_KEY'),
            'response' => \Input::get('recaptcha')
        ];

        $response = $client->request('POST', '/recaptcha/api/siteverify', ['form_params' => $recaptchaRequestContent]);
        $hasPassedCaptcha = json_decode((string)$response->getBody())->success;

        if ($hasPassedCaptcha && \Session::has('currentTime') && !\Input::has('favourite_color')) { // check if the user's not a bot
            $start = \Session::get('currentTime');
            $end = new \DateTime();
            $diff = $end->getTimestamp() - $start->getTimestamp();
            if($diff > $spamMinTime){
                \Session::put('currentTime', new \DateTime());
                \Mail::send('emails.contact',
                    [
                        'email' => \Input::get('email'),
                        'name' => \Input::get('name'),
                        'messageSend' => \Input::get('message'),
                    ], function($message)
                {
                    $message->from('admin@mmarinov.com');
                    $message->to('marian.mmarinov@gmail.com', 'Marian Marinov')->subject('Blog contact email!');
                });
            }
        }

        return '';
    }

}
