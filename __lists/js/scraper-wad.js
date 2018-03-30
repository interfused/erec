/*
MAKE SURE JQUERY IS INSTALLED IN HEAD
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>

ADD THIS SCRIPT TO THE BOTTOM BODY
<script type="text/javascript" src="js/scraper-wad.js"></script>
*/
function isTextNode(){
 // If this is a text node, return true.
 return( this.nodeType === 3 );
}

$(document).ready(function(){
  var contacts_obj = {};
  var contacts_arr=[];
  contacts_obj.contacts_arr=contacts_arr;

  profileCnt = $('.mini-profile').length;

  $('.mini-profile').each(function(index, el) {
  ///selector for name
  var contact = {};

  contact.list_source = 'World Association of Detectives';
  contact.full_name =  $.trim( $(this).find('h3.name strong div').text() );
  
  namesplit = contact.full_name.split(' ');

  contact.first_name = namesplit[0];
  contact.last_name = namesplit[1];
  //manually enter  Mark McCabe (FL), Allen Cardoza (CA), Scott Filley (CA), Joel Michel, Barry Silvers
  if(contact.full_name == 'Barry Silvers'){
    return true;
  }
  
  contact.company = $.trim( $(this).find('.searchTemplateLeft .searchTemplateRow5').text());

  contact.address1 = $.trim( $(this).find('.searchTemplateLeft .searchTemplateRow33').text());
  contact.address2 = $.trim( $(this).find('.searchTemplateLeft .searchTemplateRow12').text());

  contact.city = $.trim( $(this).find('.searchTemplateRow17').text());
  contact.state = $.trim( $(this).find('.searchTemplateRow18').text());
  contact.country = $.trim( $(this).find('.searchTemplateRow19').text());
  contact.zip = $.trim( $(this).find('.searchTemplateRow28').text());


  contact.email = $.trim( $(this).find('.searchTemplateRow6 a').eq(0).text());
  
  //WAD is using text nodes (annoying) so we need to grab text nodes
  
  var phoneTextNodes = $(this).find('.searchTemplateRow6').contents()
  .filter( isTextNode )
  ;
  
/*
  console.log('//// TEL /////');
  console.dir(phoneTextNodes);
  console.log('////////////');
*/

  contact.phone = phoneTextNodes[3].nodeValue ;
  contact.fax = phoneTextNodes[5].nodeValue ;

  contact.website = $(this).find('.searchTemplateRow6 a').eq(1).text();

  contacts_obj.contacts_arr.push(contact);

  
  var str = '<li>';
  str += 'first name: '+contact.first_name;
  str += '<br>last name: '+contact.last_name;
  str += '<br>company: '+contact.company;
  str += '<br>address: '+contact.address1+"<br>"+contact.address2;
  str += '<br>'+contact.city+','+contact.state +' '+contact.zip;
  str += '<br>'+contact.country;
  str += '<br><strong>email:</strong>'+contact.email;
  str += '<br><strong>tel:</strong>'+contact.phone;
  str += '<br><strong>fax:</strong>'+contact.fax;
  str += '<br><strong>website:</strong>'+contact.website;
  str += '</li>';

  $("#export_list").append(str);

});

//alert('loaded: '+profileCnt);
//console.log('contacts_arr');

//console.dir(contacts_arr);
//push to server
$.ajax({
  url: 'save.php',
  type: 'POST',
  data: JSON.stringify(contacts_obj),
})
.done(function(data) {
  console.log("success: ");
  console.dir(data);
})
.fail(function(data) {
  console.log("error: ");
  console.dir(data);
})
.always(function() {
  console.log("complete");
});


});