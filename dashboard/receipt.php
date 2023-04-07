<?php
include('../includes/connection.php');
session_start();
if (!isset($_SESSION['id'])) {
   header("Location: login.php");
}
$receiptId = $_GET["id"];
$sql2 = "SELECT receipt.session,receipt.remark, receipt.date,receipt.datetime,receipt.convenience_charge_amount,receipt.exam_fee_amount,receipt.fee_month,receipt.convenience_fee_month,receipt.total_paying_amount,receipt.checkNumber,receipt.checkDate,receipt.balance_amount,class.class_name,
 admission.section_id,admission.roll_no,admission.name,admission.father_name,admission.section_id,receipt.offline_payment_amount,receipt.online_payment_amount FROM ((receipt
  INNER JOIN admission ON receipt.student_id=admission.id)
  INNER JOIN class ON class.id=admission.class_id)
  where receipt.id='$receiptId'";
$res2 = mysqli_query($conn, $sql2);
while ($row = mysqli_fetch_array($res2)) {
   $section_id = $row['section_id'];
   $session = $row['session'];
   $convenience_fee_month = $row["convenience_fee_month"];
   $datetime = $row['datetime'];
   $fee_month = $row["fee_month"];
   $section = $row["section"];
   $roll_no = $row["roll_no"];
   $remark = $row["remark"];
   $name = $row["name"];
   $class = $row["class_name"];
   $father_name = $row["father_name"];
   $convenience_charge_amount = $row["convenience_charge_amount"];
   $exam_fee_amount = $row["exam_fee_amount"];
   $total_paying_amount = $row["total_paying_amount"];
   $balance_amount = $row["balance_amount"];
   $offline_payment_amount = $row["offline_payment_amount"];
   $online_payment_amount = $row["online_payment_amount"];
   $checkNumber = $row["checkNumber"];
   $checkDate = $row["checkDate"];
}
?>
<?php include 'header.php'; ?>
<style>
   .receipt_copy {
      /* float: right; */
      text-align: center;
      margin-bottom: 10px;
      color: blue;
      font-weight: bold;
   }
</style>
<main id="main" class="main">
   <div class="pagetitle">
      <h1>Payment Receipt </h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active">Payment Receipt</li>
         </ol>
      </nav>
   </div>
   <section class="section">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="printpage" id="printpage">
                  <div class="card-body">
                     <div id="receipt-print">
                        <div class="schoollogon">
                           <div class="row">
                              <div class="col-lg-12">
                                 <?php
                                 include '../includes/connection.php';
                                 $id = $_SESSION['id'];
                                 $mydata = "SELECT * FROM school WHERE id = '$id'";
                                 $myresult = mysqli_query($conn, $mydata);
                                 if (mysqli_num_rows($myresult) > 0) {
                                    while ($row = mysqli_fetch_assoc($myresult)) {
                                 ?>
                                       <div class="print-page">
                                          <div class="main-block">
                                             <div class="logo-left">
                                                <div class="logo-icon"><img src="upload/<?php echo $row['logo']; ?>" class="img-responsive"></div>
                                             </div>
                                             <div class="logo-content">
                                                <div class="receipt_copy">Copy</div>
                                                <div class="logo-title">
                                                   <h1><?php echo strtoupper($row['name']); ?>
                                                   </h1>
                                                </div>
                                                <div class="tagline"><?php echo ucwords($row['tagline']); ?></div>
                                                <div class="address">
                                                   <h3><?php echo strtoupper($row['address']); ?></h3>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="email-id">
                                             <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                                          </div>
                                          <div class="website">
                                             <p><strong>Website:</strong> <?php echo $row['website']; ?></p>
                                          </div>
                                          <div class="phone">
                                             <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
                                          </div>
                                          <div class="ids">
                                             <div class="aff">
                                                <p><strong>Affiliation ID:</strong> <?php echo $row['affiliation_id']; ?></p>
                                             </div>
                                             <div class="aff text-right">
                                                <p><strong>School Affiliation:</strong> <?php echo $row['schoolaffiliation']; ?></p>
                                             </div>
                                          </div>
                                       </div>
                                 <?php
                                    }
                                 } else {
                                    echo "<div class='alert alert-danger'>No Records Found</div>";
                                 }
                                 ?>
                              </div>
                           </div>
                        </div>
                        <div class="print-data">
                           <div class="top-head">
                              <div class="toprow">
                                 <div class="block">
                                    <p class="border-bottom"><strong>Date</strong><span><?php echo $datetime; ?></span></p>
                                 </div>
                                 <div class="block">
                                    <h2>Fee Receipt<span><strong class="alert-success">Session</strong><?php echo $session; ?></span></h2>
                                 </div>
                                 <div class="block">
                                    <p class="border-bottom"><strong>Receipt No</strong><span> <?php echo $receiptId; ?></span></p>
                                 </div>
                              </div>
                           </div>
                           <div class="receipt-date">
                              <form>
                                 <div class="inforow">
                                    <div class="block">
                                       <p class="border-bottom"><strong>Class</strong><span><?php echo $class; ?></span></p>
                                    </div>
                                    <div class="block">
                                       <p class="border-bottom"><strong>Section</strong><span><?php 
                                       
                                       $sql5 = "select * from section WHERE id = '$section_id' ";

                                       $res5 = mysqli_query($conn, $sql5);
                                       while ($data5 = mysqli_fetch_assoc($res5)) {
                                          echo  $data5["section"];
                                       }
                                       
                                       
                                       ?></span></p>
                                    </div>
                                    <div class="block">
                                       <p class="border-bottom"><strong>Roll No</strong><span><?php
                                       
                                       
                                       echo $roll_no; ?></span></p>
                                    </div>
                                 </div>
                                 <div class="inforow">
                                    <div class="col2block">
                                       <p class="border-bottom"><strong>Student Name</strong><span>
                                             <?php echo $name; ?>
                                          </span></p>
                                    </div>
                                    <div class="col2block">
                                       <p class="border-bottom"><strong>Father Name</strong><span>
                                             <?php echo $father_name; ?>
                                          </span></p>
                                    </div>
                                 </div>
                           </div>
                           <table align="center" cellpadding="0" cellspacing="0" width="100%" border="0" style="background:#fff;margin-top:30px;border:2px solid #e6e6e6;padding:10px 20px">
                              <tbody>
                                 <tr>
                                    <td colspan="2">
                                       <table style="width:100%;table-layout:fixed;border-collapse:collapse">
                                          <thead style="margin:0;border:1px solid #ddd;background-color:#efefef;font-weight:700;line-height:21px;font-size:15px">
                                             <tr>
                                                <th style="padding:5px 5px;color:#555;text-align:left">
                                                   Description</th>
                                                <th style="padding:5px 15px 5px 5px;color:#555;text-align:right">
                                                   Amount</th>
                                             </tr>
                                          </thead>
                                          <tbody style="border-bottom:1px solid #e2e2e2">
                                             <tr style="width:100%">
                                                <td style="padding-top:8px;padding-bottom:8px;padding-left:15px;color:#555;font-size:15px;text-align:left">
                                                   <strong> Paid Amount</strong>
                                                </td>
                                                <td style="padding-top:8px;padding-bottom:8px;padding-left:15px;padding-right:15px;color:#555;font-size:15px;text-align:right">
                                                   Rs. <?php echo $total_paying_amount; ?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <table style="width:100%;border-collapse:collapse">
                                          <tbody style="border-bottom:1px solid #e2e2e2">
                                             <tr>
                                                <td></td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;border-left:1px solid #ddd;border-right:1px solid #ddd;padding:5px 15px">
                                                   <strong>Exam Fee</strong>
                                                </td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;padding:5px 15px;text-align:right">
                                                   <strong> Rs. <?php echo $exam_fee_amount; ?></strong>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td></td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;border-left:1px solid #ddd;border-right:1px solid #ddd;padding:5px 15px">
                                                   <strong>Convience Charges
                                                      <?php if ($convenience_fee_month != "") { ?>
                                                         ( <?php echo $convenience_fee_month; ?> month)
                                                      <?php } ?>

                                                   </strong>
                                                </td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;padding:5px 15px;text-align:right">
                                                   <strong> Rs. <?php echo $convenience_charge_amount; ?></strong>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td></td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;border-left:1px solid #ddd;border-right:1px solid #ddd;padding:5px 15px">
                                                   <strong>Balance Due</strong>
                                                </td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;padding:5px 15px;text-align:right">
                                                   <strong> Rs. <?php echo $balance_amount; ?></strong>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td></td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;border-left:1px solid #ddd;border-right:1px solid #ddd;padding:5px 15px">
                                                   <strong> Decided Amount</strong>
                                                </td>
                                                <td style="width:35%;background-color:#f9f9f9;border-top:1px solid #ddd;border-bottom:1px solid #ddd;font-size:14px;border-right:1px solid #ddd;color:#555;padding:5px 15px;text-align:right">
                                                   <strong> Rs. <?php echo $exam_fee_amount; ?></strong>
                                                </td>
                                             </tr>


                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="2"></td>
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Fee For: </strong>

                                          <?php

                                          echo $fee_month;

                                          ?>
                                       </p>

                                       <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Remark: </strong> <?php echo $remark; ?> </p>
                                       <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Amount Paid online: Rs. </strong> <?php echo $online_payment_amount; ?> </p>
                                       <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Amount Paid offline: </strong> Rs. <?php echo $offline_payment_amount; ?> </p>
                                       <?php if ($checkNumber !== "") { ?>
                                          <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Cheque Number: </strong> <?php echo $checkNumber; ?> </p>
                                       <?php } ?>
                                       <?php if ($checkDate !== "") { ?>
                                          <p style="font-size:14px;margin-top:35px;line-height:24px;color:#474747; padding-left:10px;"><strong>Cheque Date: </strong> <?php echo $checkDate; ?> </p>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <tr>
                              <td colspan="2">
                                 <p style="line-height:26px;margin-top:25px;margin-bottom:0px;font-size:18px;font-weight:600; text-align:right;"> Authorized Signature</p>
                                 <p style="line-height:26px;margin-top:0px;font-size:16px; text-align:right;"> </p>
                              </td>
                           </tr>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-sm-12">
                     <input type="button" class="btn btn-primary" onclick="printDiv('printpage')" value="Print Receipt" />
                  </div>
               </div>
            </div>
         </div>
   </section>
</main>
<?php include 'footer.php'; ?>
<script>
   function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
   }
</script>