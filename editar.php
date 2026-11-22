<?php
require "conexao.php";

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);
$erro = "";

$stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id = :id");
$stmt->execute([":id" => $id]);
$msg = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$msg) {
    header("Location: mensagens.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");

    if (mb_strlen($nome) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($mensagem) < 10) {
        $erro = "Preencha todos os campos corretamente.";
        $msg["nome"] = $nome;
        $msg["email"] = $email;
        $msg["mensagem"] = $mensagem;
    } else {
        $stmt = $pdo->prepare("UPDATE mensagens SET nome = :nome, email = :email, mensagem = :mensagem WHERE id = :id");
        $stmt->execute([
            ":nome" => $nome,
            ":email" => $email,
            ":mensagem" => $mensagem,
            ":id" => $id
        ]);
        header("Location: mensagens.php");
        exit;
    }
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
    <title>Editar mensagem - MoonBase</title>
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
                <a href="mensagens.php">Mensagens</a>
            </div>
        </div>
    </header>

    <main>
        <section id="editar">
            <h2>Editar mensagem</h2>

            <form method="POST" action="editar.php">
                <input type="hidden" name="id" value="<?= $msg["id"] ?>">

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($msg["nome"]) ?>">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($msg["email"]) ?>">

                <label for="mensagem">Mensagem</label>
                <textarea id="mensagem" name="mensagem" rows="5"><?= htmlspecialchars($msg["mensagem"]) ?></textarea>

                <button type="submit">Salvar alterações</button>
                <?php if ($erro): ?>
                    <p class="erro"><?= $erro ?></p>
                <?php endif; ?>
            </form>

            <p><a href="mensagens.php">Voltar para as mensagens</a></p>
        </section>
    </main>

    <footer></footer>
</body>
</html>