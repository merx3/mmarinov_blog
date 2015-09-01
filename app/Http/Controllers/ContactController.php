<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Crypt;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        \JavaScript::put([
            'sendEmailUrl' => route('contact.store')
        ]);

        \Session::put('currentTime', new \DateTime());
        return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $spamMinTime = 10; // in seconds
        if (\Session::has('currentTime') && !\Input::has('favourite_color')) { // check if the user's not a bot
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
