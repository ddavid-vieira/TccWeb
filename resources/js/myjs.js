function auth() {
    const matricula = document.getElementsByName('matricula').value
    const senha = document.getElementsByName('senha').value
    if (matricula != '' && senha != '') {
        window.location()
        alert(`Matricula: ${matricula} e Senha ${senha}`)
       
    }

}