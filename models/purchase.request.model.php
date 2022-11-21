<?php

require_once 'connection.php';


class ModelPurchaseRequests{
	/*=============================================
	SHOWING SALES
	=============================================*/


	static public function mdlShowPurchaseRequests($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		//$stmt -> close();

		$stmt = null;

	}

		static public function mdlAddPurchaseRequest($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(id,requesting_date,requesting_time,person,department,purpose,urgency,filename)
		 VALUES (:id,:datePR, :timePR,:person, :department, :purpose, :urgencyPR, :filename)");

		$stmt->bindParam(":id", $data["idPR"], PDO::PARAM_INT);
		$stmt->bindParam(":datePR", $data["datePR"], PDO::PARAM_INT);
		$stmt->bindParam(":timePR", $data["timePR"], PDO::PARAM_INT);
		$stmt->bindParam(":person", $data["person"], PDO::PARAM_STR);
		$stmt->bindParam(":department", $data["department"], PDO::PARAM_STR);
		$stmt->bindParam(":purpose", $data["purpose-text"], PDO::PARAM_STR);
		$stmt->bindParam(":urgencyPR", $data["urgencyPR"], PDO::PARAM_STR);
		$stmt->bindParam(":filename", $data["filename"], PDO::PARAM_STR);

		$invoiceId = $data["idPR"];

		for ($a = 0; $a < count($_POST["itemName"]); $a++)
        {
           $stmt = Connection::connect()->prepare("INSERT INTO items(id, name, description,	measure, quantity)
		  VALUES ('$invoiceId', '" . $_POST["itemName"][$a] . "', '" . $_POST["itemDescription"][$a] . "','" . $_POST["UOM"][$a] . "', '" . $_POST["itemQuantity"][$a] . "') ");

		  $stmt->execute();
		   
        }

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//$stmt->close();
		$stmt = null;

	}

}