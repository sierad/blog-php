<?php $this->title = "Modifié commentaire"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=editComment&commentId=<?= $comment->getId();?>">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= $comment->getPseudo(); ?>"><br>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content"><?= $comment->getContent(); ?></textarea><br>
        <input type="hidden" value="<?= $comment->getId(); ?>" id="hidden" name="id">
        <input type="hidden" value="<?= $comment->getArticleId(); ?>" id="hidden" name="articleId">
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
</div>