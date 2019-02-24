<!DOCTYPE html>
<html lang="en">

<?php
// Include head
include 'inc/head.php';

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Lütfen, kullanıcı adınızı giriniz.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Lütfen kullanıcı şifrenizi giriniz.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Girmiş olduğunuz kullanıcı şifreniz hatalı.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Kullanıcı adınız hatalı ya da sistemimizde kayıtlı değil.";
                }
            } else{
                echo "Oops! Bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>


<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
method="post">
            <h1>Giriş Ekranı</h1>
            <div  class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <input type="email" class="form-control" 
name="username" placeholder="Kullanıcı E-Mail" required="" value="<?php echo $username; ?>" />
		<span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <input type="password" name="password" class="form-control" placeholder="Şifre" required="" />
		<span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div>
          <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Giriş">
            </div>

              <a class="reset_pass" href="#">Şifreyi unuttum?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-key" style="font-size: 26px;"></i> SiriCount v2.0!</h1>

                <p>©2019 Tüm Hakları Saklıdır. SiriCount v2.0!.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
