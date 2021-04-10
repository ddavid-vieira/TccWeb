<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{url('css/UniqueReport.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Relatório</title>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="{{url('images/LogoIfs.png')}}" widht="170" height="170" alt="ImgLogin">
        </div>
        <div class="datas">
            <div class="rowData">
                <p>Setor: {{$conferencia[0]->NomeSetor}}</p>
                <p>Sala: {{$conferencia[0]->Sala}}</p>

            </div>
            <div class="rowData">
                <p>Conferencista: {{$servidor[0]->Nome}}</p>
                <p>Matrícula: {{$servidor[0]->Matricula}}</p>

            </div>
            <div class="rowData">
                <p>Início: <?php
                            $date = new DateTime($registerConference[0]->DataInit);
                            echo $date->format('d/m/Y H:i:s');
                            ?> </p>
                <p>Término: <?php
                            $date = new DateTime($registerConference[0]->DataClose);
                            echo $date->format('d/m/Y H:i:s');
                            ?></p>

            </div>
            <div class="rowData">
                <p>Patrimônio(s) Verficado(s): {{$CountVerificados}}</p>
                <p>Patrimônio(s) Alterado(s): {{$CountAlterados}}</p>

            </div>

        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <tr style="background-color:#6cf119; color:white;">
                <th scope="col">Unidade Gestora</th>
                <th scope="col">Unidade</th>
                <th scope="col">Data de Garantia</th>
                <th scope="col">Denominação </th>
                <th scope="col">Marca</th>
                <th scope="col">Antigo Estado</th>
                <th scope="col">Novo Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patrimonios as $patrimonio)
            <tr>
                <td>{{$patrimonio->get("Unidade Gestora")[0]["Unidade Gestora"]}}</td>
                <td>{{$patrimonio->Unidade}}</td>
                <td>{{$patrimonio->DataGarantia}}</td>
                <td>{{$patrimonio->Denominacao}}</td>
                <td>{{$patrimonio->Marca}}</td>
                <td>{{$patrimonio->Estado}}</td>
                @if($patrimonio->NovoEstado == '')
                <td>Não Alterou</td>
                @endif
                @if(isset($patrimonio->NovoEstado))
                <td>{{$patrimonio->NovoEstado}}</td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="rowbutton">
        <p>Gerado em: <?php
                        date_default_timezone_set('America/Sao_Paulo');
                        $agora = date('d/m/Y H:i:s');
                        echo $agora;
                        ?></p>
        <button  type="button" onclick="window.print();" class="noPrint">Gerar</button>


    </div>

</body>


</html>