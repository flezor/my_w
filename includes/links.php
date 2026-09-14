<?php 

$path = $_SERVER['PHP_SELF'];
$file = strtolower(basename($path));
if ($file == 'links.php')
{
	exit;
}
if(isset($_GET['page']))
{
switch ($_GET['page'])
{

	case 'study_form':
		include('includes/study_form.php');
        break;

	default:
        break;
}
}


?>