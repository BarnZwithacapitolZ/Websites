// Global
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
			height = self.height(),
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

		if (displayTop > 100 && !toggleDown){
			$('.header').addClass('scrollTop');
		} else{
			$('.header').removeClass('scrollTop');
		}	
	});	
});

// Navigation bar logic
$(function(){	
	var menuToggle = false;
	$('.openNav').on('click', function(){
		menuToggle = !menuToggle;
		if (menuToggle){ // OPEN
			$('.openNav').css('backgroundImage', 'url("img/arrowBlackUp.png")');
			// Get actual height
			$('.navMenu').css('height', 'auto');
			var menuHeight = $('.navMenu').css('height');
			// Set back to no height
			$('.navMenu').css('height', '0');
			
			// Show layers
			$('.navMenu, .colorLayer').css('display', 'block');
			$('.colorLayer').animate({backgroundColor: 'black'}, 10);
			
			// Animate to actual height
			$('.navMenu').animate({height: menuHeight}, 300, function(){
				// Reset back to auto so it can scale when open
				$('.navMenu').css('height', 'auto');
			});
					
		} else{ // CLOSE
			$('.openNav').css('backgroundImage', 'url("img/arrowBlack.png")');
			$('.colorLayer').animate({backgroundColor: 'transparent'}, 10);
			$('.navMenu').animate({height: '0'}, 300, function(){
				// Only hide once animation has finished
				$('.navMenu, .colorLayer').css('display', 'none');
			});	
		}		
	});
	
	$('.openCart').on('click', function(){
		$('.cart').fadeIn();
	});
	
	// Different button to close cart
	$('#closeCart').on('click', function(){
		$('.cart').fadeOut();
	});
		
	var moveNav = $('.topNav');
	var cross = $('#topCross');
	var duration = 300; // Of animating the navigation page up & down
	cross.hide();
	$('.verticalNav').hide();
	
	// Main navigation page (hamburger menu)
	$('.buttonOpen').on('click', function() {	
		toggleDown = !toggleDown;	
		if (toggleDown){ // OPEN
			if (displayTop > 100){		
				$('.header').removeClass('scrollTop'); // Replace existing header when scrolling down
			}

			$('.openNav, .navMenu, .colorLayer').css('display', 'none');
			
			moveNav.animate({top: '0%'}, duration, function(){
				$('.verticalNav').fadeIn(400); // Fade the vertical nav text, only after the animation has finished
			});		
			$('.header').css('color', 'white');
			$('.line').animate({
				backgroundColor: 'white',		
				width: '30px'
			}, duration);
			cross.fadeIn(500);			
		} else{ // CLOSE
			if (displayTop > 100){
				$('.header').addClass('scrollTop'); // Replace existing header when scrolling down
			}
			
			if (menuToggle){
				$('.openNav').css('backgroundImage', 'url("img/arrowBlack.png")');
				menuToggle = false;
			}
			$('.openNav').css('display', 'block');
			
			$('.verticalNav').fadeOut(150);
			moveNav.animate({top: '-100%'}, duration);
			$('.header').css('color', 'black');
			$('.line').animate({
				backgroundColor: 'black',
				width: '50px'
			}, duration);
			cross.fadeOut(100);
		}
	});
	
	var i = 0;
	var background = $('.leftContainer');
	var colors = [ '#ff4d94', '#8080ff', '#f6d638' ];
	
	window.setInterval(function(){
		i = i == colors.length ? 0 : i;
		background.animate({backgroundColor: colors[i]}, 3000);
		i++
	}, 30);	
})


$(function(){
	var inWrap = $('.inner-wrapper');
	$('.prev').on('click', function() {
		inWrap.animate({left: '0%'}, 800, function(){
			inWrap.css('left', '-100%');
			$('.slide').first().before($('.slide').last());
		});
	});
	
	$('.next').on('click', function() {
		inWrap.animate({left: '-200%'}, 800, function(){
			inWrap.css('left', '-100%');
			$('.slide').last().after($('.slide').first());
		});
	});
})
