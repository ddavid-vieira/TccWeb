@extends('templates.templateindex')


@section('title')
Importação de dados
@endsection

@section('ImgMain')
<img src="{{url('images/ImgImport.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Importação de dados para o sistema</h1>
@if(session('message'))
<div class="alert alert-danger" style='display:flex; justify-content: flex-start;'>
    <lottie-player src="https://assets1.lottiefiles.com/datafiles/q0z5reyGijuF4rk/data.json" mode="bounce" background="rgba(0, 0, 0, 0)" speed="0.85" style="width: 50px; height: 50px;" loop autoplay></lottie-player>
    <p style="margin-top:15px;">{{session('message')}}</p>
</div>
@endif
@if(session('messageSucesso'))
<div class="alert alert-success">
    <p>{{session('messageSucesso')}}</p>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger" style='display:flex; justify-content: flex-start;'>
    <lottie-player src="https://assets1.lottiefiles.com/datafiles/q0z5reyGijuF4rk/data.json" mode="bounce" background="rgba(0, 0, 0, 0)" speed="0.85" style="width: 50px; height: 50px;" loop autoplay></lottie-player>
    <ul style='list-style:none; margin:0; margin-top:15px; padding:0;'>
        @foreach ($errors->all() as $error)
        <li style='list-style:none; margin:0;'>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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