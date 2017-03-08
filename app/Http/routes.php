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


use Illuminate\Support\Facades\Mail;

Route::get('/','IndexController@index')->name('home');

//Route::get('/up','UpController@index')->name('up');
Route::post('/up/upload','UpController@upload')->name('upload');


//Route::get('/down','DownController@index')->name('down');
Route::post('/down/download','DownController@download')->name('download');
Route::post('/down/verifyCode','DownController@verifyCode')->name('verifyCode');

Route::any('mail',function (){

//    dd(Config::get('mail'));
    $data=array(
        'email'=>'tommywhy1989@gmail.com',
        'bodyMsg'=>'感谢使用~！',
        'subject'=>'laravel gmail wocao zhende fachuqule a ',
    );
    Mail::send('emails.test',$data,function ($message) use($data){
        $message
            ->from('tommywhy2016@gmail.com')
//                from 设置无效 但必须填写
            ->to('tommywhy1989@gmail.com')
            ->subject($data['subject']);
    });
    return 'success111';

});