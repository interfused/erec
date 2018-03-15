/*
RESOURCE: Followed https://blog.miguelgrinberg.com/post/easy-web-scraping-with-nodejs
https://www.npmjs.com/package/trim
*/

// https://www.npmjs.com/package/request for details regarding methods for Requests
var request = require('request');
var cheerio = require('cheerio');
const trim = require('trim');
var axios = require('axios');
var console = require('better-console');

var results_per_page = 20;
var contactID=0;



var last_link = 'http://www.cii2.org/index.php%3Foption=com_community&view=search&task=usersearch&uuId=5a57ae0991d93&templateId=338&params[servId]=1601&params[option]=com_community&params[view]=search&params[task]=usersearch&params[value366719]=&params[value366721]=&params[value366724]=&params[value366758]=&params[value366730]=United+States&params[value366727]=&params[value366728]=&params[parameterType366729]=1&params[value366729]=&params[radius366729]=25&params[operator366729]=6&params[templateId]=338&params[Itemid]=&limitstart=140';
//basic search string http://www.cii2.org/index.php%3Foption=com_community&view=search&task=usersearch&uuId=5a57ae0991d93&templateId=338&params[servId]=1601&params[option]=com_community&params[view]=search&params[task]=usersearch&params[value366719]=&params[value366721]=&params[value366724]=&params[value366758]=&params[value366730]=United+States&params[value366727]=&params[value366728]=&params[parameterType366729]=1&params[value366729]=&params[radius366729]=25&params[operator366729]=6&params[templateId]=338&params[Itemid]=&limitstart=140 


//var scrapeURL = 'http://www.cii2.org/index.php?option=com_mccustomsearch&view=search&customSearchTemplateId=338';
//IF SEARCH FORM, MUST BE URL OF SEARCH RESULTS
var scrapeURL = 'http://www.cii2.org/index.php?option=com_community&view=search&task=usersearch';
var formData = {
  value366730: "United States",
  radius366729: "25",
  templateId: "38"
};

function isTextNode(){
 // If this is a text node, return true.
 return( this.nodeType === 3 );
}


/*
request(scrapeURL, function (error, response, body) {
  console.log('error:', error); // Print the error if one occurred
  console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
  console.log('body:', body); // Print the HTML for the Google homepage.
});
*/

for (let i=0; i<= (140/results_per_page); i++ ){

  let start_index = 20*i;
  let rip_url = 'http://www.cii2.org/index.php?option=com_community&view=search&task=usersearch&uuId=5a5900f90620d&templateId=338&params[servId]=1601&params[option]=com_community&params[view]=search&params[task]=usersearch&params[value366719]=&params[value366721]=&params[value366724]=&params[value366758]=&params[value366730]=United+States&params[value366727]=&params[value366728]=&params[parameterType366729]=1&params[value366729]=&params[radius366729]=25&params[operator366729]=6&params[templateId]=338&params[Itemid]=&limitstart='+start_index;
  //console.log('rip page : '+rip_url);

  request.post({url:rip_url, formData: formData}, function optionalCallback(err, httpResponse, body) {
    if (err) {
      return console.error('failed:', err);
    }
 // console.log('successful!  Server responded with:', body);
 $ = cheerio.load(body);

 let cnt = $('.mini-profile').length;
 console.log('body loaded successfully with cnt: ' + cnt);
//console.log( $.html() );

var contacts_obj = {};
var contacts_arr=[];
contacts_obj.contacts_arr=contacts_arr;


$('.mini-profile').each(function(index, el) {
  contactID++;
  let contact = {};
  contact.list_source = 'Council of International Investigators';
  contact.fullname = trim( $(this).find('.searchTemplateRow1').text() );

  let namesplit = contact.fullname.split(' ');

  contact.salutation = namesplit[0];
  contact.first_name = namesplit[1];
  contact.middle_name = namesplit[2];
  contact.last_name = namesplit[3];
  if(namesplit.length > 4){
    contact.name_suffix = namesplit[4];  
  }
  

  contact.company = trim( $(this).find('.searchTemplateRow15').text() );
  
  let tmpStr =  $(this).find('.searchTemplateRow21').text();
  contact.contact_title = trim( tmpStr.split("Title").pop() );
  
  tmpStr =  $(this).find('.searchTemplateRow19').text();

  contact.city = trim( tmpStr.split("Closest Major City").pop() );
  //contact.state = '';
  tmpStr = $(this).find('.searchTemplateRow16').text();
  contact.country = trim( tmpStr.split("Country").pop() );
  //contact.zip = '';

  contact.email = trim( $(this).find('.searchTemplateRow18 a').text() );
  contact.phone = trim( $(this).find('.searchTemplateRow12').text() );
  //contact.fax = '';
  contact.website = trim( $(this).find('.searchTemplateRow13 a').text() );
  contact.detail_link = 'http://www.cii2.org'+$(this).find('h3.name a').attr('href') ;

  contacts_obj.contacts_arr.push(contact);
/*
  console.log('//------- CONTACT DETAIL: '+contactID+' ---------//');
    //console.dir(contact);
    console.log('name: '+contact.full_name);
    console.log('salutation: '+contact.salutation);
    console.log('middle: '+contact.middle_name);
    console.log('suffix: '+contact.name_suffix);
    console.log('title: '+contact.contact_title);
    console.log('city: '+contact.city);
    
    console.log('link: '+contact.detail_link);

    /*
    console.log('email: '+contact.email);
    */

  });//END EACH
  
  
  //POST TO SAVE URL
  axios.post('http://eyerecruit.com/__lists/save.php', contacts_obj)
  .then(function (response) {
    console.log('successfully save');
    console.log(response);
  })
  .catch(function (error) {
    console.log('wtf');
    console.log(error);
  });


  //end post
});

}

