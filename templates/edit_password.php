<h1>Mon blog</h1>
<p>En construction</p>

<?= $this->session->get('pseudo'); ?>

<div>
    <form method="post" action="../public/index.php?route=editPassword">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= $this->session->get('pseudo');?>"><br>
        <label for="password">Nouveau mot de passe</label><br>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>