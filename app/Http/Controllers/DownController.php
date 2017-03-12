<?php

namespace App\Http\Controllers;

use App\Updown;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

//use Illuminate\Http\Response;

class DownController extends Controller
{
    public function verifyCode(Request $request)
    {
        $input=$request->all();
        $file=Updown::find($input['id']);
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
    }

    public function download(Request $request)
    {
        /*
         * ?????????*/
        $input=$request->all();
//        dd($input);
        $file=Updown::find($input['id']);
        $file_name=$file['files_name'];
        $path=public_path('resources/uploads/'.$file_name);
//        dd($path);
        $headers = array('Content-Type=>image/jpeg');
//        dd(response()->download($path,$file_name,$headers));
//        return response()->download($path,$file_name,$headers);
        return response()->download($path,$file_name,$headers);
    }

}
