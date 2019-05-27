<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('article_not_found'); ?>
<?= $this->session->show('article_delete'); ?>
<?= $this->session->show('connexion'); ?>
<?= $this->session->show('id'); ?>
<?= $this->session->get('pseudo'); ?>


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