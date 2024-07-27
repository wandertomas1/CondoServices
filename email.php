<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefone = trim($_POST["telefone"]);
    $mensagem = trim($_POST["mensagem"]);

    if (empty($nome) || empty($email) || empty($telefone) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Um ou mais campos estão vazios ou inválidos
        http_response_code(400);
        echo "Por favor, preencha todos os campos e tente novamente.";
        exit;
    }

    $recipient = "gestor@servicesgestao.com.br";
    $subject = "Nova mensagem de $nome";

    $email_content = "Nome: $nome\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Telefone: $telefone\n\n";
    $email_content .= "Mensagem:\n$mensagem\n";

    $email_headers = "From: $nome <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Obrigado! Sua mensagem foi enviada.";
    } else {
        http_response_code(500);
        echo "Ops! Algo deu errado e não pudemos enviar sua mensagem.";
    }
} else {
    http_response_code(403);
    echo "Houve um problema com seu envio, por favor tente novamente.";
}
?>
