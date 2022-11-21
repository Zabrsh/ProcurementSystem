<?php

class ControllerPurchaseRequest{

	/*=============================================
	SHOW PR
	=============================================*/

	static public function ctrShowPurchaseRequest($item, $value){

		$table = "purchase_requests";

		$answer = ModelPurchaseRequests::mdlShowPurchaseRequests($table, $item, $value);

		return $answer;

	}

	/*=============================================
	CREATE PR
	=============================================*/

	static public function ctrCreatePurchaseRequest(){

		if(isset($_POST["newPR"])){
    
			/*=============================================
				VALIDATE File
				=============================================*/

				$document = "";
			
				if (isset($_FILES["newFile"]["tmp_name"])){


					$folder = "views/img/pr/".$_POST["newPR"];

					mkdir($folder, 0755);
					
				}
			
			/*=============================================
			SAVE THE PR
			=============================================*/	

			$table = "purchase-requests";

			$data = array("idPR"=>$_POST["newPR"],
						   "datePR"=>$_POST["newDate"],
						   "timePR"=>$_POST["newTime"],
						   "urgencyPR"=>$_POST["urgency"],
						   "department"=>$_POST["department"],
						   "person"=>$_POST["person"],
						   "purpose-text"=>$_POST["purpose-text"],
						   "filename"=>$document);

			$answer = ModelPurchaseRequests::mdlAddPurchaseRequest($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "PR succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "Confirm"
					  }).then((result) => {
								if (result.value) {

								window.location = "purchase-request";

								}
							})

				</script>';

			}

		}

	}



}