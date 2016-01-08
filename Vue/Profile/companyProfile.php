<?php $this->title = "GW L - Company profile"?>

<article>
    <header>
        <h1>
        	<?= $this->secure($company['name']) ?>
        </h1>
    </header>
    
	<p>Industry sector: <?= $this->secure($company['industrySector']) ?></p>
	<p>Creation date: <?= $this->secure($company['creationDate']) ?></p>
	<p>Company Owner: <?= $this->secure($company['companyOwner'])?></p>
	<p>Location: <?= $this->secure($company['location'])?></p>
    <p><?= $this->secure($company['about']) ?></p>
</article>