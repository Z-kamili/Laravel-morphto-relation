<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($Students as $Student)
    <img src="{{URL::asset('files/file/Student/'.$Student->image->filename)}}" height="50px" width="50px" alt="">
    @endforeach
</body>
</html>