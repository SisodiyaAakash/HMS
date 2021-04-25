//Anni and Shubham this is for your understanding about regEx
// ^   -> start of string
// $   -> end of string. 
// \s  -> use for space character

//anchors
    // + -> one or more 
    // * -> zero or more
console.log("Hello");
//Validate alphabets only
var alphaExp = /^[a-zA-Z]+$/;

//Validate alphabets and space only
var alphaspaceExp = /^[a-zA-Z\s]+$/; 

//Validate Username
var usernameExp = /^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/;

//Validate numbers only
// I can also use "\d" for this alphanumericExp and "\D" to avoid numericExp
var numericExp = /^[0-9]+$/; 

//Validate Alphabets and number only
// I can also use "\w" for this alphanumericExp and "\W" to avoid alphanumericExp
var alphanumericExp = /^[0-9a-zA-Z]+$/; 

//Validate Alphabets, space and number only
var alphanumericspaceExp = /^[0-9a-zA-Z\s]+$/; 

//Basic formation of email
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;