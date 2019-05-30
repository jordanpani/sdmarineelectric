/***********************************************
* Encrypt Email script- Please keep notice intact.
* Tool URL: http://www.dynamicdrive.com/emailriddler/
* **********************************************/

var emailarray= new Array(105,110,98,111,117,110,100,64,115,116,97,110,102,111,114,100,116,114,97,118,101,108,46,99,111,109)
var postemail=''
for (i=0;i<emailarray.length;i++)
postemail+=String.fromCharCode(emailarray[i])

