@extends('templates.templateindex')


@section('title')
Criação de Conferência
@endsection
@section('ImgMain')
<img src="{{url('images/ImgCreateConference.svg')}}" widht="400" height="400" alt="ImgLogin">
@endsection

@section('content')
<h1>Cadastro de Conferência</h1>
@if(session('messageSucesso'))
<div class="alert alert-success">
    <p>{{session('messageSucesso')}}</p>
</div>
@endif
@if(session('message'))
<div class="alert alert-danger" style='display:flex; justify-content: flex-start;'>
    <lottie-player src="https://assets1.lottiefiles.com/datafiles/q0z5reyGijuF4rk/data.json" mode="bounce" background="rgba(0, 0, 0, 0)" speed="0.85" style="width: 50px; height: 50px;" loop autoplay></lottie-player>
    <p style="margin-top:15px;">{{session('message')}}</p>
</div>
@endif
<form action="{{route('ConferenceStore')}}" method="post">
    @csrf
    <div class="rowuser">
        <select class="custom-select" name="SelectSetor" id="SelectSetor">
            <option value="">Selecione o Setor</option>
            @foreach($AllSetores as $setor)
            <option name="setor" value="{{$setor->nome}}">{{$setor->nome}}</option>
            @endforeach
        </select>
    </div>
    <select class="custom-select mt-3" name="SelectSala" id="SelectSala">
        <option value="">Selecione a Sala</option>
        @foreach($AllSalas as $sala)
        <option name="setor" value="{{$sala->nome}}">{{$sala->nome}}</option>
        @endforeach
    </select>
    <div class="date">
        <input type="datetime-local" class='dateinput p-1' name="data" id="data" placeholder="Selecione o data da conferência">

    </div>
    <div class="button">
        <button type="submit" class="btn btn-outline-info btn-lg btn-block">Criar</button>
    </div>

</form>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow", function() {
                $(this).alert('close');
            });
        }, 4000);
    });
</script>

@endsection