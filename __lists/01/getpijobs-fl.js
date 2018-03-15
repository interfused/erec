/*
JOB SCRAPER

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
var jobIDX=0;
var maxPages = 5;



//basic search string http://www.cii2.org/index.php%3Foption=com_community&view=search&task=usersearch&uuId=5a57ae0991d93&templateId=338&params[servId]=1601&params[option]=com_community&params[view]=search&params[task]=usersearch&params[value366719]=&params[value366721]=&params[value366724]=&params[value366758]=&params[value366730]=United+States&params[value366727]=&params[value366728]=&params[parameterType366729]=1&params[value366729]=&params[radius366729]=25&params[operator366729]=6&params[templateId]=338&params[Itemid]=&limitstart=140 


//var scrapeURL = 'http://www.cii2.org/index.php?option=com_mccustomsearch&view=search&customSearchTemplateId=338';
//IF SEARCH FORM, MUST BE URL OF SEARCH RESULTS
var scrapeURL = 'https://www.getprivateinvestigatorjobs.com/Florida.html';
var formData = {
  value366730: "United States",
  radius366729: "25",
  templateId: "38"
};

function isTextNode(){
 // If this is a text node, return true.
 return( this.nodeType === 3 );
}

for (i=1;i<=maxPages;i++){
  let tmpLink = 'https://www.getprivateinvestigatorjobs.com/Florida-p'+i;
  console.log('//////////////////// RIP THIS URL: ' + tmpLink);

/*
request(scrapeURL, function (error, response, body) {
  console.log('error:', error); // Print the error if one occurred
  console.log('statusCode:', response && response.statusCode); // Print the response status code if a response was received
  console.log('body:', body); // Print the HTML for the Google homepage.
});
*/


//  let start_index = 20*i;
 // let rip_url = 'http://www.cii2.org/index.php?option=com_community&view=search&task=usersearch&uuId=5a5900f90620d&templateId=338&params[servId]=1601&params[option]=com_community&params[view]=search&params[task]=usersearch&params[value366719]=&params[value366721]=&params[value366724]=&params[value366758]=&params[value366730]=United+States&params[value366727]=&params[value366728]=&params[parameterType366729]=1&params[value366729]=&params[radius366729]=25&params[operator366729]=6&params[templateId]=338&params[Itemid]=&limitstart='+start_index;
  //console.log('rip page : '+rip_url);

  request.get({url:tmpLink, formData: formData}, function optionalCallback(err, httpResponse, body) {
    if (err) {
      return console.error('failed:', err);
    }
 // console.log('successful!  Server responded with:', body);
 $ = cheerio.load(body);

 let cnt = $('ol.searchResults li:not(.googlePub)').length;
 console.log('body loaded successfully with cnt: ' + cnt);
//console.log( $.html() );

var jobs_obj = {};
var jobs_arr=[];
jobs_obj.jobs_arr=jobs_arr;


$('ol.searchResults li:not(.googlePub)').each(function(index, el) {

  
//  var detailTextNodes = $(this).contents().filter( isTextNode );

let detail_link =  $(this).find('.jobTitle a').attr('href') ;
if(!detail_link.includes('http') ){
  detail_link = 'https://www.getprivateinvestigatorjobs.com' + detail_link;
}



//send secodary request for detail link
console.log('link: '+detail_link);



request.get({url:detail_link, formData: formData}, function optionalCallback(err, httpResponse, body2) {
  if (err) {
    return console.error('failed:', err);
  }
  jobIDX++;
  $ = cheerio.load(body2);
//    console.log('successful!  Server responded with secondary body:', body2);

let job = {};
  job.list_source = 'Get Private Investigator Jobs';
job.detail_link = detail_link;
/*
  job.detail_link =  $(this).find('.jobTitle a').attr('href') ;
  if(!job.detail_link.includes('http') ){
  job.detail_link = 'https://www.getprivateinvestigatorjobs.com' + job.detail_link;
}
*/

let location = trim ( $('.noTopSpace ul li').eq(2).text() );
let location_arr = location.split(',');
if(location_arr.length > 1){
  job.city = trim( location_arr[0] );
job.state = trim(location_arr[1]);
}

  

job.job_title = $('h1.jobTitle').text();

job.company = trim ( $('.noTopSpace ul li').eq(0).text() );
job.posted_on = $('.noTopSpace ul li').eq(1).text();
job.zip = trim( $('.noTopSpace ul li').eq(3).text());
job.salary = trim($('.noTopSpace ul li').eq(4).text());
job.job_type = trim ($('.noTopSpace ul li').eq(5).text() );
job.description = trim ($('.jobDescription').text() );

jobs_obj.jobs_arr.push(job);

console.log('//------- CONTACT DETAIL: '+jobIDX+' ---------//');
console.log('title: '+job.job_title);
console.log('city: '+job.city);
console.log('state: '+job.state);
console.log('zip: '+job.zip);
console.log('company: '+job.company);
console.log('salary: ' + job.salary);
console.log('job type: ' + job.job_type);
console.log('description: ' + job.description);

    //send post for saving
     //POST TO SAVE URL
  axios.post('http://eyerecruit.com/__lists/save-job.php', job)
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
//end secondary request
/*
  var brExp = /<br\s*\/?>/i;
  var lines = ( $(this).html() ).split('<br>');
/*
  if(lines.length > 1){
    job.fullname = lines[1];
  }
  */

  //job.fullname = trim( $(this).text() );
  //job.fullname = detailTextNodes[0].nodeValue;
  
  

/*
  let namesplit = job.fullname.split(' ');

  job.salutation = namesplit[0];
  job.first_name = namesplit[1];
  job.middle_name = namesplit[2];
  job.last_name = namesplit[3];
  if(namesplit.length > 4){
    job.name_suffix = namesplit[4];  
  }
  
  job.email = trim( $(this).find('a').eq(0).text() );
  job.website = trim( $(this).find('a').eq(1).text() );
  job.misc_data = trim( $(this).text() );
  
/*
  job.company = trim( $(this).find('.searchTemplateRow15').text() );
  
  let tmpStr =  $(this).find('.searchTemplateRow21').text();
  job.contact_title = trim( tmpStr.split("Title").pop() );
  
  tmpStr =  $(this).find('.searchTemplateRow19').text();

  job.city = trim( tmpStr.split("Closest Major City").pop() );
  //job.state = '';
  tmpStr = $(this).find('.searchTemplateRow16').text();
  job.country = trim( tmpStr.split("Country").pop() );
  //job.zip = '';

  job.email = trim( $(this).find('.searchTemplateRow18 a').text() );
  job.phone = trim( $(this).find('.searchTemplateRow12').text() );
  //job.fax = '';
  
  */
  

    //console.dir(contact);
    
//    console.dir(detailTextNodes);
  /*
    console.log('email: '+job.email);
    console.log('web: '+job.website);
    console.log('misc: '+job.misc_data);
/*
    console.log('salutation: '+job.salutation);
    console.log('middle: '+job.middle_name);
    console.log('suffix: '+job.name_suffix);
    console.log('city: '+job.city);
    
    
    /*
    console.log('email: '+job.email);
    */

  });//END EACH

  /*
  
  //POST TO SAVE URL
  axios.post('http://eyerecruit.com/__lists/save.php', jobs_obj)
  .then(function (response) {
    console.log('successfully save');
    console.log(response);
  })
  .catch(function (error) {
    console.log('wtf');
    console.log(error);
  });

*/
  //end post
});


}


