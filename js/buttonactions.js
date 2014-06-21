//Similar to the previous function addGenericWordSpelling(wordSpelling), it adds a word object using its spelling, but also inserts it the display area, and associates all events
// with the word html object, such as click, mouseenter, mouseleave etc...
function AddWordHTMLandEvents (wordSpelling){
	//Add the HTML lines and Event handler
	//Add the  word to the word list display area on the web page
		newWordhtml = "<a  href=\"#\" id=word" +String(wordList.value.length)+ " class=\"wordlistelement\">" + wordList.value[wordList.value.length-1].spelling  + "   </a>"
		$(newWordhtml).appendTo("#listDisplayArea");
	//Make the text bold if mouse is above the word and back to normal text is mouse is not
		$("#word"+String(wordList.value.length)).mouseenter( function() {
			$(this).css("font-weight","bold");
			
		});
		$("#word"+String(wordList.value.length)).mouseleave( function() {
			$(this).css("font-weight","normal");
		});
	//Do something if you click on a word 
	$("#word"+String(wordList.value.length)).click( function() {
		//Remove border if previous word has been selected
		if ($selectedWord !== undefined) {
			$selectedWord.css("border","none");
			}
		//Put a border around selected word
		$(this).css("border","solid");
		$(this).css("borderColor","red");
		$(this).css("border-width","1px");
		
		$selectedWord = $(this);
		//Update current index in wordList
		idSelectedWord = $selectedWord.attr("id"); //Get the $selectedWord html id (format will be wordx, with x = index+1)
		idxSelectedWord = parseInt(idSelectedWord.replace("word",""))-1;
		//Activate remove and pronounce buttons
		$("#removeSelectedWord").prop("disabled", ($selectedWord === undefined));
		$("#pronounceSelectedWord").prop("disabled", ($selectedWord === undefined));
	});




}

//Build word list from mySpellingList 
if (mySpellingList != []) {
	for (i=0;i<mySpellingList.length;i++) {
		addGenericWordSpelling(mySpellingList[i]);
		AddWordHTMLandEvents(mySpellingList[i]);	
	}
}
/*
addGenericWordSpelling("Look");
AddWordHTMLandEvents("Look");
addGenericWordSpelling("Like");
AddWordHTMLandEvents("Like");
addGenericWordSpelling("An");
AddWordHTMLandEvents("An");
addGenericWordSpelling("Angel");
AddWordHTMLandEvents("Angel");
*/



var $selectedWord; //Keeps track of selected word html area
var idSelectedWord; //Keeps track of the "id" of selected word html area
var idxSelectedWord; // Keeps track of the selected word index in wordList
var $wordinputwrapper = $("wordinputwrapper"); //Remember the area where words are being input
var $wordpracticewrapper = $("#wordpracticewrapper"); //Remember the area where words get practiced
var idxPracticeWord=-1; // Keeps track of the practiced word index in wordList

//If no word is selected, make sure the remove and pronounce buttons are disabled
$("#removeSelectedWord").prop("disabled", ($selectedWord === undefined));
$("#pronounceSelectedWord").prop("disabled", ($selectedWord === undefined));

//This function is triggered when the user want to manually add a word from the input box and presses the "Add" button, it then createse a word object from the spelling in the text box
// and then adds it to the wordList and adds it to the display area
function addWordinTextBoxfn(){
	newWordValue = $("#newWord").val();
	addGenericWordSpelling(newWordValue);
	AddWordHTMLandEvents (newWordValue);
};

//This function is triggered when the user wants to remove a word from the display area on the web page by pressing the "Remove" button, it then removes it from the wordList and 
// from the display area
function removeSelectedWordfn(){
	//Remove the word from the wordList variable
	wordList.removeWord(idxSelectedWord);
	//Remove the word from the html code displaying the selected word in  the list
	$selectedWord.remove();
	$selectedWord = undefined;
	//If no word is selected, make sure the remove and pronounce buttons are disabled
	$("#removeSelectedWord").prop("disabled", ($selectedWord === undefined));
	$("#pronounceSelectedWord").prop("disabled", ($selectedWord === undefined));
}

//This function is triggered when the user wants to hear the pronunciation of a word selected from the display area on the web page by pressing the "Pronounce" button
function pronounceSelectedWordfn(){
	$("#audioArea").remove();
	//audioSourcessl = "https://ssl.gstatic.com/dictionary/static/sounds/de/0/"+wordList.value[idxSelectedWord].spelling+".mp3";
	//audioSource = "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q="+wordList.value[idxSelectedWord].spelling.replace(" ","+"); 
	//htmlAudioArea = "<audio id=\"audioArea\" autoplay ><source id=\"audioSource\" src=\""+wordList.value[idxSelectedWord].pronunciationFile+"\" ></audio>";
	htmlAudioArea = "<audio id=\"audioArea\" autoplay rel=\"noreferrer\" ><source id=\"audioSource\" src=\""+wordList.value[idxSelectedWord].pronunciationFile+"\" ></audio>";
	console.log(htmlAudioArea);
	$("#pronounceSelectedWord").after(htmlAudioArea);
}

 function checkWordfn() {
		correct = ($("#practiceWord").val() == wordList.value[idxPracticeWord].spelling);
		$("#checkanotherWord").prop("disabled", false);
	}
	
function wordPracticefn(){
	$wordinputwrapper = $("#wordinputwrapper");
	$wordinputwrapper.remove();
	$wordpracticewrapper.css("visibility","visible");
	idxPracticeWord = idxPracticeWord+1;
	wordCount = "Words Left:  " + String(wordList.value.length-idxPracticeWord)+" out of a total of "+String(wordList.value.length)+ " words.";
	$("#wordsLeft").text(wordCount);
	$("#checkanotherWord").prop("disabled", true);
	//audioSource = "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q="+wordList.value[idxPracticeWord].spelling.replace(" ","+");
	//htmlAudioArea = "<audio id=\"audioArea\" controls ><source id=\"audioSource\" src="+ audioSource +" ></audio>";
	htmlAudioArea = "<audio id=\"audioArea\" controls ><source id=\"audioSource\" src="+ wordList.value[idxPracticeWord].pronunciationFile +" ></audio>";
	$("#audioArea").remove();  //Remove previous Audio controls
	$("#practiceWord").before(htmlAudioArea);
}


$("#addWords").click(addWordinTextBoxfn);
$("#removeSelectedWord").click(removeSelectedWordfn);
$("#pronounceSelectedWord").click(pronounceSelectedWordfn);
$("#letsPractice").click(wordPracticefn);
$("#checkWord").click(checkWordfn);
$("#checkanotherWord").click(wordPracticefn);













