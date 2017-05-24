jQuery.fn.start = function(rating,cb) {
    var length = jQuery(this).children().length;
    var children = jQuery(this).children();
    //current index ,0 base
    var current = -1;


    if(typeof(rating) === 'function'){
        cb = rating;
    }else{
        if(rating <1 || rating > length){
            rating = -1;
        }
    }
    //init rating
    current = rating - 1;
    for (var j = 0; j <= current; j++) {
        jQuery(children[j]).removeClass('jr-nomal jr-rating').addClass('jr-rating');
    }
    for (var i = 0; i < length; i++) {

        jQuery(children[i]).bind('click', function(event) {
            current = jQuery(this).index(children[i]);

            for (var j = 0; j <= current; j++) {
                jQuery(children[j]).removeClass('jr-nomal jr-rating').addClass('jr-rating');
            }
            for (var j = current + 1; j < length; j++) {
                jQuery(children[j]).removeClass('jr-nomal jr-rating').addClass('jr-nomal');
            }

            if (typeof(cb) === 'function') {

                cb(current + 1);
            }
        });
    }
}

jQuery.fn.getCurrentRating = function(){
    var length = jQuery(this).children().length;
    var children = jQuery(this).children();
    var resulut = 0;

    for (var i = 0; i < length; i++) {
        if(jQuery(children[i]).hasClass('jr-rating')){
            resulut +=1;
        }else{
            break;
        }
    }
    return resulut;
}