<?php $this->title = 'Mon profil'; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('update_password');?>
<?= $this->session->show('not_admin');?>
<?= $this->session->show('need_login');?>

<div>
    <h2><?= $this->session->get('pseudo'); ?></h2>
    <p><?= $this->session->get('id'); ?></p>
    <a href="../public/index.php?route=editPassword">Modifier mot de passe</a>
    <a href="../public/index.php?route=deleteAccount">Supprimer mon compte</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>