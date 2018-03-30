/* THIS ONE WORKS */
var Nightmare = require('nightmare');                                                                                                                                                                      
var vo = require('vo');
const jquery = require('jquery');                                                                                                                                                                                
var axios = require('axios');
var states_list = ["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District of Columbia","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"];

//var scrapeURL = 'http://nalionline.org/business-directory/?action=search&dosrch=1&q&listingfields%5B1%5D&listingfields%5B14%5D&listingfields%5B15%5D&listingfields%5B17%5D=-1&listingfields%5B11%5D&listingfields%5B12%5D=Florida&listingfields%5B13%5D';
var scrapeURL = 'http://nalionline.org/business-directory/?action=search';
vo(run)(function(err, result) {                                                                                                                                                                            
    if (err) throw err;                                                                                                                                                                                    
});                                                                                                                                                                                                        

function* run() {                                                                                                                                                                                          
    var nightmare = Nightmare({show:true}),                                                                                                                                                                           
    MAX_PAGE = 10,                                                                                                                                                                                     
    currentPage = 0,                                                                                                                                                                                   
    nextExists = true,                                                                                                                                                                                 
    links = [];
    var contacts_obj = {};
    contacts_obj.contacts_arr = [];

    yield nightmare                                                                                                                                                                                        
    .goto(scrapeURL)
    .select('#wpbdp-field-12',states_list[7])
    .click('#wpbdp-search-form input[type=submit]')
    .wait(4000)
    .inject('js', 'node_modules/jquery/dist/jquery.js')                                                                                                                                                                     
    .wait(1000)
    .wait('.search-results')
    .wait(250)                                                                                                                                                                                      

    nextExists = yield nightmare.visible('.wpbdp-pagination .next a');

    while (nextExists && currentPage < MAX_PAGE) {
        links.push(yield nightmare
            .evaluate(function() {
            //var links = document.querySelectorAll(".wpbdp-field-company a");
            //console.log(links[0].href);
            //return links[0].href;

            var links = [];

            jQuery('.wpbdp-listing ').each(function(index,el){
                //links.push ( jQuery(this).attr('href') );
                //
                let contact = {};
                contact.list_source = 'National Association of Legal Investigators';
                contact.first_name = jQuery(this).find('.wpbdp-field-firstname .value').text();
                contact.last_name = jQuery(this).find('.wpbdp-field-lastname .value').text();

                contact.email = jQuery(this).find('.wpbdp-field-e-mailaddress .value').text();

                contact.company = jQuery(this).find('.wpbdp-field-company a').text();

                contact.address1 = jQuery(this).find('.wpbdp-field-address .value').text();
                contact.city = jQuery(this).find('.wpbdp-field-city .value').text();
                contact.state = jQuery(this).find('.wpbdp-field-stateprovince .value').text();
                contact.zip = jQuery(this).find('.wpbdp-field-zippostalcode .value').text();

                contact.phone = jQuery(this).find('.wpbdp-field-phone .value').text();
                contact.fax = jQuery(this).find('.wpbdp-field-fax .value').text();

                contact.website = jQuery(this).find('.wpbdp-field-website .value a').attr('href');
                links.push(contact);
                //
            });
return links;
}));

yield nightmare
.click('.wpbdp-pagination .next a')
.wait('body')

currentPage++;
nextExists = yield nightmare.visible('.wpbdp-pagination .next a');
}

//console.dir(links);
//console.log('links len: ' +links.length);

for(let i=0;i<links.length;i++){
    
    for(let j=0; j< links[i].length; j++){
        contacts_obj.contacts_arr.push(links[i][j] );
    }
}
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
  
yield nightmare.end();                                                                                                                                                                                

}  