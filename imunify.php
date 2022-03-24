<?php
/*
Imunify Cpanel read files poisoned and add any action:
ex: (root shell)
php imunify.php | xargs rm -rfv (command list all files detected by imunify360 and remove)
*/

    $myPDO = new PDO('sqlite:/var/imunify360/imunify360.db');
    $result = $myPDO->query("select * from malware_history");
        foreach($result as $row)
    {
        print $row['path'] . "\n";
    }
?>
