<?php


class ControllerEmployees{

	/*=============================================
	USER LOGIN
	=============================================*/
	
	static public function ctrEmployeeLogin(){

		if (isset($_POST["loginUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"])) {

				//$encryptpass = crypt($_POST["loginPass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$table = 'employees';

				$item = 'username';
				$value = $_POST["loginUser"];

				$answer = EmployeesModel::MdlShowEmployees($table, $item, $value);

				//var_dump($answer);

				if($answer != null) {
                    if($answer["username"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPass"]){

                        if($answer["status"] == 1){
    
                            $_SESSION["loggedIn"] = "ok";
                            $_SESSION["id"] = $answer["id"];
                            $_SESSION["name"] = $answer["name"];
                            $_SESSION["user"] = $answer["username"];
                            $_SESSION["profile"] = $answer["profile"];
                            $_SESSION["department"] = $answer["department"];
    
                            
                            $lastLogin = "ok";
                            
                            if($lastLogin == "ok"){
    
                                echo '<script>
    
                                    window.location.href = "home";
    
                                </script>';
    
                            }
    
                        }else{
                            
                            echo '<br><div class="alert alert-danger">User is deactivated</div>';
                        
                        }
    
                    }else{
    
                        echo '<br><div class="alert alert-danger">User or password incorrect</div>';
                    
                    }
                }
			
			}
		
		}
	
	}


	/*=============================================
	CREATE USER
	=============================================*/
	
	static public function ctrCreateEmployee(){

		if (isset($_POST["newUser"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPasswd"])){



				$table = 'employees';

				$encryptpass = crypt($_POST["newPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$data = array('name' => $_POST["newName"],
							  'username' => $_POST["newUser"],
                              'company' => $_POST["newCompany"],
                              'location' => $_POST["newLocation"],
                              'department' => $_POST["newDepartment"],
							  'password' => $encryptpass,
							  'profile' => $_POST["newProfile"],
                            
								);

				$answer = EmployeesModel::mdlAddEmployees($table, $data);

				if ($answer == 'ok') {

						echo '<script>
						
						swal({
							type: "success",
							title: "¡User added succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						}).then(function(result){

							if(result.value){

								window.location.href = "employees";
							}

						});
						
						</script>';

				}
			
			}else{

				echo '<script>
					
					swal({
						type: "error",
						title: "No especial characters or blank fields",
						showConfirmButton: true,
						confirmButtonText: "Close"
			
						}).then(function(result){

							if(result.value){

								window.location = "employees";
							}

						});
					
				</script>';
			}
			
		}
	}

	/*=============================================
	SHOW Employees
	=============================================*/

	static public function ctrShowEmployees($item, $value){

		$table = "employees";

		$answer = EmployeesModel::MdlShowEmployees($table, $item, $value);

		return $answer;
	}

	// /*=============================================
	// EDIT USER
	// =============================================*/

	// static public function ctrEditEmployee(){

	// 	if (isset($_POST["EditUser"])) {
			
	// 		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditName"])){

	// 			/*=============================================
	// 			VALIDATE IMAGE
	// 			=============================================*/

	// 			$photo = $_POST["currentPicture"];

	// 			if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])){

	// 				list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);
					
	// 				$newWidth = 500;
	// 				$newHeight = 500;

	// 				/*=============================================
	// 				Let's create the folder for each user
	// 				=============================================*/

	// 				$folder = "views/img/users/".$_POST["EditUser"];

	// 				/*=============================================
	// 				we ask first if there's an existing image in the database
	// 				=============================================*/

	// 				if (!empty($_POST["currentPicture"])){
						
	// 					unlink($_POST["currentPicture"]);

	// 				}else{

	// 					mkdir($folder, 0755);

	// 				}

	// 				/*=============================================
	// 				PHP functions depending on the image
	// 				=============================================*/

	// 				if($_FILES["editPhoto"]["type"] == "image/jpeg"){

	// 					/*We save the image in the folder*/

	// 					$randomNumber = mt_rand(100,999);
						
	// 					$photo = "views/img/users/".$_POST["EditUser"]."/".$randomNumber.".jpg";
						
	// 					$srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);
						
	// 					$destination = imagecreatetruecolor($newWidth, $newHeight);

	// 					imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	// 					imagejpeg($destination, $photo);

	// 				}
					
	// 				if ($_FILES["editPhoto"]["type"] == "image/png") {

	// 					/*We save the image in the folder*/

	// 					$randomNumber = mt_rand(100,999);
						
	// 					$photo = "views/img/users/".$_POST["EditUser"]."/".$randomNumber.".png";
						
	// 					$srcImage = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);
						
	// 					$destination = imagecreatetruecolor($newWidth, $newHeight);

	// 					imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

	// 					imagepng($destination, $photo);
	// 				}

	// 			}

				
	// 			$table = 'users';

	// 			if($_POST["EditPasswd"] != ""){

	// 				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditPasswd"])){

	// 					$encryptpass = crypt($_POST["EditPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

	// 				}

	// 				else{

	// 					echo '<script>
					
	// 						swal({
	// 							type: "error",
	// 							title: "No especial characters in the password or blank fields",
	// 							showConfirmButton: true,
	// 							confirmButtonText: "Close"

	// 							}).then(function(result){
										
	// 								if (result.value) {
						
	// 									window.location = "users";

	// 								}
	// 							});
							
	// 					</script>';
	// 				}
				
	// 			}else{

	// 				$encryptpass = $_POST["currentPasswd"];
					
	// 			}

	// 			$data = array('name' => $_POST["EditName"],
	// 							'user' => $_POST["EditUser"],
	// 							'password' => $encryptpass,
	// 							'profile' => $_POST["EditProfile"],
	// 							'photo' => $photo);

	// 			$answer = EmployeesModel::mdlEditEmployees($table, $data);

	// 			if ($answer == 'ok') {
					
	// 				echo '<script>
					
	// 					swal({
	// 						type: "success",
	// 						title: "¡User edited succesfully!",
	// 						showConfirmButton: true,
	// 						confirmButtonText: "Close"

	// 					 }).then(function(result){
							
	// 						if (result.value) {

	// 							window.location = "users";
	// 						}

	// 					});
					
	// 				</script>';
	// 			}
	// 			else{
	// 				echo '<script>
						
	// 					swal({
	// 						type: "error",
	// 						title: "No especial characters in the name or blank field",
	// 						showConfirmButton: true,
	// 						confirmButtonText: "Close"
	// 						 }).then(function(result){
									
	// 							if (result.value) {

	// 								window.location = "users";
								
	// 							}

	// 						});
						
	// 				</script>';
	// 			}
			
	// 		}	
		
	// 	}
	
	// }

	// /*=============================================
	// DELETE USER
	// =============================================*/

	// static public function ctrDeleteEmployee(){

	// 	if(isset($_GET["userId"])){

	// 		$table ="users";
	// 		$data = $_GET["userId"];

	// 		if($_GET["userPhoto"] != ""){

	// 			unlink($_GET["userPhoto"]);				
	// 			rmdir('views/img/users/'.$_GET["username"]);

	// 		}

	// 		$answer = EmployeesModel::mdlDeleteEmployees($table, $data);

	// 		if($answer == "ok"){

	// 			echo'<script>

	// 			swal({
	// 				  type: "success",
	// 				  title: "The user has been succesfully deleted",
	// 				  showConfirmButton: true,
	// 				  confirmButtonText: "Close"

	// 				  }).then(function(result){
					  	
	// 					if (result.value) {

	// 					window.location = "users";

	// 					}
	// 				})

	// 			</script>';

	// 		}		

	// 	}

	// }
	
}
