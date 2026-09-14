<?php
 
    require_once('./includes/init.php'); 
    session_start();
	
    $path = $_SERVER['PHP_SELF'];
    $file = strtolower(basename($path));
    if ($file == 'study_form.php')
    {
    	exit;
    }
    
	if(isset($_POST['regstd'])) {
			
        global $DB_site;
    	global $ums_fun;
		
        $DB_site->var_i = $_POST['std_id'];
	    $stmt = $DB_site->query_prepare('SELECT * FROM tbl_markting_link WHERE std_id=?','i');
	    $ismarkting=$DB_site->query_stmt_result($stmt); 
		
		$check_login = htmlspecialchars($_POST['chk_id']);
	 
		if(is_numeric($check_login)){

        	if(isset($_POST['std_id']) and $ismarkting['std_id'] == $_POST['std_id'] and $ismarkting['mark_link'] == $_POST['Mark_link']) {	
     
	    		try
                {
        	    	$mark_link=$ums_fun->test_input_ums($_POST['Mark_link']);
                    $std_id=$ums_fun->test_input_ums($_POST['std_id']);
                    $selectsection =$ums_fun->test_input_ums($_POST['selectsection']);
                    $textstud_name = $ums_fun->test_input_ums($_POST['textstud_name']);
                    $selectcity = '';
                    $textbirth_day ='2000-01-01';
                    $selectsex='-';
                    $textNationality='-';
                    $selectcard_type='';
                    $textcard_id='0';
                    $textaddress = $ums_fun->test_input_ums($_POST['textaddress']);
                    $textmobile1=$ums_fun->test_input_ums($_POST['textmobile1']);
                    $textkareb_name1='';
                    $textkareb_type1='';
                    $textkareb_phone1 = $ums_fun->test_input_ums($_POST['textkareb_phone1']);	
                    $textbac_id= $ums_fun->test_input_ums($_POST['textbac_id']);
                    $selectbac_year = $ums_fun->test_input_ums($_POST['selectbac_year']);
                    $selectbac_sec=$ums_fun->test_input_ums($_POST['selectbac_sec']);
                    $textschole='-';
                    $selectcity2=$ums_fun->test_input_ums($_POST['selectcity2']);
                    $textbac_sum=$ums_fun->test_input_ums($_POST['textbac_sum']);
                    $is_active = 1;
        	        
                    if($textstud_name ==''){
                        print_message('يجب ادخال الاسم');
                        echo '<br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a> ';
        	            return;
        	        }
        	        
                    if($selectsection ==0){
                        print_message('يجب تحديد التخصص الدراسي');
                        echo '<br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a> ';
        	            return;
        	        }
        	        
                    // التأكد أن الاسم غير مكرر
	    	    	$DB_site->var_i=$textbac_id;
                    $stmt = $DB_site->query_prepare('SELECT count(*)bac_id from tbl_stdform where bac_id=?','i');
	                $stuy = $DB_site->query_stmt_result($stmt);
	    	    	 
	    	    
                    if($stuy['bac_id']>0){ 
        	        	print_message("<span style='color:#a20606;'><b> x </b>   رقم الجلوس <b>( $textbac_id )</b>الذي تم ادخالة مكرر، يوجد سجل سابق بهذا الرقم</span>");
        	        	echo '<br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a> ';
        	        	return;
        	        }
        	     
	    	    	$DB_site->var_i=$textbac_id;
                    $stmt = $DB_site->query_prepare('SELECT  count(*)bac_id from tbl_stdform_sys where bac_id=?','i');
	                $stuy_sys = $DB_site->query_stmt_result($stmt); 
                    if($stuy_sys['bac_id']>0){ 
        	        	print_message("<span style='color:#a20606;'><b>x</b> تنبية : رقم الجلوس المدخل <b>< $textbac_id ></b> يوجد سجل سابق بهذا الرقم</span>");
        	        	echo '<br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a> ';
        	        	return;
        	        }
                    
	    	    	$DB_site->var_i=$selectsection;
                    $stmt = $DB_site->query_prepare('SELECT ad_id, section_id, bac_sec, bac_sum FROM tbl_admission WHERE section_id=?','i');
	                $admission = $DB_site->query_stmt_result($stmt);
          
                    if(($admission['bac_sec']==$selectbac_sec or $admission['bac_sec']=='') and $admission['bac_sum']<=$textbac_sum ){
        	          
                        $year_study = $DB_site->query_first("select * from tbl_year_study ORDER BY year_study_id  DESC LIMIT 0, 1"); 
                        $DB_site->query("INSERT INTO tbl_stdform VALUES(null,'$year_study[year_study]',1,' ','$textstud_name',' ',' ','$selectcity','$textbirth_day','$selectsex','$textNationality','$selectcard_type','$textcard_id','$textaddress','std@gmail.com','-','$textmobile1','-','$textkareb_name1','$textkareb_type1','$textkareb_phone1','-','-','0','$selectbac_year','$textbac_id','$selectbac_sec','$textschole','$selectcity2','-','$textbac_sum','$selectsection',Now(),Now(),Now(),Now(),'$mark_link','$std_id',0,0,$is_active)");
                         
        	    	}else{
                	  echo "<script> window.location = 'index.php?page=study_form&op=admission&section=".$admission['section_id']."&bac_sec=".$selectbac_sec."&bac_sum=".$textbac_sum."'; </script>";
        	    	}
        	      
        	    }catch(Exception $e) {
        	        echo $e->getMessage();
        	    }finally { 
                    echo "<script> window.location = 'index.php?page=study_form&op=state'; </script>";
                }
				
	    	}else{
	    		echo '
	    		<div class="alert alert-danger" role="alert">
                   بيانات رابط التسويق غير صحيحة
	    		   <br><br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a>
                </div>';
        	}
	    
        }else{
	    	echo '
	    		<div class="alert alert-danger" role="alert">
                   بيانات التحقق غير صحيحة
	    		   <br><br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a>
                </div>';
	    }
	}

    //--------------------------------------------------------------------------------------
    ?>
    <script type="text/javascript">
    function setyearschoool(secid)
    {
       var selector_to_fill = document.getElementById("selectbac_year");
       selector_to_fill.options.length = 0;
      
        selector_to_fill.options[0]=new Option( "حدد الاختيار", 0, false, false);
     <?php 
    	 $section= $DB_site->query("select * from tbl_admission");
       while ($row = $DB_site->fetch_array($section))
        { ?>
    
            if (secid =="<?php echo $row['section_id']; ?>"){
    
           <?php 
    		$list_count = 0;
    		 
                 $emp= $DB_site->query("SELECT * FROM tbl_year_school WHERE year_study_id>='$row[min_year]' order by year_study_id desc");
               while ($rows = $DB_site->fetch_array($emp))
                { ?>
    
                    selector_to_fill.options[<?php echo $list_count; ?>]=new Option("<?php echo $rows['year_study']; ?>", "<?php echo $rows['year_study']; ?>", false, false);
    
                    <?php
    
                    $list_count++;
    
                } ?>
            }
        <?php 
        } ?>
    		
    }
    </script>
    
    
      <?php 
    function show_add_form(){
    	global $DB_site;
    	global $ums_fun;
		
    	if(isset($_GET['std']) and isset($_GET['mark_link'])) {	
    	    $std = $_GET['std'];
    	    $mark_link=$ums_fun->test_input_ums($_GET['mark_link']);
    	     
    	    if(is_numeric($std) and $std>0 ){
				$DB_site->var_i=$std;
                $stmt = $DB_site->query_prepare('SELECT * FROM tbl_markting_link WHERE std_id=?','i');
	            $ismarkting=$DB_site->query_stmt_result($stmt); 
    	        if($ismarkting['mar_id']>0 and $ismarkting['mark_link']==$mark_link) {
    	    	 	?>
                    <div class="panel panel-default"> 
                    <div class="panel-heading">البوابة الالكترونية - للقبول والتنسيق</div>
                    <div class="table-responsive">
                        <FORM name="formadd" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="modal-body">
                            <div class="row text-right" >
                            <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4><b>بيانات التسجيل</b></h4>	
                            <hr>	
                            </div>	  
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="  col-lg-4 col-md-4 col-sm-4">
                                    <label for="exampleInputEmail1">التخصص الدراسي</label>
                                    <select name="selectsection"    onChange="setyearschoool(this.value)" onselect="setyearschoool(this.value)" class="form-control" required>
                                        <option value="">حدد الاختيار...</option>
    	    		            	    		 
    	    				    	     <?php
    	    				    	    $colgee = $DB_site->query('select colgee_id,colgee_name from tbl_colgee');
    	    				    	    while ($year = $DB_site->fetch_array($colgee))
    	    				    	    {
    	    				    	    	echo "<optgroup label='$year[colgee_name]'>";
											
    	    				    	    	$sections = $DB_site->query("select section_id, section_name from tbl_section where colgee_id ='$year[colgee_id]'");
    	    				    	    	while ($row = $DB_site->fetch_array($sections))
    	    				    	    	{
    	    				    	    		echo "<option value=$row[section_id]>&nbsp;&nbsp;&nbsp;$row[section_name]</option>";
    	    				    	    	}
    	    				    	    	$DB_site->free_result($sections);
    	    				    	    }
    	    				    	    $DB_site->free_result($colgee);
    	    				            ?>
		    				    	    
    	    			           </select>
                                </div>
		    				    
                            <input  type="hidden" name="std_id" size="50" value="<?php echo $std ;?>" class="form-control"  readonly >
                            <input  type="hidden" name="Mark_link" size="50" value="<?php echo $mark_link ;?>" class="form-control" readonly>
		    
		    
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <br>
                            <h4><b>البيانات الشخصية</b></h4>
                            <hr>
                            
                             <div class="form-group col-sm-6">
                             <label for="firstName" class="form-label">الاسم الرباعي من واقع شهادة الثانوية</label>
                            <input  type="text" name="textstud_name" size="50"  class="form-control" maxlength="70" required>
                             </div>
                             
                              <div class="form-group col-sm-4">
                             <label for="exampleInputEmail1">عنوان السكن الحالي / المدينة - الحي او الشارع</label>
                            <input type="text" name="textaddress"   class="form-control"  maxlength="70">
                             </div>
                             <div class="form-group col-sm-2">
                             <label for="exampleInputEmail1">رقم التلفون/الجوال</label>
                            <input   type="text" name="textmobile1"    class="form-control" maxlength="12">
                             </div>
                               <div class="form-group col-sm-3">
                             <label for="exampleInputEmail1">رقم تلفون احد الاقارب</label>
                             <input     type="text" name="textkareb_phone1" class="form-control"  maxlength="12" required>
                            </div>
                             </div>
                            <br>
                            <div class="form-group col-sm-12 form-group">
                            <h4><b>بيانات الثانوية العامة</b></h4>
                            <hr> 
                              </div>
                            
                            <div class="form-group col-sm-3">
                              <label for="exampleInputEmail1">عام التخرج</label>
                                            <select name="selectbac_year"  id="selectbac_year"   class="form-control" required>
                            			 <option value="">حدد الاختيار...</option>
                            				<?php
                            				 $year = $DB_site->query('select year_study from tbl_year_school ORDER BY year_study_id desc ');
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
                              <input   type="number" name="textbac_id"    class="form-control"  maxlength="20">
                              </div>
                               <div class="form-group col-sm-3">    
                             <label for="exampleInputEmail1">مكان الحصول على الثانوية العامة</label>
                            		 <select name="selectcity2" class="form-control" required>
                            		 <option value="">حدد الاختيار...</option>
                            				 <option value="امانة العاصمة">امانة العاصمة</option>
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
                            					<option value="ريمة">ريمة</option>
                            					<option value="الضالع">الضالع</option>
                            					<option value="لحج">لحج</option>
                            					<option value="ابين">ابين</option>
                            					<option value="حضرموت">حضرموت</option>
                            					<option value="شبوة">شبوة</option>
                            					<option value="المهرة">المهرة</option>
                            					<option value="سقطرى">سقطرى</option>
                            				</select>
                              </div>
                             <div class="form-group col-sm-3">  
                             <label for="exampleInputEmail1">معدل الثانوية العامة %</label>
                              <input type="number" name="textbac_sum" size="50"class="form-control"   required>
                              </div>
							<div class="col-md-12">  
        	                    <br>
                                <label for="firstName" class="form-label" style="color:#0e75ce;font-size:14px;">* رمز التحقق : (<?php
						        $_SESSION['test_reg'] = rand(1,100000);
						        echo $_SESSION['test_reg'];?>)</label>
                                <div class="col-md-12"> 
                                    <input type="number" name="chk_id" class="form-control" placeholder="ادخل رمز التحقق"  maxlength="6" style="width:100%;padding:.375rem .75rem;" required="">
                                <br>
						        </div> 
                            </div> 
                             <div class="div_btn col-sm-12"> 
                             <hr>
                            <button type="submit" name="regstd" class="btn btn-primary btn-block btn-flat" style="width:30%">تسجيل</button>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                <?php
    	    	}else{
					echo '
					<div class="alert alert-danger" role="alert">
                       الرابط غير صحيح يرجى التاكد من صحة الرابط
					   <br><br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a>
                    </div>';
					 
 
    	    	}		  
    	    }else{
					echo '
					<div class="alert alert-danger" role="alert">
                       الرابط غير صحيح يرجى التاكد من صحة الرابط
					   <br><br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary">عودة</a>
                    </div>';
    	    }
        }
     
    }
    
    function admission_study($section,$bac_sec,$bac_sum)
    {
    	 global $DB_site;
     $admission = $DB_site->query_first("SELECT ad_id, section_id,section_name,year_study,bac_sec, bac_sum FROM tbl_admission WHERE section_id='$section'"); 
    ?>
    
    <div class="panel panel-default"> 
    <div class="panel-heading" style="color:#a20606;"><i class="fa fa-times nino-close">&nbsp </i> البيانات التي تم ادخالها لاتطابق معايير القبول والتسجيل للتخصص الذي تم اختياره</div>
    <div class="table-responsive">
     <div class="modal-body">
    	<div class="row " >
    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
    <h4 style="color:#009688;"><b> معايير القبول والتنسيق للعام الجامعي <?php echo $admission['year_study']; ?></b></h4>	
    <hr>	
    </div>	  
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
    <div class="form-group col-sm-6 text-right" style="color:#009688;">  
    <label for="exampleInputEmail1">التخصص الدراسي</label>
     <b> <input value="<?php echo $admission['section_name']; ?>" class="form-control"type="text" name="textsectionname" readonly>    </b>
    
     </div>
     	   
     <div class="form-group col-sm-3 text-right" style="color:#009688;">  
    
    <label for="exampleInputEmail1">قسم شهادة الثانوية العامة - المطلوب</label>
     <b> <input value="<?php if($admission['bac_sec']<>'') echo $admission['bac_sec']; else  echo 'علمي - ادبي';?>" class="form-control" type="text" name="textsectionname" size="50" readonly>    </b>
     </div>
      <div class="form-group col-sm-3 text-right" style="color:#009688;">  
    <label for="exampleInputEmail1">معدل القبول المطلوب</label>
    <b> <input value="<?php echo  $admission['bac_sum']; ?> %" class="form-control" type="text" name="textsectionname_en" size="50" readonly>   </b>
     </div>
    
     <div class="form-group col-sm-12 text-right"> 
     <br>
    			<?php 
    			if(($admission['bac_sec']<>$bac_sec) and $admission['bac_sec']<>'')
    			 echo '<b>قسم شهادة الثانوية العامة الذي قمت بادخاله لايتناسب مع معايير القبول والتسجيل  المذكورة اعلاه</b>:<h3> <i class="fa fa-times nino-close" style="color:#a20606;">&nbsp </i> '.$bac_sec.'</h3>';
    		elseif ($admission['bac_sum']>$bac_sum)
    			 echo '<b>معدل الثانوية العامة الذي قمت بادخالة اقل من النسبة المطلوبة في معايير القبول والتسجيل المذكورة اعلاه</b>:<h3> <i class="fa fa-times nino-close" style="color:#a20606;">&nbsp </i>  %'. $bac_sum .'</h3>';
    			
    			?>
      </div>
     <div class="form-group col-sm-12">
     
    		 <br><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-primary" style="width:30%">رجوع</a>
     
      </div>
        </div>
    		</div >
    		</div >
    			</div >
    				</div >
    <div class="form-group col-sm-12 text-right">
    <br>
    <li> لمعرفة تفاصيل اكثر عن معايير القبول والتسجيل يرجى زيارة الرابط التالي :  </li> 
    <h4><a href="https://ums-edu.com/شروط-القبول-ومعايير-التنسيق"><i class="fa fa-angle-left"></i> شروط القبول ومعايير التنسيق</a></h4> 
    <hr> 
    <li><span>للاستفسار او لمعرفة المزيد يرجى التواصل عبر رقم الواتس اب التالي: </span></li> 
    <h4><a href="https://wa.me/+967778211211" rel="noreferrer"> 778211211  <i class="fa fa-whatsapp" style="color:#009688;"></i></a></h4>
    <hr> 
    <br> 
    </div >
    		<?php
    }
     
     
    function page_state()
    
    {
    		?>
    	<SCRIPT LANGUAGE="JAVASCRIPT">
            if(window.history.replaceState){
    			window.history.replaceState(null,null,window.location.href);
    		}
        </SCRIPT>
    	<?php
    	   print_message('<div class="state_bar"><i class="fa fa-check">&nbsp</i>تم التنسيق بنجاح</div>');
    		echo"<ul class='edit'>";
    		echo"<li><b>يرجى زيارة الجامعة لاستكمال عملية القبول والتسجيل .</b></li>";
    		echo'<hr>';
    		echo'<li><span>للاستفسار او لمعرفة المزيد يرجى التواصل عبر رقم الواتس اب التالي: </span></li>';
    		echo'<li ><h4><a href="https://wa.me/+967778211211" rel="noreferrer"> 778211211  <i class="fa fa-whatsapp" style="color:#009688;"></i></a></h4></li>';
    		echo'<hr>';
    		echo"<li> للاطلاع على الوثائق المطلوبة من خلال الرابط التالي :  </li>";
    		echo'<li><h4><a href="https://ums-edu.com/الوثائق-المطلوبة"><i class="fa fa-angle-left"></i> الوثائق المطلوبة</a></h4><li>';
    	  //echo'<li><a href="https://ums-edu.com/خطوات-القبول-والتسجيل"><i class="fa fa-angle-left"></i>خطوات القبول والتسجيل</a><li>';
    		echo"<br>";
    		echo"</ul>";
    
    }
    
     
    if(isset($_GET['op']))
    {
    switch ($_GET['op'])
    {
       
        case 'doadd':
            add_section();
    	
            break;
        case 'add':
            show_add_form();
            break;
    	case 'state':
            page_state();
            break;
    		case 'admission':
            admission_study($_GET['section'],$_GET['bac_sec'],$_GET['bac_sum']);
            break;
        default :
    		 show_add_form();
            break;
    }
    }
    else
    	 show_add_form();
    
 
?>