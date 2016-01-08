<?php $this->title = "GW L - School profile"?>

<article>
    <header>
        <h1>
        	<?= $this->secure($school['name']) ?>
        </h1>
    </header>
    
	<p>Location: <?= $this->secure($school['location'])?></p>
    <p>Creation date: <?= $this->secure($school['creationDate']) ?></p>
    <p>Students: <?= $this->secure($school['studentsNumber']) ?></p>
    <p>Teachers: <?= $this->secure($school['teachersNumber'])?></p>
    <p><?= $this->secure($school['about']) ?></p>
</article>