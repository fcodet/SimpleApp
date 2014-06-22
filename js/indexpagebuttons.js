//$("#chooseSpellingListForm").attr("action","AddWords.php?mySpellingListName=" + $("#spellingLists").val());
$("#addWordsLink").attr("href","AddWords.php?mySpellingListName=" + $("#spellingLists").val());
$("#praticeWordsLink").attr("href","AddWords.php?practice=yes&mySpellingListName=" + $("#spellingLists").val());
console.log("AddWords.php?mySpellingListName=" + $("#spellingLists").val());

function changeSpellingListfn () {
	console.log("AddWords.php?mySpellingListName=" + $("#spellingLists").val());
	$("#addWordsLink").attr("href","AddWords.php?mySpellingListName=" + $("#spellingLists").val());
	$("#praticeWordsLink").attr("href","AddWords.php?practice=yes&mySpellingListName=" + $("#spellingLists").val());
	
}
$("#spellingLists").change(changeSpellingListfn);
//$("#chooseSpellingListForm").change(changeSpellingListfn);
//$("#addWordsToListButton").click(addWordsToListButtonfn);