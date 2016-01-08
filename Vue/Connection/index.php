<?php $this->title = "GW L - Connection" ?>

<p>You must be logged in to access this page</p>

<form action="connection/connection" method="post">
    <input name="email" type="text" placeholder="E-mail" required autofocus>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">LOGIN !</button>
</form>

<?php if (isset($errorMessage)): ?>
    <p><?= $errorMessage ?></p>
<?php endif; ?>