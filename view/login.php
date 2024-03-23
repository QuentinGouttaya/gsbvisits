<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($_SESSION['login_error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_SESSION['login_error']); ?></p>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
    <form action="/login" method="post"> <!-- Submit to the login action of AuthenticationController -->
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required><br>

        <label for="mdp">Password:</label>
        <input type="password" name="mdp" id="mdp" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
