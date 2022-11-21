/*=============================================
ACTIVATE USER
=============================================*/
$(document).on("click", ".btnActivate", function(){

	var userId = $(this).attr("userId");
	var userStatus = $(this).attr("userStatus");

	var datum = new FormData();
 	datum.append("activateId", userId);
  	datum.append("activateUser", userStatus);

  	$.ajax({

	  url:"ajax/employees.ajax.php",
	  method: "POST",
	  data: datum,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
      	
      	// console.log("answer", answer);

      	if(window.matchMedia("(max-width:767px)").matches){
		
			swal({
				title: "The user status has been updated",
				type: "success",
				confirmButtonText: "Close"	
			}).then(function(result) {

				if (result.value) {
					window.location = "employees";
				}

			})

		}
		
      }

  	})

  	if(userStatus == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deactivated');
  		$(this).attr('userStatus',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activated');
  		$(this).attr('userStatus',0);

  	}

});


/*=============================================
VALIDATE IF USER ALREADY EXISTS
=============================================*/

$("#newUser").change(function(){

	$(".alert").remove();

	var user = $(this).val();

	var data = new FormData();
 	data.append("validateUser", user);

  	$.ajax({

	  url:"ajax/employees.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	// console.log("answer", answer);

      	if(answer){

      		$("#newUser").parent().after('<div class="alert alert-warning">This user is already taken</div>');
      		
      		$("#newUser").val('');
      	}

      }

    });

});

/*=============================================
DELETE USER
=============================================*/

$(document).on("click", ".btnDeleteUser", function(){

	var userId = $(this).attr("userId");
	var userPhoto = $(this).attr("userPhoto");
	var username = $(this).attr("username");

	swal({
		title: '¿Are you sure you want to delete the user?',
		text: "¡if you're not sure you can cancel!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancel',
		  confirmButtonText: 'Yes, delete user!'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=users&userId="+userId+"&username="+username+"&userPhoto="+userPhoto;

		}

	})

});
