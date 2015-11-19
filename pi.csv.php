<?php

use SimpleExcel\SimpleExcel;

require  'vendor/autoload.php';

class Plugin_csv extends Plugin
{
	var $meta = array(
		'name'			 => 'csv',
		'version'		 => '0.1',
		'author'		 => 'Clay Harmon',
		'author_url' => 'http://clayharmon.com'
		);


		public function read()
		{
				// check for required plugin parameters
				if (! $filepath = $this->fetchParam("file") )
				{
					return ("filename(with path) must be specified");
				}
				$file     = Request::get('$filepath');
				$filename = Path::fromAsset($file);

				if( ! File::exists($filename)){
					return ("file does not exist");
				}
				
				if (! $header_flag = $this->fetchParam("header") )
				{
					return ("must specify if header lines is first line of file");
				} 

				$parse = get_csv($filepath, $header_flag);

				return $parse;
				
		}
		
}
function get_csv( $filepath, $header_flag){

	$inputCsv = new SimpleExcel('csv');

	$inputCsv->parser->loadFile($filepath);
		
	$raw = $inputCsv->parser->getfield();

	if($header_flag == 'yes'){
		$header = $raw[0];
		$num_data_rows = count($raw)-1;
	}
	elseif ($header_flag == 'no'){
		$header[0] = '';
		$num_data_rows = count($raw);

	}
	for ( $x = 0; $x < $num_data_rows; $x++ )
	{
		if($header_flag == 'yes'){
			$data[$x]=['columns' => $raw[($x+1)]];
		}
		elseif($header_flag == 'no'){
			$data[$x]=['columns' => $raw[($x)]];
		}
		
	}

	    $csvToArray = ['header' => $header, 'rows' => $data];

	return $csvToArray;
}

