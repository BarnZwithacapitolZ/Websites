// Form global definitions
var allFruitTypes = [" Apples / Pare", " Citrus", " Stone", " Tropical", " Berries", " Melons", " Tomatoes and avocado"];
var allVegTypes = [" Leafy", " Cruciferous", " Marrow", " Root", " Plant", " Allium"];
var fruits = [];
var vegetables = [];
var formName = "lifestyleSurvey";
var numOfFruits = 0;
var minOfExer = 0;

// Scroll speed global definitions
var marginY = 0;
var destination = 0;
var speed = 8;


function checkValue(valueToFind , arrToCheck){
	// Find value within array 
	var status = false;
	for(var i = 0; i < arrToCheck.length; i++){
		if(arrToCheck[i] == valueToFind){ // Exists within array
			status = true;
			break; 
		}
	}
	return status;
 }

function addItem(fruitVeg, hide){
	// Add an item to the overall items 
	var type = document.forms[formName][fruitVeg].options[document.forms[formName][fruitVeg].selectedIndex].value;
	var text = document.forms[formName][fruitVeg].options[document.forms[formName][fruitVeg].selectedIndex].text;
	// Set index color 
	document.forms[formName][fruitVeg].options[document.forms[formName][fruitVeg].selectedIndex].style.color = "#44f244";
	
	if (fruitVeg == 'fruits'){	
		var result = checkValue(type, fruits); // Check doesn't exist
		if (!result){ // Only if not already in list
			fruits.push(type); 
			showError(hide);
		}			
	}
	else{
		var result = checkValue(type, vegetables); // Check doesn't exist
		if (!result){  // Only if not already in list
			vegetables.push(type); 
			showError(hide);
		}
	}	
	return false;
}

function showElement(elemTitle, elem, jElem){
	$(elemTitle).fadeIn();
	$(elem).fadeIn();
	initScroll(jElem);
}

function hideError(elem){
	// Remove error messages
	$(elem).fadeOut(1000);
}

function showError(elem){
	// Remove error messages
	$(elem).fadeIn(1000);
}


function submitFormFruit(){
	var col;
	var text = "If you see this, something went wrong :/"; // Default (if it doesn't change, something went wrong)	
	var elementErrors = ["#error1", "#error2"];
	var elementToCheck = []
	
	numOfFruits = parseInt(document.forms[formName]["numFruits"].value);
	elementToCheck.push(numOfFruits);
	minOfExer = parseInt(document.forms[formName]["numExercise"].value);
	elementToCheck.push(minOfExer);
	
	// Check for errors before outputting
	for (var i = 0; i < elementErrors.length; i++){	
		if (elementToCheck[i] != parseInt(elementToCheck[i], 10)){
			$(elementErrors[i]).fadeIn(1000);
			return false;
		} else{
			$(elementErrors[i]).fadeOut(1000);
		}
	}
	showElement('#section2Title', '#section2', 'section2') // Scroll screen
		
	if (numOfFruits < 5){ // Less
		col = "#f44336"
		text = "You need to try and consume all of your <b>5</b> a day, as to maintain a healthy, balanced diet.";
	} else if (numOfFruits === 5){ // Equal
		col = "#44f244";
		text = "You are on the right path to a healthy, balanced diet! Now try to <b>beat</b> your previous intake.";
	} else{ // Greater
		col = "#44f244"
		text = "Wow! You are ensuring a healthy, balanced diet, leading to a healthier lifestyle. <b>Well Done!</b>";
	}	
	document.getElementById("fruitsEaten").innerHTML = numOfFruits;
	document.getElementById("fruitsEaten").style.color = col;
	document.getElementById("fruitText").innerHTML = text;
	submitFormExer(); // Do the same for exercise
	return false;	
}

function submitFormExer(){
	var col;
	var text = "If you see this, something went wrong :/"; // Default
	var minExpect = 60; // Expected number of minutes
	
	if (minOfExer < minExpect){ // Less
		col = "#f44336";
		text = "You need to ensure you get <b>60</b> minutes a day, for a healthy lifestyle.";
	} else if (minOfExer === minExpect){ // Equal
		col = "#44f244";
		text = "You have shown effort to attaining a healthy lifestyle, <b>keep</b> it up!";
	} else{ // Greater
		col = "#44f244";
		text = "You are ensuring a healthy lifestyle, now you just need to <b>maintain</b> it.";
	}
	
	document.getElementById("exerciseTaken").innerHTML = minOfExer;
	document.getElementById("exerciseTaken").style.color = col;
	document.getElementById("exerciseText").innerHTML = text;
}

function clearForm(){
	initScroll('top');
	hideAll();
	document.forms[formName]["numFruits"].value = "Enter amount here";
	document.forms[formName]["numExercise"].value = "Enter amount here";	
	clearDropDown("fruits");
	clearDropDown("vegetables");	
	fruits = [];
	vegetables = [];
	return false;
}

function clearDropDown(elem){
	var dropDown = document.forms[formName][elem];
	for (var i = 0; i < dropDown.length; i++){ // For each element in dropdown list
		dropDown.selectedIndex = i; // Select the element
		document.forms[formName][elem].options[document.forms[formName][elem].selectedIndex].style.color = "#bfbfbf";
	}
	dropDown.selectedIndex = 0;
}

function getHavntEaten(arr, check){
	// Get the number of fruit and veg types the user hasn't selected
	var havntEaten = [];
	for (var i = 0; i < arr.length; i++){ 
		var result = checkValue(arr[i], check);
		if (!result){
			havntEaten.push(arr[i]); // Add anything not selected to array
		}
	}
	return havntEaten; // Return array
}

function recommend(){
	var text = "If you see this, something went wrong :/"; // Default
	showElement('#section3Title', '#section3', 'section3');
	
	var fruitResult = getHavntEaten(allFruitTypes, fruits); // Fruits selected
	var vegResult = getHavntEaten(allVegTypes, vegetables); // Veg selected
	
	if (fruitResult.length > 0){
		text = "We recommend eating <b>more</b> " + fruitResult + " fruit types to maintain a healthy diet.";	
	} else{
		text = "<b>Wow!</b> According to our survey you eat every fruit type! We can only recommend you <b>keep</b> up the good work.";
	}
	
	document.getElementById("fruitTypeText").innerHTML = text;
	
	if (vegResult.length > 0){
		text = "We recommend eating <b>more</b> " + vegResult + " vegetable types to maintain a healthy diet, as well as more general green, leafy vegetables.";	
	} else{
		text = "<b>Wow!</b> According to our survey you eat every vegetable type! We can still recommend eating more general green, leafy vegetables.";
	}
	document.getElementById("vegTypeText").innerHTML = text;
	return false;
}

function hideAll(){
	$('#section2').hide();
	$('#section2Title').hide();
	$('#section3').hide();
	$('#section3Title').hide();
	$('#section4').hide();
	$('#section4Title').hide();
	$('.error').hide();
}

$(document).ready(function(){
	hideAll(); 	// Hide elements of form load
});

function initScroll(elementId){
	var destination = document.getElementById(elementId).offsetTop;
	
	scroller = setTimeout(function(){
		initScroll(elementId);
	}, 1);
	
	// Scroll up
	if(marginY < destination){		
		marginY = marginY + speed;
		if(marginY >= destination){
			clearTimeout(scroller);
		}	
	}
	// Scroll down
	else if(marginY > destination){
		marginY = marginY - speed;
		if(marginY <= destination){
			clearTimeout(scroller);
		}	
	}	
	window.scroll(0, marginY);
}

window.onscroll = function(){
	marginY = this.pageYOffset;	
};




