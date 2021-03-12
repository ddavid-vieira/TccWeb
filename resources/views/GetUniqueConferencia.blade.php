<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/ViewIndex.css')}}">

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> Dados da Conferência </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6cf119; padding: 20px;   -webkit-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    -moz-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);">
        <a href="{{route('ListConferences')}}" class='a mr-3' style="color:antiquewhite; size:15px;">
            <span class="material-icons">
                keyboard_arrow_left
            </span></a>
        <a class="navbar-brand" style="color:antiquewhite;" href="#">{{$sala}} </a>
        <a class="navbar-brand" style="color:antiquewhite;" href="#"> Quantidade: {{count($patrimonios)}} </a>

    </nav>
    <main>
        <table class="table table-hover">
            <thead>
                <tr style="background-color:#6cf119; color:white;">
                    <th scope="col">Unidade Gestora</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">Data de Tombamento</th>
                    <th scope="col">Data de Garantia</th>
                    <th scope="col">Denominação </th>
                    <th scope="col">Marca</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Finalidade</th>
                    <th scope="col">Depreciável</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patrimonios as $patrimonio)
                <tr>
                    <td>{{$patrimonio->get("Unidade Gestora")[0]["Unidade Gestora"]}}</td>
                    <td>{{$patrimonio->Unidade}}</td>
                    <td>{{$patrimonio->DataTombamento}}</td>
                    <td>{{$patrimonio->DataGarantia}}</td>
                    <td>{{$patrimonio->Denominacao}}</td>
                    <td>{{$patrimonio->Marca}}</td>
                    <td>{{$patrimonio->Estado}}</td>
                    <td>{{$patrimonio->Finalidade}}</td>
                    <td>{{$patrimonio->Depreciavel}}</td>
                    <td>{{$patrimonio->Valor}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>




</body>

</html>