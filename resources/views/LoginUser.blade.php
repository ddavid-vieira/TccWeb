@extends('templates.template')
@section('title')
Login
@endsection
@section('content')

@section('ImgMain')
<img src="{{url('images/ImgMain.svg')}}" widht="400" height="400" alt="ImgLogin">
@endsection
<h1 class="h1form">Entre em sua conta </h1>
@if(session('message'))
<div class="alert alert-danger">
    <p>{{session('message')}}</p>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('Auth')}}" method="post">
    @csrf
    <label class="label" for="Matricula">Matrícula</label><br>
    <input type="text" class="input" name="matricula" id="matricula" autocomplete="off" value="{{ old('matricula') }}"><br>
    <label class="label" for="Senha">Senha </label><br>
    <div class="password">
        <input type="password" class="input" name="senha" id="senha">
        <span class="material-icons mb-3" id="eye">
            visibility
        </span>
    </div>
    <button type="submit" class="btn btn-outline-success btn-lg btn-block mt-4">Entrar</button>
    <hr class="hr">
    <p class="ml-3">Não tem conta? <a class="text-success" href="{{route('CreateUser')}}">Cadastre-se aqui</a></p>
</form>
<script>
    $(document).ready(function() {
        setTimeout(function() { 
           $(".alert").fadeOut("slow", function() {
                $(this).alert('close');
            });
        }, 4000);
    });
    let btn = document.querySelector('.material-icons');
    btn.addEventListener('click', function() {

        let input = document.querySelector('#senha')
        if (input.getAttribute('type') == 'password') {
            input.setAttribute('type', 'text');
            document.getElementById("eye").innerHTML = "visibility_off";
        } else {
            input.setAttribute('type', 'password');
            document.getElementById("eye").innerHTML = "visibility";
        }
    });
</script>
@endsection