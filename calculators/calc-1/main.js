//Калькулятор
$('document').ready(function(){

	$('.making-calc__input').on('keyup', function(){

height  = document.getElementById('height').value;
width  = document.getElementById('width').value;
if(width == ""){
// alert("Вы не указали Ширину ворот");
} else if(height == ""){
// alert("Вы не указали Высоту ворот");
} else {
	cena = 0.005;
	ploschad = parseFloat (height)* parseFloat (width);
// document.getElementById('ploschad').innerHTML = "Площадь равна: "+ ploschad +" кв. м.";
stoimost = ploschad*cena;
document.getElementById('stoimost').innerHTML = ""+ stoimost +" руб.";
}

	});
});

