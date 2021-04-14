@extends('templates.templateindex')


@section('title')
Gerar qr code único
@endsection

@section('ImgMain')
<img src="{{url('images/ImgUniqueQrCode.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Gerar Qr code</h1>

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
<form action="{{route('CreateUniqueQrCode')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="textArea">
        <textarea class="form-control pl-5" name='qrcodes' id="qrcodes" placeholder="Digite o(s) Qrcode(s)" aria-label="With textarea"></textarea>
        <div class="column">
            <span class="material-icons" id="paste" data-toggle="tooltip" data-placement="bottom" title="Aperte para colar o texto copiado recentemente">
                content_paste
            </span>
            <span class="material-icons" id="clear" data-toggle="tooltip" data-placement="bottom" title="Aperte para excluir o texto do campo">
                clear
            </span>

        </div>
    </div>

    <small style="color:gray; font-size:16px;">Separar por ";"</small>
    <div class="button"> <button type="submit" class="btn btn-outline-success btn-lg btn-block">Gerar</button>
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

    document.getElementById('paste').addEventListener('click', () => {
        let pasteArea = document.getElementById('qrcodes')
        pasteArea.value = '';
        navigator.clipboard.readText().then((text) => {
            pasteArea.value = text;
        })
    })
    document.getElementById('clear').addEventListener('click', () => {
        let textArea = document.querySelector('#qrcodes')
        textArea.value = ""
    })
</script>

@endsection