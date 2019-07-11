<h1>Mon blog</h1>
<p>En construction</p>

<?= $this->session->show('badPass'); ?>

<div>
    <form method="post" action="../public/index.php?route=inscription">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>
        <label for="mail">Email</label><br>
        <input type="text" id="mail" name="mail"><br>
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>