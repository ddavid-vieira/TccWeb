@extends('templates.template')

@section('title')
CreateUser
@endsection
@section('ImgMain')
<img src="{{url('images/ImgMain2.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1 class="h1form">Cadastre-se</h1>
@if ($errors->any())
<div class="alert alert-danger" style='display:flex; justify-content: flex-start; margin:0;'>
    <lottie-player src="https://assets1.lottiefiles.com/datafiles/q0z5reyGijuF4rk/data.json" mode="bounce" background="rgba(0, 0, 0, 0)" speed="0.85" style="width: 75px; height: 75;" loop autoplay></lottie-player>
    <ul style='list-style:none; margin:0; margin-top:5px; padding:0;'>
        @foreach ($errors->all() as $error)
        <li style='list-style:none; margin:0;'>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('Create')}}" method="post">
    @csrf
    <label class="labels" for="matricula">Matrícula </label>
    <input type="text" class='input-create ' name="matricula" id="matricula" value="{{ old('matricula') }}" /> <br>
    <label class="labels" for="nome">Nome Completo </label>
    <input type="text" class='input-create' name="nome" id="nome" value="{{ old('nome') }}" /> <br>
    <label class="labels" for="telefone">Telefone</label>
    <input type="text" class='input-create ' name="telefone" id="telefone" value="{{ old('telefone') }}" /> <br>
    <label class="labels" for="cpf">CPF</label>
    <input type="text" class='input-create ' name="cpf" id="cpf" value="{{ old('cpf') }}" /> <br>
    <label class="labels" for="senha">Senha</label>
    <div class="password">
        <input type="password" class="input-create" name="senha" id="senha">
        <span class="material-icons mb-3" id="eyes">
            visibility
        </span>
    </div>
    <button type="submit" class="btn btn-outline-info btn-block mt-3 ">Cadastrar</button>
    <hr class="hr">
    <p class="ml-3">Já possui conta? <a class="text-primary" href="{{route('LoginUser')}}">Entre aqui</a></p>

</form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow", function() {
                $(this).alert('close');
            });
        }, 4000);
    });
    $(document).ready(function() {
        var $cpf = $("#cpf");
        $cpf.mask('000.000.000-00', {
            reverse: false
        });
        var $telefone = $("#telefone");
        $telefone.mask('0 0000 - 0000', {
            reverse: false
        });
    });
    let btn = document.querySelector('.material-icons');
    btn.addEventListener('click', function() {

        let input = document.querySelector('#senha')
        if (input.getAttribute('type') == 'password') {
            input.setAttribute('type', 'text');
            document.getElementById("eyes").innerHTML = "visibility_off";
        } else {
            input.setAttribute('type', 'password');
            document.getElementById("eyes").innerHTML = "visibility";
        }
    });
</script>
@endsection