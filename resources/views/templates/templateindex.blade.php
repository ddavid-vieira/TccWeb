<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('css/ViewIndex.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> @yield('title') </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6cf119; padding: 20px;   -webkit-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    -moz-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);">
        <a class="navbar-brand" style="color:antiquewhite;" href="#">Confpat</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{route('Import')}}">Importar dados <span class="sr-only"></span></a>
                <a class="nav-item nav-link" href="{{route('CreateConference')}}">Criar conferência</a>
                <a class="nav-item nav-link" href="{{route('ListConferences')}}">Listar Conferências</a>
                <a class="nav-item nav-link" href="{{route('ImportUniqueQrCode')}}">Criar Qr code único</a>
                <div class="rowuser" style="margin-left: 270px; margin-right: 20px; color:aliceblue;">
                    <span class="material-icons">
                        person
                    </span>
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Bem vindo,
                            <?php
                            session_start();
                            echo $_SESSION['Nome'];
                            ?></button>
                        <div id="myDropdown" class="dropdown-content">
                            <p></p>
                            <a href="#"> Matrícula: <?php
                                                    echo $_SESSION['Matricula'] ?></a>
                            <a href="#">Telefone: <?php
                                                    function masc_tel($tel)
                                                    {
                                                        $tam = strlen(preg_replace("/[^0-9]/", "", $tel));
                                                        if ($tam <= 9) { 
                                                            return substr($tel, 0, $tam - 4) . "-" . substr($tel, -4);
                                                        }
                                                    }
                                                    echo masc_tel($_SESSION['Telefone']) ?></a>
                            <a href="#">CPF: <?php
                                                echo formatar_cpf_cnpj($_SESSION['Cpf']);
                                                function formatar_cpf_cnpj($doc)
                                                {

                                                    $doc = preg_replace("/[^0-9]/", "", $doc);
                                                    $qtd = strlen($doc);

                                                    if ($qtd >= 11) {

                                                        if ($qtd === 11) {

                                                            $docFormatado = substr($doc, 0, 3) . '.' .
                                                                substr($doc, 3, 3) . '.' .
                                                                substr($doc, 6, 3) . ' - ' .
                                                                substr($doc, 9, 2);
                                                        } else {
                                                            $docFormatado = substr($doc, 0, 2) . '.' .
                                                                substr($doc, 2, 3) . '.' .
                                                                substr($doc, 5, 3) . '/' .
                                                                substr($doc, 8, 4) . '-' .
                                                                substr($doc, -2);
                                                        }

                                                        return $docFormatado;
                                                    } else {
                                                        return 'Documento invalido';
                                                    }
                                                }
                                                ?></a>
                        </div>
                    </div>
                </div>
                <a class="nav-item nav-link mt-2" style="color: #ff2401;" href="{{route('Logout')}}"> <span class="material-icons">
                        logout
                    </span></a>


            </div>
        </div>
    </nav>
    <div class="container">
        <div class="image">
            @yield('ImgMain')
        </div>
        <div class="linha-vertical"></div>
        <div class="box"> @yield('content')</div>
    </div>


</body>
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

</html>