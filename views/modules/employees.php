
<div class="content-wrapper">

<section class="content-header">

  <h1>

    Employee management

  </h1>

  <ol class="breadcrumb">

    <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

    <li class="active">Dashboard</li>

  </ol>

</section>

<section class="content">

  <div class="box">

    <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">

        Add user

      </button>

    </div>

    <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tables" width="100%">
     
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Name</th>
           <th>Username</th>
           <th>Comapany</th>
           <th>Location</th>
           <th>Department</th>
           <th>Level</th>
           <th>Status</th>
           <th>Actions</th>

         </tr> 

        </thead>

        <tbody>

          <?php

            $item = null; 
            $value = null;

            $users = ControllerEmployees::ctrShowEmployees($item, $value);

            // var_dump($users);

            foreach ($users as $key => $value) {

              echo '

                <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["name"].'</td>
                  <td>'.$value["username"].'</td>
                  <td>'.$value["company"].'</td>
                  <td>'.$value["location"].'</td>
                  <td>'.$value["department"].'</td>
                  <td>'.$value["level"].'</td>
                  ';
                  

                  if($value["status"] != 0){

                    echo '<td><button class="btn btn-success btnActivate btn-xs" userId="'.$value["id"].'" userStatus="0">Activated</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btnActivate btn-xs" userId="'.$value["id"].'" userStatus="1">Deactivated</button></td>';
                  }
                  
                  echo '

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditUser" idUser="'.$value["id"].'" data-toggle="modal" data-target="#editUser"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnDeleteUser" idUser="'.$value["id"].'" username="'.$value["username"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
            }

          ?>

        </tbody>

      </table>

    </div>
  
  </div>

</section>

</div>

<!--=====================================
=            module add user            =
======================================-->

<!-- Modal -->
<div id="addUser" class="modal fade" role="dialog">

<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">

    <form role="form" method="POST" enctype="multipart/form-data">

      <!--=====================================
      HEADER
      ======================================-->

      <div class="modal-header" style="background: #3c8dbc; color: #fff">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add user</h4>

      </div>

      <!--=====================================
      BODY
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!--Input name -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input class="form-control input-lg" type="text" name="newName" placeholder="Add name" required>

            </div>

          </div>

          <!-- input username -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input class="form-control input-lg" type="text" id="newUser" name="newUser" placeholder="Add username" required>

            </div>

          </div>

          <!-- input password -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              <input class="form-control input-lg" type="password" name="newPasswd" placeholder="Add password" required>

            </div>

          </div>

          <!-- input company -->

         <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <select class="form-control input-lg" name="newCompany">

                <option value="">Select Company</option>
                <option value="TAF OIL Ethiopia">TAF OIL Ethiopia</option>
                <option value="SOTEN industrial Engineering"> SOTEN Industrial Engineering</option>
                <option value="HENITEN Construction PLC">Heniten Construction PLC</option>
                <option value="TEAM Liquid Transport">TEAM Liquid Transport</option>
                <option value="Akaki Ware House">Akaki ware house</option>


              </select>

            </div>

          </div>

          <!-- input location -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input class="form-control input-lg" type="text" name="newLocation" placeholder="Add Location" required>

            </div>

          </div>

          <!-- input Departement -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input class="form-control input-lg" type="text"  name="newDepartment" placeholder="Add Department" required>

            </div>

          </div>
          <!-- input profile -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <select class="form-control input-lg" name="newProfile">

                <option value="">Select profile</option>
                <option value="administrator">System Administrator</option>
                <option value="Manager"> Manager</option>
                <option value="Level 1">Level 1</option>
                <option value="Level 2">Level 2</option>

              </select>

            </div>

          </div>

          

      </div>

      <!--=====================================
      FOOTER
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Save</button>
        
      </div>

        <?php
          $createUser = new ControllerEmployees();
          $createUser -> ctrCreateEmployee();
        ?>

    </form>

  </div>

</div>

</div>
<!--====  End of module add user  ====-->

<!--=====================================
=            module edit user            =
======================================-->

<!-- Modal -->
<div id="editUser" class="modal fade" role="dialog">

<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">

    <form role="form" method="POST" enctype="multipart/form-data">

      <!--=====================================
      HEADER
      ======================================-->

      <div class="modal-header" style="background: #3c8dbc; color: #fff">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit user</h4>

      </div>

      <!--=====================================
      BODY
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <!--Input name -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-user"></i></span>

              <input class="form-control input-lg" type="text" id="EditName" name="EditName" placeholder="Edit name" required>

            </div>

          </div>

          <!-- input username -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <input class="form-control input-lg" type="text" id="EditUser" name="EditUser" placeholder="Edit username" readonly>

            </div>

          </div>

          <!-- input password -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-lock"></i></span>

              <input class="form-control input-lg" type="password" name="EditPasswd" placeholder="Add new password">

              <input type="hidden" name="currentPasswd" id="currentPasswd">

            </div>

          </div>

          <!-- input profile -->
          <div class="form-group">

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-key"></i></span>

              <select class="form-control input-lg" name="EditProfile">

                <option value="" id="EditProfile"></option>
                <option value="administrator">Administrator</option>
                <option value="special">Special</option>
                <option value="seller">Seller</option>

              </select>

            </div>

          </div>

          <!-- Uploading image -->
          <div class="form-group">

            <div class="panel">Upload image</div>

            <input class="newPics" type="file" name="editPhoto">

            <p class="help-block">Maximum size 2Mb</p>

            <img class="thumbnail preview" src="views/img/users/default/anonymous.png" alt="" width="100px">

            <input type="hidden" name="currentPicture" id="currentPicture">

          </div>

        </div>

      </div>

      <!--=====================================
      FOOTER
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Edit User</button>
        
      </div>

        <?php
        //   $editUser = new ControllerEmployees();
        //   $editUser -> ctrEditEmployee();
        ?>

    </form>

  </div>

</div>

</div>

<?php

// $deleteUser = new ControllerEmployees();
// $deleteUser -> ctrDeleteEmployee();

?> 