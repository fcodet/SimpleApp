<!DOCTYPE html>
<?php 
//include('ChromePhp.php');
$spellingFilePrefix = "SpellingList_";
$spellingFileSuffix = ".txt";
$spellingFileDirectory = ".";
$pageaction = "";


$mySpellingFiles = array() ;
$mySpellingLists = array() ;

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

function createSpellingListFromFile ($fileName) {
	$myFile=fopen($fileName,"r+") or die("Unable to open file");
	$locSpellingList=array();
	while(!feof($myFile)) {
	  $readWord = fgets($myFile);
	  array_push($locSpellingList, $readWord);
	 }
	fclose($myFile);	
	return $locSpellingList;
}

if ($mySpellingFiles != array()) {
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
			<li> Choose a spelling list: 
				<select name="spellingLists" id="spellingLists" value="Select from:">
						<?php
						for ($i=0; $i < count($mySpellingFiles); $i++) {
							echo "<option id=".$mySpellingFiles[$i]." value=\"".$mySpellingFiles[$i]."\">".$mySpellingFiles[$i]."</option>";
						}
						?>
				</select>
			</li>
			<br> </br
			<li> <a id="praticeWordsLink" href="AddWords.php">Practice</a> </li>
			<li> <a id="viewWordsLink" href ="AddWords.php">View Spelling List </a></li>
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
