<?php
class csv extends mysqli
{
	public function __construct()
	{
		parent::__construct("localhost","root","","pwluas");
		if ($this->connect_error) {
			echo "Failed to connect to database".$this->connect_error;
		}
	}
	
	public function import($file)
	{
		$file = fopen($file, 'r');

		while ($row = fgetcsv($file)) {
				// var_dump($row);
			print "<pre>";
			print_r($row);
			print "</pre>";
		}
		fclose($file);
	}
}