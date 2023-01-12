<?php

class facDatabase {

	private $pg_pdo;
	private $docpath;
	
	public function __construct() {

		include './config.php';
		$this->docpath = $docpath;
		// initialize variables
		
		// connect to wws/erp fpr invoice details
		$this->pg_pdo = new PDO($wwsserver, $wwsuser, $wwspass, $options);
	}
	
	public function splitQuery($sql, $splitField, $parameter, $outputFilePrefix, $header, $createType = "a") {
	
		$row_qry = $this->pg_pdo->prepare($sql);

		foreach ($parameter as $key => $value) {
			$row_qry->bindValue($key, $value);
		}
		
		$row_qry->execute() or die (print_r($row_qry->errorInfo()));
		
		$switch = null;
		$path = pathinfo($outputFilePrefix);

		while ($row = $row_qry->fetch( PDO::FETCH_ASSOC )) {

			if ( ($switch != $row[$splitField]) or (!isset($output)) ) {

				if (isset($output) and (get_resource_type($output) === 'file')) { fclose($output); }
				print "<a href='".$this->docpath.$path['filename'].'_'.$row[$splitField].'.'.$path['extension']."'>";
				print $this->docpath.$path['filename'].'_'.$row[$splitField].'.'.$path['extension']."</a><br>";
				$output = fopen($this->docpath.$path['filename'].'_'.$row[$splitField].'.'.$path['extension'], $createType);
				if ($header == null) {
					fputcsv($output, array_keys($row),";",'"');
				} else {
					fputcsv($output, $header,";",'"');					
				}
				$switch = $row[$splitField];

			}
			foreach($row as $key => $value) {
				if((is_numeric($value)) and (strpos($value,'.') !== false)){
					$row[$key] = str_replace(".",",",round($value,3));
				}
			}
			fputcsv($output, $row,";",'"');

		}
		
		fclose($output);

	}
	
}
?>
