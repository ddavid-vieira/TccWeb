@extends('templates.templateindex')


@section('title')
Importação de dados
@endsection


@section('content')
<h1>Importação de dados para o sistema</h1>
<form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf
    Enviar esse arquivo: <input name="arquivo" type="file" />
    <input type="text" name="sala" id="sala" placeholder="Selecione a sala">
    <input type="submit" value="Importar">
</form>
<a href="{{route('Logout')}}">Sair</a>
@endsection