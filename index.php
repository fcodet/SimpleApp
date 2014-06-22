<!DOCTYPE html>
<?php 
include('ChromePhp.php');
$spellingFilePrefix = "SpellingList_";
$spellingFileSuffix = ".txt";
$spellingFileDirectory = ".";
$pageaction = "";


$mySpellingFiles=[];
$mySpellingLists=[];

//Find all existing Spelling files in the directory and add them to the SpellingList array $mySpellingFiles
if ($handle = opendir($spellingFileDirectory)) {
	
	while (false !== ($entry = readdir($handle))) {
	$isASpellingFile = stripos($entry,$spellingFilePrefix);
	if ($isASpellingFile === 0) {
		$count1=0;
		$SpellingListName = str_replace($spellingFilePrefix,"",$entry,$count1);
		$count2=0;
		$SpellingListName = str_replace($spellingFileSuffix,"",$SpellingListName,$count2);
		if (($count1 != 0) and ($count2 != 0)) {
			array_push($mySpellingFiles, $SpellingListName);
		}
	}
   }
	
    closedir($handle);
}
/*
//Create Audio from file ////////////////////////Test//////////////////////////////////////////////////////////////
function downloadMP3($url,$file)
{
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    $res = curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    ChromePhp::log($res);
    $output=curl_exec($ch);
    $output=curl_exec($ch);
    ChromePhp::log("mp3 download:".$output);
    curl_close($ch);
	
    if($output === false)   
    return false;
 
    $fp= fopen($file,"wb");
    fwrite($fp,$output);
    fclose($fp);
 
    return true;
}
*/
//downloadMP3("http://translate.google.com/translate_tts?ie=UTF-8&amp;tl=en&amp;q=seine","somemp3.mp3");
/*
//Create Audio from file ////////////////////////Test//////////////////////////////////////////////////////////////

 $text = "seine";

// Name of the MP3 file generated using the MD5 hash
   $file  = md5($text);

// Save the MP3 file in this folder with the .mp3 extension 
   $file = $file .".mp3";
   if($file) {
     echo "created";
   } else {
     echo "not created";
   }

// If the MP3 file exists, do not create a new request
   if (!file_exists($file)) {
//	$mp3 = false;
//	while ($mp3 !== false) {
		 $mp3 = file_get_contents(
			'http://translate.google.com/translate_tts?q=' . $text);
		 echo "hello";
		 ChromePhp::log("mp3");
		 ChromePhp::log($mp3);
//		}
     file_put_contents($file, $mp3);
   } else {
     echo "hii";
   }

*/




function createSpellingListFromFile ($fileName) {
	$myFile=fopen($fileName,"r+") or die("Unable to open file");
	$locSpellingList=[];
	while(!feof($myFile)) {
	  $readWord = fgets($myFile);
	  array_push($locSpellingList, $readWord);
	 }
	fclose($myFile);	
	return $locSpellingList;
}

if ($mySpellingFiles != []) {
	for ($i=0; $i < count($mySpellingFiles); $i++) {
		$locSpellingList = createSpellingListFromFile ($spellingFilePrefix . $mySpellingFiles[$i] . $spellingFileSuffix );
		array_push($mySpellingLists, $locSpellingList);
		//ChromePhp::log($locSpellingList);
		}
}

$firstValue = "Animals!!";
//ChromePhp::log($mySpellingFiles);
//ChromePhp::log($mySpellingLists);


?>
<html>
  <head>
    <meta charset="utf-8">
    <title>SpellingBee</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href='http://fonts.googleapis.com/css?family=Changa+One|Open+Sans:400,400italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <meta name="vimport" content="width-device-width, initial-scale-1.0">
  </head>
  <body>
    <header>
      <a href="index.php" id="logo">
        <h1>SpellingBee</h1>
      </a>
      <nav>
        <ul>
          <li><a href="index.html" class="selected">Home</a></li>
          <li><a href="about.html">About</a></li>  
          <li><a href="contact.html">Contact</a></li>  
        </ul>
      </nav>
    </header>
    <div id="wrapper">
		  
      <section>
		<ul id="spelling">
			<li> <a href="AddWords.html">Create New List</a></li>
			<p>or</p>
			<li> Choose from list: 
				<select name="spellingLists" id="spellingLists" value="Select from:">
						<?php
						for ($i=0; $i < count($mySpellingFiles); $i++) {
							echo "<option id=".$mySpellingFiles[$i]." value=\"".$mySpellingFiles[$i]."\">".$mySpellingFiles[$i]."</option>";
						}
						?>
				</select>
			</li>
			<li> <a id="addWordsLink" href="AddWords.php">Add New Words</a></li>
			<li> <a id="praticeWordsLink" ref="AddWords.php">Practice</a> </li>
			<li> <a href="contact.html">View Spelling List </a></li>
		</ul>

      </section>
      <footer>
        <p>&copy; 2014 Frederic.</p>
      </footer>
    </div>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/indexpagebuttons.js" type="text/javascript" charset="utf-8"></script>

  </body>
</html>
