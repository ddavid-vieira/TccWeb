@extends('templates.templateindex')


@section('title')
Gerar qr code único
@endsection

@section('ImgMain')
<img src="{{url('images/ImgUniqueQrCode.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Gerar Qr code</h1>
<form action="{{route('CreateUniqueQrCode')}}" method="post" enctype="multipart/form-data">
    @csrf
    <textarea class="form-control pl-5" name='qrcodes' placeholder="Digite o(s) Qrcode(s)" aria-label="With textarea"></textarea>
    <small style="color:gray;">Separar por ";"</small>
    <div class="button"> <button type="submit" class="btn btn-outline-success btn-lg btn-block">Gerar</button>
    </div>


</form>

@endsection