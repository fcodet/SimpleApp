//Start with an empty list on the page

var wordList =  {
	value : [],
	addWord : function(word) {
		this.value.push(word);
	},
	display : function() {
		alert(this.value);
	},
	removeWord : function(index) {
		this.value.splice(index,1);
	}
};






var $selectedWord; //Keeps track of selected word html area
var idSelectedWord; //Keeps track of the "id" of selected word html area
var idxSelectedWord; // Keeps track of the selected word index in wordList
var $wordinputwrapper = $("wordinputwrapper"); //Remember the area where words are being input
var $wordpracticewrapper = $("#wordpracticewrapper"); //Remember the area where words get practiced
var idxPracticeWord=-1; // Keeps track of the practiced word index in wordList

//If no word is selected, make sure the remove and pronounce buttons are disabled
$("#removeSelectedWord").prop("disabled", ($selectedWord === undefined));
$("#pronounceSelectedWord").prop("disabled", ($selectedWord === undefined));

//Add a word 'object' to the wordList just using its spelling, and using some default of calculated parameters for the rest (i.e difficulty, pronunciation)
function addGenericWordSpelling(wordSpelling) {
	var localWord = {
			spelling:String(wordSpelling),
			difficulty:1,
			pronunciation:"https://dictionary.cambridge.org/media/british/us_pron/h/hel/hello/hello.mp3"
	};
	wordList.addWord(localWord);
}

//Similar to the previous function addGenericWordSpelling(wordSpelling), it adds a word object using its spelling, but also inserts it the display area, and associates all events
// with the word html object, such as click, mouseenter, mouseleave etc...
function AddWordHTMLandEvents (wordSpelling){
	
	addGenericWordSpelling(wordSpelling);
	//Add the HTML lines and Event handler
	//Add the  word to the word list display area on the web page
		newWordhtml = "<a href=\"#\" id=word" +String(wordList.value.length)+ " class=\"wordlistelement\">" + wordList.value[wordList.value.length-1].spelling  + "   </a>"
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

AddWordHTMLandEvents("Look");
AddWordHTMLandEvents("Like");
AddWordHTMLandEvents("An");
AddWordHTMLandEvents("Angel");

//This function is triggered when the user want to manually add a word from the input box and presses the "Add" button, it then createse a word object from the spelling in the text box
// and then adds it to the wordList and adds it to the display area
function addWordinTextBoxfn(){
	newWordValue = $("#newWord").val();
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
	audioSourcessl = "https://ssl.gstatic.com/dictionary/static/sounds/de/0/"+wordList.value[idxSelectedWord].spelling+".mp3";
	audioSource = "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q="+wordList.value[idxSelectedWord].spelling.replace(" ","+"); 
	//htmlAudioArea = "<audio id=\"audioArea\" autoplay ><source id=\"audioSource\" src="+audioSource+" ></audio>";
	htmlAudioArea = "<audio id=\"audioArea\" autoplay ><source id=\"audioSource\" src="+audioSource+" ></audio>";
	$("#pronounceSelectedWord").after(htmlAudioArea);
}

 function checkWordfn() {
		correct = ($("#practiceWord").val() == wordList.value[idxPracticeWord].spelling);
		$("#checkanotherWord").prop("disabled", false);
	}
	
function wordPracticefn(){
	console.log("enter Practice fn");
	$wordinputwrapper = $("#wordinputwrapper");
	$wordinputwrapper.remove();
	$wordpracticewrapper.css("visibility","visible");
	idxPracticeWord = idxPracticeWord+1;
	$("#checkanotherWord").prop("disabled", true);
	audioSource = "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q="+wordList.value[idxPracticeWord].spelling.replace(" ","+");
	htmlAudioArea = "<audio id=\"audioArea\" controls ><source id=\"audioSource\" src="+ audioSource +" ></audio>";
	$("#audioArea").remove();  //Remove previous Audio controls
	$("#practiceWord").before(htmlAudioArea);
	console.log("exit Practice fn");
}


$("#addWords").click(addWordinTextBoxfn);
$("#removeSelectedWord").click(removeSelectedWordfn);
$("#pronounceSelectedWord").click(pronounceSelectedWordfn);
$("#letsPractice").click(wordPracticefn);
$("#checkWord").click(checkWordfn);
$("#checkanotherWord").click(wordPracticefn);






