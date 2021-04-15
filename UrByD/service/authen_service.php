<?php
header('Content-Type: text/html; charset=utf-8');
require('../config.php');
require('../global_service/connectdb.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if($_POST["action"] == "login"){

        $username = $_POST['username'];
        $password = MD5($_POST['password']);

    	$strSQL = "SELECT * FROM aby_staff WHERE username = '".$username."'
    	and password = '".$password."'";
    	$objQuery = mysqli_query($conn,$strSQL);
    	$objResult = mysqli_fetch_array($objQuery);


    	if(!$objResult)
    	{
            echo "<script>";
            echo "alert('คุณใส่ Username หรือ Password ไม่ถูกต้อง!');";
            echo "window.location='/UrByD/login/login.php';";
            echo "</script>";
            exit();
            echo json_encode(false);
    	}
    	else
    	{
            if ($objResult['us_id'] == 1 )
            {
                if ($objResult['role_id'] == 1 )
                {
                    $redirectUrl = STAFF_URL ;
                }
                if ($objResult['role_id'] == 2)
                {
                    $redirectUrl = STAFF_URL ;
                }
               // if ($objResult['role_id'] == 3)
                //{
                  //  $redirectUrl = MANAGER_URL ;
                //}
                if ($objResult['role_id'] == 4)
                {
                    $redirectUrl = STAFF_URL ;
                }

                session_start();
                $_SESSION['authen'] = $objResult;
                session_write_close();
                header("location: " . $redirectUrl);
                exit(0);

            }else
    		    {
                echo "<script>";
                echo "alert('คุณไม่ได้รับอนุญาติ ในการใช้งาน');";
                echo "window.location='/UrByD/login/login.php';";
                echo "</script>";
                exit();
                echo json_encode(false);
                }
          
    	}
    }

    else if($_POST["action"] == "logout"){
        //$redirectUrl = (isset($_SESSION['authen']) && $_SESSION['authen']['role_id'] == 1) ? ADMIN_URL: URL;




        session_start();
        session_destroy();
        //header( "location: ".$redirectUrl );
        header("location:/UrByD");
    
        exit(0);
    }

}
?>