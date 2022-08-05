$(document).ready(function () {
	
	// Gestion du soulignement des items du menu horizontal et l'affichage des catégories du menu.
	$(".menuHorizontal").click(function () {
		event.preventDefault();
		// Swal.fire($(this).text());
		if ($(this).text() == "Menu") {
			$("span.menuHorizontal").removeClass("menuHorizontalActive");
			$(this).addClass("menuHorizontalActive");
			$(".product_item").removeClass("d-none");
		} else {
			$("span.menuHorizontal").removeClass("menuHorizontalActive");
			$(this).addClass("menuHorizontalActive");
			$(".product_item").addClass("d-none");
			$("." + $(this).text()).removeClass("d-none");
		}
	});
	
	$("#div-nbr-items").click(function () {
		location.href="./cart";
	});
	
	$(".cartPlus").click(function (event) {
		event.preventDefault();
		$.get($(this).attr('href'), {}, function(data){
			if(data.error){
				alert(data.message);
			} else {
				$('#span-nbr-items').empty().append(data.count);
			}
		}, 'json');
		return false;
	});
	
	$(".cartMinus").click(function (event) {
		event.preventDefault();
		$.get($(this).attr('href'), {}, function(data){
			if(data.error){
				alert(data.message);
			} else {
				$('#span-nbr-items').empty().append(data.count);
			}
		}, 'json');
		return false;
	});
	
	$(".removeCart").click(function (event) {
		event.preventDefault();
		$.get($(this).attr('href'), {}, function(data){
			if(data.error){
				alert(data.message);
			} else {
				location.href="../";
			}
		}, 'json');
		return false;
	});
	
	$("#formSigninSubmit").click(function (event) {
		event.preventDefault();
		$.post($(this).attr('href'), {}, function(data){
			if(data.error){
				alert(data.message);
			} else {
				$('#span-nbr-items').empty().append(data.count);
			}
		}, 'json');
		return false;
	});
	
	// 77777777777777777777777777779
	$("#SVG_receipt_menu").click(function (event) {
		event.preventDefault();
		$("#SVG_receipt_details").removeClass("d-none");
	});
	
});














