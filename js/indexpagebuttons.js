$("#chooseSpellingListForm").attr("action","AddWords.php?mySpellingListName=" + $("#spellingLists").val());
console.log("AddWords.php?mySpellingListName=" + $("#spellingLists").val());

function changeSpellingListfn () {
	$("#chooseSpellingListForm").attr("action","AddWords.php?mySpellingListName=" + $("#spellingLists").val());
	console.log("AddWords.php?mySpellingListName=" + $("#spellingLists").val());
	

}

$("#chooseSpellingListForm").change(changeSpellingListfn);
//$("#addWordsToListButton").click(addWordsToListButtonfn);