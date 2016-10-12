function addEvent(elem, event, fn) {
    if (elem.addEventListener) {
        elem.addEventListener(event, fn, false);
    } else {
        elem.attachEvent("on" + event, function() {
            // set the this pointer same as addEventListener when fn is called
            return(fn.call(elem, window.event));   
        });
    }
}

var Navigator_stat = function(nav_container){
	var current_page = window.location.href ;
	var previous_page = document.referrer ;
	
	var nav_container = nav_container;
	
	var day_id = "UNIQUE_VISIT_TODAY";
	var week_id = "UNIQUE_VISIT_WEEK";
	var month_id = "UNIQUE_VISIT_MONTH";
	var year_id = "UNIQUE_VISIT_YEAR";
	var custom_id = "UNIQUE_VISIT_CUSTOM";
	var _self = this;
	
	/*------------------------------------------------------------------
	-- FUNZIONE INIT (CHIAMA LA PAGINA E IL CALLBACK AL CARICAMENTO) ---
	------------------------------------------------------------------*/
	this.init = function(container){
		loadPage("ajax/navigation_overlay_stats.php",nav_container, pageLoaded);	
	};
	
	/*------------------------------------------------------------------
	-- AL CARICAMENTO DELLA PAGINA BINDO GLI EVENTI E CHIAMO GETSTATS
	------------------(CHE RESTITUISCE LE STATISTICHE)	----------------
	------------------------------------------------------------------*/
	var pageLoaded = function(){
		// BIND EVENT ON CUSTOM DATE CHANGE (get the custom stats)
		addEvent(document.getElementById('NAV_DATE_FROM'),"change",function(){
			custom_dt_from = document.getElementById("NAV_DATE_FROM").value;
			custom_dt_to   = document.getElementById("NAV_DATE_TO").value;
			getStat(custom_dt_from,custom_dt_to,custom_id);
		});
		
		addEvent(document.getElementById('NAV_DATE_TO'),"change",function() {
			custom_dt_from = document.getElementById("NAV_DATE_FROM").value;
			custom_dt_to   = document.getElementById("NAV_DATE_TO").value;
			getStat(custom_dt_from,custom_dt_to,custom_id);
		});
		
		getStats();
	}
	
	/*------------------------------------------------------------------
	---- CHIAMA LE FUNZIONI PER RECUPERARE E SCRIVERE LE STATISTICHE ---
	------------------------------------------------------------------*/
	var getStats = function(){
		var today_range,week_range,month_range,custom_range;
		
		custom_dt_from = document.getElementById("NAV_DATE_FROM").value;
		custom_dt_to   = document.getElementById("NAV_DATE_TO").value;
		
		today_range  = getDatePeriod("today");
		week_range   = getDatePeriod("week");
		month_range  = getDatePeriod("month");
		
		getStat(today_range[0],today_range[1],day_id);
		getStat(week_range[0],week_range[1],week_id);
		getStat(month_range[0],month_range[1],month_id);
		getStat(custom_dt_from,custom_dt_to,custom_id);
	};
	
	/*-------------------------------------------------------------------
	- CHIAMATA AJAX PER RECUPERO STATISTICHE IN BASE A UN RANGE DI DATE -
	-------------------------------------------------------------------*/
	var getStat = function(date_from,date_to,elem){
		var params = "PAGE="+encodeURIComponent(current_page)+"&DATE_FROM="+encodeURIComponent(date_from)+"&DATE_TO="+encodeURIComponent(date_to)+"&rand=" + Math.random();
		var http,strRes;
		
		if (window.XMLHttpRequest) {
			http = new XMLHttpRequest();
			http.onreadystatechange = 	function (){
				if (http.readyState == 4 && http.status == 200) { 
					strRes=http.responseText;
					document.getElementById(elem).innerHTML = strRes;
				}
			}
			http.open("POST", "ajax/getStats.php?" ,true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send(params);
		} else if (window.ActiveXObject) {
			http = new ActiveXObject("Microsoft.XMLHTTP");
			if (http) {
				http.onreadystatechange = 	function (){
					if (http.readyState == 4 && http.status == 200) { 
						strRes=http.responseText;
						document.getElementById(elem).innerHTML = strRes;
					}
				}
				http.open("POST", "ajax/getStats.php?" ,true);
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send(params);
			}
		}
	};
	
	var showPageStats = function(elem){
		
	};
	
	var createOverlayStats = function(){
		
	};
	/*-------------------------------------------------------------------
	----------RECUPERA LE DUE DATE RELATIVE A UN PERIODO ----------------
	---------------(SETTIMANA MESE ANNO CORRENTI) -----------------------
	-------------------------------------------------------------------*/
	var getDatePeriod= function(period){// return period of date (date_from and date_to)
		var today = new Date; // get current date
		var date_from;
		var date_to;
		
		switch(period){
			case "today" :
				var firstday = today;
				var lastday  = today;
				break;
			case "week"  :
				var first = today.getDate() - today.getDay() + 1; // First day is the day of the month - the day of the week +1 becouse we start from monday
				var last = first + 6; // last day is the first day + 6

				var firstday = new Date(today.setDate(first));
				var lastday = new Date(today.setDate(last));
				
				break;
			case "month" :
				var firstday = new Date(today.getFullYear(), today.getMonth(), 1); 
				var lastday = new Date(today.getFullYear(), today.getMonth() + 1, 0);
				break;
			case "year"  :
				var firstday = new Date(today.getFullYear()+"-01-01");
				var lastday  = new Date(today.getFullYear()+"-12-31");
				break;
		}
		
		date_from = dateToMysqlFormat(firstday);
		date_to   = dateToMysqlFormat(lastday);
		
		return new Array(date_from,date_to);
	}
	/*-------------------------------------------------------------------
	----------------- CONVERSIONE DATA IN FORMATO MYSQL -----------------
	-------------------------------------------------------------------*/	
	var dateToMysqlFormat = function(date){
		var year, month, day;
		year = String(date.getFullYear());
		month = String(date.getMonth() + 1);
		if (month.length == 1) {
			month = "0" + month;
		}
		day = String(date.getDate());
		if (day.length == 1) {
			day = "0" + day;
		}
		return year + "-" + month + "-" + day;
	}
	/*-------------------------------------------------------------------
	-------------- FUNZIONE PER IL CARICAMENTO DELLE PAGINE ------------- ----------------------------ASINCRONAMENTE --------------------------
	-------------------------------------------------------------------*/
	var  loadPage = function(page,container,callback = 0){
		http = new XMLHttpRequest();

		http.onreadystatechange = function (e) { 
			if (http.readyState == 4 && http.status == 200) {
				container.innerHTML += http.responseText;
				if(callback!=0)callback();
			}
		}

		http.open("GET", page, true);
		http.setRequestHeader('Content-type', 'text/html');
		http.send();
	}
}
// ----------- FINE OGGETTO NAV -----------

		
	var nav = new Navigator_stat(document.body);
	nav.init();
	
	
	

	