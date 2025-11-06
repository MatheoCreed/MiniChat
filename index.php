<?php

require 'config.php';

$default_limit = 10;

if (!empty($_POST['auteur']) && !empty($_POST['message'])) {
    $auteur = trim($_POST['auteur']);
    $message = trim($_POST['message']);

    if ($auteur !== '' && $message !== '') {
        $stmt = $pdo->prepare('INSERT INTO message (auteur, message) VALUES (:auteur, :message)');
        $stmt->execute([':auteur' => $auteur, ':message' => $message]);
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$default_limit = (int)$default_limit; 
$stmt = $pdo->query("SELECT auteur, message FROM message LIMIT $default_limit");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MiniChat PHP</title>
        <link rel="stylesheet" href="styles/style.csss">
    </head>
    <body>
        <h1>MiniChat PHP</h1>

        <form method="post">
            <input type="text" name="auteur" placeholder="Votre auteur" required>
            <textarea name="message" placeholder="Votre message" rows="3" required></textarea>
            <button type="submit">Envoyer</button>
        </form>

        <h2>Derniers messages</h2>
        <?php foreach ($messages as $m): ?>
            <div class="msg">
                <strong><?= h($m['auteur']) ?> :</strong><br>
                <?= nl2br(h($m['message'])) ?>
            </div>
        <?php endforeach; ?>

    </body>
</html>