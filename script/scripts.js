window.addEventListener('scroll', function(e) {
	var position=document.documentElement.scrollTop;
	if(position<786){
		document.getElementById("1").classList.add("active");
		document.getElementById("2").classList.remove("active");
		document.getElementById("3").classList.remove("active");
		document.getElementById("5").classList.remove("active");
	}else if(position>787 && position<1672){
		document.getElementById("1").classList.remove("active");
		document.getElementById("2").classList.add("active");
		document.getElementById("3").classList.remove("active");
		document.getElementById("5").classList.remove("active");
	}else if(position>1673 && position<3132){
		document.getElementById("1").classList.remove("active");
		document.getElementById("2").classList.remove("active");
		document.getElementById("3").classList.add("active");
		document.getElementById("5").classList.remove("active");
	}else if(position>3133){
		document.getElementById("1").classList.remove("active");
		document.getElementById("2").classList.remove("active");
		document.getElementById("3").classList.remove("active");
		document.getElementById("5").classList.add("active");
	}
	
});
