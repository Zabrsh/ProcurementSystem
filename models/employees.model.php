<?php

require_once "connection.php";

class EmployeesModel{

	/*=============================================
	SHOW Employee 
	=============================================*/

	static public function MdlShowEmployees($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();

			
		}

		//$stmt -> close();

	$stmt = null;

	}


	/*=============================================
	ADD USER 
	=============================================*/	

	static public function mdlAddEmployees($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(name, username,password,company,location,department,level ) VALUES
         (:name, :username,:password,:company, :location, :department, :level)");

		$stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":username", $data["username"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":company", $data["company"], PDO::PARAM_STR);
		$stmt -> bindParam(":location", $data["location"], PDO::PARAM_STR);
        $stmt -> bindParam(":department", $data["department"], PDO::PARAM_STR);
		$stmt -> bindParam(":level", $data["profile"], PDO::PARAM_STR);
		

		if ($stmt->execute()) {
			
			return 'ok';
		
		} else {
			
			return 'error';
		}
		
		//$stmt -> close();

		$stmt = null;
	}


	// /*=============================================
	// EDIT USER 
	// =============================================*/

	// static public function mdlEditEmployees($table, $data){

	// 	$stmt = Connection::connect()->prepare("UPDATE $table set name = :name, password = :password, profile = :profile, photo = :photo WHERE user = :user");

	// 	$stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":user", $data["user"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);
	// 	$stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_STR);

	// 	if ($stmt->execute()) {
			
	// 		return 'ok';
		
	// 	} else {
			
	// 		return 'error';
		
	// 	}
		
	// 	//$stmt -> close();

	// 	$stmt = null;
	// }


	// /*=============================================
	// UPDATE USER 
	// =============================================*/

	// static public function mdlUpdateEmployees($table, $item1, $value1, $item2, $value2){

	// 	$stmt = Connection::connect()->prepare("UPDATE $table set $item1 = :$item1 WHERE $item2 = :$item2");

	// 	$stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
	// 	$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);

	// 	if ($stmt->execute()) {
			
	// 		return 'ok';
		
	// 	} else {

	// 		return 'error';
		
	// 	}
		
	// 	$stmt -> close();

	// 	$stmt = null;
	// }

	// /*=============================================
	// DELETE USER 
	// =============================================*/	

	// static public function mdlDeleteEmployees($table, $data){

	// 	$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

	// 	$stmt -> bindParam(":id", $data, PDO::PARAM_STR);

	// 	if ($stmt->execute()) {
			
	// 		return 'ok';
		
	// 	} else {

	// 		return 'error';
		
	// 	}
		
	// 	$stmt -> close();

	// 	$stmt = null;
	// }

}