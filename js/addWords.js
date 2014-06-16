var word = {
    spelling:"Hello",
    difficulty:1,
    pronunciation:"https://dictionary.cambridge.org/media/british/us_pron/h/hel/hello/hello.mp3"
};

var words = [word];
function addWord(wordspelling) {
var localWord = {
    spelling:String(wordspelling),
    difficulty:2,
    pronunciation:"https://dictionary.cambridge.org/media/british/us_pron/h/hel/hello/hello.mp3"
	};
	return words.push(localWord);
	
}

function do_it() {
newWordSpelling = $("#newWord").val();
alert(words[0].spelling);
addWord(newWordSpelling);
alert(words[1].spelling);


}

$("#addWords").click(do_it);
$("#addWords").append("<audio autoplay> <source src="+word.pronunciation+"> </audio>");

