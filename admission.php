
<?php	
require_once('./includes/init.php'); 
global $DB_site;
   include('./includes/head.php');     
$admission = $DB_site->query_first("SELECT `ad_id`, `section_id`,`bac_sec`, `bac_sum` FROM `tbl_admission` WHERE section_id='$selectsection'"); 
?>
 
<div class="panel panel-default"> 
<div class="panel-heading">البيانات التي تم ادخالا لاتطابق شروط ومعايير القبول والتسجيل</div>
<div class="table-responsive">
 <FORM name="formadd" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="modal-body">
<div class="row text-right" >
<div class="col-lg-12 col-md-12 col-sm-12">
<h4><b>معايير القبول والتسجيل</b></h4>	
<hr>	
</div>	
  
<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<div class="  col-lg-3 col-md-3 col-sm-3">
<label for="exampleInputEmail1">التخصص الدراسي</label>
   <i class="fa fa-check">&nbsp</i><input  type="text" name="Mark_std" size="50" value="<?php echo $std ;?>" class="form-control"  readonly >
</div>
 

<div class="form-group col-sm-4">
 <label for="firstName" class="form-label">Markiting</label>
<i class="fa fa-check">&nbsp</i><input  type="text" name="Mark_std" size="50" value="<?php echo $std ;?>" class="form-control"  readonly >
 </div>
 <div class="form-group col-sm-4">
 <label for="firstName" class="form-label">Markiting LINK</label>
<i class="fa fa-check">&nbsp</i><input  type="text" name="Mark_link" size="50" value="<?php echo $mark_link ;?>" class="form-control" readonly>
 </div>

</div>
<?php	
 include('./includes/footer.php'); 
 ?>