/**
 * Created by ahmed on 6/21/17.
 */
// Add your custom JS code here
$(document).ready(function() {

    $(".str-cut").each(function (i) {
        var len = $(this).text().length;
        if (len > 80) {
            $(this).text($(this).text().substr(0, 200) + '......');
        }
    });


    /*========== Swap between Login and Register in Modal / Start =================*/

    /* Remove each [header] word */
    $('.modal .btn-login .log').addClass('run');
    $('#modal-register').css('display', 'none');

    $('.modal  .btn-login .reg').click(function(){
        $('.modal .btn-login .log').removeClass('run');
        $(this).addClass('run');
        $('.modal #modal-login').fadeOut(100);
        $('.modal #modal-register').fadeIn(200);
    });

    $('.modal .btn-login .log').click(function(){

        $('.modal .btn-login .reg').removeClass('run');
        $(this).addClass('run');
        $('.modal #modal-register').fadeOut(100);
        $('.modal #modal-login').fadeIn(200);

    });

    /*========== Swap between Login and Register in Modal / End  =================*/


    /*================ POSTS Page Script ==================*/


    $('.card').hover(function() {
        $(this).find('.card-hidden').slideDown(300);
    });

    $('.card').mouseleave(function() {
        $(this).find('.card-hidden').slideUp(300);
    });

// Open Image in Modal

// Get the modal
    var modal_img = document.getElementById('Modal-image');

// Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption-img");
    $('.myImg-modal').click(function(){
        modal_img.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });

// When the user clicks on <span> (x), close the modal

    $('.close-btn-modal').click(function(){
        modal_img.style.display = "none";
    });




});
