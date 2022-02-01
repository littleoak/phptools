<?php
//by joão paulo santos (littleoak)
//funcionalidade de testes de encriptação para dados sensíveis
//ideal é ter uma equipe boa que trabalhe com dados sensíveis de forma bem expert

$chave = 'Li8yMDIyaXNHb29k'; //pode ser qualquer chave, isso é apenas um base64 comum

function encriptar($dados, $chave) {
    $chave_encriptacao = base64_decode($chave); //inicialmente usado para testes, literalmente ignorar o base64 acima
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encriptado = openssl_encrypt($dados, 'aes-256-cbc', $chave_encriptacao, 0, $iv);
    return base64_encode($encriptado . '::' . $iv);
}

function decriptar($dados, $chave) {
    $chave_encriptacao = base64_decode($chave); //apenas para testes... evitando texto puro como chave
    list($encriptado_data, $iv) = explode('::', base64_decode($dados), 2);
    return openssl_decrypt($encriptado_data, 'aes-256-cbc', $chave_encriptacao, 0, $iv);
}

//texto puro
$texto_plano = 'Texto a Encriptar, Use qualquer String que seja para dados sensíveis...';
echo $texto_plano .PHP_EOL ;

//encriptação
$senha_encriptada = encriptar($texto_plano, $chave);
echo $senha_encriptada . PHP_EOL;

//decriptação
$senha_decriptada = decriptar($senha_encriptada, $chave);
echo $senha_decriptada . PHP_EOL;

/*resultado
Texto a Encriptar, Use qualquer String que seja para dados sensíveis...
TnB1QnEvL1Nnb3Bvd25oMUw2UHZVUlFxL0RZRzBIeVEvVDAwNlltWndZT0I3YlFya1EyV0E4RGdkMlBzRitsYk1QK0xjVjNnYmJXSXNQcTg4dXBhNXA1WHVUTzFXa1A3cG9FSExBUGJhRW89OjreQKhLjfwCTaZMxdoEhgxP
Texto a Encriptar, Use qualquer String que seja para dados sensíveis...
*/
?>
