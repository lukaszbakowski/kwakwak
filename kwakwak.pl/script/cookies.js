function ciasteczko() {
	if (!localStorage.accepted) {
		var message = "<style>#cookies {padding:2rem;position:fixed;top:20%;left:0;z-index:999;width:100%;background-color:rgba(0,0,0,0.3);display:flex;}.cookies {margin:0 auto;width:27rem;background-color:white;padding:2rem;}<\/style><div id=\"cookies\"><div class=\"cookies\"><h2>cookies<\/h2><p class=\"art\">Informujemy, iż serwis kwakwak.pl korzysta plików typu (cookies) i automatycznie przetwarza zawarte w nich dane. Korzystanie z serwisu jest równoznaczne z ich akceptacją. Czytaj więcej na temat tzw. <a href=\"cookies.php\">ciasteczek..<\/a><\/p><button onclick=\"zamknij()\" class=\"submit\">Rozumiem<\/button><\/div><\/div>";

		localStorage.accepted = true;
		document.getElementById('ciastko').innerHTML=message;
	}
}
function zamknij() {
	var zamknij=document.getElementById('ciastko');
		zamknij.hidden=true;
}