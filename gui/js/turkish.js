String.prototype.turkishToUpper = function(){
	var string = this;
	var letters = { "i": "İ", "ş": "Ş", "ğ": "Ğ", "ü": "Ü", "ö": "Ö", "ç": "Ç", "ı": "I" };
	string = string.replace(/(([iışğüçö]))+/g, function(letter){ return letters[letter]; })
	return string.toUpperCase();
}

String.prototype.turkishToLower = function(){
	var string = this;
	var letters = { "İ": "i", "I": "ı", "Ş": "ş", "Ğ": "ğ", "Ü": "ü", "Ö": "ö", "Ç": "ç" };
	string = string.replace(/(([İIŞĞÜÇÖ]))+/g, function(letter){ return letters[letter]; })
	return string.toLowerCase();
}

String.prototype.turkish2ucfirst = function(){
	var string = this;
	return string[0].turkishToUpper() + string.substr(1).turkishToLower();
}
