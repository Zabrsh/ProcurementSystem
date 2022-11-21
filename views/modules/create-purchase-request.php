<?php

if ($_SESSION["profile"] == "Special") {

  echo '<script>

    window.location = "home";

  </script>';

  return;
}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Purchase Request

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Create PR</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=============================================
      THE FORM
      =============================================-->
      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post">

            <div class="box-body">

              <div class="box">
                <div class="row">

                  <!--=====================================
                  DATE AND TIME
                  ======================================-->

                  <div class="col-xs-12 pull-left">

                    <table class="table">

                      <thead>
                        <th>PR-Number</th>
                        <th>Date</th>
                        <th>Time</th>

                      </thead>


                      <tbody>

                        <tr>

                          <td style="width: 100%">

                            <div class="input-group">

                              <?php

                              $item = null;
                              $value = null;


                              $row = ControllerPurchaseRequest::ctrShowPurchaseRequest($item, $value);


                              $number = "PR-0000001";

                              if (!$row) {

                                echo '<input type="text" class="form-control" name="newPR"  value="' . $number . '" readonly> ';
                              } else {

                                foreach ($row as $key => $value) {
                                }

                                $lastid = $value['id'];
                                $idd = str_replace("PR-", "", $lastid);
                                $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                                $number = 'PR-' . $id;
                                //var_dump($number);
                                echo '<input type="text" class="form-control" name="newPR"  value="' . $number . '" readonly> ';
                              }
                              ?>



                            </div>
                          <td style="width: 50%">

                            <div class="input-group">
                              <input type="date" class="form-control" name="newDate" value="<?php echo date('Y-m-d'); ?>" readonly />


                            </div>
                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-time"></i></span>

                              <?php
                              ini_set('date.timezone', 'Africa/Nairobi');
                              $time = date("H:i:s");

                              echo '<input type="time" class="form-control" name="newTime" value="' . $time . '" readonly>';
                              ?>

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <hr>
                  <!--=====================================
                    =            Urgency           =
                    ======================================-->
                  <div class="col-xs-6" style="padding-right: 0">

                    <div class="input-group">

                      <select class="form-control" name="urgency" required>

                        <option value="">Specify Urgency</option>
                        <option value="3">Top Urgent</option>
                        <option value="2">Urgent</option>
                        <option value="1">Normal</option>

                      </select>

                    </div>

                  </div>

                </div>

                <br>
                <!--=====================================
                    =            Department           =
                    ======================================-->


                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-department"></i></span>

                    <input type="text" class="form-control" name="department" id="newSeller" value="<?php echo $_SESSION["department"]; ?>" readonly>

                  </div>

                </div>


                <!--=====================================
                    Requesting person
             ======================================-->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-department"></i></span>

                    <input type="text" class="form-control" name="person" value="<?php echo $_SESSION["name"]; ?>" readonly>

                  </div>

                </div>

                <div class="form-group">

                  <div class="input-group">

                    <label for="PR Purpose">Purpose</label>

                    <textarea class="form-control" name="purpose-text" id="" cols="70" rows="3"></textarea>


                  </div>


                </div>

                <!--=====================================
                =            Attaching file          =
                 ======================================-->
                <div class="form-group">
                  <label for="Purchase File">Attach File</label>
                  <input type="file" class="newFile" name="newFile">
                  <p class="help-block">Maximum Size 2Mb</p>
                </div>

                <div class="form-group row newItem"></div>

                <br>

              </div>

            </div>
            


            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>

          <?php

          $savePurchaseRequest = new ControllerPurchaseRequest();
          $savePurchaseRequest -> ctrCreatePurchaseRequest();

          ?>

        </div>

      </div>


      <!--=============================================
      =            ITEMS TABLE                   =
      =============================================-->


      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
          
          <button type="button" class="btn btn-primary pull-right" onclick="addItem();">Add ITEM</button>
          <br>
          <br>
            <table class="table table-bordered table-striped dt-responsive salesTable">

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>


                    <th>Item Name</th>
                    <th>Description</th>
                    <th>UOM</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
              </table>

            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

