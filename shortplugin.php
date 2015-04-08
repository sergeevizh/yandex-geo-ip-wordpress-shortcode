<?php
/*
Plugin Name: Change City Phone
Description: Change city in select and its phone. With yandex geolocation. Use shordcode [select_city]
Author: CasePress
Version: 0.2
*/
function select_city_phone( $atts ) {
return '
<form name="CityPhone">
<div class="top-phone" id="phone"><span class="glyphicon glyphicon-phone-alt"></span> +7 (495) 111-11-111</div>
<select id="city" name="city" onchange="phoneChange(this)">
</select>
<div id="adr" class="top-adr">М.О. г. Раменское, Северное ш., д. 10</div>
</form>

<script src="http://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
	String.prototype.trim = function() {  return this.replace(/^\s+|\s+$/g, "");  }

	var CityPhoneList = new Array()
		CityPhoneList["Москва"] 		= "+111 & адрес1";
		CityPhoneList["Тюмень"] 		= "+222 & адрес2";
		CityPhoneList["Заводоуковск"] 	= "+333 & адрес3";

	var objSelect = document.CityPhone.city;
	var i=0;
	for(var element in CityPhoneList) {
		objSelect.options[i] = new Option(element, CityPhoneList[element]);
		i++;
	}

	function phoneChange(selectObj){
		var phone = document.getElementById("phone");
		var adrphone = selectObj.options[selectObj.selectedIndex].value.split("\&");
		phone.innerHTML = "<span class=\"glyphicon glyphicon-phone-alt\"></span>" + adrphone[0].trim();
		var adr = document.getElementById("adr");
		adr.innerHTML = adrphone[1].trim();
	}

	ymaps.ready(ChangeCityYa);
	function ChangeCityYa(){
		var cityYa = ymaps.geolocation.city;
		cityselect = document.getElementById("city");
		for (var i=0;i<cityselect.length;i++){
			if (cityselect[i].innerHTML===cityYa){
				cityselect[i].selected=true;
				phoneChange(cityselect);
			}
		}
	}

</script>';
}
add_shortcode( 'select_city','select_city_phone' );
?>