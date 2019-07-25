<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('article_not_found'); ?>
<?= $this->session->show('connexion'); ?>
<?= $this->session->get('id'); ?>
<?= $this->session->get('pseudo'); ?>
<?= $this->session->show('deconnexion'); ?>
<?= $this->session->show('delete_account'); ?>
<?= $this->session->show('flag_comment'); ?>



<?php
    if(!$this->session->get('pseudo')){
        ?>
        <a href="../public/index.php?route=connexion">Connexion</a>
        <a href="../public/index.php?route=inscription">Inscription</a>
        <?php
    }
    else {
        ?>
        <a href="../public/index.php?route=deconnexion">Deconnexion</a>
        <a href="../public/index.php?route=profile">Profil</a>
        <?php if($this->session->get('role')==1) { ?>
            <a href="../public/index.php?route=administration">Administration</a>
        <?php } ?>
        <a href="../public/index.php?route=addArticle">Nouvel article</a>

        <?php
    }
?>



<?php
foreach ($articles as $article)
{
    ?>
    <div>
        <h2><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId());?>"><?= htmlspecialchars($article->getTitle());?></a></h2>
        <p><?= htmlspecialchars($article->getContent());?></p>
        <p><?= htmlspecialchars($article->getAuthor());?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></p>
    </div>
    <br>
    <?php
}
?>