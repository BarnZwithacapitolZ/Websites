var toggle = false;
var textToggle = false;

$(document).ready(function() {
    var bottomHeight = $('.book__absolute-container').css('bottom');

    // default bottom value for the add modal 
    $('.book__absolute-container').css('bottom', '0');

    // default highlighted color
    $('.book__color--red').addClass('book__color--select');

    // If a color is selected, highlight it
    $('.book__color').on('click', function(e) {
        $('.color').val($(this).attr('data'));
        $('.book__color').removeClass('book__color--select');        
        $(this).addClass('book__color--select');
    });

    // default highlighted icon
    $('.book__icon--star-black').addClass('book__icon--select');

    // if an icon is selected, highlight it 
    $('.book__icon').on('click', function(e) {
        $('.icon').val($(this).attr('data').replace('-black', ''));
        $('.book__icon').removeClass('book__icon--select');
        $(this).addClass('book__icon--select');
    });

    // if there is an error in the add modal, the  display the modal so the error can be seen
    if ($('.book__absolute-container').find('.book__link-text--error').length) {
        toggle = !toggle;
        $('.book__absolute-container').css('bottom', '160px');
        $('.book__absolute-container').css('display', 'block');
        $('.book__absolute-container').css('opacity', '1');
    }

    // When the open / close modal button is press 
    $('.book__add--modal').on('click', function(e){
        openCloseModal($(this), bottomHeight, e);
    });

    // Close the flash modal when the exit button is pressed
    $('.flash__text--close').on('click', function(e) {
        $(this).parent().parent().fadeOut(250);
    });

    // if the user clicks anywhere outside the flash modal, close it 
    $('.flash').on('click', function(e) {
        console.log(e.target.className);
        if (e.target.className == 'flash') {
            $(this).fadeOut(250);
        }
    });
});

// Open the model if toggle == true, else close the modal
function openCloseModal(self, bottomHeight, e) {
    e.preventDefault();
    toggle = !toggle;

    if (toggle) { // open
        self.text("×");
        $('.book__absolute-container').css('display', 'block');
        $('.book__absolute-container').animate({
            bottom: bottomHeight,
            opacity: 1
        }, 250, function() {} );
    } else { // close
        self.text("+");
        $('.book__absolute-container').animate({
            bottom: 0,
            opacity: 0
        }, 250, function() {
            $('.book__absolute-container').css('display', 'none');
        } );
    }

}


