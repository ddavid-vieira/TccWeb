@extends('templates.templateindex')

@section('title')
Criação de Relatórios
@endsection

@section('ImgMain')
<img src="{{url('images/ImgCreateReport.svg')}}" widht="400" height="400" alt="ImgLogin">

@endsection

@section('content')
<h1>Gerar Relatórios</h1>
<table class="table table-hover">
    <thead>
        <tr style="background-color:#6cf119; color:white;">

            <th scope="col-1">Sala da conferência </th>
            <th scope="col">Matrícula</th>
            <th scope="col">Data de Início </th>
            <th scope="col">Data de término</th>
            <th scope="col"><span class="material-icons">
                    assignment
                </span></th>
        </tr>
    </thead>
    <tbody>
        @foreach($dados as $dado)
        <tr>
            <td>{{$dado->Sala}}</td>
            <td>{{$dado->Matricula}}</td>
            <td><?php
                $date = new DateTime($dado->DataInit);
                echo $date->format('d/m/Y H:i:s');
                ?></td>
            <td><?php
                $date = new DateTime($dado->DataClose);
                echo $date->format('d/m/Y H:i:s');
                ?></td>
            <td> <a href="{{route('UniqueReport', ['Idconferencia' => $dado->Idconferencia, 'IdRegisterConference' => $dado->IdRegisterConference, 'Matricula'=>$dado->Matricula])}}" style="color:#6cf119;">Gerar</a>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection