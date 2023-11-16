/*!
 * New Site BNI v1.0.0 (http://www.groupeimaya.net)
 * Copyright 2017-2023 Fawaz Bouraima
 * Licensed under the GPL-2.0-or-later license
 */


$('document').ready(function(){

	date_time('today_date');
    getBrvm();

	if($('#BannerSlidert:visible').length) {
		var myCarousel = $('#myCarousel');
		var carousel = new bootstrap.Carousel(myCarousel, {
			interval: 4000,
			wrap: false
		});
	}


	if($('#popup-start:visible').length) {

		if($.cookie('BniHomepopupDisplayed') !== 'true') { // Vérifie si le cookie n'est pas déjà défini
			var imageTo = $('.bni-popup-start').data("imglink");
			var fileTo = $('.bni-popup-start').attr("href");
			var nameFileTo = $('.bni-popup-start').attr("alt");

			$.magnificPopup.open({
				type: 'image',
				closeOnBgClick: false,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', 
				closeMarkup: '<button type="button" class="btn btn-warning btn_intro mfp-close">Passer l'+"'"+'intro</button>',
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				items: {
					src: '<img src="' + imageTo + '"/>' ,
					type: 'inline'
				}
			});

			//Définit le cookie qui expire dans 24 heures
			$.cookie('BniHomepopupDisplayed', 'true', { expires: 1 });
			// Set session variable
			//sessionStorage.setItem('popupDisplayed', true);
		}

	}
	
	/****************** End Publication Show and Download *******************/


	/****************** Add active class to left menu *******************/
	if($('#left-internal-sidebar').length) {

		var menuLinks = $('.left-static-menu-link');

		// Parcours des liens pour vérifier si leur URL correspond à la page courante
		menuLinks.each(function() {
			var linkHref = $(this).attr('href');
			var linkTitle = $(this).find('.left-menu-static-title').text().trim();
			
			if (window.location.href.indexOf(linkHref) !== -1 || linkTitle === document.title) {
				$(this).addClass('active');
			} else {
				$(this).removeClass('active');
			}
		});

	}

	/****************** Publication Show and Download 
	if($('#main-publication:visible').length) {

		$('.bni_publication-card').click(function(e) {
			e.preventDefault();
			var imageTo = $(this).data("imglink");
			var fileTo = $(this).attr("href");
			var nameFileTo = $(this).attr("alt");


			var downloadLink = '';
			if (fileTo) {
				downloadLink = '<a href="' + fileTo + '" class="download position-absolute" target="_blank" download="'+nameFileTo+'"><div class="mfp-content-download position-absolute right-0 d-flex justify-content-end py-3 px-4"><span class="mfp-content-icon position-relative p-3 rounded shadow"><i class="fa-solid fa-file-arrow-down fa-2x text-white"></i></span></div></a>';
			}
			$.magnificPopup.open({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				items: {
					src: '<img src="' + imageTo + '"/>'+ downloadLink ,
					type: 'inline'
				}
			});
		});

	}
	/****************** End Publication Show and Download *******************/

	if($('#offre-row:visible').length) {

		$('.actu-offre-card').click(function(e) {
			e.preventDefault();
			var imageTo = $(this).data("imglink");

			$.magnificPopup.open({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: true,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom',
				image: {
					titleSrc: function(item) {
						console.log(item.el.find('.actu-offre-card').attr('title'));
					},
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				},
				items: {
					src: '<img src="' + imageTo + '"/>' ,
					type: 'inline'
				}
			});
		});

	}

	
	/****************** Isotope Product age *******************/
	if($('#isote-product:visible').length) {

		$(".filtering").on("click", "span", function () {
			var a = $(".gallery").isotope({});
			var e = $(this).attr("data-filter");
			a.isotope({ filter: e });
		});
		$(".filtering").on("click", "span", function () {
			$(this).addClass("active").siblings().removeClass("active");
		});
	}

	/****************** End Isotope Product age  *******************/


	/****************** Publication Pagination  *******************/

		if($('#main-publication:visible').length) {

			createPagination(8, '#publication-row', '#pagination-data-container');
		
			function createPaginationItem(pageNumber) {
			const listItem = $('<li></li>');
			const link = $('<a></a>').addClass('page-link').attr('href', '#').text(pageNumber);
			listItem.append(link);
			return listItem;
			}
			
			function showPage(publicationItems, eltParPage, pageNumber) {
			// Index de début et de fin des éléments à afficher
			const startIndex = (pageNumber - 1) * eltParPage;
			const endIndex = startIndex + eltParPage;
			// Boucle sur tous les éléments de la liste de publications
			publicationItems.each((index, item) => {
				if (index >= startIndex && index < endIndex) {
				$(item).show();
				} else {
				$(item).hide();
				}
			});
			}
			
			function createPagination(eltParPage, divPublication, paginationContainerSelector) {
			// Sélection de la liste de publications et du conteneur de pagination
			const publicationList = $(divPublication);
			const paginationContainer = $(paginationContainerSelector).find('ul');
			
			
			// Tableau des éléments de la liste de publications
			const publicationItems = publicationList.children();
			// Nombre total de pages
			const totalPages = Math.ceil(publicationItems.length / eltParPage);
			
			// Ajout des éléments de pagination au conteneur
			for (let i = 1; i <= totalPages; i++) {
				const paginationItem = createPaginationItem(i);
				paginationContainer.append(paginationItem);
			}
			
			// Affichage de la première page au chargement de la page
			showPage(publicationItems, eltParPage, 1);
			
			// Écouteurs d'événements pour les éléments de pagination
			paginationContainer.on('click', 'a', (event) => {
				event.preventDefault();
				const pageNumber = parseInt($(event.target).text());
				showPage(publicationItems, eltParPage, pageNumber);
				// Ajout de la classe 'active' à l'élément de pagination cliqué
				paginationContainer.find('.active').removeClass('active');
				$(event.target).parent().addClass('active');
			});
			}
			
		}

	/****************** End Publication Pagination  *******************/

	if($('#mainmap_reseau:visible').length) {
		initMap();

		$('#sous_collapse1 .list-group-item .sousville a').click(function(){
	      var marker = markersList[$(this).attr('id')];
	      new google.maps.event.trigger( marker, 'click' );

	      $('.panel-title a').addClass('collapsed');
	      $('#sous_collapse1').removeClass('in');
	      $('#sous_collapse1').css('height', '0px');

	      $.scrollTo($('#mainmap_reseau'), 'slow');
	      return false;
	    });
	}


	if($('#mainmapmobile:visible').length) {
		initialize();

		$('.cadre_agence a').click(function(){
	      var marker = markersList[$(this).attr('id')];
	      new google.maps.event.trigger( marker, 'click' );
	      $.scrollTo($('#mainmapmobile'), 'slow');
	      return false;
	    });
	}

	// if($('#mainmapmobile:visible').length) {
  	// 	initialize();

	// 	$('#agence-liste form#form_agence #bni').change(function(){

	//    		//alert($(this).children(":selected").attr("id"));
	//      	var marker = markersList[$(this).children(":selected").attr("id")];
	//      	//alert(marker);
	//         new google.maps.event.trigger( marker, 'change' );
	//         $.scrollTo($('#mainmap'), 'slow');
	//         return false;
	//   	});
 	// }

	/************* CONVERTISSEUR DEVISE ************/

	if($('#main-convertisseur:visible').length) {

			
		chargerListeDevises('devise1', 'EUR');
		chargerListeDevises('devise2', 'XOF');

		
		$(document).ajaxStop(function() {
			Convert_Valeur(1, 2);
		  });
		
		$('.block-vacation #devise1').change(function(){

		  var devise1 = $('.block-vacation #devise1 option:selected').text();
		  devise1 = devise1.replace("\'", "'");
		  var tab = devise1.split(' - '); 
		  devise1 = tab[0]; 
		  $('.block-vacation #lib_devise1').html(devise1);
		  Convert_Valeur(1, 2);
		});

		$('.block-vacation #devise2').change(function(){
		  var devise2 = $('.block-vacation #devise2 option:selected').text();
		  devise2 = devise2.replace("\'", "'");
		  var tab = devise2.split(' - ');
		  devise2 = tab[0];
		  $('.block-vacation #lib_devise2').html(devise2);
		  Convert_Valeur(1, 2);
		});

		$('.block-vacation #champ_devise1').keyup(function(){
		  Convert_Valeur(1, 2);
		});

		$('.block-vacation #champ_devise2').keyup(function(){
		  Convert_Valeur(2, 1);
		});

		// Handle select change event to update the selected value
		$('.block-vacation #devise2').on('change', function() {
			
		  });

		return false;

	}

	/************* SIMULATEUR CREDIT ************/
	if($('.block-vacation form #CoutPret').length) {

        $('.block-vacation form #montant_f').on("keyup", function() {
            $('.block-vacation form #montant').val($(this).val().replace(/ /g,''));
            this.value = this.value.replace(/ /g,'');
            var number = this.value;
            this.value = number.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        });

		jQuery('.block-vacation form input:button').bind('click', function() {
			//if($('.block-vacation form #mensualite').val())
			if(!$('form #montant').TestVide()) return Msg_Erreur('Veuillez svp saisir le champ <b>Montant du credit</b>.', '.block-vacation form #montant', 1);
			else if(!$('form #montant').TestNumeric()) return Msg_Erreur('Veuillez svp saisir une valeur numerique pour le champ <b>Montant du credit</b>.', '.block-vacation form #montant', 1);
			if(!$('.block-vacation form #mensualite').TestVide()) return Msg_Erreur('Veuillez svp saisir le champ <b>Nombre de Mensualites</b>.', '.block-vacation form #mensualite', 1);
			else if(!$('form #mensualite').TestEntier()) return Msg_Erreur('Veuillez svp saisir une valeur entiere pour le champ <b>Nombre de Mensualites</b>.', '.block-vacation form #taux_interet', 1);

			if(!$('.block-vacation form #taux_interet').TestVide()) return Msg_Erreur('Veuillez svp saisir le champ <b>Taux d\'interet</b>.', '.block-vacation form #taux_interet', 1);
			else if(!$('form #taux_interet').TestNumeric()) return Msg_Erreur('Veuillez svp saisir une valeur numerique pour le champ <b>Taux d\'interet</b>.', '.block-vacation form #taux_interet', 1);

			if(!VerifierNombre('mensualite', 1, 480, 'Nombre de mensualites') ||
	        !VerifierNombre('taux_interet', 0.001, 99, "taux d'interet") ||
	        !VerifierNombre('montant', 100, 30000000000000, "Montant du credit")){
				$('.block-vacation form #CoutPret').val('');
				$('.block-vacation form #echeance').val('');
				return;
	        }

	        var i = $('.block-vacation form #taux_interet').val();

		    if (i > 1.0) {
		        i = i / 100.0;
		        //form.Taux.value = i;
		        $('.block-vacation form #taux_interet').val(i);
		    }
		    i /= 12;

		    var pow = 1;
		    for (var j = 0; j < $('.block-vacation form #mensualite').val(); j++)
		        pow = pow * (1 + i);
		    var Echeance = ($('.block-vacation form #montant').val() * pow * i) / (pow - 1);
		    Echeance = Echeance.toFixed(2);
		    Echeance = formatte(Echeance);
		    $('.block-vacation form #echeance').val(Echeance);

		    var CoutPret = ((($('.block-vacation form #montant').val() * pow * i) / (pow - 1))*$('.block-vacation form #mensualite').val())-$('.block-vacation form #montant').val();
		    CoutPret = CoutPret.toFixed(2);
		    CoutPret = formatte(CoutPret);
		    $('.block-vacation form #CoutPret').html(CoutPret);
		});
		return false;
	}

	

	/************* END SIMULATEUR CREDIT ************/

});

  
  function chargerListeDevises(deviseField, deviseParDefaut) {
	$.ajax({
	  url: 'https://api.exchangerate-api.com/v4/latest/EUR',
	  type: 'GET',
	  dataType: 'json',
	  success: function(data) {
		const rates = data.rates;
  
		// Request the currency names from an API (Open Exchange Rates in this example)
		$.ajax({
		  url: 'https://openexchangerates.org/api/currencies.json',
		  type: 'GET',
		  dataType: 'json',
		  success: function(response) {
			const currencySelect = $('#' + deviseField);
			const currencyList = Object.keys(rates);
  
			// Check if the default currency exists in the currency list
			const isDeviseParDefautExists = currencyList.includes(deviseParDefaut);
  
			// Iterate over the currency rates
			for (const currency in rates) {
			  if (rates.hasOwnProperty(currency) && response.hasOwnProperty(currency)) {
				const currencyName = response[currency];
				const rate = rates[currency];
  
				const option = $('<option>').val(rate).text(currency + ' - ' + currencyName);
  
				// Set the selected attribute for the default currency
				if (currency === deviseParDefaut) {
				  option.attr('selected', 'selected');
				}
  
				currencySelect.append(option);
			  }
			}
  
			// Optional: Trigger an event or perform additional actions after populating the select field
			currencySelect.trigger('change');
		  },
		  error: function() {
			alert("Une erreur s'est produite lors du chargement des noms de devises.");
		  }
		});
	  },
	  error: function() {
		alert("Une erreur s'est produite lors du chargement de la liste des devises.");
	  }
	});
}
  

function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+d+' '+months[month]+'  '+year;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}

function EnterPress(container, nom_form){
	$(container+' form#'+nom_form+' input.form-control').keypress(function (e) {
    	var div = $(this).closest(".setup-content");
	  	if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
	  		$('#'+div.attr('id')+' .nextBtn').trigger('click');
            return false;
        } else {
            return true;
        }
	});
}

function centerMapOnCountry(map, countryName){
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( {'address' : countryName}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	    	//console.debug(results);
	        map.setCenter(results[0].geometry.location,17);
	        map.fitBounds(results[0].geometry.bounds)
	    }
	});
}


function addToolTip(marker){
	
	var datas = marker.item;

	if(infowindow) infowindow.close();

	var html = '<div class="gMapInfo" id="gMapInfo">';
		html+= '	<div class="name">'+datas.name+'</div>';
		html+= '	<div class="adresse">'+datas.adr1+'</div>';
		if(datas.adr2!=null && datas.adr2!='') html+= '	<div class="adresse">'+datas.adr2+'</div>';
		if(datas.cp!=null && datas.cp!='') html+= '	<div class="adresse">'+datas.cp+' '+datas.ville+'</div>';
		if(datas.description!=null && datas.description!='') html+= '	<div class="adresse">'+datas.description+'</div>';
		if(datas.horaire!=null && datas.horaire!=''){
			html+= '	<div class="Horaire"><i></i><span>'+datas.horaire+'</span></div><br/>';
		}
		if(datas.tel!=null && datas.tel!=''){
			html+= '	<div class="tel fa fa-phone-square fa-1x">'+datas.tel+'</div><br/>';
		}
		if(datas.mail!=null && datas.mail!=''){
			html+= '	<div class="mail"><i>@</i><span>'+datas.mail+'<span></div>';
		}

		if(datas.site){
			var addHttp = '';
			if(datas.site.indexOf('http') == -1){
				addHttp = 'http://';
			}
			if(datas.site.indexOf(' - - ') != -1){
				res = datas.site.split(' - - ');
				html+= '	<div class="web"><strong>Web :</strong> <a href="'+ addHttp + res[0]+'" target="_blank">'+res[1]+'</a></div>';
			}else{
				html+= '	<div class="web"><strong>Web :</strong> <a href="'+ addHttp + datas.site+'" target="_blank">'+datas.site+'</a></div>';
			}

		}

		html+= '</div>';

	infowindow = new google.maps.InfoWindow({
		//pixelOffset: new google.maps.Size(260,90),
		content: html
	});

	infowindow.open(map,marker);
    map.setZoom(17);
    map.setCenter(marker.getPosition());
}


function initialize() {

		/*if(mapConf.showCountryLayer){
			drawCountry(mapConf.activeCountryIso);
		}*/

	// dessiner tous les markers
	var markers = [];
	for(var i=0; i < implantationsList.length; i++){
		var item = implantationsList[i];
		var image = 'images/gmap_marker.png';
		var imageactive = 'images/gmap_marker_active.png';

		var marker = new google.maps.Marker({
			map: map,
			icon: image,
			active: imageactive,
			position: new google.maps.LatLng(item.coordY, item.coordX),
			title: item.name,
			myLink: item.link,
			item: item
		});

		marker.addListener('click', function() {
			addToolTip(this);
  		});


		marker.addListener('change', function() {
			addToolTip(this);
		});
		/*
		google.maps.event.addListener(marker, 'click', function() {
			window.location.href = this.myLink;
		});
		if(item.uid == mapConf.activeImplantation){
			if(!isMobile()){
				addToolTip(map, marker, item);
				map.panBy(-200, -100);
			} else {
				map.panBy(-100, 0);
			}
		}
		*/
		markersList['bni'+item.uid] = marker;
		markers.push(marker);
	}

	/*if(mapConf.useClusters == '1'){
		mcOptions = {gridSize: 20, styles: [ { height: 56, url: mapConf.baseUrl + 'images/cluster.png', width: 56}]}
		var markerCluster = new MarkerClusterer(map, markers, mcOptions);
	}*/

	/*if(mapConf.activeCountry != 0 && mapConf.centerMapOnCountry == 1){
		centerMapOnCountry(map, mapConf.activeCountry);
	}*/

	/*if(mapConf.showLegend != 0){
		map.controls[google.maps.ControlPosition.RIGHT_TOP].push(document.getElementById('gmapLegendWrap'));
	}*/

	/*google.maps.event.addListener(map, 'zoom_changed', function() {
		if(map.getZoom() > 5){
			deleteCountry();
		} else {
			restoreCountry();
		}
	});*/
}


function isScrolledIntoView(elem){var $window=$(window);return elem.offset().top+ elem.outerHeight()>=$window.scrollTop()&&elem.offset().top<=$window.scrollTop()+ $window.height();}
function lazyInit(element,func){var $win=jQuery(window);$win.on('load scroll',function(){if((!element.hasClass('lazy-loaded')&&(isScrolledIntoView(element)))){func.call();element.addClass('lazy-loaded');}});}



function Convert_Valeur(id1, id2) {

	var montant = parseFloat($('#champ_devise'+id1).val());
	var deviseRateSource = parseFloat($('#devise'+id1+' option:selected').val()); 
	var deviseDestination = parseFloat($('#devise'+id2).val());

    var montantConverti = '';
    if(deviseRateSource>0) montantConverti = (deviseDestination/deviseRateSource) * montant;
    montantConverti = formatte(montantConverti);
    var tab = String(montantConverti).split('.');
    montantConverti = tab[0];
    r = 0;
    if(tab.length==2) {
     r = tab[1];
	 r = r.substring(0,6);
	 montantConverti = montantConverti + ',' + r;
    }
  
	// Afficher le montant converti dans le champ devise2
	$('#champ_devise'+id2).val(montantConverti);
}

function formatte(valeur2){

	valeur = String(valeur2);
	valeur = valeur.replace(' ', '');
	//valeur = str_replace(' ', '', valeur);
	if (isNaN(valeur.split(' ').join(''))) return valeur;
	var valeurformate =new Array()
	var tempval=valeur.split('.')
	valeur=tempval[0].split(' ').join('')
	valeur=valeur.split('').reverse()

	var i=0
	while(i<valeur.length){

	 valeurformate.push( (valeur[i+2]?valeur[i+2]:'') + (valeur[i+1]?valeur[i+1]:'') + valeur[i] );
	 i=i+3;
	}

	valeurformate=valeurformate.reverse().join(' ') +( tempval[1]?tempval[1].length>0?'.'+tempval[1]:'':'');
	return valeurformate
}

function VerifierNombre(data, min, max, msg) {
    msg = "La zone " + msg + " n'a pas une donnee correcte : " + $('#'+data).val();

    var Val = $('#'+data).val();
    for (var i = 0; i < Val.length; i++) {
        var c = Val.substring(i, i + 1)
        if ((c < "0" || "9" < c) && c != '.') {
            alert(msg);
            return false;
        }
    }
    var num = parseFloat(Val)
    if (num < min || max < num) {
        alert(msg + " n'est pas compris entre [" + min + ".." + max + "]");
        return false;
    }
    //data.value = Val;
    $('#'+data).val(Val);
    return true;
}
function numberWithSpaces(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}

function floatWithSpaces(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts.join(".");
}

function getBrvm() {
    var str = '',
        c;
    $.get('https://easytrade.bnifinances.ci/BNIFinancesServer/Service.svc/GetMarketSnapshot', function(response) {
        //console.log(response);
      if (response && response.Ticker) {
        $.each(response.Ticker, function(idx, data) {
            c = data.var >= 0 ? 'fa fa-arrow-up text-success' : 'fa fa-arrow-down text-danger';
            data.var = data.var.toFixed(2);
            str += '<span style="padding:0px 10px;display:inline-block;color:#fff">' + data.Titre + ' &nbsp;&nbsp; ' + numberWithSpaces(data.prix) + ' &nbsp;&nbsp;' + data.var + ' <i class="' + c + '"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#6c6d6e">|</span></span>';
        });
        $('#brvm').html(str);
      }
    });
}

function SelectValues(champ, sep) {
    var obj = typeof champ === "object" ? champ : $(champ);
    if (!obj.length) return '';
    var str = '';
    if (typeof sep === 'undefined') sep = ',';
    $(champ + " option:selected").each(function() {
        if (str) str += sep;
        str += $(this).val();
    });
    return str;
}

// function BrowserDetection() {
//     var browser = '';
//     //Check if browser is IE or not
//     if (navigator.userAgent.search("MSIE") >= 0) browser = 'ie';
//     //Check if browser is Chrome or not
//     else if (navigator.userAgent.search("Chrome") >= 0)  browser = 'chrome';
//     //Check if browser is Firefox or not
//     else if (navigator.userAgent.search("Firefox") >= 0)  browser = 'firefox';
//     //Check if browser is Safari or not
//     else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0)  browser = 'safari';
//     //Check if browser is Opera or not
//     else if (navigator.userAgent.search("Opera") >= 0)  browser = 'opera';

//     return browser;
// }
// initialise plugins
// jQuery(function(){
//   $('ul li:first-child').addClass('first');
//   $('ul li:last-child').addClass('last');
//   var classe = BrowserDetection();
//   if(classe) $('body').addClass(classe);
// });