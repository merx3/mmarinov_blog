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

Route::get('/', ['as' => 'articles.index',
    'uses' => 'ArticlesController@index'
]);

Route::get('contact', ['as' => 'contact.index',
    'uses' => 'ContactController@index']);
Route::post('contact', ['as' => 'contact.store',
    'uses' => 'ContactController@store']);

Route::get('about', ['as' => 'about',
    'uses' => function(){
        $data = [
            'title' => 'Marian Marinov - About Me',
            'header_type' => 'about',
            'header_content' => '<h1>About me</h1>',
            'pageDescription' => 'Hello, I\'m Marian Marinov and I have made this blog in hope to share ',
                'some knowledge and tips about Laravel and PhP\'s amazing features.',
            'pageKeywords' => 'blog, about, laravel, php, biography'
        ];
        return view('about', $data);
}]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('login', [ 'as' => 'login.index',
        'uses' => 'LoginController@index'
    ]);
    Route::post('login', [ 'as' => 'login.create',
        'uses' => 'LoginController@create'
    ]);
    Route::get('logout', [ 'as' => 'login.destroy',
        'uses' => 'LoginController@destroy'
    ]);

    Route::get('/', [ 'as' => 'index',
        'uses' => 'DashboardController@index'
    ]);

    Route::get('filemanager/images', ['as' => 'filemanager.images.index', 
        'uses' => 'FileManagerController@index']);
    Route::post('filemanager/images/list', ['as' => 'filemanager.images.list', 
        'uses' => 'FileManagerController@listFiles']);
    Route::post('filemanager/images/upload', ['as' => 'filemanager.images.upload', 
        'uses' => 'FileManagerController@upload']);
    Route::post('filemanager/images/rename', ['as' => 'filemanager.images.rename', 
        'uses' => 'FileManagerController@rename']);
    Route::post('filemanager/images/copy', ['as' => 'filemanager.images.copy', 
        'uses' => 'FileManagerController@copy']);
    Route::post('filemanager/images/remove', ['as' => 'filemanager.images.remove', 
        'uses' => 'FileManagerController@remove']);
    Route::post('filemanager/images/edit', ['as' => 'filemanager.images.edit', 
        'uses' => 'FileManagerController@edit']);
    Route::post('filemanager/images/content', ['as' => 'filemanager.images.content', 
        'uses' => 'FileManagerController@getContent']);
    Route::post('filemanager/images/create-folder', ['as' => 'filemanager.images.createFolder', 
        'uses' => 'FileManagerController@createFolder']);
    Route::get('filemanager/images/download', ['as' => 'filemanager.images.download', 
        'uses' => 'FileManagerController@download']);
    Route::post('filemanager/images/compress', ['as' => 'filemanager.images.compress', 
        'uses' => 'FileManagerController@compress']);
    Route::post('filemanager/images/extract', ['as' => 'filemanager.images.extract', 
        'uses' => 'FileManagerController@extract']);
    Route::post('filemanager/images/permissions', ['as' => 'filemanager.images.permissions', 
        'uses' => 'FileManagerController@permissions']);
});
Route::resource('admin/articles', 'Admin\ArticlesController');

Route::get('/{slug}' , ['as' => 'articles.show', 'uses' => 'ArticlesController@show']);

//Route::get('admin/temp', function(){
//    \App\User::create([
//        'name' => 'Admin',
//        'email'   => 'admin@mmarinov.com',
//        'password' => bcrypt(''),
//        'is_admin' => 1,
//        'is_banned'   => 0,
//        'ban_days_left' => 0,
//        'is_subscribed' => 0,
//    ]);
//});