/*
********************************
-------------pbTable-----------
https://github.com/pieroblunda/pbTable

Piero Blunda 2013
License: licencia de Creative Commons Reconocimiento-NoComercial 3.0 Unported
********************************
*/

//Hacer un metodo que sea recargar datos (para despues de hacer un ABM que refresque la tabla con los datos actualizados)
(function($){
	$.fn.pbTable = function(options_user){
		var options_default = {
			selectable: true,
			sortable:true,
			isMobile:false,
			msgSinDatos:'No specific results found.',
			toolbar:{
					enabled:true,
					idToAppend:'undefined',
					filterBox:true,
					selectedClass:'selected',
					tags:[{display:'All', toSearch:''}],
					buttons:['view', 'edit', 'delete', 'new', 'print', 'receipt']
			}
		};

		//herencia de las opciones definidasa por el usuario
		var options = jQuery.extend(true, options_default, options_user);

		//Definicion de los objetos que se agregan
		var myTable = $(this);
		var txtSearchBox = '<input id="search-' + myTable.attr('id') + '" search-in="' + myTable.attr('id') + '" type="search" class="form-control" placeholder="Filter...">',
		    btnView =	'<button id="btn-View" class="btn btn-success" disabled><span class="glyphicon glyphicon-eye-open visible-xs center-block"></span><span class="hidden-xs">&nbsp;&nbsp;Ver</span></button>',
		    btnEdit =	'<button id="btn-Edit" class="btn btn-warning" disabled><span class="glyphicon glyphicon-file visible-xs center-block"></span><span class="hidden-xs">&nbsp;&nbsp;Editar</span></button>',
		    btnDelete = '<button id="btn-Delete" class="btn btn-danger" disabled><span class="glyphicon glyphicon-trash visible-xs center-block"></span><span class="hidden-xs">&nbsp;&nbsp;Eliminar</span></button>',
		    btnNew =	'<button id="btn-New" class="btn btn-primary"><span class="glyphicon glyphicon-plus visible-xs center-block"></span><span class="hidden-xs">&nbsp;&nbsp;Nuevo</span></button>',
		    btnPrint =	'<button id="btn-Print" class="btn btn-primary"><span class="glyphicon glyphicon-print visible-xs center-block"></span><span class="hidden-xs">&nbsp;&nbsp;Imprimir</span></button>',
		    btnReceipt ='<button id="btn-Receipt" class="btn btn-primary">Recibo</button>',

		    divContainer = '<div id="' + myTable.attr('id') + '-pbToolbar' + '" class="row">';

			divContainer +=	'<div name="sectionForButtons" class="col-lg-auto pull-right"></div>';

			divContainer +=	'<div name="sectionForSearchBox" class="col-xs-12 col-md-6 col-lg-4 pull-right" style="padding-right:0px;">';
			divContainer +=		'<div name="divForSearchBox"">';

			if(options.toolbar.tags.length > 0 && options.isMobile == false){
				divContainer +=			'<div class="input-group-btn">';
				divContainer +=				'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tags&nbsp;&nbsp;<span class="caret"></span></button>';
				divContainer +=				'<ul name="sectionForTags" class="dropdown-menu" role="menu"></ul>';
				divContainer +=			'</div>'; //input-group-btn
			}

			divContainer +=		'</div>'; //.input-group
			divContainer +=	'</div>'; //sectionForSearchBox

			if(options.isMobile == false)
				divContainer +=	'<div name="sectionForTitle" class="col-lg-3"><h1 style="margin-top:4px;">'+options.title+'</h1></div>';

			divContainer +=	'</div>'; //.row

		//Agrega fila para "No se encontraron resultados"
		cantidadDeColumnas = $('#'+myTable.attr('id')+ ' thead tr:first th').length;
		$(this).children('tbody').append('<tr name="filaMsgSinDatos"><td colspan="'+cantidadDeColumnas+'"><i>'+options.msgSinDatos+'</i></td></tr>');
		$('#'+myTable.attr('id')+ ' tbody tr[name="filaMsgSinDatos"]').hide();

		//Selectable
		if(options.selectable){
			$(this).children('tbody').css('cursor', 'pointer');
			$(this).children('tbody').children('tr').on('click', function(){

				if($(this).hasClass(options.toolbar.selectedClass)){
				    var thisTieneClass = 1;
					$('#btn-View').attr('disabled', 'disabled');
					$('#btn-Edit').attr('disabled', 'disabled');
					$('#btn-Delete').attr('disabled', 'disabled');
				}

				myTable.children('tbody').children('tr').removeClass(options.toolbar.selectedClass);

				if(thisTieneClass != 1){
				    $(this).addClass(options.toolbar.selectedClass);
					$('#btn-View').removeAttr('disabled');
					$('#btn-Edit').removeAttr('disabled');
					$('#btn-Delete').removeAttr('disabled');
				}

			});
		};

		//Sortable
		if(options.sortable){
			myTable.addClass('sortable');
			$('#' + myTable.attr('id') + ' thead').css('cursor', 'pointer');

			pbSortable();
		};

		//Enable Toolbar
		if(options.toolbar.enabled){
			//Cargo el div contenedor
			if(options.toolbar.idToAppend == 'undefined' || options.toolbar.idToAppend == false)
				//Si no se especifica el div contenedor
				myTable.before(divContainer);
			else
				$('#'+options.toolbar.idToAppend).append(divContainer);

			//Cargo el text-input
			if(options.toolbar.filterBox){
				$('#' + myTable.attr('id') + '-pbToolbar div[name="divForSearchBox"]').prepend(txtSearchBox);
			};

			//Cargo los tags
			if(options.toolbar.tags.length > 0 && options.toolbar.filterBox && options.isMobile == false){
				if(options_user.toolbar !== undefined && options_user.toolbar.tags !== undefined)
					options.toolbar.tags = options_user.toolbar.tags;

				options.toolbar.tags.forEach(function(tag){
					$('#' + myTable.attr('id') + '-pbToolbar ul[name="sectionForTags"]').append(
						'<li><a name="pbButtonTag"  input-search="search-'+myTable.attr('id')+'" toSearch="'+tag.toSearch+'" href="#">'+tag.display+'</a></li>'
					);
				});
				$('a[name="pbButtonTag"]').click(function(e){
					var campoBusqueda = $('#' + $(this).attr('input-search'));
					var textoBusqueda = $(this).attr('toSearch');
					filtrarTabla(campoBusqueda, textoBusqueda);
				});

				$('div[name="divForSearchBox"]').addClass('input-group');
			};

			//Evento para la funcion de busqueda
			$('input[search-in]').keyup(function(){
				filtrarTabla($(this));
			});

			//Cargo los botones
			if(options.toolbar.buttons.length > 0 && options.toolbar.filterBox){
				if(options_user.toolbar !== undefined && options_user.toolbar.buttons !== undefined)
					options.toolbar.buttons = options_user.toolbar.buttons;

				options.toolbar.buttons.forEach(function(button){
					switch(button){
						case 'view':
							addButton(myTable, btnView);
							$('#btn-View').bind('click', onView);
							break;

						case 'edit':
							addButton(myTable, btnEdit);
							$('#btn-Edit').bind('click', onEdit);
							break;

						case 'delete':
							addButton(myTable, btnDelete);
							$('#btn-Delete').bind('click', onDelete);
							break;

						case 'new':
							addButton(myTable, btnNew);
							$('#btn-New').bind('click', onNew);
							break;

						case 'print':
							addButton(myTable, btnPrint);
							$('#btn-Print').bind('click', onPrint);
							break;

						case 'receipt':
							addButton(myTable, btnReceipt);
							$('#btn-Receipt').bind('click', onReceipt);
							break;
					};
				});
			};


		} //if options.toolbar enabled

		function onView(){
                options.onView.call(this);
        }

        function onEdit(){
                options.onEdit.call(this);
        }

        function onDelete(){
                options.onDelete.call(this);
        }

        function onNew(){
                options.onNew.call(this);
        }

        function onPrint(){
                options.onPrint.call(this);
        }

        function onReceipt(){
                options.onReceipt.call(this);
        }

		//Para menajar las acciones de teclado
		$(document).on('keydown', function(e){
			accionesDeTeclado(myTable, e, options, options.onView, options.onDelete);
		});

		//Esto lo hago para evitar hacer un CSS por dos lineas
		$('.col-xs-auto, .col-sm-auto, .col-md-auto, .col-lg-auto').attr('style', 'width: auto;padding: 0 15px 0 0px;');

	};

	//jQuery expression for case-insensitive filter
	$.extend($.expr[":"], {
		"contains-ci": function(elem, i, match, array){
			//elem -> pajar
			//match[3] -> aguja
			match[3] = omitirAcentos(match[3]);
			//return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
			return (omitirAcentos(elem.innerHTML) || elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});


	function accionesDeTeclado(myTable, e, options, onView, onDelete){
		if(myTable.children('tbody').children('tr').hasClass(options.toolbar.selectedClass)){ //Si hay seleccionado una fila


			//Flecha arribla(38)
			if(e.keyCode == 38)
				$('#'+myTable.attr('id')+' tbody tr.'+options.toolbar.selectedClass).removeClass(options.toolbar.selectedClass).prev('tr').addClass(options.toolbar.selectedClass);

			//Flecha abajo(40)
			if(e.keyCode == 40){
				$('#'+myTable.attr('id')+' tbody tr.'+options.toolbar.selectedClass).removeClass(options.toolbar.selectedClass).next('tr').addClass(options.toolbar.selectedClass);
			}

			//Barra espaciadora(32) o Enter(13)
			if( !($("input").is(":focus")) && (e.keyCode == 32 || e.keyCode == 13) )
				onView();

			//Supr(8)  -- Delete(46)
			if( !($("input").is(":focus")) && (e.keyCode == 8 || e.keyCode == 46) ) {
				e.preventDefault();
				onDelete();
			}
		}
	}

	function omitirAcentos(text) {
		var acentos  = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
		var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc";
		for (var i=0; i<acentos.length; i++) {
			text = text.replace(acentos.charAt(i), original.charAt(i));
		}
		return text;
	};

	function filtrarTabla(campoBusqueda, textoBusqueda){
		if(textoBusqueda != undefined)
			campoBusqueda.val(textoBusqueda);

		var miTabla = campoBusqueda.attr('search-in');
		if(campoBusqueda.val() === ''){
			$("#"+miTabla+" tbody>tr").show();
		}else{
			$("#"+miTabla+" tbody>tr").hide();
			$("#"+miTabla+" td:contains-ci('" + campoBusqueda.val() + "')").parent("tr").show();
		};

		if($("#"+miTabla+" tbody>tr:visible").length == 0){
			$('#'+miTabla+ ' tbody tr[name="filaMsgSinDatos"]').show();
		}else{
			$('#'+miTabla+ ' tbody tr[name="filaMsgSinDatos"]').hide();
		}
	}

	function addButton(myTable, myButton){
		$('#' + myTable.attr('id') + '-pbToolbar div[name="sectionForButtons"]').append('&nbsp;' + myButton);
	}

	function pbSortable(){
	/*
	  SortTable
	  version 2
	  7th April 2007
	  Stuart Langridge, http://www.kryogenix.org/code/browser/sorttable/

	  Instructions:
	  Download this file
	  Add <script src="sorttable.js"></script> to your HTML
	  Add class="sortable" to any table you'd like to make sortable
	  Click on the headers to sort

	  Thanks to many, many people for contributions and suggestions.
	  Licenced as X11: http://www.kryogenix.org/code/browser/licence.html
	  This basically means: do what you want with it.
	*/


	var stIsIE = /*@cc_on!@*/false;

	sorttable = {
	  init: function() {
	    // quit if this function has already been called
	    if (arguments.callee.done) return;
	    // flag this function so we don't do the same thing twice
	    arguments.callee.done = true;
	    // kill the timer
	    if (_timer) clearInterval(_timer);

	    if (!document.createElement || !document.getElementsByTagName) return;

	    sorttable.DATE_RE = /^(\d\d?)[\/\.-](\d\d?)[\/\.-]((\d\d)?\d\d)$/;

	    forEach(document.getElementsByTagName('table'), function(table) {
	      if (table.className.search(/\bsortable\b/) != -1) {
		sorttable.makeSortable(table);
	      }
	    });

	  },

	  makeSortable: function(table) {
	    if (table.getElementsByTagName('thead').length == 0) {
	      // table doesn't have a tHead. Since it should have, create one and
	      // put the first table row in it.
	      the = document.createElement('thead');
	      the.appendChild(table.rows[0]);
	      table.insertBefore(the,table.firstChild);
	    }
	    // Safari doesn't support table.tHead, sigh
	    if (table.tHead == null) table.tHead = table.getElementsByTagName('thead')[0];

	    if (table.tHead.rows.length != 1) return; // can't cope with two header rows

	    // Sorttable v1 put rows with a class of "sortbottom" at the bottom (as
	    // "total" rows, for example). This is B&R, since what you're supposed
	    // to do is put them in a tfoot. So, if there are sortbottom rows,
	    // for backwards compatibility, move them to tfoot (creating it if needed).
	    sortbottomrows = [];
	    for (var i=0; i<table.rows.length; i++) {
	      if (table.rows[i].className.search(/\bsortbottom\b/) != -1) {
		sortbottomrows[sortbottomrows.length] = table.rows[i];
	      }
	    }
	    if (sortbottomrows) {
	      if (table.tFoot == null) {
		// table doesn't have a tfoot. Create one.
		tfo = document.createElement('tfoot');
		table.appendChild(tfo);
	      }
	      for (var i=0; i<sortbottomrows.length; i++) {
		tfo.appendChild(sortbottomrows[i]);
	      }
	      delete sortbottomrows;
	    }

	    // work through each column and calculate its type
	    headrow = table.tHead.rows[0].cells;
	    for (var i=0; i<headrow.length; i++) {
	      // manually override the type with a sorttable_type attribute
	      if (!headrow[i].className.match(/\bsorttable_nosort\b/)) { // skip this col
		mtch = headrow[i].className.match(/\bsorttable_([a-z0-9]+)\b/);
		if (mtch) { override = mtch[1]; }
		      if (mtch && typeof sorttable["sort_"+override] == 'function') {
			headrow[i].sorttable_sortfunction = sorttable["sort_"+override];
		      } else {
			headrow[i].sorttable_sortfunction = sorttable.guessType(table,i);
		      }
		      // make it clickable to sort
		      headrow[i].sorttable_columnindex = i;
		      headrow[i].sorttable_tbody = table.tBodies[0];
		      dean_addEvent(headrow[i],"click", sorttable.innerSortFunction = function(e) {

		  if (this.className.search(/\bsorttable_sorted\b/) != -1) {
		    // if we're already sorted by this column, just
		    // reverse the table, which is quicker
		    sorttable.reverse(this.sorttable_tbody);
		    this.className = this.className.replace('sorttable_sorted',
							    'sorttable_sorted_reverse');
		    this.removeChild(document.getElementById('sorttable_sortfwdind'));
		    sortrevind = document.createElement('span');
		    sortrevind.id = "sorttable_sortrevind";
		    sortrevind.innerHTML = stIsIE ? '&nbsp<font face="webdings">5</font>' : '&nbsp;&#x25B4;';
		    this.appendChild(sortrevind);
		    return;
		  }
		  if (this.className.search(/\bsorttable_sorted_reverse\b/) != -1) {
		    // if we're already sorted by this column in reverse, just
		    // re-reverse the table, which is quicker
		    sorttable.reverse(this.sorttable_tbody);
		    this.className = this.className.replace('sorttable_sorted_reverse',
							    'sorttable_sorted');
		    this.removeChild(document.getElementById('sorttable_sortrevind'));
		    sortfwdind = document.createElement('span');
		    sortfwdind.id = "sorttable_sortfwdind";
		    sortfwdind.innerHTML = stIsIE ? '&nbsp<font face="webdings">6</font>' : '&nbsp;&#x25BE;';
		    this.appendChild(sortfwdind);
		    return;
		  }

		  // remove sorttable_sorted classes
		  theadrow = this.parentNode;
		  forEach(theadrow.childNodes, function(cell) {
		    if (cell.nodeType == 1) { // an element
		      cell.className = cell.className.replace('sorttable_sorted_reverse','');
		      cell.className = cell.className.replace('sorttable_sorted','');
		    }
		  });
		  sortfwdind = document.getElementById('sorttable_sortfwdind');
		  if (sortfwdind) { sortfwdind.parentNode.removeChild(sortfwdind); }
		  sortrevind = document.getElementById('sorttable_sortrevind');
		  if (sortrevind) { sortrevind.parentNode.removeChild(sortrevind); }

		  this.className += ' sorttable_sorted';
		  sortfwdind = document.createElement('span');
		  sortfwdind.id = "sorttable_sortfwdind";
		  sortfwdind.innerHTML = stIsIE ? '&nbsp<font face="webdings">6</font>' : '&nbsp;&#x25BE;';
		  this.appendChild(sortfwdind);

			// build an array to sort. This is a Schwartzian transform thing,
			// i.e., we "decorate" each row with the actual sort key,
			// sort based on the sort keys, and then put the rows back in order
			// which is a lot faster because you only do getInnerText once per row
			row_array = [];
			col = this.sorttable_columnindex;
			rows = this.sorttable_tbody.rows;
			for (var j=0; j<rows.length; j++) {
			  row_array[row_array.length] = [sorttable.getInnerText(rows[j].cells[col]), rows[j]];
			}
			/* If you want a stable sort, uncomment the following line */
			//sorttable.shaker_sort(row_array, this.sorttable_sortfunction);
			/* and comment out this one */
			row_array.sort(this.sorttable_sortfunction);

			tb = this.sorttable_tbody;
			for (var j=0; j<row_array.length; j++) {
			  tb.appendChild(row_array[j][1]);
			}

			delete row_array;
		      });
		    }
	    }
	  },

	  guessType: function(table, column) {
	    // guess the type of a column based on its first non-blank row
	    sortfn = sorttable.sort_alpha;
	    for (var i=0; i<table.tBodies[0].rows.length; i++) {
	      text = sorttable.getInnerText(table.tBodies[0].rows[i].cells[column]);
	      if (text != '') {
		if (text.match(/^-?[£$¤]?[\d,.]+%?$/)) {
		  return sorttable.sort_numeric;
		}
		// check for a date: dd/mm/yyyy or dd/mm/yy
		// can have / or . or - as separator
		// can be mm/dd as well
		possdate = text.match(sorttable.DATE_RE)
		if (possdate) {
		  // looks like a date
		  first = parseInt(possdate[1]);
		  second = parseInt(possdate[2]);
		  if (first > 12) {
		    // definitely dd/mm
		    return sorttable.sort_ddmm;
		  } else if (second > 12) {
		    return sorttable.sort_mmdd;
		  } else {
		    // looks like a date, but we can't tell which, so assume
		    // that it's dd/mm (English imperialism!) and keep looking
		    sortfn = sorttable.sort_ddmm;
		  }
		}
	      }
	    }
	    return sortfn;
	  },

	  getInnerText: function(node) {
	    // gets the text we want to use for sorting for a cell.
	    // strips leading and trailing whitespace.
	    // this is *not* a generic getInnerText function; it's special to sorttable.
	    // for example, you can override the cell text with a customkey attribute.
	    // it also gets .value for <input> fields.

	    if (!node) return "";

	    hasInputs = (typeof node.getElementsByTagName == 'function') &&
			 node.getElementsByTagName('input').length;

	    if (node.getAttribute("sorttable_customkey") != null) {
	      return node.getAttribute("sorttable_customkey");
	    }
	    else if (typeof node.textContent != 'undefined' && !hasInputs) {
	      return node.textContent.replace(/^\s+|\s+$/g, '');
	    }
	    else if (typeof node.innerText != 'undefined' && !hasInputs) {
	      return node.innerText.replace(/^\s+|\s+$/g, '');
	    }
	    else if (typeof node.text != 'undefined' && !hasInputs) {
	      return node.text.replace(/^\s+|\s+$/g, '');
	    }
	    else {
	      switch (node.nodeType) {
		case 3:
		  if (node.nodeName.toLowerCase() == 'input') {
		    return node.value.replace(/^\s+|\s+$/g, '');
		  }
		case 4:
		  return node.nodeValue.replace(/^\s+|\s+$/g, '');
		  break;
		case 1:
		case 11:
		  var innerText = '';
		  for (var i = 0; i < node.childNodes.length; i++) {
		    innerText += sorttable.getInnerText(node.childNodes[i]);
		  }
		  return innerText.replace(/^\s+|\s+$/g, '');
		  break;
		default:
		  return '';
	      }
	    }
	  },

	  reverse: function(tbody) {
	    // reverse the rows in a tbody
	    newrows = [];
	    for (var i=0; i<tbody.rows.length; i++) {
	      newrows[newrows.length] = tbody.rows[i];
	    }
	    for (var i=newrows.length-1; i>=0; i--) {
	       tbody.appendChild(newrows[i]);
	    }
	    delete newrows;
	  },

	  /* sort functions
	     each sort function takes two parameters, a and b
	     you are comparing a[0] and b[0] */
	  sort_numeric: function(a,b) {
	    aa = parseFloat(a[0].replace(/[^0-9.-]/g,''));
	    if (isNaN(aa)) aa = 0;
	    bb = parseFloat(b[0].replace(/[^0-9.-]/g,''));
	    if (isNaN(bb)) bb = 0;
	    return aa-bb;
	  },
	  sort_alpha: function(a,b) {
	    if (a[0]==b[0]) return 0;
	    if (a[0]<b[0]) return -1;
	    return 1;
	  },
	  sort_ddmm: function(a,b) {
	    mtch = a[0].match(sorttable.DATE_RE);
	    y = mtch[3]; m = mtch[2]; d = mtch[1];
	    if (m.length == 1) m = '0'+m;
	    if (d.length == 1) d = '0'+d;
	    dt1 = y+m+d;
	    mtch = b[0].match(sorttable.DATE_RE);
	    y = mtch[3]; m = mtch[2]; d = mtch[1];
	    if (m.length == 1) m = '0'+m;
	    if (d.length == 1) d = '0'+d;
	    dt2 = y+m+d;
	    if (dt1==dt2) return 0;
	    if (dt1<dt2) return -1;
	    return 1;
	  },
	  sort_mmdd: function(a,b) {
	    mtch = a[0].match(sorttable.DATE_RE);
	    y = mtch[3]; d = mtch[2]; m = mtch[1];
	    if (m.length == 1) m = '0'+m;
	    if (d.length == 1) d = '0'+d;
	    dt1 = y+m+d;
	    mtch = b[0].match(sorttable.DATE_RE);
	    y = mtch[3]; d = mtch[2]; m = mtch[1];
	    if (m.length == 1) m = '0'+m;
	    if (d.length == 1) d = '0'+d;
	    dt2 = y+m+d;
	    if (dt1==dt2) return 0;
	    if (dt1<dt2) return -1;
	    return 1;
	  },

	  shaker_sort: function(list, comp_func) {
	    // A stable sort function to allow multi-level sorting of data
	    // see: http://en.wikipedia.org/wiki/Cocktail_sort
	    // thanks to Joseph Nahmias
	    var b = 0;
	    var t = list.length - 1;
	    var swap = true;

	    while(swap) {
		swap = false;
		for(var i = b; i < t; ++i) {
		    if ( comp_func(list[i], list[i+1]) > 0 ) {
			var q = list[i]; list[i] = list[i+1]; list[i+1] = q;
			swap = true;
		    }
		} // for
		t--;

		if (!swap) break;

		for(var i = t; i > b; --i) {
		    if ( comp_func(list[i], list[i-1]) < 0 ) {
			var q = list[i]; list[i] = list[i-1]; list[i-1] = q;
			swap = true;
		    }
		} // for
		b++;

	    } // while(swap)
	  }
	}

	/* ******************************************************************
	   Supporting functions: bundled here to avoid depending on a library
	   ****************************************************************** */

	// Dean Edwards/Matthias Miller/John Resig

	/* for Mozilla/Opera9 */
	if (document.addEventListener) {
	    document.addEventListener("DOMContentLoaded", sorttable.init, false);
	}

	/* for Internet Explorer */
	/*@cc_on @*/
	/*@if (@_win32)
	    document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");
	    var script = document.getElementById("__ie_onload");
	    script.onreadystatechange = function() {
		if (this.readyState == "complete") {
		    sorttable.init(); // call the onload handler
		}
	    };
	/*@end @*/

	/* for Safari */
	if (/WebKit/i.test(navigator.userAgent)) { // sniff
	    var _timer = setInterval(function() {
		if (/loaded|complete/.test(document.readyState)) {
		    sorttable.init(); // call the onload handler
		}
	    }, 10);
	}

	/* for other browsers */
	window.onload = sorttable.init;

	// written by Dean Edwards, 2005
	// with input from Tino Zijdel, Matthias Miller, Diego Perini

	// http://dean.edwards.name/weblog/2005/10/add-event/

	function dean_addEvent(element, type, handler) {
		if (element.addEventListener) {
			element.addEventListener(type, handler, false);
		} else {
			// assign each event handler a unique ID
			if (!handler.$$guid) handler.$$guid = dean_addEvent.guid++;
			// create a hash table of event types for the element
			if (!element.events) element.events = {};
			// create a hash table of event handlers for each element/event pair
			var handlers = element.events[type];
			if (!handlers) {
				handlers = element.events[type] = {};
				// store the existing event handler (if there is one)
				if (element["on" + type]) {
					handlers[0] = element["on" + type];
				}
			}
			// store the event handler in the hash table
			handlers[handler.$$guid] = handler;
			// assign a global event handler to do all the work
			element["on" + type] = handleEvent;
		}
	};
	// a counter used to create unique IDs
	dean_addEvent.guid = 1;

	function removeEvent(element, type, handler) {
		if (element.removeEventListener) {
			element.removeEventListener(type, handler, false);
		} else {
			// delete the event handler from the hash table
			if (element.events && element.events[type]) {
				delete element.events[type][handler.$$guid];
			}
		}
	};

	function handleEvent(event) {
		var returnValue = true;
		// grab the event object (IE uses a global event object)
		event = event || fixEvent(((this.ownerDocument || this.document || this).parentWindow || window).event);
		// get a reference to the hash table of event handlers
		var handlers = this.events[event.type];
		// execute each event handler
		for (var i in handlers) {
			this.$$handleEvent = handlers[i];
			if (this.$$handleEvent(event) === false) {
				returnValue = false;
			}
		}
		return returnValue;
	};

	function fixEvent(event) {
		// add W3C standard event methods
		event.preventDefault = fixEvent.preventDefault;
		event.stopPropagation = fixEvent.stopPropagation;
		return event;
	};
	fixEvent.preventDefault = function() {
		this.returnValue = false;
	};
	fixEvent.stopPropagation = function() {
	  this.cancelBubble = true;
	}

	// Dean's forEach: http://dean.edwards.name/base/forEach.js
	/*
		forEach, version 1.0
		Copyright 2006, Dean Edwards
		License: http://www.opensource.org/licenses/mit-license.php
	*/

	// array-like enumeration
	if (!Array.forEach) { // mozilla already supports this
		Array.forEach = function(array, block, context) {
			for (var i = 0; i < array.length; i++) {
				block.call(context, array[i], i, array);
			}
		};
	}

	// generic enumeration
	Function.prototype.forEach = function(object, block, context) {
		for (var key in object) {
			if (typeof this.prototype[key] == "undefined") {
				block.call(context, object[key], key, object);
			}
		}
	};

	// character enumeration
	String.forEach = function(string, block, context) {
		Array.forEach(string.split(""), function(chr, index) {
			block.call(context, chr, index, string);
		});
	};

	// globally resolve forEach enumeration
	var forEach = function(object, block, context) {
		if (object) {
			var resolve = Object; // default
			if (object instanceof Function) {
				// functions have a "length" property
				resolve = Function;
			} else if (object.forEach instanceof Function) {
				// the object implements a custom forEach method so use that
				object.forEach(block, context);
				return;
			} else if (typeof object == "string") {
				// the object is a string
				resolve = String;
			} else if (typeof object.length == "number") {
				// the object is array-like
				resolve = Array;
			}
			resolve.forEach(object, block, context);
		}
	};
	}

}(jQuery));
