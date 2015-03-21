<?php $this->load->view('header');
error_reporting(0);?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAmb06g-X8zv6br3HaGrdHjNQQTi4dAcT0" type="text/javascript"></script> 


<link rel="shortcut icon" href="https://ssl.gstatic.com/docs/spreadsheets/forms/favicon_jfk2.png" type="image/x-icon">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=10; chrome=1;">
	<meta name="fragment" content="!">
	<base target="_blank">
	<title>SPCS DC - Navratri 2014 RSVP Form</title>
	<link rel="stylesheet" type="text/css" href="">
	
	<link href='/static/forms/client/css/3291421356-formview_ltr.css' type='text/css' rel='stylesheet'>

	<style type="text/css">
	body.ss-base-body {
	font-family: Arial,sans-serif;
	}
	div.ss-form-container {
	padding: 15px;
	background-color: #f7f7f7;
	border-color: #0b61a4;
	border-style: solid;
	border-width: 1px;
	text-align: center;
	}
	h1.ss-form-title {
	background-color: #0b61a4;
	padding: 15px;
	margin: -15px -15px 15px;
	color: #ffffff;
	text-align: center;
	}
	div.errorbox-bad {
	background-color: #f7f7f7;
	}
	h2.ss-section-title {
	background-color: transparent;
	}
	div.ss-submit div.ss-form-entry {
	background: none;
	border: none;
	}
	
	</style>
	
	
	<link rel="alternate" type="text/xml+oembed" href="https://docs.google.com/forms/d/1VN6r4D2GjMwSUXvbVKq-ROMkkR7tWA5lCBXF89dtxS4/oembed?url=https://docs.google.com/forms/d/1VN6r4D2GjMwSUXvbVKq-ROMkkR7tWA5lCBXF89dtxS4/viewform&amp;format=xml">

	<meta name="viewport" content="width=device-width">
	<meta property="og:title" content="SPCS DC - Navratri 2014 RSVP Form"><meta property="og:type" content="article"><meta property="og:site_name" content="Google Docs"><meta property="og:url" content="https://docs.google.com/forms/d/1VN6r4D2GjMwSUXvbVKq-ROMkkR7tWA5lCBXF89dtxS4/viewform"><meta property="og:image" content="https://ssl.gstatic.com/docs/forms/social/social-forms.png"><meta property="og:image:width" content="90"><meta property="og:image:height" content="90">
	
	
	
	<link href='/static/forms/client/css/1446748018-mobile_formview_ltr.css' type='text/css' rel='stylesheet' media='screen and (max-device-width: 721px)'>



	<script type="text/javascript"> 

	//<![CDATA[

	function loadmap(address,locname,mapid) {

	

	document.getElementById('map'+mapid).style.display = 'block';

	if (GBrowserIsCompatible()) {

	var map = new GMap2(document.getElementById("map"+mapid));

	

	map.addControl(new GSmallMapControl());

	map.addControl(new GMapTypeControl());



		var companyAddress = address;



		var geoCoder = new GClientGeocoder();

		geoCoder.getLatLng(companyAddress, function(point) {

			map.setCenter(point, 14);

			map.addOverlay(new GMarker(point));

			map.openInfoWindowHtml(point, "<div style='font-size:20px; font-width:bold;'>"+locname+"</div><div style='width:350px; padding-top:6px;'>"+address+"</div>");

			

		});

	  }

	}

	

	

	//]]>


	
	
	function CalcCost(frm) {
    if (!isNaN(frm.members.value) && frm.members.value > 0) {
        frm.membercost.value = ((frm.members.value*1) * frm.memberfee.value).toFixed(2);
    }else{
        frm.members.value = '0';
        frm.membercost.value = '0.00';
    }

    if (!isNaN(frm.guests.value) && frm.guests.value > 0) {
        frm.guestcost.value = ((frm.guests.value*1) * frm.guestfee.value).toFixed(2);
    }else{
        frm.guests.value = '0';
        frm.guestcost.value = '0.00';
    }

    if (!isNaN(frm.children.value) && frm.children.value > 0) {
        frm.childcost.value = ((frm.children.value*1) * frm.childfee.value).toFixed(2);
    }else{
        frm.children.value = '0';
        frm.childcost.value = '0.00';
    }

    frm.total.value = ((frm.membercost.value * 1) + (frm.guestcost.value*1) + (frm.childcost.value * 1)).toFixed(2);
}


function PackageForm(frm) {
    var m,g,c,t;
    var emsg = '';

    if (frm.contactname.value == '') {
        emsg += "Please fill in a contact name.\n\n";
    }

    if (frm.contactphone.value == '') {
        emsg += "Please enter a telephone number.\n\n";
    }
	
	   if (frm.contactemail.value == '') {
        emsg += "Please enter a email.\n\n";
    }

    var m = frm.members.value * 1;
    var g = frm.guests.value * 1;
    var c = frm.children.value * 1;

    t = m+g+c;
    if (t < 1) {
        emsg += "Please enter how many members, guests and children will be attending.\n\n";
    }

    if (m < 1 && g > 0) {
        emsg += "Sorry, but guests must be accompanied by at least 1 members.\n\n";
    }
    if (m < 1 && c > 0) {
        emsg += "Sorry, but children must be accompanied by at least 1 adult member.\n\n";
    }


    if (emsg > '') {
        alert(emsg);
        return false;

    }else{
        CalcCost(frm);
        frm.os0.value = frm.contactname.value+" "+frm.contactphone.value +" "+frm.contactemail.value;;
        frm.os1.value = "Members="+frm.members.value+", Guests="+frm.guests.value+",  Children="+frm.children.value;
        frm.amount.value = frm.total.value;
        return true;
    }
}



	/**
	* @license
	*! H5F
	* https://github.com/ryanseddon/H5F/
	* Copyright (c) Ryan Seddon | Licensed MIT
	*/
	
	(function(e,t){"function"==typeof define&&define.amd?define(t):e.H5F=t()})(this,function(){var e,t,a,i,n,r,s,l,u,o,c,d,v,f,p,m,h,g,b,y,w,C,N,A,E,$,k=document,x=k.createElement("input"),q=/^[a-zA-Z0-9.!#$%&'*+-\/=?\^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,M=/[a-z][\-\.+a-z]*:\/\//i,L=/^(input|select|textarea)$/i;return r=function(e,t){var a=!e.nodeType||!1,i={validClass:"valid",invalidClass:"error",requiredClass:"required",placeholderClass:"placeholder"};if("object"==typeof t)for(var r in i)t[r]===void 0&&(t[r]=i[r]);if(n=t||i,a)for(var l=0,u=e.length;u>l;l++)s(e[l]);else s(e)},s=function(a){var i,n=a.elements,r=n.length,s=!!a.attributes.novalidate;if(b(a,"invalid",u,!0),b(a,"blur",u,!0),b(a,"input",u,!0),b(a,"keyup",u,!0),b(a,"focus",u,!0),b(a,"change",u,!0),b(a,"click",o,!0),b(a,"submit",function(i){e=!0,t||s||a.checkValidity()||w(i)},!1),!v())for(a.checkValidity=function(){return c(a)};r--;)i=!!n[r].attributes.required,"fieldset"!==n[r].nodeName.toLowerCase()&&l(n[r])},l=function(e){var t=e,a=g(t),n={type:t.getAttribute("type"),pattern:t.getAttribute("pattern"),placeholder:t.getAttribute("placeholder")},r=/^(email|url)$/i,s=/^(input|keyup)$/i,l=r.test(n.type)?n.type:n.pattern?n.pattern:!1,u=f(t,l),o=m(t,"step"),v=m(t,"min"),h=m(t,"max"),b=!(""===t.validationMessage||void 0===t.validationMessage);t.checkValidity=function(){return c.call(this,t)},t.setCustomValidity=function(e){d.call(t,e)},t.validity={valueMissing:a,patternMismatch:u,rangeUnderflow:v,rangeOverflow:h,stepMismatch:o,customError:b,valid:!(a||u||o||v||h||b)},n.placeholder&&!s.test(i)&&p(t)},u=function(e){var t=C(e)||e,a=/^(input|keyup|focusin|focus|change)$/i,r=/^(submit|image|button|reset)$/i,s=/^(checkbox|radio)$/i,o=!0;!L.test(t.nodeName)||r.test(t.type)||r.test(t.nodeName)||(i=e.type,v()||l(t),t.validity.valid&&(""!==t.value||s.test(t.type))||t.value!==t.getAttribute("placeholder")&&t.validity.valid?(A(t,[n.invalidClass,n.requiredClass]),N(t,n.validClass)):a.test(i)?t.validity.valueMissing&&A(t,[n.requiredClass,n.invalidClass,n.validClass]):t.validity.valueMissing?(A(t,[n.invalidClass,n.validClass]),N(t,n.requiredClass)):t.validity.valid||(A(t,[n.validClass,n.requiredClass]),N(t,n.invalidClass)),"input"===i&&o&&(y(t.form,"keyup",u,!0),o=!1))},c=function(t){var a,i,n,r,s=!1;if("form"===t.nodeName.toLowerCase()){a=t.elements;for(var l=0,o=a.length;o>l;l++)i=a[l],n=!!i.attributes.required,r=!!i.attributes.pattern,"fieldset"!==i.nodeName.toLowerCase()&&(n||r&&n)&&(u(i),i.validity.valid||s||(e&&i.focus(),s=!0));return!s}return u(t),t.validity.valid},d=function(e){var t=this;t.validationMessage=e},o=function(e){var a=C(e);a.attributes.formnovalidate&&"submit"===a.type&&(t=!0)},v=function(){return E(x,"validity")&&E(x,"checkValidity")},f=function(e,t){if("email"===t)return!q.test(e.value);if("url"===t)return!M.test(e.value);if(t){var i=e.getAttribute("placeholder"),n=e.value;return a=RegExp("^(?:"+t+")$"),n===i?!1:""===n?!1:!a.test(e.value)}return!1},p=function(e){var t={placeholder:e.getAttribute("placeholder")},a=/^(focus|focusin|submit)$/i,r=/^(input|textarea)$/i,s=/^password$/i,l=!!("placeholder"in x);l||!r.test(e.nodeName)||s.test(e.type)||(""!==e.value||a.test(i)?e.value===t.placeholder&&a.test(i)&&(e.value="",A(e,n.placeholderClass)):(e.value=t.placeholder,b(e.form,"submit",function(){i="submit",p(e)},!0),N(e,n.placeholderClass)))},m=function(e,t){var a=parseInt(e.getAttribute("min"),10)||0,i=parseInt(e.getAttribute("max"),10)||!1,n=parseInt(e.getAttribute("step"),10)||1,r=parseInt(e.value,10),s=(r-a)%n;return g(e)||isNaN(r)?"number"===e.getAttribute("type")?!0:!1:"step"===t?e.getAttribute("step")?0!==s:!1:"min"===t?e.getAttribute("min")?a>r:!1:"max"===t?e.getAttribute("max")?r>i:!1:void 0},h=function(e){var t=!!e.attributes.required;return t?g(e):!1},g=function(e){var t=e.getAttribute("placeholder"),a=/^(checkbox|radio)$/i,i=!!e.attributes.required;return!(!i||""!==e.value&&e.value!==t&&(!a.test(e.type)||$(e)))},b=function(e,t,a,i){E(window,"addEventListener")?e.addEventListener(t,a,i):E(window,"attachEvent")&&window.event!==void 0&&("blur"===t?t="focusout":"focus"===t&&(t="focusin"),e.attachEvent("on"+t,a))},y=function(e,t,a,i){E(window,"removeEventListener")?e.removeEventListener(t,a,i):E(window,"detachEvent")&&window.event!==void 0&&e.detachEvent("on"+t,a)},w=function(e){e=e||window.event,e.stopPropagation&&e.preventDefault?(e.stopPropagation(),e.preventDefault()):(e.cancelBubble=!0,e.returnValue=!1)},C=function(e){return e=e||window.event,e.target||e.srcElement},N=function(e,t){var a;e.className?(a=RegExp("(^|\\s)"+t+"(\\s|$)"),a.test(e.className)||(e.className+=" "+t)):e.className=t},A=function(e,t){var a,i,n="object"==typeof t?t.length:1,r=n;if(e.className)if(e.className===t)e.className="";else for(;n--;)a=RegExp("(^|\\s)"+(r>1?t[n]:t)+"(\\s|$)"),i=e.className.match(a),i&&3===i.length&&(e.className=e.className.replace(a,i[1]&&i[2]?" ":""))},E=function(e,t){var a=typeof e[t],i=RegExp("^function|object$","i");return!!(i.test(a)&&e[t]||"unknown"===a)},$=function(e){for(var t=document.getElementsByName(e.name),a=0;t.length>a;a++)if(t[a].checked)return!0;return!1},{setup:r}});
	
	</script>


</script>
	
	

<div class="container">

	<h1 class="title"><?php echo $title;?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

	

    <div>    

    <?php

	$count_invitation = $this->dbheader->count_invitation($query->event_id);

	$count_rsvp = $this->dbheader->count_rsvp($query->event_id);

	$count_confirm = $this->dbheader->count_confirm($query->event_id);

	$count_maybe = $this->dbheader->count_maybe($query->event_id);

	$count_notcoming = $this->dbheader->count_notcoming($query->event_id);

	$count_people = $this->dbheader->count_people($query->event_id);

	?>

    <span class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span>

    <span class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span>

    <span class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span>

    <span class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span>

    <span class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span>

    <span class="label label-inverse"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</span>

    </div>

</div>



<hr class="header_hr"/>



<div class="container">

	<div class="row">



<div class="span10 nomargin">

        <div class="page_content">

        <?php $this->load->view('action_status'); ?>

        

        <?php

			if($query)

			{

				echo $query->event_description;

			}

			else

			{

				redirect(base_url('error'));

			}

		?>

		
		<?php 
		
		  
			// Description: PayPal Event RSVP form to capture 
			// contact name & telephone number, number of members, guests & children. 
			// Error checking: a member must accompany guests and children. 

			// (1) fill in the memberfee,guestfee & childfee amounts 
			$memberfee = '20.00';
			$guestfee = '51.00';
			$childfee = '0.00';

			// (2) replace the page title details.
			//scroll to middle of page, to the header row for form table and fix.

			//(3) substitute your own PayPal business email address.

			//(4) enter your own item_name and item_number in the PP form. 


			//the following is just to keep the sample updated on my website.
			//for your own use, remove the next 4 lines.
			$year = date("Y");
			$today = date('Ymd');
			$eday = $year.'07'.'04';
			if ($eday-$today <= 0) $year = $year + 1;

			?>
			
			
			
			
			<h1>Event RSVP Form</h1>



			
			

		
			
			
			
	
        <hr class="hr_2px" />

        <h4>Event Location</h4>

            <div class="location_map">

            <div id="map1" style="margin: 5px; height: 350px; width:750px; border:1px solid #ccc;"></div>

            </div>

            <script language='JavaScript' type='text/javascript'>

            window.onload = loadmap('<?php echo $query->event_location; ?>','<?php echo $query->event_name; ?>','1');

            </script>

        <p style=" padding-left:6px;"><?php echo $query->event_location; ?></p>

        

        <div class="clear"></div>

        </div>

</div>



<div class="span3" style=" margin-left:20px; margin-top:-20px;">

    <div class="sidebar">

        <?php $this->load->view('chapter_menu'); ?>

        <?php $this->load->view('ca_menu'); ?>

        <?php $this->load->view('ads_panel'); ?>

        <div class="space20px"></div>

    </div>

</div>



</div></div>

<?php $this->load->view('footer'); ?>