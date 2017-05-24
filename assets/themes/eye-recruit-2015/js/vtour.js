function VTour(pageTourUrl, contextNew)
{
    var tourItems = new Array();
    var pageVTourUrl = pageTourUrl;
    var mobileMode = jQuery(window).width() <= 767;
    var vTour = this;
    var context = contextNew;

    var buildTourItems = function(fields){
        //remove any old fields
        jQuery('#vtour-help-guide-alert').remove();
        jQuery('#vtour-modal').remove();
        // jQuery('.tour-guide-highlight').css({"z-index": '', position: ''});
        jQuery(".tour-guide-highlight").removeClass("tour-guide-highlight");
        jQuery(".popover").removeClass("popover");
        jQuery('[id^="popover-continue-"]').unbind('click');
        //Load the virtual tour help text into memory
        var jQuerytourHtml = undefined;
        jQuery.ajax(
            {
                url: pageVTourUrl,
                type: 'get',
                dataType: 'html',
                async: false,
                cache: false,
                success: function(data)
                {
                    jQuerytourHtml = jQuery(data);
                }
            }
        );
        if(jQuerytourHtml != undefined){
            //iterate over each div in the vtour page
            var itemIndex = 0;
            jQuerytourHtml.each(
                function(){
                    var jQueryitem = jQuery(this);
                    //If the iterating item has the attribute display, add it to the tourItems list
                    if(jQueryitem.attr("display")){
                        //The passed value fields if undefined means add all items, otherwise determine the fields
                        //to add to the tourItems list.
                        var fieldRequired = fields == undefined;
                        if(!fieldRequired){
                            jQuery.each(fields,
                                function(index, value){
                                    if(value == jQueryitem.attr("field")){
                                        fieldRequired = true;
                                        return false;
                                    }
                                }
                            );
                        }
                        if(fieldRequired){
                            tourItems[itemIndex] = {
                                fieldId: jQueryitem.attr("field"),
                                displayType: jQueryitem.attr("display"),
                                placement: jQueryitem.attr("placement"),
                                mobilePlacement: jQueryitem.attr("mobile-placement"),
                                title: jQueryitem.attr("title"),
                                content: jQueryitem.html()
                            };
                            itemIndex ++;
                        }
                    }
                }
            );
        }
    };

    var guideHelpBox = '<div id="vtour-help-guide-alert" class="alert alert-info" style="position:absolute; z-index: 1071;top: .5px;left:35%;text-align: center;"><div><strong>Help Guide</strong><br/>Hover or press over a highlighted area. Press Esc to close.</div></div>';
    var staticModal = '<div id="vtour-modal" class="modal fade"  tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close welcome_close_button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"></div><div class="modal-footer"><div class="text-center"><button type="button" class="step-btn" id="modal-continue"><i class="fa fa-angle-double-left"></i> Close <i class="fa fa-angle-double-right"></i></button></div></div></div></div></div>';
    // jQuery("<style type='text/css'> .popover{z-index:1061; width: 280px;} .tour-guide-highlight{-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6);-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6);box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(82, 168, 236, .6); </style>").appendTo("head");

    var currentTourIndex = 0;
    var closed = false;

  /*  jQuery.fn.center = function (jQuery) {
      var w = jQuery(window);
      this.css({
        'position':'absolute',
        'top':Math.abs(((w.height() - this.outerHeight()) / 2) + w.scrollTop())
      });
      return this;
    }*/


    var displayTourItem = function (index){
        if(index < tourItems.length && index >= 0 ){
            currentTourIndex = index+1;
            var tourItem = tourItems[index];
            if(tourItem.displayType == "modal"){
                jQuery('#vtour-modal .modal-body').html(tourItem.content);
                jQuery('#vtour-modal').modal({
                    keyboard: false,
                    backdrop: 'static',
                    title: tourItem.title
                });
                jQuery('.modal-backdrop.in').css(backdropDefaultStyle);
                jQuery('#modal-continue').on('click', function() {
                    setTimeout(function() { jQuery('#vtour-modal').modal('hide') }, 1);
                    setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
                });
                // setInterval(function(){ 
                //     jQuery('#modal-continue').click();
                // }, 5000);
            }else if(tourItem.displayType == "popover"){
                var buttonText = tourItems.length - 1 == index ? "Hide" : "Continue";
                var tempContent = tourItem.content
                    + '<div class="text-center"><button type="button" class="popover_count step-btn" id="popover-continue-' + index + '"><< Continue >></button></div>';
                var fieldArr = ['tourUpgrade', 'tourEmployeerView', 'tourConNow', 'tourSearch', 'tourNewPosting', 'tourSurveyRes', 'tourCarrOpp', 'tourCommunCent', 'tourCoverLett', 'tourReferences', 'tourHonoAndAwa', 'tourLicensing', 'tourTechTran', 'tourTasks', 'tourSalNav', 'tourContOpp', 'tourTanSupport', 'tourPerCons'];
                if ( jQuery.inArray(tourItem.fieldId, fieldArr) != -1 ) {
                    var cusPlac = 'left'
                }
                else{
                    var cusPlac = mobileMode && tourItem.mobilePlacement != undefined ? tourItem.mobilePlacement : tourItem.placement;
                }
                jQuery("#" + tourItem.fieldId).popover(
                    {
                        content: tempContent,
                        trigger: 'manual',
                        html: true,
                        placement: cusPlac,
                        //title: tourItem.title
                    }
                );

                jQuery("#" + tourItem.fieldId).popover('show');
                //add backdrop and highlight the field
                toggleBackdrop();
                toggleItemHighLight(tourItem.fieldId, index);
                jQuery("#" + tourItem.fieldId).focus();
                //handle key press and click on continue
                handleKeyPress(index, tourItem.fieldId);
                jQuery('#popover-continue-' + index).on('click', function() {
                    var errorDiv = jQuery('#'+tourItem.fieldId).first().offset().top - 100;
                    jQuery(window).scrollTop(errorDiv);
                    if(itemChanged || !isEditableField){
                        setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
                        toggleBackdrop();
                        toggleItemHighLight(tourItem.fieldId, index);
                        itemChanged = false; isEditableField = false;
                    }
                });
                jQuery(".close_tour").on('click', function(){
                   jQuery("#"+tourItem.fieldId).css({"z-index": 'auto'});
                   jQuery("#" + tourItem.fieldId).toggleClass("tour-guide-highlight");
                   jQuery("#"+tourItem.fieldId).popover('destroy');
                   jQuery('#vtour-backdrop').remove();
                });
                setInterval(function(){ 
                    jQuery('#popover-continue-' + index).click();
                }, 14000);
            }else{
                setTimeout(function() { displayTourItem(currentTourIndex) }, 1);
            }
        }else if(currentTourIndex == tourItems.length){
            if(!closed){
                closed = true;
                vTour.onClose();
            }
        }
    };

    var toggleTourGuide = function (){
        for(var i = 0; i < tourItems.length; i++){
            var tourItem = tourItems[i];
            if(tourItem.displayType == "popover"){
                jQuery("#" + tourItem.fieldId).popover(
                    {
                        content: tourItem.content,
                        placement: mobileMode && tourItem.mobilePlacement != undefined ? tourItem.mobilePlacement : tourItem.placement,
                        title: tourItem.title,
                        trigger: 'hover'
                    }
                );
                if(i == 0){
                    toggleBackdrop({
                        opacity: '.5',
                        filter: 'alpha(opacity=50)',
                        'z-index': '1040'
                    });
                    jQuery('#vtour-backdrop').on('click', function(e){vTour.hideTourGuide();});
                    toggleHelpGuideAlert();
                }
                toggleItemHighLight(tourItem.fieldId, i);
            }
        }
    };

    var backdropDefaultStyle = {
        opacity: '0.4',
        filter: 'alpha(opacity=40)',
        'z-index': '1040'
    };

    var toggleItemHighLight = function(focusedId, index){
        if(focusedId != undefined){
            if(jQuery("#"+focusedId).css('z-index') >= 1041){
                jQuery("#"+focusedId).css({"z-index": 'auto'});
                jQuery("#" + focusedId).toggleClass("tour-guide-highlight");
                jQuery("#" + focusedId).popover('destroy');
            }else{
                jQuery("#"+focusedId).css({'z-index': 1041 + index, position: 'relative'});
                jQuery("#" + focusedId).toggleClass("tour-guide-highlight");
                jQuery("#" + focusedId).attr("rel", "popover");
            }
        }
    };

    var toggleBackdrop = function(backdropStyle) {
        if(jQuery('#vtour-backdrop').length <= 0){
            var jQuerybackdrop = jQuery('<div id="vtour-backdrop" class="modal-backdrop"/>').appendTo(document.body);
            if(backdropStyle == undefined){
                jQuerybackdrop.css(backdropDefaultStyle);
            }else{
                jQuerybackdrop.css(backdropStyle);
            }
        }else{
            jQuery('div.modal-backdrop').remove();
        }
    };

    var toggleHelpGuideAlert = function(){
        if(jQuery("#vtour-help-guide-alert").length > 0){
            jQuery("#vtour-help-guide-alert").remove();
        }else{
            jQuery('body').append(guideHelpBox);
            jQuery("#vtour-help-guide-alert").on('click', function(e){
                vTour.hideTourGuide();
            });
        }
    };

    var itemChanged = false;
    var isEditableField = false;

    var escapeKeyListen = function(){
        var keyPressHandler = function(e){
            var keyCode = e.keyCode || e.which;
            if (keyCode == 27) {
                vTour.hideTourGuide();
                jQuery('body').unbind("keydown", keyPressHandler);
            }
        };
        jQuery('body').bind("keydown", keyPressHandler);
    };

    var handleKeyPress = function(index, focusedId) {
        var keyPressHandler = function(e){
            var keyCode = e.keyCode || e.which;
            if (keyCode == 13 || keyCode == 9) {
                e.preventDefault();
                if(itemChanged || !isEditableField){
                    jQuery('#popover-continue-' + index).click();
                    jQuery("#"+focusedId).unbind("keydown", keyPressHandler);
                    itemChanged = false; isEditableField = false;
                }
            }
        };
        jQuery("#"+focusedId).bind("keydown", keyPressHandler);

        var changeHandler = function(e){
            jQuery('#popover-continue-' + index).removeClass("disabled");
            itemChanged = true;
        };
        isEditableField = (jQuery("#"+focusedId).is('input') || jQuery("#"+focusedId).is('select'))
            && (!jQuery("#"+focusedId).hasClass('value-input') || !jQuery("#"+focusedId).hasClass('uneditable-input'));
        if(isEditableField){
            jQuery('#popover-continue-' + index).addClass("disabled");
            if(isEventSupported("input") && jQuery("#"+focusedId).is('input')){
                jQuery("#"+focusedId).one("input", changeHandler);
            }else if(jQuery("#"+focusedId).is('input')){
                jQuery('#popover-continue-' + index).removeClass("disabled");
                isEditableField = false;
            }

            if(jQuery("#"+focusedId).is('select')){
                jQuery("#"+focusedId).one("change", changeHandler);
            }
        }
    };

    this.tour = function(fields){
        if(pageVTourUrl == undefined || pageVTourUrl == "" || pageVTourUrl == null) {
            pageVTourUrl = context.attr("pageVTourUrl");
        }
        if(pageVTourUrl != undefined && pageVTourUrl != "" && pageVTourUrl != null){
            if(fields != undefined){
                buildTourItems(fields);
            }else{
                buildTourItems();
            }
            this.onStart(false);
        }
    };

    this.onStart = function(popUpGuide){
        if(popUpGuide == true){
            escapeKeyListen();
            toggleTourGuide();
        }else{
            jQuery('body').append(staticModal);
            displayTourItem(0);
        }
    };

    this.onClose = function(){

    };

    this.tourGuide = function(fields){
        if(pageVTourUrl == undefined || pageVTourUrl == "" || pageVTourUrl == null){
            pageVTourUrl = context.attr("pageVGuideUrl");
        }
        if(pageVTourUrl != undefined && pageVTourUrl != "" && pageVTourUrl != null){
            if(fields != undefined){
                buildTourItems(fields);
            }else{
                buildTourItems()
            }
            this.onStart(true);
        }
    };

    this.hideTourGuide = function(){
        toggleTourGuide();
        vTour.onClose();
    };

    VTour.getInstance = function(){
        return vTour;
    }
}

var isEventSupported = (function(){
    var TAGNAMES = {
        'select':'input','change':'input', 'input':'input',
        'submit':'form','reset':'form',
        'error':'img','load':'img','abort':'img'
    };
    function isEventSupported(eventName) {
        var el = document.createElement(TAGNAMES[eventName] || 'div');
        eventName = 'on' + eventName;
        var isSupported = (eventName in el);
        if (!isSupported) {
            el.setAttribute(eventName, 'return;');
            isSupported = typeof el[eventName] == 'function';
        }
        el = null;
        return isSupported;
    }
    return isEventSupported;
})();