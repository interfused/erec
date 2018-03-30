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
//var scrapeURL = 'http://www.myfapi.org/directory?&tab=2';
var scrapeURL = 'http://www.myfapi.org/directory?&tab=1';
var formData = {
  FunctionalBlock1$ctl00$ctl00$criteriaList$criteriaList$ctl03$ctl05: "1",
  FunctionalBlock1$ctl00$ctl00$criteriaList$criteriaList$ctl03$StringTextBox: "florida",
  templateId: "38"
};



var currencies_obj = {};
var sell_currencies;
var dataTable;
var maxCurrencies = 10;

function setFinal(obj){
  console.log('setFinal: ');
  console.dir(obj.value);
}

nightmare
.goto(scrapeURL)
.viewport(1200,500)
.wait(1000)
.click('#FunctionalBlock1_ctl00_ctl00_criteriaList_criteriaList_ctl03_ctl05')
.wait(1000)
.type('#FunctionalBlock1_ctl00_ctl00_criteriaList_criteriaList_ctl03_StringTextBox', '')
.wait(1000)
.type('#FunctionalBlock1_ctl00_ctl00_criteriaList_criteriaList_ctl03_StringTextBox', 'florida')
.click('#FunctionalBlock1_ctl00_ctl00_actionPanel_startSearchButton')
.wait(4000)
.evaluate(
  function(){
      //THE FOLLOWING HAS DETAIL LINK PAGES AND THEREFORE EACH LINK NEEDS TO BE SCRAPED
      //using `Array.from` as the DOMList is not an array, but an array-like, sort of like `arguments`
  //planning on using `Array.map()` in a moment

      //GRAB DETAILS FROM PAGE
      
      var detail_links = [];

      $('#membersTable tbody tr').each(function(index, el) {
        var link_detail = {};
        let tmp = $(this).attr('onclick');
        tmp  = tmp.split("\'");
        link_detail.href = tmp[1];
        if($(this).attr('bottomrow') != "true" ){
          detail_links.push (link_detail);
        }

      });
      return detail_links;
      
    }

    
    )
  //.end()
  .then(function(hrefs){
  //here, there are two options:
  //  1. you could navigate to each link, get the information you need, then navigate back, or
  //  2. you could navigate straight to each link and get the information you need.
  //I'm going to go with #1 as that's how it was in your original script.

  //here, we're going to use the vanilla JS way of executing a series of promises in a sequence.
  //for every href in hrefs,
  return hrefs.reduce(function(accumulator, href){
    //return the accumulated promise results, followed by...
    return accumulator.then(function(results){
      return nightmare
        //click on the href
        .click( 'tr[onclick="MemberDirectoryListRenderer.redirectToMemberDetails(\''+href.href+'\')"]' )
        .wait(250)
        .wait('.memberDirectoryDetailsContainer')
        //get the html
        .evaluate(function(){
  
    let contact = {};
          
          contact.list_source = 'Florida Association of Private Investigators';
/*  contact.fullname = trim( $(this).find('.searchTemplateRow1').text() );

  let namesplit = contact.fullname.split(' ');

  contact.salutation = namesplit[0];
  contact.middle_name = namesplit[2];
  if(namesplit.length > 4){
    contact.name_suffix = namesplit[4];  
  }
  */
  /*
  console.log('//////////');
  console.log(html);
  */
  
  contact.first_name = $('#idContainer1096116 .fieldBody span').text();
  contact.last_name = $('#idContainer1096117 .fieldBody span').text();

  contact.company = $('#idContainer1096118 .fieldBody span').text();
  //contact.contact_title = trim( tmpStr.split("Title").pop() );

  contact.city = $('#idContainer1096128 .fieldBody span').text();
  contact.state = $('#idContainer1096130 .fieldBody span').text();
  //contact.country = 'USA';
  contact.zip = $('#idContainer1096129 .fieldBody span').text();

  contact.phone = ( $('#idContainer1096121 .fieldBody span').text() );
  //contact.fax = '';
  contact.website =  ( $('#idContainer1096126 .fieldBody span a').text() );
  
  //fake email because they were not provided
  let domain_only = contact.website.replace("http://", "");
  domain_only = domain_only.replace("www.", "");
  let fakeemail = 'info@' + domain_only;
  fakeemail = fakeemail.replace("/", "");
  contact.email = fakeemail;
  
  //contact.detail_link = 'http://www.cii2.org'+$(this).find('h3.name a').attr('href') ;

//  contacts_obj.contacts_arr.push(contact);


//          return document.querySelector('html').innerHTML;
  return contact;

})
        //add the result to the results
        .then(function(contact){


          if(contact.email != 'info@'){
            results.push(contact);
          }
          
          return results;
        })
        .then(function(results){
          //click on the search result link to go back to the search result page
          return nightmare
          .click('#FunctionalBlock1_ctl00_ctl00_hlBackToDirectoryTop')
          .wait('#membersTable')
          .then(function() {
              //make sure the results are returned
              return results;
            });
        })
      });
  }, Promise.resolve([])) //kick off the reduce with a promise that resolves an empty array
})
.then(function (contacts_arr) {
  //if I haven't made a mistake above with the `Array.reduce`, `contacts_arr` should now contain all of your links' results
  console.log('contacts_arr');
  console.dir(contacts_arr);

  let contacts_obj = {};
  //var contacts_arr=[];
  contacts_obj.contacts_arr=contacts_arr;
  
  
  console.log('contacts obj');
  console.dir(contacts_obj);
  /*
  x(contacts_arr[1], 'body@html') //output listing page html
    .write('results.json');
    */
/*
    
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
*/

})


.catch((error) => {
  console.error('Search failed:', error);
});
