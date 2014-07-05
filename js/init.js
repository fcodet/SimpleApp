
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
//console.log("java mySpellingList = "+ mySpellingList);


