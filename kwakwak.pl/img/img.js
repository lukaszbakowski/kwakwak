function btns() {
	var btns = document.getElementsByClassName("btn");
	for (var i = 0; i < btns.length; i++) {
	  btns[i].addEventListener("click", activbtn);
	}
}
function activbtn() {
	
	var current = document.getElementsByClassName("activbtn");
		current[0].className = current[0].className.replace(" activbtn", "");
	this.className += " activbtn";

	var image = document.getElementsByClassName("img");
	var actual = document.getElementsByClassName("btn");

	for(var i=0;i<5;i++) {
		if(this==actual[i]) {
			var current = document.getElementsByClassName("activimg");
			current[0].className = current[0].className.replace(" activimg", "");
			image[i].className += " activimg";
		}
	}
}
/*
	if(this==actual[0]) {
		alert("1");
	var current = document.getElementsByClassName("activimg");
		current[0].className = current[0].className.replace(" activimg", "");
	image[0].className += " activimg";
	} else if(this==actual[1]) {
			alert("2");
	var current = document.getElementsByClassName("activimg");
		current[0].className = current[0].className.replace(" activimg", "");
	image[1].className += " activimg";
	} else if(this==actual[2]) {
			alert("3");
	var current = document.getElementsByClassName("activimg");
		current[0].className = current[0].className.replace(" activimg", "");
	image[2].className += " activimg";	
	} else if(this==actual[3]) {
			alert("4");
	var current = document.getElementsByClassName("activimg");
		current[0].className = current[0].className.replace(" activimg", "");
	image[3].className += " activimg";
	} else if(this==actual[4]) {
			alert("5");
	var current = document.getElementsByClassName("activimg");
		current[0].className = current[0].className.replace(" activimg", "");
	image[4].className += " activimg";
	}
	*/
	
function readURL(event) {
	var fileInput = event.target;
	var filePath = fileInput.value;
	var fileTypes = /(\.jpg|\.jpeg|\.png)$/i;
	var activimg = document.getElementsByClassName("activimg");
	var file = fileInput.files[0];
	
    if(!fileTypes.exec(filePath)){
        alert('Please upload file having extensions .jpeg .jpg .png only.');
        fileInput.value = '';
		activimg[0].innerHTML="<i class=\"icon-camera\"><\/i>";
        return false;
	}	else if(file.size>999999) {
			alert("maksymalnie 1 MB");
			fileInput.value = '';
			activimg[0].innerHTML="<i class=\"icon-camera\"><\/i>";
			return false;
    }	else	{
			var	url = URL.createObjectURL(file);
			activimg[0].innerHTML="<img class=\"output\" src=\"" + url + "\" alt=\"img\" >";
		}
}