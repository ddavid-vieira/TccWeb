<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadstrar</title>
</head>

<body>

    <h1>Cadastro de Conferência</h1>

    <form action="{{route('ConferenceStore')}}" method="post">
        @csrf
        <select name="SelectSala" id="SelectSala">
            <option value="">Selecione a Sala</option>
            @foreach($AllSalas as $sala)
            <option name="sala" value="{{$sala->nome}}">{{$sala->nome}}</option>
            @endforeach
        </select>
      
        <input type="date" name="data" id="data" placeholder="Selecione o data da conferência">
        <input type="submit" value="Cadastrar">



    </form>

</body>

</html>