<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/product')}}" method="POST">
        @csrf
        <input type="text" name='title'><br>
        <input type="text" name='description'><br>
        <input type="number" name='price'><br>
        <input type="number" name='stock'><br>
        <button>Tambah</button>
    </form>
</body>
</html>