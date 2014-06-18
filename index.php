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

//Create Audio from file ////////////////////////Test
function downloadMP3($url,$file)
{
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$url);
    $res = curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    ChromePhp::log($res);
    $output=curl_exec($ch);
    ChromePhp::log($output);
    curl_close($ch);
	
    if($output === false)   
    return false;
 
    $fp= fopen($file,"wb");
    fwrite($fp,$output);
    fclose($fp);
 
    return true;
}

downloadMP3("http://translate.google.com/translate_tts?ie=UTF-8&amp;tl=en&amp;q=like","somemp3.mp3");



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
    <link rel="stylesheet" href="css/normalise.css">
    <link href='http://fonts.googleapis.com/css?family=Changa+One|Open+Sans:400,400italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <meta name="vimport" content="width-device-width, initial-scale-1.0">
  </head>
  <body>
    <header>
      <a href="index.html" id="logo">
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
				<select id="spellingLists">
					<?php
					for ($i=0; $i < count($mySpellingFiles); $i++) {
						echo "<option value=\"".$mySpellingFiles[i]."\">".$mySpellingFiles[$i]."</option>";
					}
					?>
				</select>
			</li>
			<li> <a href="AddWords.php?mySpellingListName=Rivers">Add New Words</a></li>
			<li> <a href="AddWords.php">Practice</a> </li>
			<li> <a href="contact.html">View Spelling List </a></li>
		</ul>

      </section>
      <footer>
        <p>&copy; 2014 Frederic.</p>
      </footer>
    </div>

  </body>
</html>
