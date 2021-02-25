@extends('templates.template')
@section('title')
Login
@endsection
@section('content')

@section('ImgMain')
<img src="{{url('images/ImgMain.svg')}}" widht="400" height="400" alt="ImgLogin">
@endsection
<h1 class="h1form">Entre em sua conta </h1>
<form action="{{route('Auth')}}" method="post">
    @csrf
    <label class="label" for="Matricula">Matrícula</label><br>
    <input type="text" class="input" name="matricula" id="matricula" autocomplete="off"><br>
    <label class="label" for="Senha">Senha </label><br>
    <input type="password" class="input" name="senha" id="senha"><br>
    <button type="submit" class="btn btn-outline-success btn-lg btn-block mt-4">Entrar</button>
    <hr class="hr">
    <p class="ml-3">Não tem conta? <a class="text-success" href="{{route('CreateUser')}}">Cadastre-se aqui</a></p>


</form>
@endsection