<?php $this->title = "Commentaire"; ?>
<h1>Mon blog</h1>
<p>En construction</p>

<div>
    <h2><?= htmlspecialchars($comment->getPseudo());?></h2>
    <p><?= htmlspecialchars($comment->getContent());?></p>
    <p><?= htmlspecialchars($comment->getCreatedAt());?></p>

</div>
