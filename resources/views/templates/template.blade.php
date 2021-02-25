<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/LoginandCreate.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>
    <div class="header">
        <img src="{{url('images/image-removebg-preview.png')}}" alt="Confpat" widht="60" height="60">

    </div>
    <div class="container">
        <div class="image">
         @yield('ImgMain')
          
        </div>
        <div class="linha-vertical"></div>
        <div class="form"> @yield('content')</div>

    </div>

</body>

</html>