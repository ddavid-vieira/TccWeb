@extends('templates.template')

@section('title')
CreateUser
@endsection
@section('ImgMain')
<img src="{{url('images/ImgMain2.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1 class="h1form">Cadastre-se</h1>
<form action="{{route('Create')}}" method="post">
    @csrf
    <label class="labels" for="matricula">Matrícula </label>
    <input type="text" class='input-create ' name="matricula" id="matricula" /> <br>
    <label class="labels" for="nome">Nome Completo </label>
    <input type="text" class='input-create' name="nome" id="nome" /> <br>
    <label class="labels" for="telefone">Telefone</label>
    <input type="text" class='input-create ' name="telefone" id="telefone" /> <br>
    <label class="labels" for="cpf">CPF</label>
    <input type="text" class='input-create ' name="cpf" id="cpf" /> <br>
    <label class="labels" for="senha">Senha</label>
    <input type="password" class='input-create ' name="senha" id="senha" /><br>
    <button type="submit" class="btn btn-outline-info btn-block mt-3 ">Cadastrar</button>
    <hr class="hr">
    <p class="ml-3">Já possui conta? <a class="text-primary" href="{{route('LoginUser')}}" >Entre aqui</a></p>

</form>
@endsection