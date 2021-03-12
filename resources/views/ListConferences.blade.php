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
    <title> Listagem de conferências </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6cf119; padding: 20px;   -webkit-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    -moz-box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);
    box-shadow: 4px 4px 4px 0px rgba(54, 50, 50, 0.63);">
        <a class="navbar-brand" style="color:antiquewhite;" href="#">Confpat</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
                <a class="nav-item nav-link mt-2" href="{{route('Import')}}">Importar dados <span class="sr-only"></span></a>
                <a class="nav-item nav-link mt-2" href="{{route('CreateConference')}}">Criar conferência</a>
                <a class="nav-item nav-link mt-2" href="{{route('ListConferences')}}">Listar Conferências</a>
                <a class="nav-item nav-link mt-2" href="{{route('ImportUniqueQrCode')}}">Criar Qr code único</a>
                <div class="rowuser" style="margin-left: 270px; margin-right: 20px; color:aliceblue;">
                    <span class="material-icons">
                        person
                    </span>
                    <a class="nav-item nav-link" href="#">
                        <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn">Bem vindo,
                                <?php
                                session_start();
                                echo $_SESSION['Nome'];
                                ?></button>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="#"> Matrícula: <?php
                                                        echo $_SESSION['Matricula'] ?></a>
                                <a href="#">Telefone: <?php
                                                        function telephone($number)
                                                        {
                                                            $number = "(" . substr($number, 0, 2) . ") " . substr($number, 2, -4) . " - " . substr($number, -4);
                                                            // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
                                                            return $number;
                                                        }
                                                        echo telephone($_SESSION['Telefone']) ?></a>
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
                    </a>
                </div>
                <a class="nav-item nav-link mt-3" style="color: #ff2401;" href="{{route('Logout')}}"> <span class="material-icons">
                        logout
                    </span></a>

                <?php

                ?>
            </div>
        </div>
    </nav>
    <section>
        <h1 class="h1ex">Conferências</h1>
    </section>
    <main>
        <div class="container2">
            @foreach($conferencias as $conferencia)
            <div class="card">
                <div class="rowsetor">
                    <div class="setor">
                        <p>Setor {{ $conferencia->NomeSetor}}</p>
                    </div>
                    <div class="data">
                        <p> <?php
                            $date = new DateTime($conferencia->Data);
                            echo $date->format('d/m/Y H:i');
                            ?></p>
                    </div>
                </div>
                <div class="rowsala">
                    <div class="sala">
                        <p class="p">Sala</p>
                        <p class="p">
                            {{$conferencia->Sala}}
                        </p>
                    </div>
                    <div class="view">
                        Patrimônios: <a href="{{route('GetUniqueConference', $conferencia->Sala )}}" class="viewlink">Vizualizar</a>
                    </div>

                </div>

            </div>
            @endforeach







        </div>

    </main>




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