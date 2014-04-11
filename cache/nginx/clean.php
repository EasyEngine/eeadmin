<?php 
/* 
  This script assumes you are using nginx fastcgi-cache as rtCamp/EasyEngine uses
*/

function unlinkRecursive($dir, $deleteRootToo)
{
    if(!$dh = opendir($dir))
    {
        return;
    }
    while (false !== ($obj = readdir($dh)))
    {
        if($obj == '.' || $obj == '..')
        {
            continue;
        }

        if (@!unlink($dir . '/' . $obj))
        {
            unlinkRecursive($dir.'/'.$obj, true);
        }
    }

    closedir($dh);

    if ($deleteRootToo)
    {
       @rmdir($dir);
    }

    return;
}

/*
  Change your cache location here. 
  Leave false as it is so that parent cache folder will not be deleted.
*/

unlinkRecursive("/var/run/nginx-cache/", false) ;

echo "Nginx cache cleaned" ;

?>
