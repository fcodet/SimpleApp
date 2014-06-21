<!DOCTYPE html>


<html>
	<?php
	include('ChromePhp.php');
	//Pass the name of the list into a PHP variable
	$spellingList=array();
	if (isset($_GET['mySpellingListName'])==true) {
		$mySpellingListName =  $_GET['mySpellingListName'];
		ChromePhp::log("Spelling List not empty!");	
		//Create the actual PHP array containing the spelling words in the list from the file
		$fileName = "SpellingList_" . $mySpellingListName . ".txt";
		ChromePhp::log($fileName);
		$myFile=fopen($fileName,"r+") or die("Unable to open file");
		while(!feof($myFile)) {
		  $readWord = fgets($myFile);
		  $readWord = str_replace(array("\r", "\n"), '', $readWord); //remove the newline character
		  array_push($spellingList, $readWord);
		 }
		fclose($myFile);
		ChromePhp::log("in the loop");	
		}
	ChromePhp::log("The spelling list size is : " . count($spellingList));
	if (count($spellingList) != 0) {ChromePhp::log("Spelling list is not empty");
		} else {
		ChromePhp::log("Spelling list empty");
		}
	?>
	
	
	<script type="text/javascript" charset="utf-8">
	if (<?php if (count($spellingList) != 0) {echo "true";} else {echo "false";} ?>) {
			//create mySpellingList javascript variable which will be used in a init.js javascript called at the bottom of the page
			var mySpellingList = <?php 
			$echostring = "";
			$echostring = $echostring . "["; 
			if (count($spellingList)!=0) {
				for ($i=0; $i < count($spellingList); $i++) {
					if ($i < (count($spellingList)-1)) {
						$echostring = $echostring . "\"".$spellingList[$i]."\"".",";
					}	
					else {
						$echostring = $echostring . "\"".$spellingList[$i]."\""."];";
					}
				}
			}
			else {
				$echostring = "[];"; 
			}
			ChromePhp::log("echostring:"  .  $echostring);
			echo $echostring;
			?>
			console.log("Javascript mySpellingList is not empty");
			}
			else {
			var mySpellingList = [];
			console.log("Javascript mySpellingList is empty");
			}
		console.log(mySpellingList);
	</script>
	
	

  <head>
    <meta charset="utf-8">
    <title>SpellingBee</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href='http://fonts.googleapis.com/css?family=Changa+One|Open+Sans:400,400italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">
    <meta name="vimport" content="width-device-width, initial-scale-1.0">
    <script src="js/init.js" type="text/javascript" charset="utf-8"></script>

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
          <li><a href="contact.html" >Contact</a></li>  
        </ul>
      </nav>
    </header>
    <div id="wrapper">
		<div id="wordinputwrapper">
			<h3>Let's add some new words</h3>
			<button id="addWords">Add</button>
			<form id="newWordForm" name"newWordForm">
				<input id="newWord" name="newWord" value="new word">
				</input>
			</form>
			<div id="listDisplayArea">
			
			</div>
			<button id="removeSelectedWord">Remove</button> 
			<button id="pronounceSelectedWord">Pronounce</button>
			<button id="letsPractice">Let's Practice</button>
		</div>
		<div id="wordpracticewrapper">
			<form id="practiceWordForm" name"practiceWordForm">
				<p id="wordsLeft"></p>
				<input id="practiceWord" name="practiceWord" value="">
				</input>
				<button type="button" id="checkWord">Check</button>
				<button type="button" id="checkanotherWord" disabled>Try another</button>
			</form>
		</div>

      <footer>
 <!--        <a href="http://twitter.com"><img src="img/twitter-wrap.png" alt="Twitter Logo" class="social-icon"></a>
        <a href="http://facebook.com"><img src="img/facebook-wrap.png" alt="Facebook Logo" class="social-icon"></a> -->
        <p>&copy; 2014 Frederic.</p>
      </footer>
    </div>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/buttonactions.js" type="text/javascript" charset="utf-8"></script>
	<!-- <script src="data/readWordsFile.js" type="text/javascript" charset="utf-8"></script> -->
	<!-- <script src="js/addWords.js" type="text/javascript" charset="utf-8"></script> -->
  </body>
</html>
