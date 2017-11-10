<?php
/*************************  
  @HEADER@
  $Date: 2009-06-17 22:57:10 +0200 (Mi, 17 Jun 2009) $
  $Revision: 73 $
**********************************************/

define( '_VALID_TWG', '42' ); 
@session_start();

// we keep this here as the zip lib is not php 7 compatible.
function fixPattern($pattern) {
  if ($pattern[0] == "\\") {
     return substr($pattern,1); 
  }
  return $pattern;
}

if(!function_exists('ereg')) { 
  function ereg($pattern, $subject, &$matches = null) { 
     $pattern = fixPattern($pattern);
     if ($matches == null) { 
         return preg_match('/'.$pattern.'/', $subject); 
     } else {
         return preg_match('/'.$pattern.'/', $subject, $matches); 
     }
  } 
}
if(!function_exists('eregi')) { 
  function eregi($pattern, $subject, &$matches = null) { 
       $pattern = fixPattern($pattern);
       if ($matches == null) {
           return preg_match('/'.$pattern.'/i', $subject); 
       } else {
           return preg_match('/'.$pattern.'/i', $subject, $matches); 
       }    
 } 
}

$timezone = ''; // Please set your timezone here if you have problems with timezones - if you need exact times - enter your timezone - see http://www.dynamicwebpages.de/php/timezones.php
ob_start();
if (function_exists('date_default_timezone_set')) { // php 5.1.x
   if ($timezone != '') {
     @date_default_timezone_set($timezone);
   } else if (function_exists('date_default_timezone_get')) {
     @date_default_timezone_set(@date_default_timezone_get());
   } else {
     @date_default_timezone_set('Europe/Berlin');
   }
}
ob_end_clean();

if (isset($_GET["lang"])) {
    $_SESSION["twg_language"] = $_GET["lang"];
} 

if (!isset($_SESSION["twg_language"])) {
    if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
        $lang_browser = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        if ($lang_browser == "de") {
            $_SESSION["twg_language"] = "de";
        } else {
            $_SESSION["twg_language"] = "en";
        } 
    } 
    $_SESSION["twg_language"] = "en";
} 

$GLOBALS["language"] = $_SESSION["twg_language"];

$GLOBALS["en"] = array("delete" => "Delete ",
    "ok" => "OK",
    "error" => "ERROR",
    "notexist" => " does not exist.",
    "installok" => "TWG installation sucessfull",
    "updateok" => "TWG update sucessfull",
    "readthis" => "PLEASE READ THIS!",
    "success1" => "You have suchessfully installed TWG. Please read how-to 1 to make TWG secure.<br/>The installation script does not do this because it could be possible that you cannot access/delete your files with your FTP program anymore!",
    "success2" => "The installer has installed a small sample gallery. Please delete this gallery if it is shown nicely. You can get some help by looking at the examples. It shows which files you can place in the folders to adopt TWG to your needs! Read the how-to\'s to get the maximum out of TWG!",
    "success3" => "By default the parameter \$cache_dirs is set to false in the config. Please change this parameter to true if you are done with your basic setup! A red 'No Cache' text is shown as long as this parameter is set to false.",
    "success4" => "You can configure lot of features of TWG in the TWG admin in the configuration page. Use the Color Manager to create a basic style sheet with you color settings.<br/>If you don't use the TWG Admin you can configure TWG by changing parameters in the config.php file in the main directory! I recommend to store your settings in a file called my_config.php and all css changes in the file my_style.css. This makes it easier for you to upgrade or to see your modifications!<br/>Below is a extended version of the TWG info - you can see if you have any restrictions using TWG.",
    "success5" => "Safe mode is enabled on your system. Please read how-to 30 about the restrictions.",
    "success6" => "Please delete the install files! Otherwise anyone can reinstall TWG!",
    "success7" => "Delete install files",
    "success8" => "You can now go to the areas of TWG:",
    "success9" => "The default login/password for the TWG admin is admin/twg_admin.",
    "success10" => "If you need some help please go to the how-to's and the forum first. Maybe someone had the same problem already. ",
    "success11" => "Have fun using TWG",
    "error1" => "TWG installation NOT sucessfull",
    "error2" => "TWG could not be installed! If the installer fails please use the 'normal' way like described on the website or the readme",
    "error3" => "Error: ",
    "errorallready" => "You already deleted the installation files!",
    "updatejs1" => "TWG is already installed in this directory.\\nAll files except the my_config.php, my_style.css\\nthe user file and the pictures directory are overwritten!\\nDo you want to continue with the update?",
    "updatetext" => "Update",
    "installjs1" => "You have Safe Mode enabled.\\nTherefore TWG is installed in the directory \'twg\'\\nAre you sure you want to continue?",
    "installtext" => "Install",
    "welcome" => "Welcome to the installer of TWG. The installer will extract TWG into the current directory and makes the directories and files writeable if needed!",
    "installerror1" => "TWG cannot create directories in the current folder. Please change the permissions of this folder to 777 with your FTP program<br/>&nbsp;<br/>Please try again after you have changed the permissions!",
    "installisok" => "Safe Mode restictions to not apply on your system and therefore you can upload and <br/>manage your files either with the TWGXplorer of the TWG admin or your FTP program.",
    "installerror2" => "Safe Mode enabled on your system and therefore you have some restrictions if you use the installer!<br/>&nbsp;<br/>If you continue this installation you can only upload and manage your files with the TWGXplorer. You cannot use your FTP program because the safe mode does not allow that someone who is not the owner of a file can access/modify it. Because the installation is done by the php user TWG cannot work properly if your files are uploaded with a FTP program.<br/>&nbsp;<br/>I do not recommend to continue the installation if you are not sure what your are doing. Use the normal install of TWG and manage your files with your FTP program! Please read how-to 30 on the website for more details! If you don't have the www-run problem described in how-to 30 you can continue without restrictions.<br/>&nbsp;<br/>Because of the safe mode restrictions TWG is installed in the subdirectory 'twg'.",
    "installold" => "An older version of TWG is already installed in this directory.<br/>&nbsp;<br/>You can only update version 1.4 or newer!",
    "manually" => "You can install TWG very easy manually as well - please read the installation instructions on the website or in the readme's.",
    "checkh1" => "TWG installation check for TWG ",
    "checkt1" => "If any of these items are highlighted in red then please take actions to correct them. Failure to do so could lead to your TWG installation not functioning correctly.<br/>Yellow means that some functions tests failed and this feature is not available. You can call the info.php after the installation for a more detailed check! In the TWG admin is the full version of this check available!",
    "header" => "TWG installation",
    "checkt2" => "These settings are recommended for PHP in order to ensure full compatibility with TWG.<br>However, TWG will still operate if your settings do not quite match the recommended",
    "yes" => "Yes",
    "no" => "No",
    "available" => "Available",
    "unavailable" => "Unavailable",
    "nojs" => "Most features of TWG are disabled without Javascript",
    "checkphp" => "PHP version >= 4.3.0",
    "checkxml" => "XML support",
    "checkgd" => "GD lib support",
    "checkgdversion" => "GD lib >= 2.0",
    "memory" => "Memory limit",
    "memorynotdetected" => "Memory limit not detected",
    "limit1" => "Very Good",
    "limit2" => "O.k. but don\'t use large images",
    "limit3" => "Only use small images",
    "watermark" => "Text watermark",
    "remote" => "Remote jpg support",
    "upload" => "File uploads",
    "uploadmax" => "Upload max filesize",
    "uploadnotdetected" => "Upload max filesize not detected",
    "resize" => "Resize images",
    "back" => "Back",
    "notfound" => "not found",
    "checkh2" => "Recommended settings:",
    "checkr1" => "Directive",
    "checkr2" => "Recommended",
    "checkr3" => "Actual",
    "delete1" => "Removing TWG installation files:",
    "delete2" => "Removing TWG installation copies because of <br>safe mode:",
    "delete3" => "If not all files could be deleted please delete the remaining files with your FTP program.",
    "showphpinfo" => "Show php info",
    "checkagain" => "Check Again",
    "updatewrong" => "TWG is already installed in this directory. Safe mode is enabled and because of this the installer will install TWG into the directory 'twg'. Therefore this is not an update but a new installation. If you don't like this please use the manual install for your gallery!",
    "filesmissing" => "The required files for the installation are missing. Please make sure that you have copied  install.lib.php and install_twg.zip."
    );

$GLOBALS["de"] = array("delete" => "L&ouml;schen ",
    "ok" => "OK",
    "error" => "FEHLER",
    "notexist" => " existiert nicht.",
    "installok" => "TWG Installation erfolgreich",
    "updateok" => "TWG Update erfolgreich",
    "readthis" => "BITTE LESEN!",
    "success1" => "TWG wurde erfolgreich installiert. Bitte lest how-to 1 um TWG sicher zu machen.<br/>Das Installationsskript macht diese Anpassungen nicht, da es m&ouml;glich sein kann, das die Dateien nicht mehr mit dem FTP Programm gel&ouml;scht btw. ge&auml;ndert werden k&ouml;nnen!",
    "success2" => "Der Installer hat eine kleine Beispielgalerie installiert. Bitte l&ouml;scht diese Galerie, wenn Sie richtig angezeigt wird. Die Beispielgalerie zeigt euch ein paar M&ouml;glichkeiten und zus&auml;tzliche Dateien, die man verwenden kann, um TWG anzupassen. Lest auch die how-to\'s um TWG optimal zu konfigurieren!",
    "success3" => "Nach der Installation ist der Parameter \$cache_dirs auf false gesetzt. Dieser sollte auf true gesetzt werden, wenn ihr mit eurem Setup fertig seit. Ein roter 'No Cache' Text wird solange angezeigt so lange dieser Parameter auf false gesetzt ist!",
    "success4" => "Ihr k&ouml;nnt die wichtigsten Einstellungen im TWG Admin unter Configuration machen. Um Farben anzupassen k&ouml;nnt ihr den Color Manager verwenden! <br/>TWG kann manuell &uuml;ber die config.php Datei im Hauptverzeichnis konfiguriert werden. Ich empfehle, alle &Auml;nderungen in der Datei my_config.php und alle css &Auml;nderungen in der Datei my_style.css zu speichern. Das macht es einfacher TWG zu aktualisieren und eure Einstellungen zu sehen.<br/>Unten wird eine erweiterte Version der TWG info zu sehen - Hier wird angezeigt, welche Features m&ouml;glicherweise nicht genutzt werden k&ouml;nnen. Hier k&ouml;nnt ihr sehen, welche Einschr&auml;nkungen beim Betrieb von TWG vorhanden sind.",
    "success5" => "Safe mode ist auf diesem System aktiv. Bitte lest how-to 30 &uuml;ber die Restriktionen.",
    "success6" => "Bitte l&ouml;scht die Installationsdateien! Sonst ist es m&ouml;glich, dass jeder TWG erneut installieren kann!",
    "success7" => "L&ouml;sche Installationsdateien",
    "success8" => "Ihr k&ouml;nnt nun in die folgenden Bereiche von TWG gehen:",
    "success9" => "Der Standardbenutzer/Standardpasswort f&uuml;r den TWG admin ist admin/twg_admin.",
    "success10" => "Wenn ihr Hilfe ben&ouml;tigt schaut euch bitte zuerst die how-to's an und sucht im Forum. Vielleicht hatte ja jemand genau euer Problem bereits. ",
    "success11" => "Viel Spaß mit der TWG",
    "error1" => "TWG Installation war NICHT erfolgreich",
    "error2" => "TWG konnte nicht installiert werden! Wenn der Installer nicht funktioniert lest bitte im readme nach, wie ihr TWG 'normal' installieren k&ouml;nnt.",
    "error3" => "Fehler: ",
    "errorallready" => "Die Installationsdateien sind bereits gel&ouml;scht!",
    "updatejs1" => "TWG ist in diesem Verzeichnis bereits installiert.\\nAlle Dateien außer my_config.php, my_style.css\\nder Benutzerdatei und das pictures Verzeichnis werden &uuml;berschrieben!\\nSoll TWG aktualisiert werden?",
    "updatetext" => "Update",
    "installjs1" => "Safe Mode ist aktiv.\\nAus diesem Grund wird TWG im Verzeichnis \'twg\' installiert\\nSoll TWG installiert werden?",
    "installtext" => "Installieren",
    "welcome" => "Willkommen bei der Installation von TWG.<br>Der Installer extrahiert TWG in das aktuelle Verzeichnis, erzeugt alle Verzeichnisse und setzt die erforderlichen Rechte!",
    "installerror1" => "TWG kann im aktuellen Verzeichnis kein Verzeichnis erzeugen. Bitte &auml;ndert die Rechte des Verzeichnisses mit dem FTP Programm auf 777.<br/>&nbsp;<br/>Bitte versucht es erneut, nachdem ihr die Rechte ge&auml;ndert habt!",
    "installisok" => "Safe Mode Restriktionen sind auf diesem System nicht aktiv und deswegen kann man Dateien mit einem FTP Programm und/oder dem TWGXplorer des TWG Admin verwalten.",
    "installerror2" => "Safe Mode ist auf diesem System aktiv und deswegen gibt es einige Einschr&auml;nkungen, wenn der Installer benutzt wird!<br/>&nbsp;<br/>Wenn die Installation durchgef&uuml;hrt wird, k&ouml;nnen Uploads und Aktionen an Dateien wahrscheinlich nur noch mit dem TWGXplorer durchgef&uuml;hrt werden. Man kann das FTP Programm evtl. nicht benutzen, weil durch den Safe Mode nur der Eigent&uuml;mer der Datei diese &auml;ndern kann. Da die Installation unter dem PHP Benutzer durchgef&uuml;hrt wird, kann es sein, dass man Dateien nicht mehr benutzen kann, welche per FTP hochgeladen wurden.<br/>&nbsp;<br/>Ich empfehle, die Installation mit dem Installer nur durchzuf&uuml;hren, wenn ihr wist was ihr tut bzw. zumindest danach testet, ob ihr das Problem habt. Ihr k&ouml;nnt sonst immer noch die normale Installation machen und dann eure Dateien per FTP durchf&uuml;hren! Bitte lest how-to 30 auf der Webseite f&uuml;r mehr Informationen! Wenn ihr das dort beschriebene www-run Problem nicht habt funktioniert TWG auch mit dem Installer ohne Einschr&auml;nkungen<br/>&nbsp;<br/>Wegen der Safe Mode Einschr&auml;nkungen wird TWG im Unterverzeichnis 'twg' installiert.",
    "installold" => "Eine &auml;ltere Version von TWG ist bereits installiert.<br/>&nbsp;<br/>Man kann mit diesem Installer nur Version 1.4 oder neuer aktualisieren!",
    "manually" => "Man kann TWG auch sehr einfach manuell installieren - Bitte lest die Installationsanleitung auf der Webseite oder in den readme's.",
    "checkh1" => "TWG Installationscheck f&uuml;r TWG ",
    "checkt1" => "Wenn Tests mit rot markiert sind, sollten diese Probleme behoben werden. Ansonsten k&ouml;nnte es sein, dass die TWG Installation nicht korrekt funktioniert.<br/>Gelb bedeutet, dass der Test nicht erfolgreich war und dieses spezielle Feature nicht verf&uuml;gbar ist. Die info.php zeigt nach der Installation eine detailliertere &Uuml;berpr&uuml;fung. Im TWG Admin ist die komplette Version der Infoseite verf&uuml;gbar!",
    "header" => "TWG Installation",
    "checkt2" => "Diese Einstellungen f&uuml;r PHP werden empfohlen, damit TWG optimal l&auml;uft.<br>In den meisten F&auml;llen l&auml;uft TWG jedoch auch, wenn nicht alle Voraussetzungen erf&uuml;llt sind.",
    "yes" => "Ja",
    "no" => "Nein",
    "available" => "Verf&uuml;gbar",
    "unavailable" => "Nicht verf&uuml;gbar",
    "nojs" => "Die meisten Features von TWG sind ohne Javascript nicht verf&uuml;gbar",
    "checkphp" => "PHP Version >= 4.3.0",
    "checkxml" => "XML Unterst&uuml;tzung",
    "checkgd" => "GD lib Unterst&uuml;tzung",
    "checkgdversion" => "GD lib >= 2.0",
    "memory" => "Speicherlimit",
    "memorynotdetected" => "Speicherlimit nicht gefunden",
    "limit1" => "Sehr gut",
    "limit2" => "O.k. aber keine großen Bilder verwenden",
    "limit3" => "Nur kleine Bilder verwenden",
    "watermark" => "Text Wasserzeichen",
    "remote" => "Remote jpg Unterst&uuml;tzung",
    "upload" => "Datei Uploads",
    "uploadmax" => "Maximale Upload Dateigr&ouml;sse",
    "uploadnotdetected" => "Maximale Upload Dateigr&ouml;sse nicht gefunden",
    "resize" => "Bilder anpassen",
    "back" => "Zur&uuml;ck",
    "notfound" => "nicht gefunden",
    "checkh2" => "Empfohlene Einstellungen:",
    "checkr1" => "Einstellung",
    "checkr2" => "Empfohlen",
    "checkr3" => "Aktuell",
    "delete1" => "Entferne TWG Installationsdateien:",
    "delete2" => "Entferne TWG Installationskopien, die wegen safe mode ben&ouml;tigt wurden:",
    "delete3" => "Wenn nicht alle Dateien gel&ouml;scht werden konnten, l&ouml;scht diese bitte mit eurem FTP Programm.",
    "showphpinfo" => "Zeige php info",
    "checkagain" => "Nochmals &uuml;berpr&uuml;fen",
    "updatewrong" => "TWG ist bereits in diesem Verzeichnis installiert. Safe mode ist aktiv und deswegen installiert der Installer TWG in das Verzeichnis 'twg'. Somit ist dies eine neue Installation und kein Update. Wenn dies nicht gew&uuml;nscht wird, muss eine manuelle Installation wie im readme beschrieben gemacht werden!",
    "filesmissing" => "Es sind nicht alle Dateien f&uuml;r die Installation vorhanden. Es werden f&uuml;r die Installation die Dateien install.lib.php und install_twg.zip ben&ouml;tigt."
    );

function get_php_setting($val)
{
    $r = (ini_get($val) == '1' ? 1 : 0);
    return $r ? 'ON' : 'OFF';
} 

function get_php_setting_val($val)
{
    $r = ini_get($val);
    return $r;
} 

$GLOBALS['isWindows'] = substr(PHP_OS, 0, 3) == 'WIN';


function runsNotAsCgi() {
$no_cgi = true;
if (isset($_SERVER["SERVER_SOFTWARE"])) {
  $mystring = $_SERVER["SERVER_SOFTWARE"];
  $pos = strpos ($mystring, "CGI");
	if ($pos === false) { 
	    // nicht gefunden...
  } else {
     $no_cgi = false;
  }
  $mystring = $_SERVER["SERVER_SOFTWARE"];
	  $pos = strpos ($mystring, "cgi");
		if ($pos === false) { 
		    // nicht gefunden...
	  } else {
	     $no_cgi = false;
  }
}
return $no_cgi;
}

function has_safemode_problem_global() {
global $isWindows;

$no_cgi = runsNotAsCgi();

if (function_exists("posix_getpwuid") && function_exists("posix_getpwuid")) {
	$userid = posix_geteuid();
	$userinfo = posix_getpwuid($userid);
	$def_user = array ("apache", "nobody", "www");
	if (in_array ($userinfo["name"], $def_user)) {
			$no_cgi = true;
	}
}


	if(ini_get('safe_mode') == 1 && $no_cgi && !$isWindows) {
	  return true;
	}
return false;	
}


function remove($item) // remove file / dir
{
    $item = realpath($item);
    $ok = true;
    if (is_link($item) || is_file($item))
        $ok = unlink($item);
    elseif (is_dir($item)) {
        $handle = opendir($item);
        while (($file = readdir($handle)) !== false) {
            if (($file == ".." || $file == ".")) continue;

            $new_item = $item . "/" . $file;
            if (is_dir($new_item)) {
                $ok = remove($new_item);
            } else {
                $ok = unlink($new_item);
            } 
        } 
        closedir($handle);
        $ok = @rmdir($item);
    } 
    return $ok;
} 

function return_bytes($val)
{
    if ($val) {
        $val = trim($val);
        $last = strtolower($val{strlen($val)-1});
        switch ($last) {
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }        
    } 
    return $val;
} 

function restoreData($path)
{
		if (!file_exists($path . "my_config.php")) {
				rename($path . "full/my_config.php", $path . "my_config.php");
		} 
		if (!file_exists($path . "my_style.css")) {
				rename($path . "full/my_style.css", $path . "my_style.css");
		} 
		if (!file_exists($path . "pictures")) {
				rename($path . "full/pictures", $path . "pictures");
		} 
		if (!file_exists($path . "admin/_config/.htusers.php")) {
				rename($path . "full/admin/_config/.htusers.php", $path . "admin/_config/.htusers.php");
		}
    remove($path . "full");
} 

function deleteFile($file)
{
    if (file_exists($file)) {
        echo $GLOBALS[$GLOBALS["language"]]["delete"] . $file . " - ";
        if (unlink ($file)) {
            echo $GLOBALS[$GLOBALS["language"]]["ok"];
        } else {
            echo $GLOBALS[$GLOBALS["language"]]["error"];
        } 
    } else {
        echo $file . $GLOBALS[$GLOBALS["language"]]["notexist"] ;
    } 
    echo "<br/>";
} 

function createTWGDirs($path)
{
global $safemode;

    if (!file_exists($path . "cache")) {
        if ($safemode || runsNotAsCgi()) {
          mkdir($path . "cache", 0777);
        } else {
          mkdir($path . "cache", 0755);
        }
    } 
    if (!file_exists($path . "counter")) {
       if ($safemode || runsNotAsCgi()) {
		          mkdir($path . "counter", 0777);
		        } else {
		          mkdir($path . "counter", 0755);
        } 
    } 
    if (!file_exists($path . "xml")) {
        if ($safemode || runsNotAsCgi()) {
					mkdir($path . "xml", 0777);
				} else {
					mkdir($path . "xml", 0755);
        }
    } 
} 

function saveOldConfigs($path)
{
    if (file_exists($path . "config.php")) {
        copy($path . "config.php", $path . "config_save.php");
        unlink($path . "config.php");
    } 
    if (file_exists($path . "style.css")) {
        copy($path . "style.css", $path . "style_save.css");
        unlink($path . "style.css");
    } 
    if (file_exists($path . "language")) { // we delete the language folder
        remove($path . "language");
    }
    
} 

function testParentdir() // we check if ye can create a directory here - if not TWG cannot installed
{
    if (@mkdir("__TWG_TEST__")) {
        rmdir("__TWG_TEST__");
        return true;
    } else {
        return false;
    } 
} 

function testIfAlreadyInstalled()
{
global $safemode;
    if ($safemode) {
      $isinstalled = file_exists("twg"); // only check for the folder! files do not work with safemode often!
    } else {
      $isinstalled = file_exists("image.php"); 
    }
  
    if ($isinstalled) {
        if (file_exists("index.php")) {
            include("config.php");
        } else {
            if (file_exists("twg/config.php")) {
              include("twg/config.php");
            } else {
              return 4;
            }
        } 
        if (isset($iframe_include)) {
            return 1;
        } else {
            return 2;
        } 
    } else {
        return 0;
    } 
} 

function gd_version()
{
    static $gd_version_number = null;
    if ($gd_version_number === null) {
   	   if (function_exists("gd_info")) {
         $info = gd_info();
         $module_info = $info["GD Version"];
         if (preg_match("/[^\d\n\r]*?([\d\.]+)/i",
                $module_info, $matches)) {
            $gd_version_number = $matches[1];
         } else {
              $gd_version_number = 0;
         } 
       } else { // needed before 4.3 !
          ob_start();
          phpinfo(8);
          $module_info = ob_get_contents();
          @ob_end_clean();
          if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i",
                  $module_info, $matches)) {
              $gd_version_number = $matches[1];
          } else {
              $gd_version_number = 0;
          } 
       }  
    } 
    return $gd_version_number;
}

function printInstall($safemodeon)
{
    global $update;

    if ($safemodeon) {
        $path = "twg/";
    } else {
        $path = "";
    } 

    echo '
			  <body>
			 			 <div id="ctr" align="center">
			 			 <div class="install">
			 			 <div>';

    if ($update) {
        echo '<div id="step">' . $GLOBALS[$GLOBALS["language"]]["updateok"] . '</div>';
    } else {
        echo '<div id="step">' . $GLOBALS[$GLOBALS["language"]]["installok"] . '</div>';
    } 
    echo '<div class="clr"></div>
			 			 <div class="bold">' . $GLOBALS[$GLOBALS["language"]]["readthis"] . '</div><br/>
			 			 <div class="form-block">' . $GLOBALS[$GLOBALS["language"]]["success1"] . '<br/>&nbsp;<br/>
			 			 ';
    if (!$update) {
        echo $GLOBALS[$GLOBALS["language"]]["success2"] . '<br/>&nbsp;<br/>
			 			 ' . $GLOBALS[$GLOBALS["language"]]["success3"] . '<br/>&nbsp;<br/>';
    } 
    echo '<div class="green">' . $GLOBALS[$GLOBALS["language"]]["success4"] . '</div></div><br>
			 			 <div class="form-block">';
    if ($safemodeon) {
        echo '  <div class="error">' . $GLOBALS[$GLOBALS["language"]]["success5"] . '</div>	';
    } 
    echo '
						 <div class="error">' . $GLOBALS[$GLOBALS["language"]]["success6"] . '&nbsp;&nbsp;<input type="button" id="delbutton" class="button" value="' . $GLOBALS[$GLOBALS["language"]]["success7"] . '" onclick="deleteFiles()" /></div>
			 			 <br/>
			 			 ' . $GLOBALS[$GLOBALS["language"]]["success8"] . '
    <br/>&nbsp;<br/>
 	  <input type="button" class="button" value="TinyWebGallery" onclick="window.location.href=\'' . $path . 'index.php\'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="button" value="TWG admin" onclick="window.location.href=\'' . $path . 'admin/index.php\'" />		 			 
			 			 <br/>&nbsp;<br/>
			 			 <div class="green">
			 			 ' . $GLOBALS[$GLOBALS["language"]]["success9"] . '
			       </div>
			       </div>
			       <br/>
			       ' . $GLOBALS[$GLOBALS["language"]]["success10"] . '
			       </div>
			       <br/>
			       ' . $GLOBALS[$GLOBALS["language"]]["success11"] . '
			        </div>
			        </div>
			       <iframe width="100%" frameborder=0 height="1120" src="' . $path . 'info.php"></iframe>
			        </body></html> 		   	  		   
';
} 

function printError($errorstring)
{
    echo '
			  <body>
			 			 <div id="ctr" align="center">
			 			 <div class="install">
			 			 <div>
			 			 <div id="step">' . $GLOBALS[$GLOBALS["language"]]["error1"] . '</div>
			 			 <div class="clr"></div>
			 			 <div class="bold">' . $GLOBALS[$GLOBALS["language"]]["error2"] . '</div><br/> 		
			       ' . $GLOBALS[$GLOBALS["language"]]["error3"] . $errorstring . '
			       </div>
			       </div>
			       </body></html> 		   	  		   
';
} 

function printHeader()
{
    global $safemode;

    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?" . ">";
    echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TWG Installation</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css" >
body { margin: 0px; padding: 0px; color : #333; background-color : #FFF; font-size : 11px; font-family : Arial, Helvetica, sans-serif; }
#step { font-size: 30px; font-weight: bold; text-align: left; color: #666666; padding: 10px 0px 20px 50px; white-space: nowrap; position: relative; float: left; }
.install { margin-left: auto; margin-right: auto; margin-top: 1em; margin-bottom: 1em; padding: 10px; border: 1px solid #cccccc; width: 750px; background: #F1F1F1; }
.install-small { margin-top: 10px; margin-bottom: 10px; margin-left: 10px; margin-right: 10px; padding: 10px; border: 1px solid #cccccc; width: 285px; height: 90%; vertical-align:middle; background: #F1F1F1; }
.install h1 { font-size: 15px; font-weight: bold; color: #c64934; padding: 10px 10px 4px 0px; text-align: left; border-bottom: 1px solid #c64934; margin-bottom: 10px; }
.install-form { position: relative; text-align: left; float: right; width: 69%; }
.install-text { position: relative; text-align: left; width: 30%; float: left; }
.form-block { border: 1px solid #cccccc; background: #E9ECEF; padding-top: 5px; padding-left: 5px; padding-bottom: 5px; padding-right: 5px; }
.left { position: relative; text-align: left; float: left; width: 50%; }
.right { position: relative; text-align: left; float: right; width: 50%; }
.far-right { position: relative; text-align: right; float: right; }
.clr { clear:both; }
.ctr { text-align: center; }
.button { border : solid 1px #cccccc; background: #E9ECEF; color : #666666; font-weight : bold; font-size : 11px; padding: 4px; cursor: pointer; }
.button2 { border : solid 2px #666666; background: #E9ECEF; color : #000000; font-weight : bold; font-size : 11px; padding: 4px; cursor: pointer; }
table.content { width: 90%; }
table.content td { color : #333333; font-size: 11px; vertical-align:top; }
td.item { width:150px; }
table.content2 { width: 90%; }
table.content2 td { color : #333333; font-size: 11px; }
.toggle { font-weight: bold; }
a { color: #C64934; text-decoration: none; }
a:hover { color : #30569D; text-decoration : underline; }
a:active { color : #FF9900; text-decoration : underline; }
.small { color : #333; font-size : 10px; }
.error { color : #cc0000; font-size : 12px; font-weight : bold; padding-top: 10px; padding-bottom: 10px; }
.green { color : #009900; font-size : 11px; font-weight : bold; padding-top: 10px; padding-bottom: 10px; }
.bold { font-size : 11px; font-weight : bold; }
select.options, input.options { font-size: 11px; border: 1px solid #999; }
form { margin: 0px 0px 0px 0px; }
.installheader { color : #FFF; font-size : 24px; }
</style>
';

    if (isset($_SERVER)) {
        $GLOBALS['__SERVER'] = &$_SERVER;
    } elseif (isset($HTTP_SERVER_VARS)) {
        $GLOBALS['__SERVER'] = &$HTTP_SERVER_VARS;
    } 
    $installphp = "http://" . $GLOBALS['__SERVER']['HTTP_HOST'] . getScriptName();

    echo '
<script type="text/javascript">

var del = false;
function deleteFiles(sm) {
  if (del == false) {

';
    if ($safemode == "ON") {
        echo '
     window.open(\'' . $installphp . '?deletefiles&sm=true\',\'TWG\',\'width=330,height=260,left=0,top=0,menubar=no,scrollbars=no,status=no,resizable=no\');
';
    } else {
        echo '
     window.open(\'' . $installphp . '?deletefiles&sm=false\',\'TWG\',\'width=330,height=160,left=0,top=0,menubar=no,scrollbars=no,status=no,resizable=no\');
';
    } 
    echo '
    del = true;
	} else {
	  alert("' . $GLOBALS[$GLOBALS["language"]]["errorallready"] . '");
  }
}
</script>
</head>
';
} 


if (file_exists("install.lib.php") && file_exists("install_twg.zip") ) {
  $fileok = true;
} else {
  $fileok = false;
}

$updatewrong = false;
$safemode = has_safemode_problem_global();

// get_php_setting("safe_mode");
// $safemode = "OFF";
$installed = testIfAlreadyInstalled();
if ($installed == 1) {
    if (((!$safemode) && file_exists("image.php")) || (($safemode) && file_exists("twg/image.php"))) {
        $update = true;
    } else {
        $update = false;
        $updatewrong = true;
    } 
} else {
    $update = false;
} 

define('_VALID_MOS', '42');

if ($safemode || runsNotAsCgi()) {
   umask(0000); // otherwise you cannot delete files anymore with ftp if you are no the owner!
} else {
   umask(0022); // Added to make created files/dirs group writable   
}


if (isset($_GET['installsm'])) {
  $copied=true;
} else {
  $copied=false;
}

if (isset($_GET['updatesm'])) {
  $copied=true;
  $updatesm=true;
  $fileok = true;
} else {
  $updatesm=false;
}

if (isset($_GET['installtwg'])) {
    $installtwg = true;
    $update = false;
    $fileok = true;
} else if (isset($_GET['updatetwg'])) {
    $installtwg = true;
    $update = true;
    $fileok = true;
} else {
    $installtwg = false;
} 

if ($installed == 4 && !$installtwg) { // update in SM !
  copy("install.php", "install.php.sm.php");
  copy("install.lib.php", "install.lib.sm.php");
  copy("install_twg.zip", "install_twg.sm.zip"); 
 // the filename of the TWG backend: (you rarely need to change this)
 if (isset($_SERVER)) {
		 $GLOBALS['__SERVER'] = &$_SERVER;
 } elseif (isset($HTTP_SERVER_VARS)) {
		 $GLOBALS['__SERVER'] = &$HTTP_SERVER_VARS;
 } 
 $name = "http://" . $GLOBALS['__SERVER']['HTTP_HOST'] . getScriptName() . ".sm.php";
header("Location: " . $name . "?updatesm=true");
}


if (!isset($_GET['deletefiles'])) {
    if ($installtwg) {
        if (!$copied) {
            if (!$safemode) {
                saveOldConfigs("");
                require_once("install.lib.php");
                $archive_name = realpath("install_twg.zip");
                $zip = new PclZip($archive_name);
                $res = $zip->extract(PCLZIP_OPT_PATH, ".");
                printHeader();
                createTWGDirs("");
                if ($res < 1) {
                    printError($zip->error_string) ;
                } else {
                    restoreData("");
                    printInstall(false);
                }  
                if (runsNotAsCgi() && (ini_get('safe_mode') == 0)) {
                  @chmod("pictures", 0777);
                }
            } else {
                if ($safemode || runsNotAsCgi()) {
                  mkdir("twg", 0777); 
                } else {
                  mkdir("twg", 0755); 
                }
                // echo "safemode - we have to copy first ...";
                copy("install.php", "install.php.sm.php");
                copy("install.lib.php", "install.lib.sm.php");
                copy("install_twg.zip", "install_twg.sm.zip"); 
                // the filename of the TWG backend: (you rarely need to change this)
                if (isset($_SERVER)) {
                    $GLOBALS['__SERVER'] = &$_SERVER;
                } elseif (isset($HTTP_SERVER_VARS)) {
                    $GLOBALS['__SERVER'] = &$HTTP_SERVER_VARS;
                } 
                $name = "http://" . $GLOBALS['__SERVER']['HTTP_HOST'] . getScriptName() . ".sm.php";
                header("Location: " . $name . "?installtwg=true&installsm=true");
            } 
        } else {
            require_once("install.lib.sm.php");
            saveOldConfigs("twg/");
            $archive_name = realpath("install_twg.sm.zip");
            $zip = new PclZip($archive_name);
            $res = $zip->extract(PCLZIP_OPT_PATH, "./twg");
            createTWGDirs("twg/");

            printHeader();
            if ($res < 1) {
                printError($zip->error_string) ;
            } else {
                restoreData("twg/");
                printInstall(true);
            } 
        } 
    } else {
        printHeader();

        @session_start();

        if (function_exists("date_default_timezone_set")) {
            @date_default_timezone_set();
        } 

        if (isset($_GET['showphpinfo'])) {
            $showphpinfo = true;
        } else {
            $showphpinfo = false;;
        } 

        if ($showphpinfo) {
            echo '<center><p>';
            echo "<style type=\"text/css\">.button { border : solid 1px #cccccc; background: #E9ECEF; color : #666666; font-weight : bold; font-size : 11px; padding: 4px;
}</style>";
            echo '<input type="button" class="button" value="' . $GLOBALS[$GLOBALS["language"]]["back"] . '" onclick="history.back();" />';
            echo '<br/>';
            echo phpinfo();
            echo '</p></center>';
            return;
        } 

        $canbeinstalled = testParentdir();
        
        if ($updatesm) {  // if we update we can do it because we alredy didi it once and hope the permissions have not changed that update would not work anymore!
          $canbeinstalled = true;
        }
        
        if (!$fileok) {
          $canbeinstalled = false;;
        }
        ?>
<body>
<div id="ctr" align="center">
<div class="install">
<div>
<div id="step"><?php echo $GLOBALS[$GLOBALS["language"]]["header"];

        ?></div>
<div class="far-right">
<?php
        if (isset($_SERVER)) {
            $GLOBALS['__SERVER'] = &$_SERVER;
        } elseif (isset($HTTP_SERVER_VARS)) {
            $GLOBALS['__SERVER'] = &$HTTP_SERVER_VARS;
        } 
        $name = "http://" . $GLOBALS['__SERVER']['HTTP_HOST'] . getScriptName();
        if ($canbeinstalled && $installed != 2) {
            if ($update) {
               if ( $updatesm) {
                 $add = "&updatesm=true"; // files already copied!
               } else {
                 $add= "";
               }
                echo '<input type="button" class="button2" value="&nbsp;&nbsp;' . $GLOBALS[$GLOBALS["language"]]["updatetext"] . '&nbsp;&nbsp;" onclick="if (';
                echo "confirm('" . $GLOBALS[$GLOBALS["language"]]["updatejs1"] . "')";
                echo ") { window.location='" . $name . "?updatetwg=true" . $add . "'}\" />";
            } else {
                echo '<input type="button" class="button2" value="&nbsp;&nbsp;' . $GLOBALS[$GLOBALS["language"]]["installtext"] . '&nbsp;&nbsp;" onclick="if (';
                if (!$safemode) {
                    echo "true";
                } else {
                    echo "confirm('" . $GLOBALS[$GLOBALS["language"]]["installjs1"] . "')";
                } 
                echo ") { window.location='" . $name . "?installtwg=true'}\" />";
            } 

            ?>
<?php
        } 

        ?>   
	<input type="button" class="button" value="<?php echo $GLOBALS[$GLOBALS["language"]]["checkagain"];

        ?>" onclick="window.location=window.location" />
	<input type="button" class="button" value="<?php echo $GLOBALS[$GLOBALS["language"]]["showphpinfo"];

        ?>" onclick="window.location=window.location+'?showphpinfo=true'" /><br>
	
	<?php if ($GLOBALS["language"] == "en") {

            ?>
	<input type="button" class="button" value="Deutsch" onclick="window.location='<?php echo "http://" . $_SERVER['HTTP_HOST'] . getScriptName() . "?lang=de";

            ?>'" /> 
	<?php } else {

            ?>
	<input type="button" class="button" value="English" onclick="window.location='<?php echo "http://" . $_SERVER['HTTP_HOST'] . getScriptName() . "?lang=en";

            ?>'" />
  <?php } 

        ?>
</div><div class="clr"></div>
<?php
        echo $GLOBALS[$GLOBALS["language"]]["welcome"];
        echo "<br/>";
        if ($updatewrong) {
            echo '<br/><div class="form-block"><div class="error">' . $GLOBALS[$GLOBALS["language"]]["updatewrong"] . '</div></div>';
        } 
        if ($fileok) {
        if ($installed != 2) {
            if (!$canbeinstalled) {
                echo '<br/><div class="form-block"><div class="error">' . $GLOBALS[$GLOBALS["language"]]["installerror1"] . '</div></div>';
            } else if (!$safemode) {
                echo '<br/><div class="form-block"><div class="green">' . $GLOBALS[$GLOBALS["language"]]["installisok"] . '</div></div>';
            } else {
                echo '<br/><div class="form-block"><div class="error">' . $GLOBALS[$GLOBALS["language"]]["installerror2"] . '</div></div>';
            } 
        } else {    
          echo '<br/><div class="form-block"><div class="error">' . $GLOBALS[$GLOBALS["language"]]["installold"] . '</div></div>';
        } 
        } else {
          echo '<br/><div class="form-block"><div class="error">' . $GLOBALS[$GLOBALS["language"]]["filesmissing"] . '</div></div>';
        }

        echo "<br/>";
        echo $GLOBALS[$GLOBALS["language"]]["manually"];
        echo "<h1>";
        echo $GLOBALS[$GLOBALS["language"]]["checkh1"];
        echo "</h1>";
        echo '<div class="install-text">';
        echo $GLOBALS[$GLOBALS["language"]]["checkt1"];

        ?>
<div class="ctr"></div>
</div>

<div class="install-form">
<div class="form-block">

<table summary="" class="content">
<tr>
	<td class="item">
	<?php
        echo $GLOBALS[$GLOBALS["language"]]["checkphp"];

        ?>
	</td>
	<td align="left">
	<?php echo phpversion() < '4.3' ? '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["no"] . '</font></b>' : '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["yes"] . '</font></b>';
        echo " (" . phpversion() . ")";

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["checkxml"];

        ?>
	</td>
	<td align="left">
	<?php echo extension_loaded('xml') ? '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . '</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["checkgd"];

        ?>
	</td>
	<td align="left">
	<?php echo extension_loaded('gd') ? '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . '</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td class="item">
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["checkgdversion"];

        ?>
	</td>
	<td align="left">
	<?php echo gd_version() < '2.0' ? '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["no"] . '</font></b>' : '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["yes"] . '</font></b>';
        echo " (" . gd_version() . ")";

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["memory"];

        ?>
	</td>
	<td align="left">
	<?php
        $limit = return_bytes(ini_get('memory_limit'));
        if (!$limit) {
            echo '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["memorynotdetected"] . '</font></b>';
        } else {
            if ($limit > 48000000) {
                echo '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["limit1"] . '</font></b>';
            } else if ($limit > 30000000) {
                echo '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["limit2"] . '</font></b>';
            } else {
                echo '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["limit3"] . '</font></b>';
            } 
            echo " (" . ini_get('memory_limit') . ")";
        } 

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["watermark"];

        ?> 
	</td>
	<td align="left">
	<?php echo (function_exists("imagettftext")) ? '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . ' (imagettftext ' . $GLOBALS[$GLOBALS["language"]]["notfound"] . ')</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["remote"];

        ?>   
	</td>
	<td align="left">
	<?php echo (get_php_setting('allow_url_fopen') == 'ON') ? '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . ' (allow_url_fopen = off)</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["upload"];

        ?> 
	</td>
	<td align="left">
	<?php echo (get_php_setting('file_uploads') == 'ON') ? '<b><font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . '</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td>
	&nbsp;&nbsp;&nbsp;&nbsp; - <?php
        echo $GLOBALS[$GLOBALS["language"]]["uploadmax"];

        ?>
	</td>
	<td align="left">
	<?php
        $limit = return_bytes(ini_get('upload_max_filesize'));
        if (!$limit) {
            echo '<b><font color="#FFCC00">' . $GLOBALS[$GLOBALS["language"]]["uploadnotdetected"] . '</font></b>';
        } else {
            if ($limit > 2500000) {
                echo '<b><font color="green">' . ini_get('upload_max_filesize') . '</font></b>';
            } else {
                echo '<b><font color="#ff9900">' . ini_get('upload_max_filesize') . ' - ' . $GLOBALS[$GLOBALS["language"]]["resize"] . ' > ' . ini_get('upload_max_filesize') . '</font></b>';
            } 
        } 

        ?>
	</td>
</tr>
<tr>
	<td class="item">
	Session
	</td>
	<td align="left">
	<b><?php echo session_id() ? '<font color="green">' . $GLOBALS[$GLOBALS["language"]]["available"] . '</font></b>' : '<b><font color="red">' . $GLOBALS[$GLOBALS["language"]]["unavailable"] . '</font></b>';

        ?>
	</td>
</tr>
<tr>
	<td>
	Javascript
	</td>
	<td align="left">
	<script type="text/javascript">
	document.write('<b><font color="green"><?php echo $GLOBALS[$GLOBALS["language"]]["available"];

        ?><\/font><\/b>');
	</script>
	<noscript><b><font color="red"><?php echo $GLOBALS[$GLOBALS["language"]]["nojs"];

        ?></font></b></noscript>
	</td>
</tr>
</table>
</div>
</div>

<div class="clr"></div>
</div>
<div class="clr"></div>
<h1><?php echo $GLOBALS[$GLOBALS["language"]]["checkh2"];

        ?></h1>
<div class="install-text">
<?php echo $GLOBALS[$GLOBALS["language"]]["checkt2"];

        ?>
<div class="ctr"></div>
</div>

<div class="install-form">
<div class="form-block">

<table summary="" class="content">
<tr>
	<td class="toggle">
	<?php echo $GLOBALS[$GLOBALS["language"]]["checkr1"];

        ?>
	</td>
	<td class="toggle">
	<?php echo $GLOBALS[$GLOBALS["language"]]["checkr2"];

        ?>
	</td>
	<td class="toggle">
	<?php echo $GLOBALS[$GLOBALS["language"]]["checkr3"];

        ?>
	</td>
</tr>
<?php
        $php_recommended_settings = array(array ('Safe Mode', 'safe_mode', 'OFF'),
            array ('Display Errors', 'display_errors', 'ON'),
            array ('File Uploads', 'file_uploads', 'ON'),
            array ('Magic Quotes GPC', 'magic_quotes_gpc', 'ON'),
            array ('Magic Quotes Runtime', 'magic_quotes_runtime', 'OFF'),
            array ('Register Globals', 'register_globals', 'ON/OFF'),
            array ('Output Buffering', 'output_buffering', 'OFF'),
            array ('Session auto start', 'session.auto_start', 'OFF'),
            );
        foreach ($php_recommended_settings as $phprec) {

            ?>
<tr>
	<td class="item"><?php echo $phprec[0];

            ?>:</td>
	<td class="toggle"><?php echo $phprec[2];

            ?>:</td>
	<td>
	<?php
            if (strpos($phprec[2], get_php_setting($phprec[1])) === false) {

                ?>
		<font color="red"><b>
	<?php
            } else {

                ?>
		<font color="green"><b>
	<?php
            } 
            echo get_php_setting($phprec[1]);

            ?>
	</b></font>
	<td>
</tr>
<?php
        } 

        ?>
</table>
</div>
</div>
<div class="clr"></div>
</div>
</div>
<div class="ctr">
	<a href="http://www.tinywebgallery.com" target="_blank">Copyright (c) 2004-2017 TinyWebGallery</a>
</div>
</body>
</html>

<?php
    } 
} else { // delete all install files!
    printHeader();
    echo '
<body>
<div class="install-small">
<div> ';
    echo '<b>' . $GLOBALS[$GLOBALS["language"]]["delete1"] . '</b><br>&nbsp;<br>';

    deleteFile("install.php");
    deleteFile("install.lib.php");
    deleteFile("install_twg.zip");
    if ($safemode) {
        echo '<br><b>' . $GLOBALS[$GLOBALS["language"]]["delete2"] . '</b><br>&nbsp;<br>';
        deleteFile("install.php.sm.php");
        deleteFile("install.lib.sm.php");
        deleteFile("install_twg.sm.zip");
    } 
    echo '<br/><b>' . $GLOBALS[$GLOBALS["language"]]["delete3"] . '</b>';
    echo "</div></div></body></html>" ;
} 

function getScriptName() {
  return htmlentities($_SERVER['PHP_SELF']);
}

?>