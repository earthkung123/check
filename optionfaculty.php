<?php
	function get_options()
	{
		$faculty=array('บริหารธุรกิจ'=>'1','ศิลปศาสตร์'=>2);
		$options ='';
		while(list($k,$v)=each($faculty))
		{
			$options.='<option value="'.$v.'">'.$k.'</option>';
		
		}
		return $options;
	}
	if(isset($_POST['faculty']))
	{
		echo $_POST['faculty'];
	}
?>