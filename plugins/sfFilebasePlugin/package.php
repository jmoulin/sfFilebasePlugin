#!/usr/bin/php -q 
<?php
$dirs = array();
for($i=1; $i<count($_SERVER['argv']); $i++)
{
  $dirs[] = $_SERVER['argv'][$i];
}
$log = fopen(dirname(__FILE__) . '/files.txt', 'w+');

foreach($dirs AS $dir)
{
  $dir = dirname(__FILE__)  . '/' . $dir;
  iterate($dir);
}
function iterate($dir)
{
  global $log;
  foreach(new RecursiveDirectoryIterator($dir) AS $file)
  {
    if($file->isDir())
    {
      if(strpos($file->getFilename(), '.') !==0 )
      {
        //fwrite(STDOUT, $file->getFilename());
        iterate($file->getPathname());
      }
    }
    elseif($file->isFile())
    {
      $fname = str_replace(dirname(__FILE__), '', $file->getPathname());
      fwrite(STDOUT, $fname . "\n");
      fwrite($log, '<file role="data" name="' . $fname . '" />' . "\n");
    }
  }
}

fclose($log);
