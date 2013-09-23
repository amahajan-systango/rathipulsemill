function setLocation(url){	
	window.location.href = url;
} 


var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && (typeof date == "string" || date instanceof String) && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date();
		if (isNaN(date)) throw new SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};

 
function confirmDelete()//ask for delete page using java script function
{
	    if(confirm("Are you sure you want to delete ?")){
		return true;
		}else {
		return false;
		}


	}

//function for validate event form
function validateEvent(){

	var title=ltrim(document.getElementById('title').value,"");
		if((document.getElementById('title').value=="")||(title.length==0))
		{
			alert("Please enter title.");
			document.getElementById('title').focus();
			return false;
		}
	var eventDate =ltrim(document.getElementById('date').value,"");
		if((document.getElementById('date').value=="")||(eventDate.length==0))
		{
			alert("Please enter event start date.");
			document.getElementById('date').focus();
			return false;
		}
	
	
	var eventDate=document.getElementById('date').value;


	var eventDateNew =new Date(eventDate);

	
	var today = new Date();
	var newDate=today.format("m/dd/yyyy");
	var todayNew=new Date(newDate);



		if (eventDateNew < todayNew)
		{
		alert("Event date must be greater than Today's date. ");
		document.getElementById('date').focus();
		return false;
		}

		//new code add by me for event time validation

		if (eventDateNew == todayNew)
		{
		//alert(eventDateNew);
		var a_p = "";
		var d = new Date();

		var curr_hour = d.getHours();

		if (curr_hour < 12)
		   {
			   a_p = "AM";
		   }
		else
		   {
			   a_p = "PM";
		   }
		if (curr_hour == 0)
		   {
			   curr_hour = 12;
		   }
		if (curr_hour > 12)
		   {
			   curr_hour = curr_hour - 12;
		   }

		var curr_min = d.getMinutes();

		var currentTime=curr_hour + " : " + curr_min + " " + a_p;

		var inputTime=document.getElementById('date').value;

		//alert(currentTime);alert(inputTime);
			if(currentTime > inputTime)
			{
				alert("Event time must be greater than current date.");
				return false;
			}
		
		}




		
	var timepicker12 =ltrim(document.getElementById('timepicker12').value,"");
		if((document.getElementById('timepicker12').value=="")||(timepicker12.length==0))
		{
			alert("Please enter event Start Time.");
			document.getElementById('timepicker12').focus();
			return false;
		}
	var eventEndDate =ltrim(document.getElementById('enddate').value,"");
		if((document.getElementById('enddate').value=="")||(eventEndDate.length==0))
		{
			alert("Please enter event End Date.");
			document.getElementById('enddate').focus();
			return false;
		}

	var eventDate=document.getElementById('date').value;
	var eventDateNew =new Date(eventDate);

	var eventEndDate=document.getElementById('enddate').value;
	var eventEndDateNew =new Date(eventEndDate);
		if(eventDateNew > eventEndDateNew) 
  		{
			alert("End Date must be greater than Start Date.");
			document.getElementById('enddate').focus();
			return false;
		}

	var endtimepicker12 =ltrim(document.getElementById('endtimepicker12').value,"");
		if((document.getElementById('endtimepicker12').value=="")||(endtimepicker12.length==0))
		{
			alert("Please enter event End Time.");
			document.getElementById('endtimepicker12').focus();
			return false;
		}

		else
		{
			return true;
		}

}



//function for Email validation
function echeck(str) {

var at="@"
var dot="."
var lat=str.indexOf(at)
var lstr=str.length
var ldot=str.indexOf(dot)
if (str.indexOf(at)==-1){
alert("Invalid E-mail ID")
return false
}

if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
alert("Invalid E-mail ID")
return false
}

if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
alert("Invalid E-mail ID")
return false
}

if (str.indexOf(at,(lat+1))!=-1){
alert("Invalid E-mail ID")
return false
}

if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
alert("Invalid E-mail ID")
return false
}

if (str.indexOf(dot,(lat+2))==-1){
alert("Invalid E-mail ID")
return false
}

if (str.indexOf(" ")!=-1){
alert("Invalid E-mail ID")
return false
}

return true
} 
//function for blank validation
function valid_func( )
{

if(document.getElementById('user_name').value=="")
{
alert("Please enter user name");document.getElementById('user_name').focus();
return false;
}
if(document.getElementById('first_name').value=="")
{
alert("Please enter first name");
document.getElementById('first_name').focus();
return false;
}
if(document.getElementById('last_name').value=="")
{
alert("Please enter last name");
document.getElementById('last_name').focus();
return false
}
if(document.getElementById('phone').value=="")
{
alert("Please enter phone");
document.getElementById('phone').focus();
return false
}

if(document.getElementById('address').value=="")
{
alert("Please enter address");
document.getElementById('address').focus();
return false
}


var emailID=document.edit.email
if ((emailID.value==null)||(emailID.value=="")){
alert("Please Enter Email ID");
emailID.focus();
return false
}
if (echeck(emailID.value)==false){
emailID.value=""
emailID.focus()
return false
}

if(document.getElementById('password').value=="")
{
alert("Please enter password");
document.getElementById('password').focus();
return false
}


return true 
}

//function for charcter validation
	function ValidateForm(val1)
	{	
		var val=val1.value;
		if(val!="")
		{
			var re=new RegExp("[0-9]");
			var st = (/^[a-zA-Z ]+$/.test(val))?true:false;
			if(st==false)
			{
			
				alert("Only charcter is allowed Please renter");
				val1.value="";
				val1.focus();
				return false;
			
			}
			else {
				return true;
				}
		}
	}
	function ValidateForm1(val1)
	{

		var val=val1.value;
		var re=new RegExp("[0-9]");
		var st = (/^[a-zA-Z0-9]+$/.test(val))?true:false;
		if(st==false)
		{
			alert("Space is not allowed Please renter");
			val1.value="";
			val1.focus();
			return false;
		}
		else
		{
			return true;

		}
	}
 
//function for charcter validation
	function Validate_Form(val)
	{
	
		var re=new RegExp("[0-9]");
		var st = (!re.test(val))?true:false;
		if(st==false)
		{
			alert("Only charcter is allowed Please renter");
			document.getElementById('last_name').value="";
			document.getElementById('last_name').focus();
			return false;
		}
		else 
		{
			return true;
		} 
	}
//function for Integer validation
	function isInteger(s)
	{
		var i;
		s = s.toString();
		for (i = 0; i < s.length; i++)
		{
			var c = s.charAt(i);
			if (isNaN(c)) 
			{
				alert("Enter only number");
				document.getElementById('phone').value="";
				document.getElementById('phone').focus();
				return false;
		
		
			}
		}
		return true;
	}



function valid_blog()
{

if((document.getElementById('CategoryName').value== null)||(document.getElementById('CategoryName').value==""))
{
	alert("Please enter Category Name");
	return false
}

if(document.getElementById('CategoryPhoto').value!='')
{
var sFileName=document.getElementById('CategoryPhoto').value;

var i = sFileName.lastIndexOf(".") ;

if (i == -1 || sFileName.substring(i,sFileName.length).toLowerCase() != ".jpg" && sFileName.substring(i,sFileName.length).toLowerCase() != ".gif" && sFileName.substring(i,sFileName.length).toLowerCase() != ".jpeg"&& sFileName.substring(i,sFileName.length).toLowerCase() != ".png")
{
alert("Please select .jpg or .gif .png image.");
return false;
}
}

var uval=ltrim(document.getElementById('CategoryName').value,"");
if(document.getElementById('CategoryName').value!="" && uval.length==0)
{
alert("Please enter Category Name");
document.getElementById('CategoryName').focus();
return false;
}
else
return true;
}



function valid_blogfunc()
{

if(document.getElementById('tittle').value=="")
{
alert("Please enter Title");
document.getElementById('tittle').focus();
return false;
}
var tittle=ltrim(document.getElementById('tittle').value,"");
if(document.getElementById('tittle').value!="" && tittle.length==0)
{
alert("Please enter Title");
document.getElementById('tittle').focus();
return false;
}


if(document.getElementById('tags').value=="")
{
alert("Please enter Tags");
document.getElementById('tags').focus();
return false;
}
var tags=ltrim(document.getElementById('tags').value,"");
if(document.getElementById('tags').value!="" && tags.length==0)
{
alert("Please enter Tags");
document.getElementById('tags').focus();
return false;
}

if(document.getElementById('posttext').value=="")
{
alert("Please enter description");
document.getElementById('posttext').focus();
return false;
}
var posttext=ltrim(document.getElementById('posttext').value,"");
if(document.getElementById('posttext').value!="" && posttext.length==0)
{
alert("Please enter description");
document.getElementById('posttext').focus();
return false;
}
if(document.getElementById('assoimage').value!='')
{
var sFileName=document.getElementById('assoimage').value;

var i = sFileName.lastIndexOf(".") ;

if (i == -1 || sFileName.substring(i,sFileName.length).toLowerCase() != ".jpg" && sFileName.substring(i,sFileName.length).toLowerCase() != ".gif" && sFileName.substring(i,sFileName.length).toLowerCase() != ".jpeg"&& sFileName.substring(i,sFileName.length).toLowerCase() != ".png")
{
alert("Please select .jpg or .gif .png image.");
return false;
}
}

else
return true;

}


function add_comment( )
{
//alert("sefg");return false;
document.getElementById("divhide").style.display ="block";

}

function cancel_addcomment()
{

document.getElementById("divhide").style.display ="none";
}
function cancelcomment_func(id)
{
 var  comtext=document.getElementById('t'+id).value ;
document.getElementById('com_'+id).innerHTML=comtext;
document.getElementById('com1_'+id).style.display='';

}



function edit_comment(id)
{
var comment=document.getElementById('com_'+id).innerHTML;


var str="<textarea name='commenttext' id='t"+id+"' rows='5' cols='50'>"+comment+"</textarea><br><br><input type='submit' name='editcomment' value='Update' onclick='editcomment_func("+id+")'><input type='submit' name='Cancelcomment' value='Cancel' onclick='cancelcomment_func("+id+")'>";
// var str='<textarea name="commenttext" id="t'+id>'+comment+'</textarea><br><input type=\'submit\' name=\'editcomment\' value=\'Edit Comment\' onclick=\'editcomment_func(+id+)\' >';

document.getElementById('com_'+id).innerHTML=str;
document.getElementById('com1_'+id).style.display='none';
//alert(document.getElementById('t'+id).value);
}


function editcomment_func(id)
{
var http = getHTTPObject(); // We create the HTTP Object  

function getHTTPObject() {
  var xmlhttp;

  if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  else if (window.ActiveXObject){
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    if (!xmlhttp){
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
   
}
  return xmlhttp;

 
}


var commentid=id;



 var  comtext=document.getElementById('t'+id).value ;


var url="showaddcomment.php?cid="+commentid+"&comtext="+comtext;
//alert(url);
http.open("GET", url, true);
	http.onreadystatechange = function(){ 
		if (http.readyState == 4) {
			if(http.status==200) {
				var results=http.responseText;
				

document.getElementById('com_'+commentid).innerHTML=comtext;
document.getElementById('com1_'+commentid).style.display='';

				
// 		alert(http.responseText);
			/*document.getElementById('AutoNumber1').value = results;
			document.getElementById('te'+id).style.display='none';
			*/
			}
         	}
	}


            http.send(null);


}


function valid_commform( )
{
var commenttext1=ltrim(document.getElementById('commenttext').value,"");
var lenghtcomment=commenttext1.length;
if(document.getElementById('commenttext').value==""||lenghtcomment==0)
{
alert("Please enter Comment.");
document.getElementById('commenttext').focus();
return false
}
else
return true;

}


function select_flag(id)
{
if(document.getElementById(id).checked==true)
 {
var pid=document.getElementById(id).value;
var flag = 1;
  }
  else{
  var pid=document.getElementById(id).value;
	var flag = 0;
  }

var http = getHTTPObject(); // We create the HTTP Object  

function getHTTPObject() {
  var xmlhttp;

  if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  else if (window.ActiveXObject){
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    if (!xmlhttp){
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
   
}
  return xmlhttp;
}
var url="showpost.php?postid="+pid+"&flag="+flag;
//alert(url);
http.open("GET", url, true);
	http.onreadystatechange = function(){ 
		if (http.readyState == 4) {
			if(http.status==200) {
				var results=http.responseText;
				


//	alert(http.responseText);
			/*document.getElementById('AutoNumber1').value = results;
			document.getElementById('te'+id).style.display='none';
			*/
			}
         	}
	}


            http.send(null);

}


  
	function searchUser(id)
	{
		var user = $F('user_name');

		if(user!="")
		{
			if(ValidateForm1(document.getElementById('user_name')))
			{
				var url = 'checkuser.php';
				var pars = 'user='+user+'&id='+id;
				var myAjax = new Ajax.Request(
					url, 
					{
						method: 'get', 
						parameters: pars, 
						onComplete: showResponse
					});

			}
			else
			{
			}
		}
	}
	function showResponse(originalRequest)
	{
		
		if(originalRequest.responseText==1)
		{
			$('user_name').value='';
			$('user_error').innerHTML='<font color=\'red\'>User name already exist</font>';
		}
		else
		{
			$('user_error').innerHTML='';

		}


	}



	function set_user(id)
	{
		
		if(id!="")
		{
			var url = 'setuser.php';
			var pars = 'id='+id;
			var myAjax = new Ajax.Request(
				url, 
				{
					method: 'get', 
					parameters: pars, 
					onComplete: setResponse
				});

		}
	}
	function setResponse(originalRequest)
	{
		
		if(originalRequest.responseText!=0)
		{
			//$('user_name').value='';
			$('user').innerHTML=originalRequest.responseText;
		}
		else
		{
			//$('user_error').innerHTML='';

		}

	}





function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

	 function isNumeric(val){
		
		var re = /(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;
		var st = (!val.match(re))?false:true;
		return st;
	}

	 function isEmpty(str){
			alert(str);
		if(str == undefined || str == '') {return true};
			
		var str=str.trim();
		
		if ((str == null || str.length==0|| str == '')) return true;
		else		
		return false;

	}

	function validateme()
	{
		
		var uval=ltrim(document.getElementById('user_name').value,"");
		var fval=ltrim(document.getElementById('first_name').value,"");
		var lval=ltrim(document.getElementById('last_name').value,"");
		var pass=ltrim(document.getElementById('password').value,"");
		var add=ltrim(document.getElementById('address').value,"");
		if((document.getElementById('user_name').value=="")||(uval.length==0))
		{
			alert("Please enter  User name");
			document.getElementById('user_name').focus();
			return false;
		}
		if((document.getElementById('user_name').value!="")&&(uval.length<2))
		{
			alert("User name must be of minimum length 4");
			document.getElementById('user_name').focus();
			return false;
		}
		if((document.getElementById('first_name').value=="")||(fval.length==0))
		{
			alert("Please enter  first name");
			document.getElementById('first_name').focus();
			return false;
		}
		if(!isNaN(document.getElementById('first_name').value))
		{
			alert("Enter Valid First Name \n");	
			document.getElementById('first_name').focus();
			return false;
		}
		if((document.getElementById('last_name').value=="")||(lval.length==0))
		{
			alert("Enter  Last name");
			document.getElementById('last_name').focus();
			return false;
		}
		if(!isNaN(document.getElementById('last_name').value))
		{
			alert("Enter Valid Last Name \n");	
			document.getElementById('last_name').focus();
			return false;
		}
		if(document.getElementById('phone').value=="")
		{
			alert("Enter  phone number")
			document.getElementById('phone').focus();
			return false;
		}
		if(!isNumeric(document.getElementById('phone').value))
		{
			alert("Enter valid phone number");
			document.getElementById('phone').focus();
			return false;
		}
		
		if (document.edit.email.value=="")
		{
			alert("Enter Email \n");
			document.edit.email.focus();	
			return false;
		}
		if (document.edit.email.value!="")
		{
			check = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+[.][a-zA-Z]+[a-zA-Z.]*$/.test(document.edit.email.value);
			if (!check) 
			{
	
				alert("Please enter a valid email address. \n");
				document.edit.email.focus();
				return false;
			}
	
		}

		if((document.getElementById('password').value=="")||(pass.length==0))
		{
			alert("Please enter  password")
			document.getElementById('password').focus();
			return false;
		}
		if (document.getElementById('password').value!=""&& 		document.getElementById('password').value.length<4)
		{
			alert("password must be of minimum length 4 ");	
			document.getElementById('password').focus();
			return false;
	
		}
		
		if((document.getElementById('address').value=="")||(add.length==0))
		{
			alert("Enter  address");
			document.getElementById('address').focus();
			return false;
		}
		if(document.getElementById('component_select').value=="")
		{
			alert("Please select intern parent");
			document.getElementById('component_select').focus();
			return false;
		}

	}
function validateother()
	{
		
		var uval=ltrim(document.getElementById('user_name').value,"");
		var fval=ltrim(document.getElementById('first_name').value,"");
		var lval=ltrim(document.getElementById('last_name').value,"");
		var pass=ltrim(document.getElementById('password').value,"");
		var add=ltrim(document.getElementById('address').value,"");


		if((document.getElementById('user_name').value=="")||(uval.length==0))
		{
			alert("Please enter User name");
			document.getElementById('user_name').focus();
			return false
		}
	
		if((document.getElementById('first_name').value=="")||(fval.length==0))
		{
			alert("Please enter first name");
			document.getElementById('first_name').focus();
			return false
		}
	

		if(!isNaN(document.getElementById('first_name').value))
		{
			alert("Please Enter Valid First Name \n");	
			document.getElementById('first_name').focus();

			return false

			
		}
		if((document.getElementById('last_name').value=="")||(lval.length==0))
		{
			alert("Please enter Last name");
			document.getElementById('last_name').focus();
			return false
		}
		if(!isNaN(document.getElementById('last_name').value))
		{
			alert("Please Enter Valid Last Name \n");	
			document.getElementById('last_name').focus();
			return false

		}
			if(document.getElementById('phone').value=="")
		{
			alert("Please enter phone number");
			document.getElementById('phone').focus();
			return false
		}
			if(!isNumeric(document.getElementById('phone').value))
		{
			alert("Please enter valid phone number");
			document.getElementById('phone').focus();
			return false
		}
		

		if (document.edit.email.value=="")
		{
			alert("Please Enter Email \n");	
			document.edit.email.focus();
			return false;
		}
		if (document.edit.email.value!="")
		{
			check = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+[.][a-zA-Z]+[a-zA-Z.]*$/.test(document.edit.email.value);
			if (!check) 
			{
	
				alert("Please provide a valid email address. \n");
				document.edit.email.focus();
				return false
			}
	
		}

	

	if((document.getElementById('password').value=="")||(pass.length==0))
	{
		alert("Please enter password")
		document.getElementById('password').focus();
		return false;
	}
	if (document.getElementById('password').value!=""&& document.getElementById('password').value.length<4)
	{
		alert("password must be of minimum length 4 ");	
		document.getElementById('password').focus();
		return false;

	}
		if((document.getElementById('address').value=="")||(add.length==0))
		{
		alert("Please enter address")
		document.getElementById('address').focus();
		return false;
		}
		
}

	function validateannoucement()
	{
		
		var title1=ltrim(document.getElementById('title').value,"");
		var message1=ltrim(document.getElementById('message').value,"");
		if((document.getElementById('title').value=="")||(title1.length==0))
		{
			alert("Please enter Title");
			document.getElementById('title').focus();
			return false;
		}
		var eventDate =ltrim(document.getElementById('date').value,"");
		if((document.getElementById('date').value=="")||(eventDate.length==0))
		{
			alert("Please enter Date.");
			document.getElementById('date').focus();
			return false;
		}
		var eventDate=document.getElementById('date').value;
		var eventDateNew =new Date(eventDate);
		var today = new Date();
		var newDate=today.format("m/dd/yyyy");
		var todayNew=new Date(newDate);
		if (eventDateNew < todayNew)
		{
			alert("Date must be greater than Today's date. ");
			document.getElementById('date').focus();
			return false;
		}
		
		var timepicker12 =ltrim(document.getElementById('timepicker12').value,"");
		if((document.getElementById('timepicker12').value=="")||(timepicker12.length==0))
		{
			alert("Please enter Time.");
			document.getElementById('timepicker12').focus();
			return false;
		}
		if((document.getElementById('message').value=="")||(message1.length==0))
		{
			alert("Please enter message");
			document.getElementById('message').focus();
			return false;
		}
		if(document.getElementById('user').value=="")
		{
			alert("Please select users");
			document.getElementById('user').focus();
			return false;
		}

	}

	function replyValidate()
	{

		var message1=ltrim(document.getElementById('message').value,"");
		if((document.getElementById('message').value=="")||(message1.length==0))
		{
			alert("Please enter message");
			document.getElementById('message').focus();
			return false;
		}


	}





























