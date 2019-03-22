<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session('success'))
        {!!session('success')!!}
        <h3>hehe</h3><br>
    @endif

    @if($tes=='create')
    {{"oke"}}
    @else
    {{"no"}}
    @endif

    <form>
        <input value="{{$t}}">
        <input value="{{$k}}">    
    </form>        
    <a href="{{url('tes/back')}}">Tes Back</a>
</body>
</html>