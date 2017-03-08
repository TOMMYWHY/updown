<?php

namespace App\Http\Controllers;

 use App\Updown;
 use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests;
//use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Request;

class UpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('up');
    }

    public function upload(Request $request)
    {
//        $asd=$request->all();
//        dd($asd);
            /*多文件处理*/
            $file_path_arrs=array();
            $uploader=$request->email;
            $files = $request->file('file_uploads');
            foreach ($files as $key =>$file) {
                $newName=date('Ymd').'_'.$file->getClientOriginalName();
//                $newName=$file->getClientOriginalName();

                $path=$file->move(public_path().'/resources/uploads',$newName);
                $filePath= '/resources/uploads/'.$newName;
                $file_path_arrs[$key]=$filePath;
                /*生成随机验证码*/
                $radmon=mt_rand(100,999);
                $re = Updown::create([
                    'email' => $uploader,
                    'verify_code' => $radmon,
                    'files_name' => $file->getClientOriginalName(),
                    'location' => $file_path_arrs[$key],
                ]);
            }
            if($re){
//                $msg={};
//                $msg=['status'=>0,'message'=>'content & question_id are required!'];
                /*
                 * 返回成功信息无法实现*/
                return redirect()->route('home')->with('status', 'Profile updated!');

            }else{
                    return back()->with('status','添加数据错误！');
            }




//        }




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
