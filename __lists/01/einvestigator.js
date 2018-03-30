/*
RESOURCE: Followed https://blog.miguelgrinberg.com/post/easy-web-scraping-with-nodejs
https://www.npmjs.com/package/trim
*/
//this uses nigthmare
//https://hackernoon.com/nightmarishly-good-scraping-with-nightmare-js-and-async-await-b7b20a38438f

//https://stackoverflow.com/questions/38772060/moving-between-pages-and-scraping-as-i-go-with-nightmare

// https://www.npmjs.com/package/request for details regarding methods for Requests
var request = require('request');
var cheerio = require('cheerio');
const trim = require('trim');
var axios = require('axios');
var console = require('better-console');
const Nightmare = require('nightmare');
const nightmare = Nightmare({ show: true });
const jquery = require('jquery');

var results_per_page = 20;
var contactID=0;



//var scrapeURL = 'http://www.cii2.org/index.php?option=com_mccustomsearch&view=search&customSearchTemplateId=338';
//IF SEARCH FORM, MUST BE URL OF SEARCH RESULTS
//NOTE BASE URL https://www.einvestigator.com/florida-private-investigators/ was formatted crappy so we modified with html replacing hrs with divs
var scrapeURL = 'http://eyerecruit.com/__lists/01/ripper/einvestigator-wy.html';
/*
var formData = {
  FunctionalBlock1$ctl00$ctl00$criteriaList$criteriaList$ctl03$ctl05: "1",
  FunctionalBlock1$ctl00$ctl00$criteriaList$criteriaList$ctl03$StringTextBox: "florida",
  templateId: "38"
};
*/
function setFinal(obj){
  console.log('setFinal: ');
  console.dir(obj.value);
}

nightmare
.goto(scrapeURL)
.inject('js', 'node_modules/jquery/dist/jquery.js')
.viewport(1200,500)
.wait(250)
.evaluate(function(){
  var contacts_obj = {};
  contacts_obj.contacts_arr = [];

  $('.er-entry').each(function(index,el){
    let contact = {};

    let details1 = $(this).find('p').eq(0).contents().filter(function() { 
    //Node.TEXT_NODE === 3
    return (this.nodeType === 3);
  });

    contact.list_source = 'eInvestigators.com';
//    #post-2437 > div:nth-child(3) > p:nth-child(2)
    //contact.name = $(this).find('p').eq(0).text();

    contact.fullname = $.trim( $(this).find('p').eq(0).contents().eq(0).text() );
    
    contact.fullname = contact.fullname.replace('Owner - ','');
    contact.fullname = contact.fullname.replace('/',' / ');
    
    let namesplit = contact.fullname.split(' ');
    contact.first_name = namesplit[0];
    contact.last_name = namesplit[1];

/*  
  
  contact.salutation = namesplit[0];
  contact.middle_name = namesplit[2];
  if(namesplit.length > 4){
    contact.name_suffix = namesplit[4];  
  }
  */
  contact.company = $(this).find('h3').eq(0).text();
  //contact.contact_title = trim( tmpStr.split("Title").pop() );

  let one_line_addr = $.trim( $(this).find('p').eq(0).contents().eq(2).text() );

  let addr_partials = one_line_addr.split(",");

  //since everything only one line we split by space and get the last
  let zip_partials = one_line_addr.split(" ");

  contact.address1 = addr_partials[0];
  
  if(addr_partials.length >= 4){
    contact.address2 = addr_partials[1];
  }else{
    if(addr_partials.length >= 3){
      contact.city = addr_partials[1];  
    }
    
  }
  
  contact.zip = zip_partials[zip_partials.length-2];
  //contact.country = 'USA';
  contact.zip = zip_partials[zip_partials.length-1];

  contact.phone = $.trim( $(this).find('p').eq(0).contents().eq(4).text() );
  contact.phone = contact.phone.replace("Telephone - ","");

  contact.fax = $.trim( $(this).find('p').eq(0).contents().eq(6).text() );
  contact.fax = contact.fax.replace("FAX - ","");
  
  contact.website =  $.trim( $(this).find('a').eq(1).attr('href') );
  /*
  //fake email because they were not provided
  let domain_only = contact.website.replace("http://", "");
  domain_only = domain_only.replace("www.", "");
  let fakeemail = 'info@' + domain_only;
  fakeemail = fakeemail.replace("/", "");
  contact.email = fakeemail;
  */
  contact.email =  $.trim( $(this).find('a').eq(0).attr('href') );

  if(!contact.email.includes('@')){
    //they were switched
    let str = contact.email;
    contact.email = contact.website;
    contact.website = str; 
  }
  contact.email = contact.email.replace('mailto:','');
  contact.email = contact.email.replace('mailto: ','');
  //contact.detail_link = 'http://www.cii2.org'+$(this).find('h3.name a').attr('href') ;

  contact.misc_data = $(this).find('p').eq(1).text();
  // require emeail
  if(contact.email){
    contacts_obj.contacts_arr.push(contact);
  }
  
});

return contacts_obj;

})
.end()
.then(function(contacts_obj){
  console.log('end');
  console.dir(contacts_obj);

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
  


})




.catch((error) => {
  console.error('Search failed:', error);
});
