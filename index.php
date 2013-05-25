<?php
include 'scripts/Mobile_Detect.php';
$detect = new Mobile_Detect();

if (($detect->isAndroidOS() || $detect->isiPhone() || $detect-> isPalmOS() || $detect->isWindowsPhoneOS() || $detect->isBlackBerryOS()) && !$detect-> isOpera()) {
    include 'smartphone.php';
}
else if($detect->isTablet()){
    include 'tabelt.php';
}
else if(!$detect->isTablet() && !$detect->isMobile()){
    include 'computer.php';
}
else {
    include 'default.php';
}

?>
