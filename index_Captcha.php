<?php
require_once('./includes/init.php'); 
global $DB_site;
$path = $_SERVER['PHP_SELF'];
$file = strtolower(basename($path));
define('SITE_KEY', '6Le9Pp0aAAAAAEkui7qZgtSugylxoB5SiMwW1BYz');
define('SECRET_KEY', '6Le9Pp0aAAAAABvusajNBgXK5ielDajUJDgktQBf');

if(isset($_POST['regstd'])){
    function getCaptcha($SecretKey){
        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$SecretKey}");
        $Return = json_decode($Response);
        return $Return;
    }
    $Return = getCaptcha($_POST['g-recaptcha-response']);
    //var_dump($Return);
    if($Return->success == true && $Return->score > 0.5){
		add_section();
    }else{
        echo "error!!";
    }
}
	      
function add_section()
{
  global $DB_site;
 $selectsection =addslashes(Trim($_POST['selectsection']));
	$textstud_name = addslashes(Trim($_POST['textstud_name']));
	$selectcity = addslashes(Trim($_POST['selectcity']));
	 $textbirth_day = addslashes(Trim($_POST['textbirth_day']));
  $selectsex=addslashes(Trim($_POST['selectsex']));
 $textNationality=addslashes(Trim($_POST['textNationality']));
 
 $selectcard_type =addslashes(Trim($_POST['selectcard_type']));
	$textcard_id = addslashes(Trim($_POST['textcard_id']));
	$textaddress = addslashes(Trim($_POST['textaddress']));
	 $textemail = addslashes(Trim($_POST['textemail']));
	  $textphone = addslashes(Trim($_POST['textphone']));
	 
  $textmobile1=addslashes(Trim($_POST['textmobile1']));
 $textmobile2=addslashes(Trim($_POST['textmobile2']));
 
  $textkareb_name1 =addslashes(Trim($_POST['textkareb_name1']));
	$textkareb_type1 = addslashes(Trim($_POST['textkareb_type1']));
	$textkareb_phone1 = addslashes(Trim($_POST['textkareb_phone1']));
	 $textkareb_name2 =addslashes(Trim($_POST['textkareb_name2']));
	$textkareb_type2 = addslashes(Trim($_POST['textkareb_type2']));
	$textkareb_phone2 = addslashes(Trim($_POST['textkareb_phone2']));
	
	$textbac_id= addslashes(Trim($_POST['textbac_id']));
	$selectbac_year = addslashes(Trim($_POST['selectbac_year']));
  $selectbac_sec=addslashes(Trim($_POST['selectbac_sec']));
 $textschole=addslashes(Trim($_POST['textschole']));
 	$textbac_balad = addslashes(Trim($_POST['textbac_balad']));
  $selectcity2=addslashes(Trim($_POST['selectcity2']));
 $textbac_sum=addslashes(Trim($_POST['textbac_sum']));
 $is_active = 1;
 // التأكد أن الاسم غير مكرر
$stuy = $DB_site->query_first("select card_id from tbl_stdform where card_id='$textcard_id'");
if($stuy['card_id']<>'')
{
		print_message(" الاسم <b>$textcard_id</b> مكرر ... البيانات التي تم ادخالها مكررة");
		print_go_back();
		return;
	}
$year_study = $DB_site->query_first("select * from tbl_year_study ORDER BY year_study_id  DESC LIMIT 0, 1");
 $DB_site->query("INSERT INTO tbl_stdform VALUES(null,'$year_study[year_study]',1,'$textstud_name',' ',' ',' ','$selectcity','$textbirth_day','$selectsex','$textNationality','$selectcard_type',$textcard_id,'$textaddress','$textemail','$textphone','$textmobile1','$textmobile2','$textkareb_name1','$textkareb_type1','$textkareb_phone1','$textkareb_name2','$textkareb_type2','$textkareb_phone2','$selectbac_year',$textbac_id,'$selectbac_sec','$textschole','$selectcity2','$textbac_balad','$textbac_sum','$selectsection',Now(),0,$is_active)");
 page_state();
} 

?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-control" content="public">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-rtl.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>جامعة ابن النفيس - استمارة طلب الالتحاق بالجامعة</title>
<meta name="keywords" content="جامعة ابن النفيس، جامعة ابن النفيس الخاصه، التخدير، المختبرات الطبية، الصيدلة السريرية، الصيدلة، طب الاسنان، جامعة متخصصة في المجال الطبي في اليمن،جامعات خاصة في اليمن، جامعة خاصة، جامعات اليمن">
<meta name="description" content="جامعة ابن النفيس هي اول جامعة اهلية متخصصة في العلوم الطبية في اليمن، أنشأت بقرار وزاري رقم (1 )
صادر من وزارة التعليم العالي والبحث العلمي في اليمن.">
 
</head>
<body >
<div class="outerdiv"> 
<div class="container-fluid"> 

<div class="logo"> 
<div class="container-fluid"> 

<div class="row"> 

<div id="E-learningums-logo" class="col-lg-3 col-md-3 col-sm-3 ">
<ul class="title_top">

<li><h4 class="h4_title">الجمهورية اليمنية</h4></li>
<li><h4 <h4 class="ibn">جامعة ابن النفيس</h4></li>
<li><h4>شؤون الطلاب</h4></li>
<li><h4>ادارة القبول والتسجيل</h4></li>
</ul>

</div>

<div id="E-learningums-sitetitle" class="col-lg-6 col-md-6 col-sm-6 ">
<ul>
<img src="images/logoinu.jpg" >
 
</ul>
</div>
<div  id="left-logo" class="col-lg-2 col-md-2 col-sm-2 ">
<div class="left">
<li><h4>صورة </h4></li>
<li><h4>4*6</h4></li>
</div>


</div>

</div>

</div>

</div>	

<div class="sectionContent">
<div class="row">
<div  class="col-lg-12 col-md-12 col-sm-12 ">
<div class="panel panel-default"> 
<div class="panel-heading">استمارة طلب الالتحاق بالجامعة</div>
<div class="table-responsive">
 <FORM name="formadd" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="modal-body">
<div class="row text-right" >
<div class="col-lg-12 col-md-12 col-sm-12">
<h4><b>بيانات التسجيل</b></h4>	
<hr>	
</div>	  
<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<div class="  col-lg-3 col-md-3 col-sm-3">
<label for="exampleInputEmail1">التخصص الدراسي</label>
<select name="selectsection" class="form-control">
  <option value="">حدد الاختيار...</option>
					<?php
						$sections = $DB_site->query('select section_id,section_name from tbl_section');
						while ($row = $DB_site->fetch_array($sections))
						{
						echo "<option value=$row[section_id]>". stripslashes($row['section_name']) . "</option>"; 
						}
						 $DB_site->free_result($sections);
					?>
				</select>
</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 form-group">
<br>
<h4><b>البيانات الشخصية</b></h4>
<hr>

 <div class="form-group col-sm-4">
 <label for="firstName" class="form-label">الاسم الرباعي مع اللقب </label>
<input  type="text" name="textstud_name" size="50"  class="form-control" required>
 </div>
 <div class="form-group col-sm-2">
<label for="exampleInputEmail1">المحافظة </label>
<select name="selectcity"   class="form-control" required>
  <option value="">حدد الاختيار...</option>
					<option value="صنعاء">صنعاء</option>
					<option value="عدن">عدن</option>
					<option value="تعز">تعز</option>
					<option value="الحديدة">الحديدة</option>
					<option value="ذمار">ذمار</option>
					<option value="اب">اب</option>
					<option value="عمران">عمران</option>
					<option value="حجة">حجة</option>
					<option value="صعدة">صعدة</option>
					<option value="الجوف">الجوف</option>
					<option value="مارب">مارب</option>
					<option value="البيضاء">البيضاء</option>
					<option value="المحويت">المحويت</option>
					<option value="الضالع">الضالع</option>
					<option value="لحج">لحج</option>
					<option value="ابين">ابين</option>
					<option value="حضرموت">حضرموت</option>
					<option value="شبوة">شبوة</option>
					<option value="المهرة">المهرة</option>
					<option value="سقطرى">سقطرى</option>
				</select>
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">تاريخ الميلاد </label>
 <input     type="date" name="textbirth_day"    class="form-control" required>
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">الجنس</label>
<select name="selectsex"    class="form-control" required>
  <option value="">حدد الاختيار...</option>
<option value="ذكر">ذكر</option>
<option value="انثى">انثى</option>
</select>
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">الجنسية </label>
<input type="text" name="textNationality" class="form-control" required>
 </div>
  <div class="form-group col-sm-4">
 <label for="exampleInputEmail1">العنوان الحالي </label>
<input type="text" name="textaddress"   class="form-control" >
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">نوع الهوية</label>
 <select name="selectcard_type" class="form-control" >
  <option value="">حدد الاختيار...</option>
<option value="البطاقة الشخصية"  >البطاقة الشخصية</option>
<option value="جواز السفر"   >جواز السفر</option>
</select>
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">رقم الهوية </label>
 <input type="text" name="textcard_id"  class="form-control" required>
 </div>

 <div class="form-group col-sm-4">
 <label for="exampleInputEmail1">البريد الالكتروني </label>
<input  dir="ltr"  type="email" name="textemail"   class="form-control" placeholder="you@example.com">
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">رقم الهاتف </label>
<input   type="text" name="textphone"   class="form-control" >
 </div>
 <div class="form-group col-sm-2">
 <label for="exampleInputEmail1">رقم الجوال1 </label>
<input   type="text" name="textmobile1"    class="form-control">
 </div>
<div class="form-group col-sm-2">
 <label for="exampleInputEmail1">رقم الجوال2 </label>
<input   type="text" name="textmobile2"    class="form-control">
 </div>
 </div>
<div class="form-group col-sm-12 form-group">
<h4><b>اقرب شخصين يمكن الاتصال بهما</b></h4>	
 <hr>

 <div class="form-group col-sm-6">
 <label for="exampleInputEmail1">الاسم1</B><span class=RedStar> </label>
<input   type="text" name="textkareb_name1"  class="form-control">
 </div>
  <div class="form-group col-sm-3">
 <label for="exampleInputEmail1">صلة القرابة1 </label>
<input    type="text" name="textkareb_type1"  class="form-control">
 </div>
  <div class="form-group col-sm-3">
 <label for="exampleInputEmail1">الهاتف1 </label>
 <input     type="text" name="textkareb_phone1" class="form-control">
</div>
 <div class="form-group col-sm-6">
  <label for="exampleInputEmail1">الاسم2</label>
<input     type="text" name="textkareb_name2"   class="form-control">
 </div>
  <div class="form-group col-sm-3">
  <label for="exampleInputEmail1">صلة القرابة2</label>
<input     type="text" name="textkareb_type2" class="form-control" >
 </div>
   <div class="form-group col-sm-3">
  <label for="exampleInputEmail1">الهاتف2</label>
<input    type="text" name="textkareb_phone2" class="form-control">
 </div>
 </div>
<div class="form-group col-sm-12 form-group">
<h4><b>بيانات الثانوية العامة</b></h4>
<hr> 
  </div>

<div class="form-group col-sm-3">
  <label for="exampleInputEmail1">العام الدراسي</label>
                <select name="selectbac_year"    class="form-control" required>
				<option value="">حدد الاختيار...</option>
				<?php
					$year = $DB_site->query('select year_study from tbl_year_study');
						while ($row = $DB_site->fetch_array($year))
						{
						echo "<option value=$row[year_study]>". stripslashes($row['year_study']) . "</option>";
                        
						}
						$DB_site->free_result($year);
						?>
				</select>
  </div>
  <div class="form-group col-sm-3">
  <label for="exampleInputEmail1">القسم</label>
 <select name="selectbac_sec"  class="form-control" required>
 <option value="">حدد الاختيار...</option>
<option value="العلمي">العلمي</option>
<option value="الادبي">الادبي</option>
</select>
  </div>
  <div class="form-group col-sm-3">  
   <label for="exampleInputEmail1">رقم الجلوس</label>
  <input   type="text" name="textbac_id"    class="form-control">
  </div>
   <div class="form-group col-sm-3">    
 <label for="exampleInputEmail1">المحافظة</label>
		 <select name="selectcity2" class="form-control">
		 <option value="">حدد الاختيار...</option>
				<option value="صنعاء">صنعاء</option>
					<option value="عدن">عدن</option>
					<option value="تعز">تعز</option>
					<option value="الحديدة">الحديدة</option>
					<option value="ذمار">ذمار</option>
					<option value="اب">اب</option>
					<option value="عمران">عمران</option>
					<option value="حجة">حجة</option>
					<option value="صعدة">صعدة</option>
					<option value="الجوف">الجوف</option>
					<option value="مارب">مارب</option>
					<option value="البيضاء">البيضاء</option>
					<option value="المحويت">المحويت</option>
					<option value="الضالع">الضالع</option>
					<option value="لحج">لحج</option>
					<option value="ابين">ابين</option>
					<option value="حضرموت">حضرموت</option>
					<option value="شبوة">شبوة</option>
					<option value="المهرة">المهرة</option>
					<option value="سقطرى">سقطرى</option>
				</select>
  </div>
<div class="form-group col-sm-6">  
  <label for="exampleInputEmail1">المدرسة</label>
 <input   type="text" name="textschole"    class="form-control">
  </div>
<div class="form-group col-sm-3">    
 <label for="exampleInputEmail1">البلد</label>
 <input     type="text" name="textbac_balad"     class="form-control">
  </div>
 <div class="form-group col-sm-3">  
 <label for="exampleInputEmail1">النسبة المئوية %</label>
  <input      type="text" name="textbac_sum" size="50" maxlength="50" class="form-control" required>
  </div>
 <div class="div_btn col-sm-12"> 
 <hr>
<button type="submit" name="regstd" class="btn btn-primary btn-block btn-flat" style="width:20%">تسجيل</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>

</html>
