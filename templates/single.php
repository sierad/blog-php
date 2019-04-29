<?php $this->title = "Article"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('add_comment'); ?>

<div>
    <h2><?= htmlspecialchars($article->getTitle());?></h2>
    <p><?= htmlspecialchars($article->getContent());?></p>
    <p><?= htmlspecialchars($article->getAuthor());?></p>
    <p>Créé le : <?= htmlspecialchars($article->getCreatedAt());?></p>
</div>
<br>
<div class="actions">
    <a href="../public/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
    <a href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>

</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments" class="text-left" style="margin-left: 50px">
    <h3>Commentaires</h3>
    <div id="button">
        <?php include 'add_comment.php'?>
    </div>
<br><hr><br>
    <?php
    foreach ($comments as $comment)
    {
        ?>
        <a href="../public/index.php?route=editComment&commentId=<?= $comment->getId(); ?>"> Modifier </a>
        <a href="../public/index.php?route=deleteCommentSingle&commentId=<?= $comment->getId()?>"> Supprimer </a>
        <h4><?= htmlspecialchars($comment->getPseudo());?></h4>
        <p><?= htmlspecialchars($comment->getContent());?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedAt());?></p>
        <?php
    }
    ?>

</div>