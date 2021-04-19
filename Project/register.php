<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Basic.css" >
    <title>Login</title>
</head>
<body>
<div >
<br>
    <form action="checkpass.php" method="GET">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <center>
                    <div class="card h-100">
                        <div class="card-body">
                            <h1>REGISTER</h1>
                            <br>   
                            <h5>USERNAME : <input type="text" name="user" size="40"></h5>
                            <br>
                            <h5>PASSWORD : <input type="password" name="password" size="40"></h5>
                            <br>
                            <h5>RE-PASSWORD : <input type="password" name="repassword" size="40"></h5>
                            <br>
                            <div class="card-footer">
                            <a href="login"><button class="btn btn-primary">CANCLE</button></a>
                            <input class="btn btn-primary" name="btnSubmit" type="Submit" value="SIGN UP">
                            </div>
                        </div>
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </form>
</div>
    
</body>
</html>