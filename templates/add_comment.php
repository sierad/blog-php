<?php $this->title = "Nouvel article"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=addComment">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo"><br>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content"></textarea><br>
        <input type="hidden" value="<?= $article->getId(); ?>" id="hidden" name="articleId">
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
</div>