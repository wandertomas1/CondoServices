<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = sanitize_text_field($_POST['nome']);
    $email = sanitize_email($_POST['email']);
    $telefone = sanitize_text_field($_POST['telefone']);
    $mensagem = sanitize_textarea_field($_POST['mensagem']);

    $to = 'gestor@condoservicesgestao.com';  // Seu e-mail de destino
    $subject = 'Nova mensagem do formulário de contato';
    $body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\n\nMensagem:\n$mensagem";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
        echo 'Sua mensagem foi enviada com sucesso!';
    } else {
        echo 'Ocorreu um erro ao enviar sua mensagem. Por favor, tente novamente.';
    }
}
?>
