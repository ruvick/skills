

//BURGER
let iconMenu = document.querySelector(".icon-menu");
let body = document.querySelector("body");
let menuBody = document.querySelector(".mob-menu");
if (iconMenu) {
	iconMenu.addEventListener("click", function () {
		iconMenu.classList.toggle("active");
		body.classList.toggle("lock");
		menuBody.classList.toggle("active");
	});
}


// // Закрытие моб меню при клике на якорную ссылку
    $('.menu__list a').on('click', function(){ 
      if($('.icon-menu').css('display') !='none'){
        $(".icon-menu").trigger( "click" ); 
      }
    });


// Плавный скролл якорных ссылок
    $(".menu__list").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });