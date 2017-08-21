<!DOCTYPE>
<html>

<head>
    <title>MiniChat Project II - The Return</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Design Light -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
</head>

<body>
    <div class="mdl-layout mdl-js-layout">
        <main class="mdl-layout__content">
            <div class="page-content">
                <ul class="demo-list-item mdl-list" id="conversation">

                </ul>

                <form action="minichat_post.php" class="mdl-grid" method="POST">
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="pseudo" id="pseudo">
                        <label class="mdl-textfield__label" for="sample3">Pseudo</label>
                    </div>
                    <div class="mdl-cell mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="message" id="message">
                        <label class="mdl-textfield__label" for="sample3">Message</label>
                    </div>
                    <button id="send" class="mdl-cell mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
                        <i class="material-icons">send</i>
                    </button>
                </form>

                <?php
                // Connexion à la base de données
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'akoi', 'ok');
                }
                catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }

                // Récupération des 10 derniers messages
                $reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY ID DESC LIMIT 0, 10');

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                {
                    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
                }

                $reponse->closeCursor();

                ?>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <!-- Material Design Light -->
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</body>

</html>
