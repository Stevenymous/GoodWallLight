<?php $this->title = "GW L - Post" . $this->secure($post['title']); ?>

<article>
    <header>
        <h1><?= $this->secure($post['title']) ?></h1>
        <time><?= $this->secure($post['date']) ?></time>
    </header>
    <p><?= $this->secure($post['content']) ?></p>
</article>

<hr />

<header>
    <h1 id="answerTitle">Replies : </h1>
</header>

<?php foreach ($comments as $comment): ?>
    <p>
        - <?= $this->secure($comment['author'])?> - 
        <i><?= $this->secure($comment['date'])?></i> 
    </p>
    <p><?= $this->secure($comment['content']) ?></p>
<?php endforeach; ?>

<hr />

<form method="post" action="post/commenter">
    <input id="author" name="author" type="text" placeholder="Your Pseudo" 
           required /><br />
    <textarea id="txtComment" name="content" rows="4" 
              placeholder="Add a comment..." required></textarea><br />
    <input type="hidden" name="id" value="<?= $post['id'] ?>" />
    <input type="submit" value="Comment" disabled/>
</form>