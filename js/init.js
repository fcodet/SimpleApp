
//Start with an empty list on the page
if ((wordList === undefined) || (wordList)){
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
}
console.log("java mySpellingList = "+ mySpellingList);

//Add a word 'object' to the wordList just using its spelling, and using some default of calculated parameters for the rest (i.e difficulty, pronunciation)
function addGenericWordSpelling(wordSpelling) {
	var localWord = {
			spelling:String(wordSpelling).toLowerCase(),
			difficulty:1,
			//pronunciationFile: "http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q="+String(wordSpelling).toLowerCase().replace(" ","+"), //Get pronunciation from google translate			
			pronunciationFile: "http://api.voicerss.org/?key=ccf4d8e04f0c4202970bd88194909b4f&src="+String(wordSpelling).toLowerCase().replace(" ","+")+"&hl=en-gb", //Use voicerss.org instead of google
	};
	wordList.addWord(localWord);
}

//Build word list from mySpellingList 
if (mySpellingList != []) {
	for (i=0;i<mySpellingList.length;i++) {
		addGenericWordSpelling(mySpellingList[i]);	
	}
}

