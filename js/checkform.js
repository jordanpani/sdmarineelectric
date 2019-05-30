function formCheck(formobj){
	// dialog message
	var alertMsg = "Please complete the following fields:                 \n";
	var alertErr = "\nAnd correct the following errors:                 \n";
	
	var l_Msg = alertMsg.length;
	var l_Err = alertErr.length;
	
	var cVal = '';
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i][0]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].value == fieldRequired[i][2]){
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
			case "radio":
				if (fieldRequired[i][2]==0){
					if(obj.checked == false){
						alertMsg += " - " + fieldRequired[i][1] + "\n";
						if(selFld == '')
							selFld = fieldRequired[i][0];
					}
				}
				break;
			case "password":
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

		if(fieldRequired[i][3]=='1'){
			if(cVal ==	 '') {
				cMsg = fieldRequired[i][1];
				cVal = obj.value;
			} else {
				if(cVal != obj.value)
					alertErr += " - " + fieldRequired[i][1] + " must be the same as " + cMsg +"\n";
			}
		}

	}

	if (alertMsg.length == l_Msg){
//		alert(frm.mailform_from.value);
		return true;
	}else{

		if(alertErr.length != l_Err)
			alertMsg += alertErr;
		alert(alertMsg);

if(document.all||document.getElementById){

	for (i=0;i<document.forms.length;i++){
		for (j=0;j<document.forms[i].elements.length;j++){
			var tempobj=document.forms[i].elements[j];
			if(tempobj.type.toLowerCase()=="submit" || tempobj.type.toLowerCase()=="reset" || tempobj.type.toLowerCase()=="button")
				tempobj.disabled=false;
		}
	}
}
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
	case "G":
		if(val.length==6)
			 return true;
		break;
	default:
		return true;
		break;
	}
}
