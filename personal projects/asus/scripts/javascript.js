var displayTop = $(window).scrollTop();
var toggleDown = false;


$(document).ready(function(){ // On load
	var button = $('.scrollToTop');
	
	button.on('click', function(e){
		$('html, body').animate({scrollTop: 0}, 500);
		e.preventDefault();
	});
	
	$(window).on('scroll', function(){
		var self = $(this),
			height = 250,
			top = self.scrollTop();
		displayTop = top;	
			
		if (displayTop > height){		
			if (!button.is(':visible')){
				button.css('bottom', '0%');
				button.show();
				button.animate({bottom: '10%'}, 300);
			}			
		} else{		
			button.fadeOut();
		}	
	});	
});

$(function(){
	var topNav = $('.top-nav');
	var fadeNav = $('.fade-nav');
	var duration = 500;
	fadeNav.hide();
	
	$('.open-nav').on('click', function() {	
		toggleDown = !toggleDown;	
		if (toggleDown){ // OPEN			
			topNav.animate({top: '0%'}, duration, function(){
				fadeNav.fadeIn(200); // Fade the vertical nav text, only after the animation has finished
			});				
		} else{ // CLOSE
			fadeNav.fadeOut();
			topNav.animate({top: '-100%'}, duration);

		}
	});
})

function submitForm(){
	var quantity = parseInt(document.forms["frm-product"]["quantity"].value);
	if (quantity > 10){
		$('.product-hidden').css('display', 'inline-block');
		$('.form-control').css('border', '1px solid #ff6666');
		return false;
	}
	else{
		return true;
	}
}

function removeStyle(){
	$('.product-hidden').css('display', 'none');
	$('.form-control').css('border', '1px solid #ccc');
}

