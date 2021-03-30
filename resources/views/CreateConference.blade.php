@extends('templates.templateindex')


@section('title')
Criação de Conferência
@endsection
@section('ImgMain')
<img src="{{url('images/ImgCreateConference.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Cadastro de Conferência</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
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
        <option name="sala" value="{{$sala->nome}}">{{$sala->nome}}</option>
        @endforeach
    </select>
    <div class="date">
        <input type="datetime-local" class='dateinput p-1' name="data" id="data" placeholder="Selecione o data da conferência">

    </div>
    <div class="button">
        <button type="submit" class="btn btn-outline-info btn-lg btn-block">Criar</button>

    </div>

</form>

@endsection