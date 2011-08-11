// Email Validation
function is_email(emailAddress) {
  var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
  return pattern.test(emailAddress);
}
function is_tc(tc) {
    var tc, on, onbir;
    if (tc.length != 11) return false;
    on =
	((((Number(tc[0]))+Number(tc[2])+Number(tc[4])+Number(tc[6])+Number(tc[8]))*7)
	 -(Number(tc[1])+Number(tc[3])+Number(tc[5])+Number(tc[7])))%10;
    onbir =
	(Number(tc[0])+Number(tc[1])+Number(tc[2])+Number(tc[3])+Number(tc[4])+
	 Number(tc[5])+Number(tc[6])+Number(tc[7])+Number(tc[8])+Number(tc[9]))%10;

    if (!on || !onbir) return false;

    if (String(on) + String(onbir) == tc.substring(9,11))
        return true;
    else
	return false;
}
function is_serino(value) {
        var regexp = /([a-zA-ZsçÇöÖşŞıİğĞüÜ]{1})([0-9]{1})([0-9]{1})/;
        return value.match(regexp);
}
