function changeImage(elem, img){ elem.setAttribute('src', img); }
function returnImage(elem, img){ elem.setAttribute('src', img); }


let productText = document.querySelectorAll('.dsc'),
	titleButton = document.querySelector('.titles'),
	textToggle = false;
	
function hideText(){
	for (var i = 0; i < productText.length; i++){
		productText[i].style.display = 'none'; // hide everything 
	}
	titleButton.innerHTML = "show product titles";
}

function showText(){
	for (var i = 0; i < productText.length; i++){
		productText[i].style.display = 'block'; // show everything 
	}
	titleButton.innerHTML = "hide product titles";
}

titleButton.addEventListener('click', function(){
	textToggle = !textToggle;
	if (textToggle){ // OPEN
		showText();
	} else{ // CLOSE
		hideText();
	}
})
hideText(); // hide text on load

