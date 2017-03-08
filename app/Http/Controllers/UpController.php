<?php

namespace App\Http\Controllers;

 use App\Updown;
 use Illuminate\Http\Request;

 use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;
use App\Http\Requests;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Request;

class UpController extends Controller
{


    public function upload(Request $request)
    {
            /*多文件处理*/
            $file_path_arrs=array();
            $uploader=$request->email;
            $files = $request->file('file_uploads');
            $radmon=mt_rand(100,999);
            foreach ($files as $key =>$file) {
                $newName=date('Ymd').'_'.$file->getClientOriginalName();
//                $newName=$file->getClientOriginalName();

                $path=$file->move(public_path().'/resources/uploads',$newName);
//                $path_way=public_path().'/resources/uploads/'.$newName;
                $filePath=asset('/resources/uploads/'.$newName);
//                dd($path_way);
//                $filePath= '/resources/uploads/'.$newName;
                $file_path_arrs[$key]=$filePath;
                /*生成随机验证码*/
//                $radmon=mt_rand(100,999);
                $re = Updown::create([
                    'email' => $uploader,
                    'verify_code' => $radmon,
                    'files_name' => $file->getClientOriginalName(),
                    'location' => $file_path_arrs[$key],
                ]);
            }
            if($re){

                $mail_data=array(
                    'email'=>$uploader,
                    'verify_code'=>$radmon,
                    'subject'=>'您已成功上传的文件至UpDown!',
                );

                Mail::send('emails.test',$mail_data,function ($message) use($mail_data){
                    $message
                        ->from('tommywhy2016@gmail.com')
//                from 设置无效 但必须填写
                        ->to('tommywhy1989@gmail.com')
                        ->subject($mail_data['subject']);
                });
                return redirect()->route('home')->with('status', 'Profile updated and send verify code to your email!');
            }else{
                    return back()->with('status','update fail！');
            }

    }
    

}
