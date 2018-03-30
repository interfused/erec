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

if(jquery){
  console.log('defined');
}else{
  console.log('not defined');
}

var results_per_page = 20;
var contactID=0;

//set to false to post
var debugging = false;


//IF SEARCH FORM, MUST BE URL OF SEARCH RESULTS
var scrapeURL = 'https://pihub.org/directory.php/United-States-of-America/Florida/';
//FORM DATA NECCESSARY IF POST REQUIRED
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
.evaluate(
  function(){
      //THE FOLLOWING HAS DETAIL LINK PAGES AND THEREFORE EACH LINK NEEDS TO BE SCRAPED
      //using `Array.from` as the DOMList is not an array, but an array-like, sort of like `arguments`
  //planning on using `Array.map()` in a moment
  var detail_links = [];

  $('.listingItem').each(function(index, el) {
    var link_detail = {};
    let tmp = $(this).find('.col1 a').attr('href');
 //       tmp  = tmp.split("\'");
 link_detail.href = tmp;
 detail_links.push (link_detail);

});
  return detail_links;

})
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
        .click( '.listingItem a[href="'+href.href+'"]' )
        .inject('js', 'node_modules/jquery/dist/jquery.js')
        .wait(250)
        .wait('.listingItem')
        .wait(250)
        //get the html
        .evaluate(function(){

          let contact = {};
          
          contact.list_source = 'pihub.org';

          contact.fullname = $.trim( $("#mainBody > div > table.fields > tbody > tr:nth-child(1) > td.f").text() );

          let namesplit = contact.fullname.split(' ');
/*
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
  
  contact.first_name = namesplit[0];
  contact.last_name = namesplit[1];

  contact.company = $('#mainBody tbody  h3').text();
  //contact.contact_title = trim( tmpStr.split("Title").pop() );

  contact.city = $('#mainBody > div > table.fields > tbody > tr:nth-child(6) > td.f').text();
  contact.state = $('#mainBody > div > table.fields > tbody > tr:nth-child(7) > td.f').text();
  //contact.country = 'USA';
  contact.zip = $('#mainBody > div > table.fields > tbody > tr:nth-child(8) > td.f').text();

  contact.phone = ( $('#mainBody > div > table.fields > tbody > tr:nth-child(11) > td.f').text() );
  contact.fax = $('#mainBody > div > table.fields > tbody > tr:nth-child(12) > td.f').text();
  contact.website =  ( $('#mainBody > div > table.fields > tbody > tr:nth-child(14) > td.f > a').text() );
  
  //fake email because they were not provided
  /*
  let domain_only = contact.website.replace("http://", "");
  domain_only = domain_only.replace("www.", "");
  let fakeemail = 'info@' + domain_only;
  fakeemail = fakeemail.replace("/", "");
  contact.email = fakeemail;
  */
  contact.email = $('#mainBody > div > table.fields > tbody > tr:nth-child(13) > td.f > a').text();

  //contact.detail_link = 'http://www.cii2.org'+$(this).find('h3.name a').attr('href') ;
  contact.misc_data = $('#mainBody div.description').text();
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
          .back()
          .wait(1000)
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
  //console.log('contacts_arr');
  //console.dir(contacts_arr);

  let contacts_obj = {};
  //var contacts_arr=[];
  contacts_obj.contacts_arr=contacts_arr;
  
  
  /*
  x(contacts_arr[1], 'body@html') //output listing page html
    .write('results.json');
    */
    if(debugging){
      console.log('contacts obj');
      console.dir(contacts_obj);
    }else{
      console.log('post it');
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

    }


  })


.catch((error) => {
  console.error('Search failed:', error);
});
