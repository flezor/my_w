<?php

// db class for mysql
// this class is used in all scripts
// do NOT fiddle unless you know what you are doing


define('DBARRAY_ASSOC', MYSQLI_ASSOC);


$new_link = defined( 'MYSQL_NEW_LINK' ) ? MYSQL_NEW_LINK : true;
		$client_flags = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;
		
if (!defined('DB_EXPLAIN'))
{
	define('DB_EXPLAIN', false);
}

if (!defined('DB_QUERIES'))
{
	define('DB_QUERIES', false);
}

class DB_Sql_vb
{
	var $database = '';
	var $link_id = 0;
	var $errdesc = '';
	var $errno = 0;
	var $reporterror = 1;
	var $appname = 'Adham_Abohatem';
	var $appshortname = 'Adham_Abohatem';
	var $var_i = 0;
	var $var_s ='';
	private $use_mysqli = false;

	function connect($server, $user, $password,$db, $usepconnect)
	{
		// connect to db server

		global $querytime;
		// do query

		if (DB_QUERIES)
		{
			echo "Connecting to database\n";

			global $pagestarttime;
			$pageendtime = microtime();
			$starttime = explode(' ', $pagestarttime);
			$endtime = explode(' ', $pageendtime);

			$beforetime = $endtime[0] - $starttime[0] + $endtime[1] - $starttime[1];

			echo "Time before: $beforetime\n";
			if (function_exists('memory_get_usage'))
			{
				echo "Memory Before: " . number_format((memory_get_usage() / 1024)) . 'KB' . " \n";
			}
		}
		if ( version_compare( phpversion(), '7.0', '>=' ) || ! function_exists( 'mysql_connect' ) ) {
				$this->use_mysqli = true;
			} 

		if (0 == $this->link_id)
		{
			if (empty($password))
			{
				if ($usepconnect == 1)
				{
				
					if ( $this->use_mysqli ) {
					$this->link_id = @mysqli_connect($server,$user, $password, $db, $new_link,$client_flags);
					mysqli_set_charset($this->link_id,'utf8');
			         }  
					
				}
			
			}
			else
			{
				if ($usepconnect == 1)
				{
				
					if ( $this->use_mysqli ) {
						$this->link_id = @mysqli_connect($server,$user, $password, $db, $new_link,$client_flags);
						mysqli_set_charset($this->link_id,'utf8');
			         } 
					
					
				}
			}
			if (!$this->link_id)
			{
				$this->halt('Link-ID == false, connect failed');
				return false;
			}

			$this->select_db($this->database);

			if (DB_QUERIES)
			{
				$pageendtime = microtime();
				$starttime = explode(' ', $pagestarttime);
				$endtime = explode(' ', $pageendtime);

				$aftertime = $endtime[0] - $starttime[0] + $endtime[1] - $starttime[1];
				$querytime += $aftertime - $beforetime;

				echo "Time after: $aftertime\n";
				echo "Time taken: " . ($aftertime - $beforetime) . "\n";
				if (function_exists('memory_get_usage'))
				{
					echo "Memory After: " . number_format((memory_get_usage() / 1024)) . 'KB' . " \n";
				}

				echo "\n<hr>\n\n";
			}

			return true;
		}
	}

	function affected_rows()
	{
		
		
			
		if ( $this->use_mysqli ) {
			$this->rows = mysqli_affected_rows($this->link_id);
			} 
		return $this->rows;
	}

	function geterrdesc()
	{
		if ( $this->use_mysqli ) {
			$this->error = mysqli_error($this->link_id);
			}  
		return $this->error;
	}

	function geterrno()
	{
		
		if ( $this->use_mysqli ) {
		   $this->errno = mysqli_errno($this->link_id);
			} 
		return $this->errno;
	}

	function select_db($database = '')
	{
		// select database
		if (!empty($database))
		{
			$this->database = $database;
		}
    if ( $this->use_mysqli ) {
		if(!@mysqli_select_db($this->link_id,$this->database ))
		{
			$this->halt('cannot use database ' . $this->database);
		}
		}  
		

	}

	function query_unbuffered($query_string)
	{
		return $this->query($query_string, 'mysql_unbuffered_query');
	}

	function shutdown_query($query_string, $arraykey = 0)
	{
		global $shutdownqueries;

		if (NOSHUTDOWNFUNC)
		{
			return $this->query($query_string);
		}
		elseif ($arraykey)
		{
			$shutdownqueries["$arraykey"] = $query_string;
		}
		else
		{
			$shutdownqueries[] = $query_string;
		}
	}

	function query($query_string, $query_type = 'mysqli_query')
	{
		global $query_count, $querytime;

		
        $query_string=$this->test_input_ums($query_string);
  
        if(!empty($query_string)){
		// do query
		if ( $this->use_mysqli ) {
			
		 		$query_id = mysqli_query($this->link_id,$query_string);
			}  
		
		$this->lastquery = $query_string;
			
		if (!$query_id)
		{
			$this->halt('Invalid SQL: ' . $query_string);
		}

		$query_count++;

		if (DB_QUERIES)
		{
			$pageendtime = microtime();
			$starttime = explode(' ', $pagestarttime);
			$endtime = explode(' ', $pageendtime);

			$aftertime = $endtime[0] - $starttime[0] + $endtime[1] - $starttime[1];
			$querytime += $aftertime - $beforetime;

			echo "Time after: $aftertime\n";
			echo "Time taken: " . ($aftertime - $beforetime) . "\n";
			if (function_exists('memory_get_usage'))
			{
				echo "Memory After: " . number_format((memory_get_usage() / 1024)) . 'KB' . " \n";
			}

		if (DB_QUERIES)
		{
			if ( $this->use_mysqli ) {
				
				$explain_id = mysqli_query($this->link_id,"EXPLAIN " . $query_string);
			} 
				
				echo "</pre>\n";
				echo '
				<table width="100%" border="1" cellpadding="2" cellspacing="1">
				<tr>
					<td><b>table</b></td>
					<td><b>type</b></td>
					<td><b>possible_keys</b></td>
					<td><b>key</b></td>
					<td><b>key_len</b></td>
					<td><b>ref</b></td>
					<td><b>rows</b></td>
					<td><b>Extra</b></td>
				</tr>
				';
				if ( $this->use_mysqli ) {
				while($array = mysqli_fetch_assoc($explain_id))
				{
					echo "
					<tr>
						<td>$array[table]&nbsp;</td>
						<td>$array[type]&nbsp;</td>
						<td>$array[possible_keys]&nbsp;</td>
						<td>$array[key]&nbsp;</td>
						<td>$array[key_len]&nbsp;</td>
						<td>$array[ref]&nbsp;</td>
						<td>$array[rows]&nbsp;</td>
						<td>$array[Extra]&nbsp;</td>
					</tr>
					";
				}
		   	}  
				
				echo "</table>\n<BR><hr>\n";
				echo "\n<pre>";
			}
			else
			{
				echo "\n<hr>\n\n";
			}
		}

		return $query_id;
	}
	else{
				echo "<html><head><title>acsess dnieded</title>";
	}
}
	function fetch_array($query_id, $type = MYSQLI_BOTH)
	{
		if ( $this->use_mysqli ) {
				
				return @mysqli_fetch_array($query_id,MYSQLI_BOTH);
			}  
		// retrieve row
		
	}

	function free_result($query_id)
	{
		// retrieve row
		if ( $this->use_mysqli) {
			return @mysqli_free_result($query_id);
			
		}  
		
	}

	function query_first($query_string, $type = MYSQLI_ASSOC)
	{
		// does a query and returns first row
		$query_id = $this->query($query_string);
		
		$returnarray = $this->fetch_array($query_id, MYSQLI_ASSOC);
		$this->free_result($query_id);
		$this->lastquery = $query_string;
		return $returnarray;
	}
	
	function query_prepare($query_string,$stmt_type)
	{
		/* create a prepared statement */
		 
		$stmt=mysqli_prepare($this->link_id,$query_string);
		
	if($this->var_i>0 and !empty($this->var_s))
		    mysqli_stmt_bind_param($stmt,$stmt_type,$this->var_i,$this->var_s);
	    elseif($this->var_i>0 and empty($this->var_s))
		    mysqli_stmt_bind_param($stmt,$stmt_type,$this->var_i);
		else
		    mysqli_stmt_bind_param($stmt,$stmt_type,$this->var_s);	
	
		mysqli_stmt_execute($stmt);
		
		return $stmt;
	 
	}
	
	
	
	function query_stmt_result($stmt)
	{
		 /* bind result variables */
        $result =mysqli_stmt_get_result($stmt);
		return @mysqli_fetch_array($result);

	}

	function data_seek($pos, $query_id)
	{
		// goes to row $pos
		return @mysql_data_seek($query_id, $pos);
	}

	function num_rows($query_id)
	{
		// returns number of rows in query
		if ( $this->use_mysqli ) {
				return mysqli_num_rows($query_id);
				
			} 
		
	}

	function num_fields($query_id)
	{
		// returns number of fields in query
		if ( $this->use_mysqli ) {
				return mysqli_num_fields($query_id);
			}  
		
	}

	function field_name($query_id, $columnnum)
	{
		// returns the name of a field in a query
	
		return mysql_field_name($query_id, $columnnum);
				
		
		
	}


	function close()
	{
		// closes connection to the database
	if ( $this->use_mysqli ) {
				return mysqli_close($this->link_id);
				}  
	}

	function print_query($htmlize = true)
	{
		// prints out the last query executed in <pre> tags
		$querystring = $htmlize ? htmlspecialchars($this->lastquery) : $this->lastquery;
		echo "<pre>$querystring</pre>";
	}

	function escape_string($string)
	{
		// escapes characters in string depending on Characterset
		if ( $this->use_mysqli ) {
				return mysqli_escape_string($string);
				}  
		
	}

	function halt($msg)
	{
		if ($this->link_id)
		{
			if ( $this->use_mysqli ) {
				$this->errdesc = mysqli_error($this->link_id);
				}  
			if ( $this->use_mysqli ) {
				$this->errno = mysqli_errno($this->link_id);
				}  
		}
		// prints warning message when there is an error
		global $technicalemail, $_SERVER;

		if ($this->reporterror == 1)
		{
			$message  = 'Database error in ' . $this->appname . ":\r\n\r\n$msg\r\n";
			$message .= 'mysql error: ' . $this->errdesc . "\r\n\r\n";
			$message .= 'mysql error number: ' . $this->errno . "\r\n\r\n";
			$message .= 'Date: ' . date('l dS of F Y h:i:s A') . "\r\n";
			$message .= "Script: http://$_SERVER[HTTP_HOST]" . $_SERVER['SCRIPT_NAME'] . "\r\n";
			$message .= 'Referer: ' . REFERRER . "\r\n";
			if ($bbuserinfo['username'])
		{
				$message .= 'Username: ' . $bbuserinfo['username'] . "\r\n";
			}
			$message .= 'IP Address: ' . $_SERVER['REMOTE_ADDR'] . "\r\n";


			if (!empty($technicalemail))
			{
				@mail ($technicalemail, $this->appshortname . ' Database error!', $message, "From: $technicalemail");
			}

			echo "<html><head><title>System Database Error</title>";
			echo "<style type=\"text/css\"><!--.error { font: 11px tahoma, verdana, arial, sans-serif; }--></style></head>\r\n";
			echo "<body></table></td></tr></table></form>\r\n";
			echo "<blockquote><p class=\"error\">&nbsp;</p><p class=\"error\"><b>There seems to have been a slight problem with the system database.</b><br />\r\n";
			echo "Please try again by pressing the <a href=\"javascript:window.location=window.location;\">refresh</a> button in your browser.</p>";
		//	echo "<p class=\"error\">An E-Mail has been dispatched to our <a href=\"mailto:$technicalemail\">Technical Staff</a>, who you can also contact if the problem persists.</p>";
			echo "<p class=\"error\">We apologise for any inconvenience.</p>";

			// display hidden error message
			//echo "</blockquote>\r\n\r\n<!--\r\n" . htmlspecialchars($message) . " -->";

			echo "\r\n\r\n</body></html>";
			exit;
		}
	}
	
		
 function test_input_ums($data) {
  $data = trim($data);
  $data = stripslashes($data);



	switch ($data){
	    
	    case (preg_match('/information_schema/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/schema/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/database/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/update/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/tables/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/tbl_user/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/tblums_admins/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/tblums_login/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/grant/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/execute/i',$data) ? true : false):
	    $data='';
        break;
	    case (preg_match('/script/i',$data) ? true : false):
	    $data='';
        break;
        case (preg_match('/exists/i',$data) ? true : false):
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
		case (preg_match("/UTL_/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/get_host_addr/i",$data) ? true : false):
		$data='';
        break;
		case (preg_match("/SYS.DBMS_LDAP.INIT/i",$data) ? true : false):
		$data='';
        break;
 
	   
        default :
	    return $data;
        break;
    }	
}
	
	
	
	

	
	
}



?>