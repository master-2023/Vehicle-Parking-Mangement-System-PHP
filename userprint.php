<?php
session_start();
error_reporting(0);
include('db_connect.php');
if (strlen($_SESSION['vpmsuid']==0)) {
  header('location:userlogout.php');
  } else{


?>          
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">           
<?php
 $cid=$_GET['vid'];
$ret=mysqli_query($conn,"select * from parked_list where id='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
  ?>

<div  id="exampl">

      <table border="1" class="table table-bordered mg-b-0">
        <tr>
          <th colspan="4" style="text-align: center; font-size:22px;"> Vehicle Parking receipt</th>

        </tr>
   
   <tr>
                                <th>Parking Number</th>
                                   <td><?php  echo $row['location_id'];?></td>
                                              

                                <th>Vehicle Category</th>
                                   <td><?php  echo $row['category_id'];?></td>
                                   </tr>
                                   <tr>
                                <th>Vehicle Company Name</th>
                                   <td><?php  echo $packprice= $row['vehicle_brand'];?></td>
                             
                                <th>Registration Number</th>
                                   <td><?php  echo $row['vehicle_registration'];?></td>
                                   </tr>
                                   <tr>
                                    <th>Owner Name</th>
                                      <td><?php  echo $row['owner'];?></td>
                                  
                                       <th>Owner Contact Number</th>
                                        <td><?php  echo $row['phone_number'];?></td>
                                    </tr>
                                    <tr>
                               <th>In Time</th>
                                <td><?php  echo $row['date_created'];?></td>
    <th>Status</th>
    <td> <?php  
if($row['Status']=="in")
{
  echo "Incoming Vehicle";
}
if($row['Status']=="Out")
{
  echo "Outgoing Vehicle";
}

     ;?></td>
  </tr>
<?php if($row['Remark']!=""){ ?>
<tr>
<th>Out time</th>
<td><?php  echo $row['OutTime'];?></td>
<th>parking Charge</th>
<td><?php  echo $row['amount_tendered'];?></td>
</tr>
<tr>
  <th>Remark</th>
  <td colspan="3"><?php  echo $row['Remark'];?></td>

</tr>


<?php } ?>
  <tr>
    <td colspan="4" style="text-align:center; cursor:pointer"><i class="fa fa-print fa-2x" aria-hidden="true" OnClick="CallPrint(this.value)"  ></i></td>
  </tr>

</table>
            <?php }}  ?>
          </div>
            <script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script> 