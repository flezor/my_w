<?php 
class fun_check{
	
  public $ckeck;
 
 function test_input_ums($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);


	switch ($data){
		
	    case (preg_match('/information_schema/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/schema/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/table_schema/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/database/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/show/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/tables/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/select/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/insert/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/update/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/delete/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/tbl_user/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/tbl_admins/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/tbl_login/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/grant/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/execute/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/exists/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/script/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/UNION/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/NULL,NULL/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/0x/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/--/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/DROP/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/SUBSTRING/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/ISNULL/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/NOT EXIST/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/EXIST/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/NOT IN/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/IF\(/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/ASCII/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/sysObjects/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/waitfor delay/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/BENCHMARK/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/sleep/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/sleep\(/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/pg_sleep/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/SHA1/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/DUMPFILE/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/LockWorkStation/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/exitprocess/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/mysql/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/boot.ini/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/MD5/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/OUTFILE/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/.REQUEST/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/LOAD_FILE/i',$data) ? true : false):
	    $data='';
        break;
		case (preg_match('/;#/',$data) ? true : false):
	    $data='';
        break;
		case (preg_match("/\/\*/",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/HAVING/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/convert\(/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/\(CASE/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/CASE\(/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/foo\(/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/queryout/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/sysprocesses/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/DECLARE/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/@result/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/root@/i",$data) ? true : false):
		$data='';
        break; 		
		case (preg_match("/SHOWCONTIG/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/xp_cmdshell/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/xtype/i",$data) ? true : false):
		$data='';
        break; 	
		case (preg_match("/1=1/i",$data) ? true : false):
		$data='';
        break; 
		case (preg_match("/xx@xx/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/INJECTION/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/UTL_/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/get_host_addr/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/SYS.DBMS_LDAP.INIT/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/inetpub/i",$data) ? true : false):
		$data='';
        break;

		
		
        default :
	    return $data;
        break;
    }	
}
 


}


function print_message($msg)
{
?>
    <table cellspacing="5" cellpadding="1" width="100%" border=0 align=center>
        <tr>
            <td align="center">
                <font class="Message">
                    <?php echo $msg ; ?> <br>
                </font>
            </td>
        </tr>
    </table>
<?php
}

function print_go_back($msg = "ÚæÏÉ")
{
    echo "<center><a class='GeneralHref' href=\"javascript:history.back()\"><span class='ClickHere'>$msg</span></a></center>";
}

function print_link($url, $msg = 'ÇäŞÑ åäÇ')
{
    echo "<center><a title='ÇäŞÑ åäÇ' class='GeneralHref' href=\"$url\"><span class='ClickHere'>$msg</span></a></center>";
}

function check_file_type($file_name)
{
	global $DB_site;

	if ($file_name == '')
	{
		return true;
	}

	// ÇÓÊÎÑÇÌ ÇáÇãÊÏÇÏ
	$ext = explode('.', $file_name);
	$ext = $ext[count($ext) - 1];

	// İÍÕ ÇáÇãÊÏÇÏ
	$file_type = $DB_site->query_first("select type_id from tbl_uploader_file_type where file_type = '$ext'");
	if ($file_type['type_id'] == '')
	{
		print_message('åĞÇ ÇáäæÚ ãä ÇáãáİÇÊ ÛíÑ ãÓãæÍ Èå');
		print_go_back();
		return false;
	}

	return true;
}

$perpage = 5;  //ÚÏÏ ÇáÕİæİ İí ßá ÕİÍÉ

function naifhreftag($url, $text, $title = '')
{
 return '<a href="' . $url . '"' . ifelse($title, ' title="' . $title . '"' , '') . '>' . $text . '</a>';
}

function ifelse($expression, $returntrue, $returnfalse)
{
	if($expression) return $returntrue;
 	else return $returnfalse;
}

function naifpagelink($link, $page_bar, $pages, $char = '?')
{
	global $template;
	$pagelink = "ÇáÕİÍÉ: ";

	if ($page_bar - 5 > 1)
	{
		$pagelink .= '[' . naifhreftag($link . $char . 'page_bar=1', '&laquo;', 'ÇáÕİÍÉ ÇáÃæáì') . '] ';
	}

	if ($page_bar > 1)
	{
		$pagelink .= '[' . naifhreftag($link . $char . 'page_bar=' . ($page_bar - 1), '‹', 'ÇáÕİÍÉ ÇáÓÇÈŞÉ') . '] ';
	}

	$count = ifelse($page_bar + 5 >= $pages, $pages, $page_bar + 5);
	for ($i = $page_bar - 5; $i <= $count; $i++)
	{
		if ($i < 1)
		{
			$i = 1;
		}

		if ($i == $page_bar)
		{
			$pagelink .= "($i) ";
		}
		else
		{
			$pagelink .= '[' . naifhreftag($link . $char . 'page_bar=' . ($i), $i) . '] ';
		}
	}

	if ($page_bar < $pages)
	{
		$pagelink .= '[' . naifhreftag($link . $char . 'page_bar=' . ($page_bar + 1) , '›', 'ÇáÕİÍÉ ÇáÊÇáíÉ' ) . ']';
	}

	if ($page_bar + 5 < $pages)
	{
		$pagelink .= '[' . naifhreftag($link . $char . 'page_bar=' . $pages, '»', 'ÇáÕİÍÉ ÇáÃÎíÑÉ') . ']';
	}

	return $pagelink;
}

?>