window.onload=function(){
	
	
	function ajax(method, url, data, success) {
		var xhr = null;
		try {
			xhr = new XMLHttpRequest();
		} catch (e) {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
		if (method == 'get' && data) {
			url += '?' + data;
		}
		
		xhr.open(method,url,true);
		if (method == 'get') {
			xhr.send();
		} else {
			xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
			xhr.send(data);
	}
	
	xhr.onreadystatechange = function() {
		
		if ( xhr.readyState == 4 ) {
			if ( xhr.status == 200 ) {
				success && success(xhr.responseText);
			} else {
				alert('出错了,Err：' + xhr.status);
			}
		}
		
	}
}
	ajax('get','api/list',null,function(text){
		var oText=JSON.parse(text);
		music(oText.length,oText,0);
	})

};
function music(len,obj,num){
	var oDoc=document.getElementById('doc'),
	iCon = document.getElementById('icon'),
	aAIcon=iCon.getElementsByTagName('a'),
	oAudio=document.getElementsByTagName('audio')[0],
	Off=true;
	function show(obj,num){
		oAudio.src=obj[num]['mp3URL'];
		oDoc.style.background='url('+obj[num]['img']+') center no-repeat';
	}
	show(obj,num);
	aAIcon[1].onclick=function(){
		if(Off){
			oAudio.play();
			this.className='icon-pause';
			Off=false;
		}else{
			oAudio.pause();
			this.className='icon-play2';
			Off=true;
		}
		aAIcon[2].onclick=function(){
			num++;
			if(num==len){
				num=0;
			};
			show(obj,num);
			oAudio.play();
		};
		aAIcon[0].onclick=function(){
			num--;
			if(num==-1){
				num=len-1;
			}
			show(obj,num);	
			oAudio.play();
		};
	};
}