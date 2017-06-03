function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1o digito 
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return false;
    // Valida 2o digito 
    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

function remove(str, sub) {
    i = str.indexOf(sub);
    r = "";
    if (i == -1) return str;
    {
        r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
    }

    return r;
}

function validarData(source, args) {
    var data = args.Value;

    // verificando data
    if (data.length != 10) return false;

    var dia = data.substr(0, 2);
    var barra1 = data.substr(2, 1);
    var mes = data.substr(3, 2);
    var barra2 = data.substr(5, 1);
    var ano = data.substr(6, 4);
    if (data.length != 10 || barra1 != "/" || barra2 != "/" || isNaN(dia) || isNaN(mes) || isNaN(ano) || dia > 31 || mes > 12) {
        args.IsValid = false;
        return false;
    }

    if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia == 31) {
        args.IsValid = false;
        return false;
    }

    if (mes == 2 && (dia > 29 || (dia == 29 && ano % 4 != 0))) {
        args.IsValid = false;
        return false;
    }

    var dtIni = new Date(data);
    var dtFim = new Date();

    if ((dtFim.getFullYear() - dtIni.getFullYear()) > 80 ) {
        args.IsValid = false;
        source.textContent = "A idade nao pode ser superior a 80 anos.";
        return false;
    }

    //if ((dtFim.getFullYear() - dtIni.getFullYear()) < 18) {
    //    args.IsValid = false;
    //    source.textContent = "A idade nao pode ser inferior a 18 anos.";
    //    return false;
    //}

    return true;
}


function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}

function validarEmail(args) {
    var $email = args.Value;
    if ($email.length == 0) {
        return true;
    }
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (emailReg.test($email)) {
        return true;
    }
    else {
        args.IsValid = false;
        return false;
    }
}

function validarContemSobrenome(source, args) {
    var str = args.Value.split(" ");

    if (str.length > 1) {
        return true
    } else {
        args.IsValid = false;
        return false;
    }
}

function SomenteNumero(event) {
    if (event.keyCode < 48 || event.keyCode > 57)
        return false;
}

$('#date_bornN').on('change', function (e) {

    //var dia = document.getElementById('date_born').value;
    var mes = document.getElementById('date_bornN').value;
    var ano = document.getElementById('date_bornN').value;
    var anoAtual = new Date();//pegar o ano atual via JS

    mes = mes.substring(0,2);
    ano = ano.substring(3,7);
    
    anoAtual = anoAtual.getFullYear();

    if(document.getElementById('date_bornN').value == "")
    {
     return false;
    }
    else{
    if (mes > 12|| mes<=00) {
         return false;
    } if(ano > anoAtual){
     return false;
    }
    }
});

$("#date_bornN").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});

$('#date_failN').on('change', function (e) {

    //var dia = document.getElementById('date_born').value;
    var mes = document.getElementById('date_failN').value;
    var ano = document.getElementById('date_failN').value;
    var anoAtual = new Date();//pegar o ano atual via JS

    mes = mes.substring(0,2);
    ano = ano.substring(3,7);
    
    anoAtual = anoAtual.getFullYear();

    if(document.getElementById('date_failN').value == "")
    {
     return false;
    }
    else{
    if (mes > 12|| mes<=00) {
         return false;
    }
     if(ano > anoAtual){
     return false;
    }
    }
});

$("#date_failN").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});