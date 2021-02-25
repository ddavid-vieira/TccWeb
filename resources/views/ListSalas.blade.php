<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Salas</title>
</head>

<body>
    <h1>Listagem de Salas</h1>


    <select name="SelectSetor" id="SelectSetor">
        <option value="">Selecione o Setor</option>
        @foreach($AllSetores as $setor)
        <option name="setor" value="{{$setor->nome}}">{{$setor->nome}}</option>
        @endforeach

    </select>

    <select name="SelectSetor" id="SelectSetor">
        <option value="">Selecione o sala</option>
        @foreach($salas as $sala)
        <option name="setor" value="{{$setor->nome}}">{{$sala->nome}}</option>
        @endforeach


</body>

</html>