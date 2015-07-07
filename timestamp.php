<?php
class scTimestamp
{
	private $timestamp;
	private $year;
	private $month;
	private $day;
	private $hour;
	private $minute;
	private $second;
	
	public function __construct() 
    {
		register_shutdown_function(array($this,'__destruct'));
		$this->setTimestamp($_SERVER['REQUEST_TIME']);
	}
	public function __destruct()
	{
		unset($this->timestamp);
		unset($this->year);
		unset($this->month);
		unset($this->day);
		unset($this->hour);
		unset($this->minute);
		unset($this->second);
	}
	private function rebuildTimestampFromDate()
	{
		$this->timestamp=mktime($this->hour,$this->minute,$this->second,$this->month,$this->day,$this->year);
	}
	private function rebuildDateFromTimestamp()
	{
		$this->day=date('j',$this->timestamp);
		$this->month=date('n',$this->timestamp);
		$this->year=date('Y',$this->timestamp);
		$this->hour=date('g',$this->timestamp);
		$this->minute=date('G',$this->timestamp);
		$this->second=date('s',$this->timestamp);		
	}
	public function setTimestamp($tempTimestamp)
	{
		$this->timestamp=$tempTimestamp;     
		$this->rebuildDateFromTimestamp();
	}
	public function getTimestamp()
	{
		return $this->timestamp;	
	}
	public function setYear($tempYear)
	{
		$this->year = $tempYear;
		$this->rebuildTimestampFromDate();
	}
	public function getYear()
	{
		return $this->year;
	}
	public function setMonth($tempMonth)
	{
		$this->month = $tempMonth;
        $this->rebuildTimestampFromDate();
	}
	public function getMonth()
	{
		return $this->month;
	}
	public function setDay($tempDay)
	{
		$this->day=$tempDay;
        $this->rebuildTimestampFromDate();
	}
	public function getDay()
	{
		return $this->day;
	}
	public function setHour($tempHour)
	{
		$this->hour = $tempHour;
        $this->rebuildTimestampFromDate();
	}
	public function getHour()
	{
		return $this->hour;
	}
	public function setMinute($tempMinute)
	{
		$this->minute = $tempMinute;
        $this->rebuildTimestampFromDate();
	}
	public function getMinute()
	{
		return $this->minute;
	}
	public function setSecond($tempSecond)
	{
		$this->second = $tempSecond;
        $this->rebuildTimestampFromDate();
	}
	public function getSecond()
	{
		return $this->second;
	}
	
	
	public function getDateDifferenceFromNow()
	{
		return $this->getDateDifferenceFrom($_SERVER['REQUEST_TIME']);
	}
	public function getDateDifferenceFrom($fromDate)
	{
		$return="";
		$sec=" Second";
		$min=" Minute";
		$hrs=" Hour";
		$before=" Before";
		$difference=$fromDate-$this->getTimestamp();
		if($difference<0)
			$return.="In the Future";
		else if($difference<60)
		{
			if($difference>1)
				$sec.="s";
			$return.= $difference.$sec.$before;
		}
		else if($difference<3600)
		{
			$difference=intval($difference/60);
			if($difference>1)
				$min.="s";
			$return.=$difference.$min.$before;
		}
		else if($difference<86400)
		{
			$difference=intval($difference/3600);
			if($difference>1)
				$hrs.="s";
			$return= $difference.$hrs.$before;
		}
		else if($difference<604800)
		{
			$return.= date("l g:i a",$this->getTimestamp());
		}
		else if($difference<28512000)
		{
			$return.= date("F j",$this->getTimestamp());
		}
		else
		{
			$return.= date("F j, Y, g:i a",$this->getTimestamp());
		}
		return $return;
	}
	public function getDateAsString()
	{
		return date("F j, Y",$this->getTimestamp());
	}
	public function getDateTimeAsString()
	{
		return date("F j, Y, g:i a",$this->getTimestamp());
	}
	
	
	public function __toString()
	{
		$return = NEW_LINE."^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
		$return.= NEW_LINE." ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^".NEW_LINE;
		$return.= NEW_LINE."@@ Timestamp: ".$this->getTimestamp()." @@".NEW_LINE;
		$return.= NEW_LINE."@@ Date: ".$this->getDateTimeAsString()." @@".NEW_LINE;
		$return.= NEW_LINE." ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^".NEW_LINE;
		return $return;
	}
	
}
?>
