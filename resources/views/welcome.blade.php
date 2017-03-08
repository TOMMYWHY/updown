<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <script
                src="https://code.jquery.com/jquery-3.1.1.js"
                integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                /*display: table-cell;*/
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .table th, .table td {
                text-align: center;
                vertical-align: middle!important;
            }
            #img_div img{
                width:150px;}


        </style>
    </head>
    <script>

        function readImg(obj){
            $("#img_div").empty();
            for(var i=0;i<obj.files.length;i++){
                var reader  = new FileReader();
                reader.readAsDataURL(obj.files[i]);
                reader.onload = function(e){
                    $("#img_div").append("<img src='" + this.result  +  "'></img>");
//                    $('#imgshow').attr('src',this.result);
                }
            }
        }
    </script>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Up Down</div>
                <div class="center">
                    {{--<a href="{{route('up')}}"><button class="btn btn-default">up</button></a>--}}
                    {{--<a href="{{route('down')}}"><button class="btn btn-default" >down</button></a>--}}
                </div>
            </div>
        </div>
        <div class="upFrom container">
            <h1>Up File</h1>
             <form method="POST"  action="{{route('upload')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                 <input type="hidden" name="_token" value="{{csrf_token()}}" >
                 <div class="form-group">
                    <label for="">Email:</label><input class="form-control" type="text" id="email" name="email">
                 </div>
                 <div class="form-group">
                     <label for="">File:</label>
                     <input  multiple name="file_uploads[]" id="descImgs" type="file" onchange="readImg(this);" >
                 </div>

                 <div id="img_div">
                </div>
                <input type="submit" class="btn btn-primary" value="submit" >
            </form>
        </div>
        <br>
        <div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="container">
            <h1>Up File</h1>
            <table class="table table-striped table-hover">
                <tr>
                    <th class="">File Name</th>
                    <th>Owner</th>
                    <th>Thumbnail</th>
                    <th>Create time</th>
                    <th>Code</th>
                    <th>Option</th>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->files_name}}</td>
                        <td>{{$item->email}}</td>
                        <td><img src="{{$item->location}}" style="height: 60px;overflow: hidden" alt=""></td>
                        <td>{{$item->created_at}}</td>
                        <td><input type="text" class="form-control" class="code" onchange="verifyCode(this,'{{$item->id}}')" /></td>
                        {{--<td><input type="text" class="form-control" class="code" /></td>--}}
                        <td>

                                <a  href="{{$item->location}}"  download="{{$item->files_name}}">
                                    <button class="btn btn-success"  id="{{$item->id}}" disabled="disabled"  >
                                    Download
                                    </button>
                                </a>
                        </td>
                    </tr>
                    @endforeach

            </table>
        </div>

    </body>
</html>
<script>

    function verifyCode(obj,id) {
        console.log(obj);
        console.log(obj.value);
        $.post(
            "{{route('verifyCode')}}",{
                'id':id,
                'verify_code':obj.value,
                '_token':'{{csrf_token()}}',
            },function (r) {
                console.log(r.status);
                if(r.status!=1){
                    console.log(r.msg);
                }else{
                    $('#'+id).removeAttr('disabled');
                    console.log(r.msg);

                }
            }
        );
    }

     function download(id) {
         $.post(
             "{{route('download')}}",{
                 'id':id,
                 
                 '_token':'{{csrf_token()}}',
             },function (r) {
                 console.log(r.status);
                 if(r.status!=1){
                 }else{
//                     alert($(this));
                 }
             }
         );
     }
</script>