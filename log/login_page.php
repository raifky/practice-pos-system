<?php
session_start();
?>
<?php
include 'konek.php';

if(isset($_POST['login_btn'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $data_user = mysqli_query($konek, "SELECT * FROM login WHERE username = '$user' AND password = '$pass'");
    $r = mysqli_fetch_array($data_user);
    $username = $r['username'];
    $password = $r['password'];
    $level = $r['level'];
    if ($user == $username && $pass == $password){
        $_SESSION['level'] = $level;
        $_SESSION['login_time'] = time();
        header('location: ../public/dashboard.php');
    }else{
        header("location: login_page.php?error= <h5>Username atau password salah</h5>");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

     <!-- JavaScript Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

      <!-- <link rel="stylesheet" href="loginpage.css"> -->
      <style>
        .bmt_foto {
    width: 320px;
    
}
.login {
    position: relative;
    left: 500px;
    top: 70px;
    z-index: 2;
    width: 360px;
    height: min-content;
    padding: 20px;
    border-radius: 12px;
    background: white;
}

.img-belakang {
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    width: 115%;
}
      </style>
</head>
<body>
<img class="img-belakang" src="BMT-1.jpg" alt="">
    <div class="login">
        <div class="">
          <form action="" method="POST" class="needs-validation">
            <img class="bmt_foto" src="BMT-Logo-Normnal.jpg" alt="">
            <h1 class="text-center">Login</h1>
            <?php if(isset($_GET['error'])) {?>
                 <p class="error"><?php echo $_GET['error']; ?></p>
            <?php }
             ?>
            
              
           <div class="from-group was-validated">
                <label  class="form-lable" for="username">Username:</label>
                <input  class="form-control" name="username" value="" class="form-control" type="text" id="nama" Required>
                <div class="invalid-feedback">
                    Masukan Username
                </div>
            </div>

            <div class="from-group was-validated mb-2">
                <label class="form-lable"  for="password">Password:</label>
                <input class="form-control" name="password"class="form-control" type="password" id="password" Required>
                <div class="invalid-feedback">
                    Masukan Password
                </div>
            </div>

            <input name="login_btn" class="btn btn-success w-100" id="login_btn" type="submit" value="Login">

          </form>


        </div>
    </div>
    
</body>
</html>