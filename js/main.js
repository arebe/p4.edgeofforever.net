/** Global variables **/
var first_name_check = false;
var last_name_check = false;
var email_check = false;
var password_check = false;

/** v_users_signup **/
// first name input validation
$('input[name=first_name]').focusout(function(){
	var first_name = $(this).val();
	// check if first name is 1 - 30 chars
	first_name_check = check_name(first_name);
	$('#first_name_error').css('display', first_name_check ? 'none' : 'block');
});

// last name input validation
$('input[name=last_name]').focusout(function(){
	var last_name = $(this).val();
	// check if last name is 1 - 30 chars
	last_name_check = check_name(last_name);
	$('#last_name_error').css('display', last_name_check ? 'none' : 'block');
});

// email validation
$('input[name=email]').focusout(function(){
	var email = $(this).val();
	// check if this is a valid email address
	email_check = validateEmail(email);
	$('#email_error').css('display', email_check ? 'none' : 'block');	
});

// password validation
$('input[name=password]').focusout(function(){
	var password = $(this).val();
	// check if this is a valid password, min 5 chars
	password_check = validatePassword(password);
	$('#password_error').css('display', password_check ? 'none' : 'block');
});

// display submit button if all fields check out ok
$('#submit_button').css('display', first_name_check && last_name_check && email_check && password_check ? 'none' : 'block');


function check_name(name){
	if (name.length > 0 && name.length <= 30){
		return true;
	}
}

/* borrowed from : 
http://stackoverflow.com/questions/46155/validate-email-address-in-javascript */
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function validatePassword(password) { 
	// check for at least 5 char, no spaces
    var re = /^\S{5,}$/;
    return re.test(password);
} 