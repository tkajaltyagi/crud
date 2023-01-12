
<?php

$conn= mysqli_connect("localhost","root","password","kajal");
if(!$conn){
    die("connection failed".mysqli_connect_error());
}


if(isset($_POST['submit'])){
    $Uname= $_POST["email"];
    $Password= $_POST["pwd"];


            try {
                if (empty($email)) {
                    throw new Exception("Please enter your email", 123);
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Please enter valid email", 124);
                }
                if (empty($pwd)) {
                    throw new Exception("Please enter your password", 125);
                }
                if (!empty($email) && !empty($pwd)) {
                    $sql = " SELECT * FROM `trycatch` WHERE `email` = '$Uname' AND `password` = ('$Password') AND `soft_delete` = '1' ";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
        
                    // Check for login successfully!
                    if ($num != 1) {
                        throw new Exception("Please enter correct details for login...", 126);
                    } 
                }
            } 
            catch (Exception $e) {
                $data = array(
                    "status"     => false,
                    "error_code"  => $e->getCode(),
                    "error"  => $e->getMessage(),
                );
                echo json_encode($data);
                die();
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
}

.form-inline button:hover {
  background-color: royalblue;
}

@media (max-width: 800px) {
  .form-inline input {
    margin: 10px 0;
  }
  
  .form-inline {
    flex-direction: column;
    align-items: stretch;
  }
}
</style>
</head>
<body>
    

<div class="container">
    <div class="row">
        <div class="col">
        <form class="form-inline" action="" id="form1" name="form1" method="POST">
        <div class="valid"></div>
            <div class="invalid"></div>
  <label for="email">Email:</label>
  <input type="email" id="email" placeholder="Enter email" name="email">
  <span class="msg"><?php echo $error_Uname; ?></span>

  <label for="pwd">Password:</label>
  <input type="password" id="pwd" placeholder="Enter password" name="pwd">
  <span class="msg"><?php echo $error_Password; ?></span>

  <label>
    <input type="checkbox" name="remember"> Remember me
  </label>
  <button type="submit" id="btn1" name="btn1" name="submit">Submit</button>
</form>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('form1').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: '',
            type: 'post',
            data: $(this).serialize(),
            success: function (response) {
                var json = $.parseJSON(response);
                if (json.status == false) {
                    $('.invalid').show();
                    $('.valid').hide();
                    $('.invalid').html('');
                    $('.invalid').append(response);
                } else {
                    $('.valid').show();
                    $('.invalid').hide();
                    $('.valid').html('');
                    $('.valid').append(response);
                }
            }
        });

    });
});
</script>
</body>
</html>



