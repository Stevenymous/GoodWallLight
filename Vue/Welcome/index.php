<?php $this->title = "GoodWall Lite"; ?>

<div>
    Already 
    <b><?= $this->secure($nbUsers) ?></b> members,
    <b><?= $this->secure($nbSchools) ?></b> schools,
    <b><?= $this->secure($nbCompanies) ?></b> companies.
    <a id="joinUs" href="<?= "connection/signup/"?>">Join us !</a>
</div>

<p id="lastNews">
    Profiles having just join us :
<p>

<p id="profilesJoinUs">Persons</p>
<?php foreach ($users as $user):
    ?>
    <article>
        <header>
            <a href="<?= "profile/index/" . $this->secure($user['userId']) ?>">
                <h1>
                    <?= $this->secure($user['lastName'])." ".$this->secure($user['firstName']) ?>
                </h1>
            </a>
            <i>Location : <?= $this->secure($user['location']) ?></i>
        </header>
        <p><?= $this->secure($user['about']) ?></p>
    </article>
    <hr />
<?php endforeach; ?>

<p id="profilesJoinUs">Schools</p>
<?php foreach ($schools as $school):
    ?>
    <article>
        <header>
            <a href="<?= "profile/index/" . $this->secure($school['schoolId']) ?>">
                <h1>
                    <?= $this->secure($school['name']) ?>
                </h1>
            </a>
        </header>
        <p><?= $this->secure($school['about']) ?></p>
    </article>
    <hr />
<?php endforeach; ?>

<p id="profilesJoinUs">Companies</p>
<?php foreach ($companies as $company):
    ?>
    <article>
        <header>
            <a href="<?= "profile/index/" . $this->secure($company['companyId']) ?>">
                <h1>
                    <?= $this->secure($company['name'])." (".$this->secure($company['industrySector']).")" ?>
                </h1>
            </a>
        </header>
    </article>
    <hr />
<?php endforeach; ?>

<p id="lastNews">
    Last Post :
<p>
<?php foreach ($posts as $post):
    ?>
    <article>
        <header>
            <a href="<?= "post/index/" . $this->secure($post['id']) ?>">
                <h1>
                    <?= $this->secure($post['title']) ?> 
                    by
                    <?= $this->secure($post['lastName']) ?>
                    <i> <?= $this->secure($post['firstName']) ?> <i>
                </h1>
            </a>
            <time><?= $this->secure($post['date']) ?></time>
        </header>
        <p><?= $this->secure($post['content']) ?></p>
    </article>
    <hr />
<?php endforeach; ?>
