<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$nome     = htmlspecialchars($_POST['nome'] ?? '');
$email    = htmlspecialchars($_POST['email'] ?? '');
$telefone = htmlspecialchars($_POST['telefone'] ?? '');
$data     = htmlspecialchars($_POST['data'] ?? '');
$servico  = htmlspecialchars($_POST['servico'] ?? '');
$mensagem = htmlspecialchars($_POST['mensagem'] ?? '');

// Formatar data
$dataFormatada = '';
if (!empty($data)) {
    $dataFormatada = date('d/m/Y', strtotime($data));
}

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contatobrunafernands@gmail.com'; // seu Gmail
    $mail->Password   = '';               // App Password sem espaços
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remetente e destinatário
    $mail->setFrom('contatobrunafernands@gmail.com', 'Formulário do Site - desentupidoramorumbi.com.br');
    $mail->addAddress('brunafernandess@outlook.com.br', 'Bruna Fernandes');
    $mail->addReplyTo($email, $nome);

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Agendamento de visita pelo site desentupidoramorumbi.com.br';
    $mail->Body    = "
        <h2>Agendamento de visita pelo site desentupidoramorumbi.com.br</h2>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Telefone:</strong> $telefone</p>
        <p><strong>Data:</strong> $dataFormatada</p>
        <p><strong>Serviço:</strong> $servico</p>
        <p><strong>Mensagem:</strong> $mensagem</p>
    ";
    $mail->AltBody = "Agendamento de visita pelo site desentupidoramorumbi.com.br\n\nNome: $nome\nEmail: $email\nTelefone: $telefone\nData: $dataFormatada\nServiço: $servico\nMensagem: $mensagem";

    // Enviar
    if($mail->send()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'MENSAGEM ENVIADA COM SUCESSO!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ERRO AO ENVIAR MENSAGEM: ' . $mail->ErrorInfo
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'ERRO AO ENVIAR MENSAGEM: ' . $mail->ErrorInfo
    ]);
}