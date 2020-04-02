<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>

<body>

  <div id="main">
    <h1 id="header">Login</h1>
    
	
	<?php if (isset($_REQUEST["error"]) && $_REQUEST["error"] == 1): ?>
    <div id="login-error">
      <p id="login-error-msg">Invalid email and/or password. Please try again.</p>
    </div>
<?php endif; ?>
	

    <form id="login-form" method="POST" action="process.php">
      <input type="text" name="email" id="email-field" class="login-form-field" placeholder="Email">
      <input type="password" name="password" id="password-field" class="login-form-field" placeholder="Password">
      <input type="submit" value="Login" id="login-form-submit">
    </form>
  
  <a href="test-page.php"><button id="sign-up">Sign Up</button></a>
  </div>
  
  
</body>

</html>