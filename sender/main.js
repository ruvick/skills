jQuery('.header__form button').click(function(e){ 
        e.preventDefault();
        
        let persPhone = jQuery('.header__form input[name=tel]').val(); 
        if ((persPhone == "")||(persPhone.indexOf("_")>0)) {
            alert("Заполните поле телефон!");
            return;
        }
        
        var  jqXHR = jQuery.post(
          "../sender/send.php",
            {
                phone: jQuery('.header__form input[name=tel]').val(),    
                name: jQuery('.header__form input[name=name]').val(),
                mail: jQuery('.header__form textarea[name=text]').val(),
            }
            
        );
        
        
        jqXHR.done(function (responce) {
            console.log(responce);
            document.location.href = "../thank-you.html"; 
            jQuery('.header__form input[name=tel]').val("");  
            jQuery('.header__form input[name=name]').val("");
            jQuery('.header__form textarea[name=text]').val("");
        });
        
        jqXHR.fail(function (responce) {
            console.log(responce);
            alert("Произошла ошибка попробуйте позднее!");
        });
 
    });