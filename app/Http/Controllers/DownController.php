<?php

namespace App\Http\Controllers;

use App\Updown;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

//use Illuminate\Http\Response;

class DownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('down');
    }

    public function verifyCode(Request $request)
    {
        $input=$request->all();
        $file=Updown::find($input['id']);
//        dd($input['verify_code']);
//        dd($file->verify_code);
        if( $input['verify_code']!=$file->verify_code){
            return[
                'status'=>0,
                'msg'=>'error！'
            ];

        }else{
            return [
                'status'=>1,
                'msg'=>'验证成功！'
            ];

        }

//        dd($input);
    }

    public function download(Request $request)
    {
        $input=$request->all();
        $file=Updown::find($input['id']);
        $file_name=$file['files_name'];
//        $path=public_path().$file['location'];
        $path=public_path('resources/uploads/'.$file_name);
//        dd($path);


        $headers = ['Content-Type: application/pdf'];


//        dd($path);
//        return Response::download($path, '$file_name',$headers,);
        return response()->download($path,$file_name,$headers);
//        return file($path);
//        return Response::download($path, 'output.csv', ['Content-Type: image/jpeg']);

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
