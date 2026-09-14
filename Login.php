<?php
    
	require_once "includes/Session.class.php";
    SessionManager::sessionStart('admin');
    require_once('includes/ini.php');
    global $CON_SQL;
    global $ums_fun;

    if(isset($_POST['login']) and filter_var($_POST['txtusername'], FILTER_VALIDATE_EMAIL)) {

		    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
		    $check_email = (preg_match($pattern, $_POST['txtusername']))?$_POST['txtusername']:"";
		    $email= $ums_fun->test_input_ums($check_email);
			
		    $check_password=$ums_fun->test_input_ums($_POST['txtpassword']);
		    $password = htmlspecialchars(md5(sha1(md5(sha1($check_password)))));
			
			
			if(!empty($email) and !empty($password)) {
	 
                $stmt = $CON_SQL->query_prepare('select *  from tbl_user where u_email=? and u_pass=?','ss',$email,$password);
	            $isuser=$CON_SQL->query_stmt_result($stmt);
  
                    if(isset($isuser['u_id']) and $isuser['u_id']>0){	
 
                        $id=$isuser['u_id'];
                        $user_name =$isuser['u_name'];
                        $f_email =$isuser['u_email'];
                        $pass =$isuser['u_pass'];
                        $type =$isuser['u_actv'];
						
						
                        if($f_email==$email and $pass==$password and $type==1){
							
                            $_SESSION ['admin'] =$user_name;
                            $_SESSION ['admin_id'] =$id;
                            $_SESSION ['type'] = $type;
							
							$log_os=((preg_match('/win/i',PHP_OS)?"WIN":"LIN"));
							$CON_SQL->query("insert into tblums_login values(null,$_SESSION[admin_id],'$_SESSION[admin]','$_SERVER[REMOTE_ADDR]','$log_os','$_SERVER[HTTP_USER_AGENT]', Now(),Now(),'')");
	                       
						    header ("location: ./");
                            echo "<meta http-equiv='refresh' content='0; url = ./' />";
							
	                    }else
	                        header("location:Loqin.php");
						
						
                    }else
                        header("location:Loqin.php");
 

            }else
				include('logn.php'); 
			 
        
    }  
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>UMS</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.rtl.css">
  <link rel="stylesheet" href="./css/style.min.css">
   <link rel="stylesheet" href="./css/home.css">
 
</head>
<body style="background-color:#ffffff;">
 
	    <div class="layer"></div>
<main class="page-center">

	  

 <hr>
  <article class="sign-up">
  <div class="login-logo text-center">
<img src="images/logo.webp" >
</div>
<br>
    <p class="sign-up__subtitle">Sign in to your account to continue</p>
	<hr>
	
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label class="form-label-wrapper">
        <p class="form-label">Email</p>
        <input class="form-input" name="txtusername"  type="email" placeholder="Enter your email" required>
      </label>
      <label class="form-label-wrapper">
        <p class="form-label">Password</p>
        <input class="form-input" type="password" name="txtpassword"  placeholder="Enter your password" required>
      </label>
     
      <button type="submit" name="login" class="form-btn primary-default-btn transparent-btn">Sign in</button>
	    
     </form>
  </article>

  
</main>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
 

 
	</body>
</html>