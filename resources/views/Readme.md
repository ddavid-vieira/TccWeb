<---------Sessão do login---------->
<?php
if (session('UserData') == null) {
    return view('LoginUser');
}
?>
<h1> Bem vindo, {{session('UserData')[0]['Nome']}}
</h1> 

<-------------------End---------------->