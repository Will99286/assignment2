<?php

?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
    <title>Sign Up</title>
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="signup.css" />
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
        document.querySelector("#signUpForm").addEventListener("submit", function(e){
          let password = document.querySelector("#password").value;
          let confirmPass = document.querySelector("#confirmPass").value;
          let email = document.querySelector("#email").value;
          console.log(email);
          if (password != confirmPass && !validateEmail(email)){
            e.preventDefault();
            document.querySelector("#errorMessages").innerHTML = "Passwords Don't Match and Email Don't match format";
          } else if (!validateEmail(email)){
            e.preventDefault();
            document.querySelector("#errorMessages").innerHTML = "Email Don't Match format";
          } else if (password != confirmPass){
            e.preventDefault();
            document.querySelector("#errorMessages").innerHTML = "Passwords Don't Match";
          }

        })

        function validateEmail(email) {
          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          console.log(re.test(String(email).toLowerCase()));
          return re.test(String(email).toLowerCase());
        }
      
    })
    </script>
  </head>
  <body>
    <main>
      <div class=signup >
        <h1>Sign UP</h1>
        <p id="errorMessages"></p>
        <form id="signUpForm" method="post" action="register.php">
          <label>First Name</label>
          <input
            type="text"
            placeholder="First Name"
            name="firstName"
            required
          />
          <label>Last Name</label>
          <input type="text" placeholder="Last Name" name="lastName" required />
          <label>City</label>
          <input type="text" placeholder="City" name="city" required />
          <label>Country</label>
          <input type="text" placeholder="Country" name="country" required />
          <label>Email</label>
          <input id="email" type="text" placeholder="Email" name="email" required />
          <label>Password</label>
          <input id="password" type="password" placeholder="Password" name="password" required/>
          <label>Confirm Password</label>
          <input id="confirmPass" type="password" placeholder="Confirm Password" name="confirmPass" required/>
          <input type="submit" id="submit" value="Sign Up" />
        </form>
      </div>
    </main>
  </body>
</html>
