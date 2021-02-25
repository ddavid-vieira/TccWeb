<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cadastro de Setor </h1>

    <form action="{{route('StoreSetor')}}" method="post">
        @csrf
        <input type="text" name="nome" id="nome">
        <input type="submit" value="Cadastrar">
    </form>

    <form action="{{route('StoreSalas')}}" method="post">
        @csrf
        <h1>Cadastro de Sala</h1>
        <input type="text" name="sala" id="sala" placeholder="Insira a nova sala/lab">
        <select name="SelectSetor" id="SelectSetor">
            <option value="">Selecione o Setor</option>
            @foreach($AllSetores as $setor){
            <option name="setor" value="{{$setor->nome}}">{{$setor->nome}}</option>
            }
            @endforeach
        </select>
        <input type="submit" value="cadastrar">
    </form>

            


</body>

</html>