function formCheck(formobj, varRequired, varFld){

	fieldRequired = varRequired;
	selFld = varFld;

// dialog message
	var alertMsg = "Please complete the following fields:                 \n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i][0]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == fieldRequired[i][2]){
					alertMsg += " - " + fieldRequired[i][1] + "\n";
					if(selFld == '')
						selFld = fieldRequired[i][0];
				}
				break;
			case "select-multiple":
				if (obj.selectedIndex == -1){
					alertMsg += " - " + fieldRequired[i][1] + "\n";
					if(selFld == '')
						selFld = fieldRequired[i][0];
				}
				break;
			case "checkbox":
				if (fieldRequired[i][2]==0){
					if(obj.checked == false){
						alertMsg += " - " + fieldRequired[i][1] + "\n";
						if(selFld == '')
							selFld = fieldRequired[i][0];
					}
				}
				break;
			case "password":
			case "hidden":
			case "text":
			case "textarea":
				if (obj.value == fieldRequired[i][2] || obj.value == null){
					alertMsg += " - " + fieldRequired[i][1] + "\n";
					if(selFld == '')
						selFld = fieldRequired[i][0];
				} else {
					valid = formValid(obj.value, fieldRequired[i][3]) ;	
					if (!valid){
						alertMsg += " - " + fieldRequired[i][1] + " [invalid value]\n";
						if(selFld == '')
							selFld = fieldRequired[i][0];
					}
				}
				break;
			default:
			}
			if (obj.type == undefined){
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++){
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked){
					alertMsg += " - " + fieldRequired[i][1] + "\n";
					if(selFld == '')
						selFld = fieldRequired[i][0];
				}
			}
		}
	}

	if (alertMsg.length == l_Msg){
//		alert(frm.mailform_from.value);
		return true;
	}else{
		alert(alertMsg);

/*
if(document.all||document.getElementById){

	for (i=0;i<document.forms.length;i++){
		for (j=0;j<document.forms[i].elements.length;j++){
			var tempobj=document.forms[i].elements[j];
			if(tempobj.type.toLowerCase()=="submit" || tempobj.type.toLowerCase()=="reset" || tempobj.type.toLowerCase()=="button")
				tempobj.disabled=false;
		}
	}
}
*/
		if(selFld != ''){
//			cEval = 'this.'+selFld+'.select();';	
//			eval(cEval);
		}
		return false;
	}
}


function formValid(val,type){
	switch(type){
	case "E":
		var returnval=emailfilter.test(val);
		return returnval;
		break;
	case "N":
		return !isNaN(val);
		break;
	case "P":
		if(val.length<7)
		     return false
		else {
		     var phoneRE = val.search("[^0-9\-_.]");
                     if(val.value.length > 0 &&  phoneRE >= 0)
                          return false; 
		}
		break;
	case "D":
		if(val.length<1)
		   return false
		else
			return isDate(val);
		break;
	default:
		return true;
		break;
	}
}

function isDate(txtDate) {
    var objDate,  // date object initialized from the txtDate string
        mSeconds, // txtDate in milliseconds
        day,      // day
        month,    // month
        year;     // year
    // date length should be 10 characters (no more no less)
    if (txtDate.length !== 10) {
        return false;
    }
    // third and sixth character should be '/'
    if (txtDate.substring(2, 3) !== '/' || txtDate.substring(5, 6) !== '/') {
        return false;
    }
    // extract month, day and year from the txtDate (expected format is mm/dd/yyyy)
    // subtraction will cast variables to integer implicitly (needed
    // for !== comparing)
    month = txtDate.substring(0, 2) - 1; // because months in JS start from 0
    day = txtDate.substring(3, 5) - 0;
    year = txtDate.substring(6, 10) - 0;
    // test year range
    if (year < 1000 || year > 3000) {
        return false;
    }
    // convert txtDate to milliseconds
    mSeconds = (new Date(year, month, day)).getTime();
    // initialize Date() object from calculated milliseconds
    objDate = new Date();
    objDate.setTime(mSeconds);
    // compare input date and parts from Date() object
    // if difference exists then date isn't valid
    if (objDate.getFullYear() !== year ||
        objDate.getMonth() !== month ||
        objDate.getDate() !== day) {
        return false;
    }
    // otherwise return true
    return true;
}


function submitOnce(){

	if(document.all||document.getElementById){
		for (i=0;i<document.forms.length;i++){
			for (j=0;j<document.forms[i].elements.length;j++){
				var tempobj=document.forms[i].elements[j];
				if(tempobj.type.toLowerCase()=="submit" || tempobj.type.toLowerCase()=="reset" || tempobj.type.toLowerCase()=="button")
					tempobj.disabled=true;
			}
		}
	}
}
