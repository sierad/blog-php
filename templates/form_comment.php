<?php
$route = isset($post)&&$post->get('id')?'editComment&commentId=' .$post->get('id') : 'addComment';
$submit = $route === 'addComment'? 'Encoyer' : 'Mise à jours';
?>


<div>
    <form method="post" action="../public/index.php?route=<?= $route; ?>>">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= isset($post)? htmlspecialchars($post->get('pseudo')):'';?>"><br>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content"><?= isset($post)? htmlspecialchars($post->get('content')):'';?></textarea><br>
        <input type="hidden" value="<?= isset($post)? htmlspecialchars($post->get('id')):'';?>" id="hidden" name="id">
        <input type="hidden" value="<?= isset($post)? htmlspecialchars($post->get('article_id')):'';?>" id="hidden" name="articleId">
        <input type="submit" value=<?= $submit;?> id="submit" name="submit">
    </form>
</div>

<a href="../public/index.php">Retour à l'accueil</a>
