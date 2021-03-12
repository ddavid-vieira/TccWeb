<---------Sessão do login---------->
<?php
if (session('UserData') == null) {
    return view('LoginUser');
}
?>
<h1> Bem vindo, {{session('UserData')[0]['Nome']}}
</h1> 

<-------------------End---------------->

<--------------Download do arquivo com qr code--------------->

1° - Receber o relátorio contendo os números do patrimônio;
2° - Iterar dentro de um while para receber os dados um a um;
3° - Utilizar a biblioteca do qr code 
4° - Criar arquivo.zip para adicionar os qr codes
5° - Fazer download do arquivo zip.

<--------------------------end----------------------------------->

<----------------------------Cards do listar conferências----------->


    <div class="boxcards">
            <h1 class="a mt-2 ml-2">Conferências</h1>
            <div class="contentCards">
                @foreach($conferencias as $conferencia)
                <div class="card">
                    <div class="row">
                        <p class="mr-3"> Setor: {{ $conferencia->NomeSetor}}</p>
                        <p>  Data: 
                            {{ $conferencia->Data}}</p>
                    </div>
                    <p class="pt-3"> Sala: {{ $conferencia->Sala}}</p>
                </div>
                @endforeach
            </div>
        </div>

<--------------------------End------------------------>