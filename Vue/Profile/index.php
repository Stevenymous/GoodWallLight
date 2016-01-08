<!DOCTYPE html>
<html>
    <head>
    		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    		<link rel="stylesheet" href="Media/CSS/font-awesome-4.3.0/css/font-awesome.min.css"/>
    </head>
<body>
<?php $this->title = "GW L - Profile" ?>


GoodWall Lite contains currently <?= $this->secure($nbPosts) ?> post(s) and <?= $this->secure($nbComments) ?> comment(s)...
help us to increase and add new post !

<h1 class="userTitle">
	Welcome <?= $this->secure($profile['lastName'])." ".$this->secure($profile['firstName']) ?> !
</h1>

<div id="profileAddSchoolOrCompagny">
	<p>
		<i aria-hidden="true" class="fa fa-plus-square fa-2x"></i>
		<a id="addSchool" href="profile/schoolForm">School</a>
        <em>(You will be registered as a director of that school. If this is not you then you need to be registered as such.)</em>
	</p>
	<p>
		<i aria-hidden="true" class="fa fa-plus-square fa-2x"></i>
		<a id="addCompagny" href="profile/companyForm">Company</a>
	</p>
</div>

<h2>Your profile :</h2>

<p>Birth date : <?= $this->secure($profile['birthDate'])?></p>
<p>Gender : <?= $this->secure($profile['gender'])?></p>
<p>Location : <?= $this->secure($profile['location'])?></p>
<p>About yourself : <?= $this->secure($profile['about'])?></p>
<hr />

<h2>Companies created:</h2>
<?php foreach ($companiesCreated as $company):?>
    <article>
        <header>
            <a href="<?= "profile/companyProfile/" . $this->secure($company['id']) ?>">
                <h3>
                    <li>
                        <?= $this->secure($company['name'])." <i>( ".$this->secure($company['industrySector']).")</i>" ?>
                    </li> 
                </h3>
            </a>
        </header>
    </article>
<?php endforeach; ?>

<hr />

<h2>Schools created:</h2>
<?php foreach ($schoolsCreated as $school):?>
    <article>
        <header>
            <a href="<?= "profile/schoolProfile/" . $this->secure($school['id']) ?>">
                <h3>
                    <li>
                        <?= $this->secure($school['name'])." <i>( ".$this->secure($school['location']).")</i>" ?>
                    </li> 
                </h3>
            </a>
        </header>
    </article>
<?php endforeach; ?>

<hr />

<h2>Yours posts :</h2>
<hr />
<?php foreach ($userPosts as $post):?>
    <article>
        <header>
            <a href="<?= "post/index/" . $this->secure($post['id']) ?>">
                <h1>
                    <?= $this->secure($post['title']) ?> 
                </h1>
            </a>
            <time><?= $this->secure($post['date']) ?></time>
        </header>
        <p><?= $this->secure($post['content']) ?></p>
    </article>
    <hr />
<?php endforeach; ?>

<a id="signOut" href="connection/signOut">Sign out</a>
</body>