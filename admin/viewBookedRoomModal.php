<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">


          <h2>
            Extend Confirmation
          </h2>
          <br>
          <br>

          <div class="table-responsive">

            <table class="table">

              <tr>
                <th>Room No.</th>
                <th colspan="2"><span id="mrnum">
                    <?php echo $_SESSION['reserved_room_info']['room_number']?>
                  </span> </th>

              </tr>

              <tr>
                <th>
                  Type
                </th>
                <th colspan="2">
                  <span id="mtype">
                    <?php echo $_SESSION['room_type'] ?>
                  </span>
                </th>
              </tr>

              <tr>
                <th>Date Check-in: </th>
                <th colspan="2">
                  <?php echo date_format(date_create($_SESSION["orig_cin"]), 'M d, Y h:i:s a'); ?>
                </th>
              </tr>
              <tr>
                <th>Original Checkout Date: </th>
                <th colspan="2">
                  <?php
                  if (!is_null($_SESSION["orig_extended_cout"])) {
                    echo date_format(date_create($_SESSION["orig_extended_cout"]), 'M d, Y h:i:s a');
                  } else {
                   echo date_format(date_create($_SESSION["orig_cout"]), 'M d, Y h:i:s a');
                  }

                  ?>
                </th>
               

                
              </tr>
              <tr>
              <th> </th>
              <th colspan="2" style="text-align: center;">
                  <?php echo "Total of " . $_SESSION["orig_num_days"]; ?>
                </th>
              </tr>
              <tr>
                <th>Price Paid: </th>
                <th>
                  <?php
                  echo   "&#8369; ".$_SESSION['current_room_info']["price"] . " per/day";
                  ?>
                </th>
                <th>
                  <?php echo "Total of "."&#8369; " . intval( $_SESSION['current_room_info']["price"])  * intval($_SESSION["orig_num_days"]) ; ?>
                </th>

                
              </tr>

            </table>
            <br> <br> <br>
            <p>Extend Info</p>
            <table class="table">

              <tr>
                <th>New Date Checkout</th>
                <th colspan="2" id="mncout">

                </th>
              </tr>
              <tr>
                <th>Days to Add</th>
                <th colspan="2" id="dayadd">

                </th>
              </tr>

              <tr>
                <th>Additional Payment</th>
                <th colspan="4" id="maddtot">

                </th>
              </tr>

              <tr>
                <th colspan="4" id="maddtot" style="text-align: center;">
                  <br>
                  <button type="button" id="mconfirm" class="btn btn-secondary" style=" padding: 1rem;">
                    Confirm

                  </button>
                  <script>
                    document.getElementById("mconfirm").onclick = function(){
                      document.getElementById("submit2").click()
                    }
                  </script>
                </th>
              </tr>


            </table>


          </div>




        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>