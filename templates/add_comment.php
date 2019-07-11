<?php $this->title = "Nouvel article"; ?>
<div>
    <form method="post" action="../public/index.php?route=addComment">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content"></textarea><br>
        <?= isset($errors['content']) ? $errors['content'] : ''; ?>
        <input type="hidden" value="<?= $article->getId(); ?>" id="hidden" name="articleId">
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
</div>