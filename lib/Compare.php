<?php
/**
 * Script to compare two direcotries
 */
class Compare
{

	private $directory1;
	private $directory2;
	
	function __construct($directory1,$directory2)
	{
		$this->directory1=$directory1;
		$this->directory2=$directory2;
	}

	private function getDirectoryStructure($directory,&$files,&$filesd){
		$result = array();

		$tree = scandir($directory);
	    foreach ($tree as $key => $value){
	    	if (!in_array($value,array(".",".."))){
	    		$path = realpath($directory.DIRECTORY_SEPARATOR.$value);
	        	if (is_dir($directory . DIRECTORY_SEPARATOR . $value)){
	            	$result[$value] = $this->getDirectoryStructure($directory . DIRECTORY_SEPARATOR . $value,$files,$filesd);
	        	} else {
	            	$result[] = $path;
	            	$files[] = $path;
	            	if(strpos($directory, $this->directory1)!==false)
	            		$filesd[] = str_replace($this->directory1, $this->directory2, $path);
	            	else
	            		$filesd[] = str_replace($this->directory2, $this->directory1, $path);
	            }
	      	}
	    }

	   return $result;
	}

	private function compareFiles($file1,$file2){
		if(sha1_file($file1) !== sha1_file($file2)){
        	$lines1=file($file1);
        	$lines2=file($file2);
        	return array(array_diff($lines1,$lines2),array_diff($lines2, $lines1));
		} else
        	return false;
	}

	private function filesDiff($files1,$files2){
		$files=array();
		foreach($files1 as $file){
			$file2=str_replace($this->directory1, $this->directory2, $file);
			if(file_exists($file2)){
				$diff=$this->compareFiles($file,$file2);
				if(is_array($diff))
					$files[]=array('file'=>$file,'diff'=>$diff);
			}
		}

		return $files;
	}

	public function compareDirectory(){
		$files1=array();
		$files2=array();
		$fiels12=array();
		$files21=array();
		
		$this->getDirectoryStructure($this->directory1,$files1,$files12);
		$this->getDirectoryStructure($this->directory2,$files2,$files21);

		$filesInDir1Only=array_diff($files1, $files21);
		$filesInDir2Only=array_diff($files2, $files12);
		$filesCommonDiff=$this->filesDiff($files1, $files2);

		return array($filesInDir1Only,$filesInDir2Only,$filesCommonDiff);
		
	}

}