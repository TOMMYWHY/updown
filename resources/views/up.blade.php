<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Up</title>
    <script
            src="https://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous"></script>
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
</head>
<body>
<center>
    <h1>Up</h1>
   {{-- <form method="POST" action="{{route('upload')}}" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="3MVeGaHf06StWMPJVJpXOgj8iLSOiH5CtMD1vGAP">
        <input type="hidden" value="{{csrf_token()}}" >
        <input multiple name="file_uploads[]" id="descImgs" type="file" onchange="readImg(this);" >
        <div id="img_div">
            <img id="imgshow" src="" alt="">
        </div>
        <input type="submit">
    </form>--}}


    {!! Form::open(['route'=>'upload','method'=>'post','files'=>true]) !!}
    <input type="hidden" value="{{csrf_token()}}" >
    {{Form::label('email', 'E-Mail Address:')}}
    {{Form::text('email')}}
    <br>
   {!!  Form::file('file_uploads[]',array('multiple'=>true,'onchange' => 'readImg(this);')) !!}
    <div id="img_div"></div>
    <input type="submit">
    {!! Form::close() !!}
</center>

</body>
</html>