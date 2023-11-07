<?php 
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['usertype'])){
  if($_SESSION['usertype'] == 1){
    header('location:home.php');
  }else{
    header('location:user.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login | PMS</title>
</head>
<body>
  <style>
    body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  height: 100vh;
  display: flex;
  justify-content: flex-end; /* Align the login container to the right */
  align-items: center;
  background: url("img/cover.png") center/cover no-repeat; /* Replace "your-image-url.jpg" with the URL or path to your image */
  
}

.lcontainer {
  width: 400px;
  background-color: rgba(255, 255, 255, 0.514); 
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-right: 30px;
}

h1{
  color: white;
  padding: 10px;
}

.login-box {
  margin:5%;
}

h2 {
  color: rgb(32, 32, 32);
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: rgb(32, 32, 32);
}

input {
  width: 90%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button {
  background-color: #4a90e2; /* Replace with your desired button color */
  color: #fff;
  width: 90%;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #3076b3; /* Replace with your desired button hover color */
}


  </style>
<div class="container2">
  <h1 class="welcom"><center><strong>Welcome to Online Prison Management System</strong></center></h1>
</div>

  <div class="lcontainer">
    <div class="login_processor-box">
      <h2 class="login_text">Login</h2>
      <?php if(isset($_SESSION['message'])) { echo "<p style='color:red;'>{$_SESSION['message']}</p>"; } ?>
      <form action="login_processor.php" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
 
</body>
</html>
