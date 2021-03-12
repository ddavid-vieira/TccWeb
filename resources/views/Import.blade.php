@extends('templates.templateindex')


@section('title')
Importação de dados
@endsection

@section('ImgMain')
<img src="{{url('images/ImgImport.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Importação de dados para o sistema</h1>
<form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input name="arquivo" type="file"><br>


    <select class="custom-select mt-4" name="Selects" id="inputGroupSelect01">

        <option value="1">Importar e gerar Qrcode</option>
        <option value="2">Apenas Importar</option>
        <option value="3">Apenas gerar qrcode</option>
    </select>

    <button type="submit" class="btn btn-outline-success btn-lg btn-block  mt-4">Importar</button>






</form>

@endsection