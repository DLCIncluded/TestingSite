<?PHP
ini_set('display_errors', '1');
session_start();
include_once("dbConn.php");
include_once("accountFunctions.php");


		//*******************************************
		//*******************************************
		//*************FORM HANDLING*****************
		//*******************************************
		//*******************************************

	if(isset($_POST['login'])){ //handle logins
		echo login($_POST['username'],$_POST['pass'],$_POST['login']);
	}
	
	if(isset($_POST['register'])){
		$fName=$_POST['fName'];
		$lName=$_POST['lName'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		$birthday=$_POST['birthday'];
		$mcUsername=$_POST['mcUsername'];
		$authQ=$_POST['authQ'];
		$authA=$_POST['authA'];
		//echo "test";
		if($fName && $lName && $email && $username && $mcUsername && $pass1 && $pass2 && $birthday && $authQ && $authA){
		  
			if ($fName != "") {
				if ($lName != "") {
					if ($email != "") {
						if ($username != "") {
							if ($mcUsername != "") {
								if ($pass1 != "") {
									if ($pass2 != "") {
										if ($birthday != "") { 
											if ($authQ != "") {
												if ($authA != "") { // these are extraneous but still have to test for them to be safe
													
													
													
													$salt = md5($fName); //Create Salt for password crypt
													$password = crypt($pass1, '$2a$07$'.$salt.'$'); //Encrypt password using blowfish + salt just created
													
													$activeCode= md5($lName); //making the code for the activation
													
													//Inserting the user info into database
													$sql = "INSERT INTO Users VALUES (NULL,'".$fName ."','".$lName."','".$username."','".$password."','".$email."','".$mcUsername."','".$birthday."','BIO','".$authQ."','".$authA."',0,0,'".$activeCode."',0,0,0)"; 
													
													if ($connection->query($sql) === TRUE){
														//if it works, send the activation email
														//???? Still not working
														$subject = "Activate your Account on DLCIncluded's Website";
														
														$message = "Hello ".$fName.", Please click this link to activate your account: <a href='http://dlcincluded.com/testing/activate.php?username=".$username."&code=".$activeCode."'>http://dlcincluded.com/testing/activate.php?username=".$username."&code=".$activeCode."</a>.";
														
														$headers[] = "MIME-Version: 1.0";
														$headers[] = 'Content-type: text/html; charset=iso-8859-1';
														$headers[] = 'To: '.$email;
														$headers[] = 'From: DLCIncluded Admin <Admin@DLCIncluded.com>';
														
														mail($email, $subject, $message, implode("\r\n", $headers));
														
														Echo "You have successfully been registered, Please check your email to activate your account.(you might have to check your spam folder)";
													} else {
														Echo "Something has gone seriously wrong, please tell the Admin this(or try again):" . $sql . "<br>" . $connection->error;
													}

												} else {
													echo "Missing authA"; 
												}
											} else {
												echo "Missing authQ";
											}
										} else {
											echo "Missing Birthday";
										}
									} else {
										echo "Missing Repeated Password";
									}
								} else {
									echo "Missing Password";
								}
							} else {
								echo "Missing MC Username";
							}
						} else {
							echo "Missing Username";
						}
					} else {
						echo "Missing Email";
					}
				} else {
					echo "Missing Last Name";
				}
			
			} else {
				echo "Missing First Name";
			}
		}
	}
	
?>