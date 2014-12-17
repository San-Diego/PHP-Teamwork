<h3>Log in</h3>
<form method="POST" action="">
    <label>User name:</label>
    <input type="text" name="username"/><br />
    <label>Password:</label>
    <input type="password" name="password" /><br/>
    <input type="submit" value="Log in"/><br />
</form>
<?php if(isset($error)): ?>
    <p class="text-center alert alert-danger"><?php echo $error ?></p>
<?php endif ?>
