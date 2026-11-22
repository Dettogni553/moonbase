<?php
require "conexao.php";

$retorno = "";
$classe = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");

    if (mb_strlen($nome) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($mensagem) < 10) {
        $retorno = "Preencha todos os campos corretamente.";
        $classe = "erro";
    } else {
        $stmt = $pdo->prepare("INSERT INTO mensagens (nome, email, mensagem) VALUES (:nome, :email, :mensagem)");
        $stmt->execute([
            ":nome" => $nome,
            ":email" => $email,
            ":mensagem" => $mensagem
        ]);
        header("Location: contato.php?ok=1");
        exit;
    }
}

if (isset($_GET["ok"])) {
    $retorno = "Obrigado! Sua mensagem foi enviada.";
    $classe = "sucesso";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <title>Contato - MoonBase</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <video autoplay muted loop id="video-fundo">
        <source src="./img/fundo.mp4" type="video/mp4">
    </video>

    <header>
        <div class="header">
            <div class="logo">
                <img src="https://images.vexels.com/media/users/3/205504/isolated/preview/f4cc22d8e599e53114df6f53cbfaa39a-ilustracao-de-lua-de-satelite.png" alt="MoonBase Logo">
            </div>
            <div class="menu">
                <a href="index.html">Home</a>
                <a href="index.html#Fotos">Fotos</a>
                <a href="contato.php">Contato</a>
            </div>
        </div>
    </header>

    <main>
        <section id="contato">
            <h2>Contato</h2>
            <p>Tem dúvidas, sugestões ou quer compartilhar sua própria foto da lua? Fale com a gente:</p>

            <form id="form-contato" method="POST" action="contato.php" novalidate>
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email">

                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" rows="5"></textarea>

                <button type="submit">Enviar</button>
                <p id="form-retorno" class="<?= $classe ?>"><?= $retorno ?></p>
            </form>

            <p>Instagram: <a href="https://www.instagram.com/moo.nbase/" target="_blank">@moo.nbase</a></p>
        </section>
    </main>

    <footer></footer>

    <script src="./contato.js"></script>
</body>
</html>