<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir_id"])) {
    $stmt = $pdo->prepare("DELETE FROM mensagens WHERE id = :id");
    $stmt->execute([":id" => (int) $_POST["excluir_id"]]);
    header("Location: mensagens.php");
    exit;
}

$mensagens = $pdo->query("SELECT * FROM mensagens ORDER BY criado_em DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <title>Mensagens - MoonBase</title>
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
        <section id="mensagens">
            <h2>Mensagens recebidas</h2>

            <?php if (count($mensagens) === 0): ?>
                <p>Nenhuma mensagem recebida ainda.</p>
            <?php else: ?>
                <div class="tabela-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Mensagem</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mensagens as $m): ?>
                                <tr>
                                    <td><?= htmlspecialchars($m["nome"]) ?></td>
                                    <td><?= htmlspecialchars($m["email"]) ?></td>
                                    <td><?= nl2br(htmlspecialchars($m["mensagem"])) ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($m["criado_em"])) ?></td>
                                    <td class="acoes">
                                        <a href="editar.php?id=<?= $m["id"] ?>">Editar</a>
                                        <form method="POST" action="mensagens.php" onsubmit="return confirm('Excluir esta mensagem?');">
                                            <input type="hidden" name="excluir_id" value="<?= $m["id"] ?>">
                                            <button type="submit" class="btn-excluir">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer></footer>
</body>
</html>