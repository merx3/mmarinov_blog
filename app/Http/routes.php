<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'articles.index',
    'uses' => 'ArticlesController@index'
]);

Route::resource('contact', 'ContactController');

Route::get('/about', [
    'as' => 'about',
    'uses' => function(){
        $data = [
            'title' => 'Marian Marinov - About Me',
            'header_type' => 'about',
            'header_content' => '<h1>About me</h1>',

        ];
        return view('about', $data);
}]);
