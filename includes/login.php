
<style type="text/css">
<!--
@import url("css/main.css");
.style1 {
	color: #FF3333;
	font-weight: bold;
}
.style4 {font-size: 16px}
.style5 {font-size: 18px}
.style6 {COLOR: #FF3333; FONT-WEIGHT:bold; FONT-FAMILY: MS Sans Serif, MS Sans Serif; TEXT-DECORATION: none; background: none;}
.style8 {COLOR: #FF3333; FONT-WEIGHT: bold; FONT-FAMILY: MS Sans Serif, MS Sans Serif; TEXT-DECORATION: none; background: none; font-size: 18px; }
-->
</style>
<?php


function show_login_form()
{
?>
    <SCRIPT LANGUAGE="JAVASCRIPT">
        function CheckLoginForm()
        {
			// اسم المستخدم
            if (Trim(document.formlogin.textstdid.value) == '' || isNaN(document.formlogin.textstdid.value))
            {
                alert("عفواً..يجب إدخال رقم الطالب!!!");
                document.formlogin.textstdid.select();
                return false;
            }

			// كلمة المرور
            if (Trim(document.formlogin.textpassword.value) == '')
            {
                alert("عفواً..يجب إدخال كلمة المرور!!!");
                document.formlogin.textpassword.focus();
                return false;
            }

            return true;
        }
    </SCRIPT>
    <link href="../css/main.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
<!--
.style9 {font-size: 14px}
-->
    </style>
    <TABLE width="100%" height="533" border="0" align="center" cellpadding="2" cellspacing="0" dir="ltr" class="Table">
        <FORM name="formlogin" method="POST" action="index.php?page=user&op=login" onsubmit="return CheckLoginForm();">
        
		<tr>
		  <td height="31" background="images/elearning_09.gif">
            <div align="center" class="boxtitle style4">
              <p class="title">بوابة التعليم الإلكترونية </p>
            </div>
	      </td>
		  </tr>
		<tr>
          
				<td width="54%"><div align="center"><strong><a id="linkall" href="" style="text-decoration: none;"><img id="pic" src="images/tutor.png" />
                    <span class="style4">
                    <label id="namesys"><span class="style9">Lecturer Portal</span> / </label>
                </span>
                    <span class="style5">
                    <label><span class="style6">دخول المدرس</span></label>
                    </span>
                    <label></label>
                    <span class="style4">
                    <label> </label>
                    </span>
                  <label id="namesys"></label>
                </a>&nbsp;&nbsp;|<a id="linkall2" href="" style="text-decoration: none;"><img id="pic2" src="images/student1.png" border="0" />
                <label id="namesys2"><span class="style4"><span class="style9">Student Portal</span> /</span> <span class="style8">دخول الطالب </span></label>
                </a></strong></div>
              <div align="center">
				    <p class="style9"><strong>Username / إسم المستخدم</strong></p>
				    <p>
				      <input type="text" name="textstdid" size="25" maxlength="100"  />
                    </p>
				  </div>
				  <div align="center">
              <p class="style9"><strong>Password / كلمة المرور </strong></p>
              <p>
                <input type="password" name="textpassword" maxlength="100" size="25"  />
              </p>
            </div>
		        
              <div align="center">
                <input type="submit" name="submitadd" accesskey="l" value=" دخول / LOGIN" class="Button" />
                <input type="reset" name="reset" value=" مسح / CLEAR" accesskey="C" class="Button" />
              </div>
            <div id="div">
                <ul>
                  <li class="style4" style="font-weight: bold;"> <img src="images/bullet_go.png" /><span class="style9" style="font-size: 16px"><a href=""  style="text-decoration:none">Security alert</a> &nbsp;&nbsp;&nbsp;<a href="" style="text-decoration:none" >&#1578;&#1606;&#1576;&#1610;&#1607; &#1571;</a></span><a href="" style="text-decoration:none" >&#1605;&#1606;&#1610; </a></li>
                  <li style="font-weight: bold;"> <span style="font-size: 16px"><img src="images/bullet_go.png" /><a title="انقر هنا للحصول على كلمة مرور جديدة"" class="GeneralHref" href="index.php?page=user&op=mypass" style="text-decoration: none;"> <span class="style9">Forgot password</span></a><span class="style9">&nbsp;&nbsp;&nbsp;<a href="" style="text-decoration: none;">&#1606;&#1587;&#1610;&#1578; &#1603;&#1604;&#1605;&#1577; &#1575;&#1604;&#1605;</a></span><a href="" style="text-decoration: none;">&#1585;&#1608;&#1585;</a></span> </li>
                  <!--
<li style="font-weight: bold;"><img src="images/bullet_go.png"><a href="" style="text-decoration: none;">Student Portal Guideline </a> <img width="15" height="15" src="images/dimdim.jpg"> <a href="" dir="rtl" style="text-decoration: none;">

                &#1583;&#1604;&#1610;&#1604; &#1576;&#1608;&#1575;&#1576;&#1577; &#1575;&#1604;&#1591;&#1604;&#1575;&#1576;</a></li>
<li style="font-weight: bold;">
<img src="images/bullet_go.png"><a href="" style="text-decoration: none;">Help</a>&nbsp;&nbsp;&nbsp;<a href="" style="text-decoration: none;">&#1605;&#1587;&#1575;&#1593;&#1583;&#1577;</a>
</li>
-->
                  <!-- <li style="font-weight: bold;"> <img src="images/bullet_go.png"><a style="text-decoration: none;" href=""> Student Portal Guideline </a><img height="15" width="15" src=""><br><img src="images/bullet_go.png"><a style="text-decoration: none;" dir="rtl" href=""> &#1575;&#1604;&#1578;&#1608;&#1580;&#1610;&#1607; &#1601;&#1610; &#1583;&#1582;&#1608;&#1604; &#1576;&#1608;&#1575;&#1576;&#1577; &#1575;&#1604;&#1591;&#1604;&#1575;&#1576;</a><img height="15" width="15" src="">                                                                                                                                                        </li> -->
                </ul>
          </div>                </td>
		</tr>
        <tr>
            <td colspan="2" align="center"></td>
        </tr>
        </form>
</table>
    <p>&nbsp;</p>
    <div align="center">
      <?
}

function show_user_menu()
{
?>
    </div>
    <TABLE width="101%" dir="rtl" height="668" border=0 align="center" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF" class="Table">
        <tr>
          <td height="26" colspan="4" align=center valign="middle" background="images/elearning_09.gif"><span class="title">بوابة التعليم الإلكترونية </span></td>
        </tr>
        <tr>
            <td height="26" colspan="4" align=center valign="middle" bgcolor="#F5F5F5"><p align="center" class="style1 style4">القائمة الشخصية</p>              </td>
        </tr>
		<tr>
		  <td height="62" colspan="2" align=center valign="top" ><p><span class="style8">أهلاً وسهلاً بك</span></p>
		    <p><br />
		        <span class="style4"><strong>[::
	            <?php echo $_SESSION['full_name'] ?>
          ::]</strong></span> </p></td>
	      <td width="24%" height="62" align=center ><div align="right"><span class="style1"><span class="storycat style9"><img src="./images/education/katomic2.png" width="128" height="128" /></span></span></div></td>
	  </tr>
		<tr>
		  <td height="13" colspan="3" align=center valign="top" ><hr></td>
	  </tr>
		<tr>
          <td width="30%" align=center ><div align="center">
            <p><a href="index.php?page=course"><img src="./images/education/1211755830.png" alt="محاضرات الفصل الأول" width="128" height="128" border="0" /></a></p>
            <p class="postdetails"><span><a class="GeneralHref" href="index.php?page=course">محاضرات الفصل الأول </a></span></p>
          </div></td>
          <td width="33%" align=center ><div align="center">
            <p><a href="index.php?page=test"><img src="./images/education/1211806099.png" alt="قسم الأنشطة والإمتحانات" width="128" height="128" border="0" /></a></p>
            <p><span><a class="GeneralHref" href="index.php?page=test">قسم الأنشطه والإمتحانات</a></span></p>
          </div></td>
          <td width="24%" align=center ><div align="center">
            <p><a href="index.php?page=rep"><img src="./images/education/1211809111.png" alt="محاضرات الفصل الثاني" width="128" height="128" border="0" /></a></p>
            <p><span><a class="GeneralHref" href="index.php?page=rep">محاضرات الفصل الثاني </a></span></p>
          </div></td>
        </tr>
		<tr>
		  <td colspan="3" align=center ><hr></td>
	  </tr>
		<tr>
		  <td align=center ><div align="center">
		    <p><a href="index.php?page=test&amp;op=old"><img src="./images/education/qualification-history.png" alt="قسم الدرجات" width="128" height="128" border="0" /></a></p>
		    <p><a class="GeneralHref" href="index.php?page=user&amp;op=pass">قسم درجات الإمتحانات</a></p>
		  </div></td>
		  <td align=center ><div align="center">
		    <p><a href="index.php?page=prob"><img src="./images/education/kontact.png" alt="قسم الإستفسارات" width="128" height="128" border="0" /></a></p>
		    <p><span><a class="GeneralHref" href="index.php?page=prob">قسم الأسئله والإستفسارات</a></span></p>
		  </div></td>
		  <td align=center ><div align="center">
		    <p><a href="index.php?page=user&amp;op=pass"><img src="./images/education/Application.png" alt="تغيير كلمة المرور" width="128" height="128" border="0" /></a></p>
		    <p><span><a title="انقر هنا لتغيير كلمة المرور" class="GeneralHref" href="index.php?page=user&amp;op=pass">تغيير كلمة المرور</a></span> </p>
		  </div></td>
	  </tr>
	    <tr>
	      <td colspan="3" align=center ><hr></td>
      </tr>
      <tr>
	    <td align=center ><div align="center">
	      <p><a href="index.php?page=user&amp;op=logout"><img src="./images/education/notebook_boy.png" alt="تسجيل الخروج" width="128" height="118" border="0" /></a></p>
	      <p><span><a title="انقر هنا للخروج من الموقع" class="GeneralHref" href="index.php?page=user&amp;op=logout">تسجيل خروج</a></span></p>
	    </div></td>
	    <td align=center >&nbsp;</td>
	    <td align=center >&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align=center ><hr></td>
      </tr>
</table>
    <div align="right"></div>
    <p>
      <?
}

?>
    </p>
    <TABLE width="100%" border=0 align="center" cellpadding="0" cellspacing="0" bordercolor="#A5C1ED" class="Table">
	<tr valign="Middle">
    	<td width="100%" align=center>
        	<?
				if (!isset($_SESSION['std_id']))
				{
					show_login_form();
				}
				else
				{
					show_user_menu();
				}
				
			?>
    	</td>
	</tr>
	
</TABLE>