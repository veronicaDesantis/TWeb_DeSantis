$.noConflict();

jQuery(document).ready(function($) {

	"use strict";

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
		new SelectFx(el);
	} );

	jQuery('.selectpicker').selectpicker;


	$('#menuToggle').on('click', function(event) {
		$('body').toggleClass('open');
	});

	$('.search-trigger').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});
});

function error_create_user()
{
	error_login();
	jQuery("#password").css("border-color", "red");
	jQuery("#password_confirm").css("border-color", "red");
}

function error_login()
{
	jQuery("#error_alert").css("display", "block");
}

function change_form()
{
	jQuery("#info_form").css("display", "none");
	jQuery("#avatar_form").css("display", "block");
}

function change_size_form()
{
	jQuery("#info_form").removeClass("col-lg-12");
	jQuery("#info_form").addClass("col-lg-6");
	jQuery("#avatar_form").css("display", "block");
}

function change_form_info()
{
	
	jQuery("#avatar_form").css("display", "none");
	jQuery("#info_form").css("display", "block");	
}

function reset_size_form()
{
	jQuery("#info_form").removeClass("col-lg-6");
	jQuery("#info_form").addClass("col-lg-12");
	jQuery("#avatar_form").css("display", "none");
}

function change_avatar_photo(id_avatar)
{
	jQuery("#avatar").val(id_avatar);
	jQuery("#img_value").attr('src', '../images/avatar/' + id_avatar);
	change_form_info();
}

function change_avatar_setting(id_avatar)
{
	reset_size_form();
	jQuery("#avatar").val(id_avatar);
	jQuery("#img_value").attr('src', '../images/avatar/' + id_avatar);
}

function select_avatar(id_avatar, id_img)
{
	jQuery("#hidden_avatar").val(id_avatar);
	jQuery("#" + id_img).removeClass("black-white-img");
	var prec_id = jQuery("#prec_avatar").val();
	if (prec_id != 0)
	{
		jQuery("#" + prec_id).addClass("black-white-img");
	}
	jQuery("#prec_avatar").val(id_img);
}

function control_div(div_to_show, div_to_hide)
{
	show_div(div_to_show);
	hide_div(div_to_hide);
}

function show_div(name_div)
{
	jQuery("#" + name_div).css("display", "block");
}
function hide_div(name_div)
{
	jQuery("#" + name_div).css("display", "none");
}

function add_span_badge_hide()
{
	var text = jQuery("#text").val();
	var color = jQuery("input[name='color']:checked").val();
	if (jQuery("input[name='color']:checked").val() != undefined)
	{
		var already_written = jQuery("#list_badge").val();
		already_written += text + "$$$" + color + "???";
		jQuery("#list_badge").val(already_written);
		jQuery("#span_badge").append("<span class='badge badge-" + color + "'>" + text + "</span>&nbsp;&nbsp;");
		jQuery("#text").val("");
		jQuery("input[name='color']:checked").prop('checked', false);
		jQuery("#modal_badge").modal('hide');
	}
}

function add_span_badge(text, color)
{
	var already_written = jQuery("#list_badge").val();
	already_written += text + "$$$" + color + "???";
	jQuery("#list_badge").val(already_written);
	jQuery("#span_badge").append("<span class='badge badge-" + color + "'>" + text + "</span>&nbsp;&nbsp;");
}

function add_span_badge_id(id_tag, text, color)
{
	var already_written = jQuery("#list_id_badge").val();
	if (!already_written.includes(id_tag + "$$$")){
		already_written += id_tag + "$$$";
		jQuery("#list_id_badge").val(already_written);
		jQuery("#span_badge").append("<span class='badge badge-" + color + "' id='tag_span_"+ id_tag +"'>" + text + "</span>&nbsp;&nbsp;");
	}
	else
	{
		var index = already_written.indexOf(id_tag + "$$$");
		var elem = document.querySelector('#tag_span_' + id_tag);
		elem.style.display = 'none';
		already_written = already_written.substring(index, ((id_tag + "$$$").length) -1 );
		jQuery("#list_id_badge").val(already_written);
	}
}

function select_autore_libro(id_autore)
{
	jQuery("#id_autore" + id_autore).prop('checked', true);
}

function select_casaeditrice_libro(id_casa_editrice)
{
	jQuery("#id_casa_editrice" + id_casa_editrice).prop('checked', true);
}

function SetNoFav_classic()
{
	jQuery.ajax({ url: '../view/esploraLibro.php',
         data: {
			 SetNotFav: 'test',
			 id_libro: jQuery("#id_libro").val()
		},
		type: 'post',
		success: function(output) {
			jQuery("#SetNoFav").css("display", "none");
			jQuery("#SetFav").css("display", "block");
		}
	});
}

function SetFav_classic()
{
	jQuery.ajax({ url: '../view/esploraLibro.php',
         data: {
			 SetFav: 'test',
			 id_libro: jQuery("#id_libro").val()
		},
		type: 'post',
		success: function(output) {
			jQuery("#SetFav").css("display", "none");
			jQuery("#SetNoFav").css("display", "block");
		}
	});
}

function SetNoFav(id_libro)
{
	jQuery.ajax({ url: '../view/esploraLibro.php',
         data: {
			 SetNotFav: 'test',
			 id_libro: id_libro
		},
		type: 'post',
		success: function(output) {
			//Effettuo un refresh della griglia
			(jQuery('#example').DataTable()).ajax.reload();
		}
	});
}

function SetFav(id_libro)
{
	jQuery.ajax({ url: '../view/esploraLibro.php',
         data: {
			 SetFav: 'test',
			 id_libro: id_libro
		},
		type: 'post',
		success: function(output) {
			//Effettuo un refresh della griglia
			(jQuery('#example').DataTable()).ajax.reload();
		}
	});
}

function InsertList()
{
	jQuery("#nomeLista").css("border", "");
	if(jQuery("#nomeLista").val() == undefined || jQuery("#nomeLista").val() == "")
	{
		jQuery("#nomeLista").css("border", "1px solid red");
	}
	else
	{
		//Mando il form per la creazione della lista
		jQuery.ajax({
			url: '../view/esploraLibro.php',
			data: {
				NewList: 'test',
				nome_lista: jQuery("#nomeLista").val(),
				public: jQuery("input[name='public']:checked").val(),
			},
			type: 'post',
			success: function(output) {
				jQuery("#listList").append("<a class='dropdown-item cursor' href='#'>" +jQuery("#nomeLista").val() + "</a>");
				//Chiudo il modale
				jQuery('#modal_new_list').modal('toggle');
				//Mostro un alert di creazione avvenuta
				jQuery("#alertCreateList").removeClass("invisible");
				setTimeout(function (){
					jQuery("#alertCreateList").addClass("invisible");
				}, 3000);
			}
		});
	}
}

function InsertListRefresh()
{
	jQuery("#nomeLista").css("border", "");
	if(jQuery("#nomeLista").val() == undefined || jQuery("#nomeLista").val() == "")
	{
		jQuery("#nomeLista").css("border", "1px solid red");
	}
	else
	{
		//Mando il form per la creazione della lista
		jQuery.ajax({
			url: '../view/listaListe.php',
			data: {
				NewList: 'test',
				nome_lista: jQuery("#nomeLista").val(),
				public: jQuery("input[name='public']:checked").val(),
			},
			type: 'post',
			success: function(output) {
				//Chiudo il modale
				jQuery('#modal_new_list').modal('toggle');
				//Mostro un alert di creazione avvenuta
				jQuery("#alertInsertInList").removeClass("invisible");
				setTimeout(function (){
					jQuery("#alertInsertInList").addClass("invisible");
				}, 3000);
				//Effettuo un refresh della griglia
				(jQuery('#example').DataTable()).ajax.reload();
			}
		});
	}
}

function OpenModalList(id)
{
	jQuery("#id_lista").val(id);
	jQuery('#modal_insert_in_list').modal('toggle');
}

function InsertBookInList()
{
	//Mando il form per l'inserimento del libro in lista
	jQuery.ajax({
		url: '../view/esploraLibro.php',
		data: {
			BookInList: 'test',
			is_read: jQuery("#statoLibro").val(),
			id_lista: jQuery("#id_lista").val(),
			id_libro: jQuery("#id_libro").val()
		},
		type: 'post',
		success: function(output) {
			//Chiudo il modale
			jQuery('#modal_insert_in_list').modal('toggle');
			//Mostro un alert di creazione avvenuta
			jQuery("#alertInsertInList").removeClass("invisible");
			setTimeout(function (){
				jQuery("#alertInsertInList").addClass("invisible");
			}, 3000);
		}
	});
}

function DeleteBookFromList(id)
{
	jQuery("#id_libro").val(id);
	jQuery('.elimina-libro').modal('toggle');
}

function ChangeStatus(id_libro, id_lista)
{
	//Aggiorna su db lo stato del libro
	var is_read = jQuery("#"+ id_libro + "_status").val();
	is_read == 0 ? is_read = 1: is_read = 0;
	jQuery("#"+ id_libro + "_status").val(is_read);
	//is_read == 1 ? is_read = 0;
	jQuery.ajax({
		url: '../view/dettaglioLista.php',
		data: {
			updateStatus: 'test',
			is_read: is_read,
			id_lista: id_lista,
			id_libro: id_libro
		},
		type: 'post',
		success: function(output) {
			if (is_read == 0)
			{
				//Modifica il testo del pulsante
				jQuery('#btn_' + id_libro).html("<i class='fa fa-times'></i> Non letto");
			}
			else
			{
				jQuery('#btn_' + id_libro).html("<i class='fa fa-check'></i> Letto");
			}
		}
	});
}

function allowDrop(ev) {
	ev.preventDefault();
  }
  
  function drag(ev, id_libro) {
	ev.dataTransfer.setData("text", id_libro);
  }
  
  function drop(ev) {
	ev.preventDefault();
	var id_libro = ev.dataTransfer.getData("text");
	//Prendo i dati del libro e lo inserisco nel carrello
	jQuery.ajax({
		url: '../view/esploraLibro.php',
		data: {
			GetBook: 'test',
			id_libro: id_libro,
		},
		type: 'post',
		success: function(output) {
			//$libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
			var splitted = output.split('$$$');
			//Se il libro è già in lista aumento solo la quantità
			if (jQuery("#qta_" + id_libro).text() != "")
			{
				//Aumento la quantità
				var qta = jQuery("#qta_" + id_libro).text();
				//qta = qta.replace("Qtà. ", "");
				qta = parseInt(qta, 10)
				qta = qta + 1;
				jQuery("#qta_" + id_libro).text(qta);
			}
			else
			{
				var div = document.createElement("div");
				div.classList.add("nav-link");
				var divRow = document.createElement("div");
				divRow.classList.add("row");
				var divCol2 = document.createElement("div");
				divCol2.classList.add("col-md-2");
				var img = document.createElement("img");
				var divCol8 = document.createElement("div");
				divCol8.classList.add("col-md-8");
				var divTitolo = document.createElement("div");
				divTitolo.classList.add("row");
				var divAutore = document.createElement("div");
				divAutore.classList.add("row");
				divAutore.setAttribute("style", "color: #e74c3c");
				var divCol2_prezzo = document.createElement("div");
				divCol2_prezzo.classList.add("col-md-2");
				var divPrezzo = document.createElement("div");
				divPrezzo.classList.add("row");
				var divQta = document.createElement("div");
				divQta.classList.add("row");
				var span = document.createElement("span");
				span.setAttribute("id", "qta_" + id_libro);
				divPrezzo.innerText = splitted[2] + " €";
				divQta.innerText = "Qtà. ";
				span.innerText = "1";
				img.setAttribute("src", splitted[3]);
				divTitolo.innerText = splitted[0];
				divAutore.innerText = "by " + splitted[1];
				divCol2.appendChild(img);
				divCol8.appendChild(divTitolo);
				divCol8.appendChild(divAutore);
				divCol2_prezzo.appendChild(divPrezzo);
				divQta.appendChild(span);
				divCol2_prezzo.appendChild(divQta);
				divRow.appendChild(divCol2);
				divRow.appendChild(divCol8);
				divRow.appendChild(divCol2_prezzo);
				div.appendChild(divRow);
				jQuery("#cart").append(div);
			}
			//Aumento il prezzo in entrambi i casi
			var total = jQuery("#totalPrice").text();
			total = parseFloat(parseFloat(total) + parseFloat(splitted[2]));
			jQuery("#totalPrice").text(total);
			//Apro il dropdown
			jQuery('#cartDropdown').dropdown().dropdown('toggle');
    		ev.stopPropagation();
		}
	});
  }

  function RemoveQuantity(id_libro)
  {
	jQuery.ajax({
		url: '../view/carrello.php',
		data: {
			RemoveSingleBook: 'test',
			id_libro: id_libro,
		},
		type: 'post',
		success: function(output) {
			//$libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
			var splitted = output.split('$$$');
			var qta = jQuery("#qta_" + id_libro).text();
			if (qta == "1")
			{
				//Se la qta è 1 rimuovo completamente il libro
				jQuery("#book_" + id_libro).remove();
			}
			else
			{
				//Se la qta è > 1 rimuovo uno dalla qta
				qta = parseInt(qta);
				qta = qta - 1;
				jQuery("#qta_" + id_libro).text(qta);
			}
			//Diminuisco il prezzo in entrambi i casi
			var total = jQuery("#totalPrice").text();
			total = parseFloat(parseFloat(total) - parseFloat(splitted[2]));
			jQuery("#totalPrice").text(total);
		}
	});
  }

  function AddQuantity(id_libro)
  {
	jQuery.ajax({
		url: '../view/carrello.php',
		data: {
			AddSingleBook: 'test',
			id_libro: id_libro,
		},
		type: 'post',
		success: function(output) {
			//$libro["titolo"]."$$$".$libro["autore"]."$$$".$libro["prezzo"]."$$$".$libro["path_copertina"];
			var splitted = output.split('$$$');
			var qta = jQuery("#qta_" + id_libro).text();
			qta = parseInt(qta);
			qta = qta + 1;
			jQuery("#qta_" + id_libro).text(qta);
			//Diminuisco il prezzo in entrambi i casi
			var total = jQuery("#totalPrice").text();
			total = parseFloat(parseFloat(total) + parseFloat(splitted[2]));
			jQuery("#totalPrice").text(total);
		}
	});
  }