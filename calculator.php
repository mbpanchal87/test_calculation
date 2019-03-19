<?php
class calculation{
 private $_type;
 private $num_arr;
 
 public function __construct($type, $num_arr){	  
	$number_str = preg_replace('/[^0-9-]+/', ',', $num_arr);
	$num_arr = explode( ',', $number_str );
	
	$num_arr = array_filter($num_arr);
	$num_arr = array_filter($num_arr, array($this, 'checkarrayvalue'));	
	$this->_type = $type;
	$this->num_arr = $num_arr;
 }
 private function checkarrayvalue($var) { return $var < 1000; }
 public function calculator(){		
	if($this->_type == "sum" || $this->_type == "add")
	{
		if(min($this->num_arr) < 0)
		{
			$negative_num = array();
			foreach($this->num_arr as $arr_v)
			{
				if($arr_v < 0)
				{
					$negative_num[] = $arr_v;
				}
			}
			$str_negative_num = implode(',',$negative_num);
			return "Error: Negative numbers($str_negative_num) not allowed.";
		}
		else
		{
			return array_sum($this->num_arr);
		}
	}
	else if($this->_type == "multiply")
	{
		return array_product($this->num_arr);
	}
}
}


if (defined('STDIN')) {  
  $calculation = new calculation($argv[1],$argv[2]);
  $result = $calculation->calculator();
  echo $result;
}

?>


