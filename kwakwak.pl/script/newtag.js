function newtag()
{
	let nwtag=document.getElementById('inputplus').value;
	
	if(nwtag)
	{
		var i=document.getElementsByClassName('inputtag').length;
		if(i<10){
				var inputtag = document.createElement('input');
					inputtag.className='inputtag';
					inputtag.type='text';
					inputtag.hidden=true;
					inputtag.name='tag'+i;

				var inputminus=document.createElement('button');
					inputminus.id='submitminus';
					inputminus.className='icon-minus-circled';
					inputminus.addEventListener('click', deletetag);

				var li=document.createElement('li');
					li.className='konttag';
		
				var divkont=document.getElementById('tagkont');

				var likont=divkont.appendChild(li);
					likont.innerHTML="&nbsp;#"+nwtag+" ";
					
				var tag=likont.appendChild(inputtag);
					tag.value=nwtag;

				var button=likont.appendChild(inputminus);

				document.getElementById('inputplus').value="";
				
				
		} else {
			alert("Możesz używać maksymalnie dziesięc tagów");
			document.getElementById('inputplus').value="";
		}
	}
	else 
	{
		quackstay();
		alert("Dont quack with me!");
	}
}
function deletetag()
{
	this.parentElement.remove();

	var b=0;

	for(var i=0;i<10;i++) {

		var tag = document.getElementsByClassName('inputtag')[i];

		if(tag) {
			tag.name='tag'+b;
			b++;
		}
	}
}
