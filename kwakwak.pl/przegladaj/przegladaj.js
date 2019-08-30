function test() {

	var zdj = document.getElementById('zdj');
	var ifrmCont = document.getElementById('recont');


	if(ifrmCont.classList=='test') {
		ifrmCont.classList.remove('test');
		zdj.style.width = '100%';
		zdj.style.height = "27rem";


	} else {
	ifrmCont.classList.add('test');
	var szerokosc = window.screen.availWidth * 0.9 + 'px';
	var wysokosc = window.screen.availHeight * 0.9 + 'px';
		zdj.style.height = wysokosc;
		zdj.style.width = szerokosc;

	}
}


function imgchange(x) {
	var prev = document.getElementById('prev');
	var next = document.getElementById('next');
	var imgd = document.getElementsByClassName('imgdisplaj');
	var curr = document.getElementsByClassName("activeimg");
	var ileimg = document.getElementsByClassName('imgdisplaj').length;
	var curently = document.getElementsByClassName('curently');
	var curact = document.getElementsByClassName('curact');
	if(prev==x) {
		for(var i=0; i < ileimg; i++){

			if((imgd[i].src)==(curr[0].src)) {
				curr[0].className = curr[0].className.replace(" activeimg", "");
				curact[0].className = curact[0].className.replace(" curact", "");
				--i;
				if(imgd[i]) {
				imgd[i].className += " activeimg";
				curently[i].className += " curact";
				} else {
					--ileimg;
					imgd[ileimg].className += " activeimg";
					curently[ileimg].className += " curact";
				}
				break;
			}
		}
	}
	if(next==x) {
		for(var i=0; i < ileimg; i++){

			if((imgd[i].src)==(curr[0].src)) {
				curr[0].className = curr[0].className.replace(" activeimg", "");
				curact[0].className = curact[0].className.replace(" curact", "");
				++i;
				if(imgd[i]) {
				imgd[i].className += " activeimg";
				curently[i].className += " curact";
				} else {
					imgd[0].className += " activeimg";
					curently[0].className += " curact";
				}
				break;
			}
		}

	}
}