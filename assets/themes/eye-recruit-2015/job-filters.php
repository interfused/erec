<?php wp_enqueue_script( 'wp-job-manager-ajax-filters' ); ?>
<?php
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

$user_ip = get_client_ip_env();

$location = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=2b3d7d0ad1a285279139487ce77f3f58d980eea9546b5ccc5d08f5ee62ce7471&ip=".$user_ip."&format=json"));

if(!empty($location)){
$lat = $location->latitude;
$long = $location->longitude; 
}else{
   $lat = '40.705311';
   $long= '-74.258188'; 
}

?>
<?php do_action( 'job_manager_job_filters_before', $atts );  ?>
<form class="job_filters">
        <section class="jobsearch_map">
            <div id="map" class="job_map"></div>
            <div class="container">
                <div class="jobsearch_bar">
                    <div class="form">
                        <div class="search_jobs search_fields">
                            <div class="row">
                                <?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
                                <div class="countrycityfield"></div>
                                <div class="col-sm-3">
                                    <div class="search_keywords form-group">
                                        <!-- <input type="text" class="form-control" name="search_keywords" id="" placeholder="<?php //esc_attr_e( 'Keywords', 'wp-job-manager' ); ?>" value="<?php //echo esc_attr( $keywords ); ?>" /> -->

                                         <input type="text" class="form-control" name="job_postcode" id="" placeholder="<?php esc_attr_e( 'Your Zip Code', 'wp-job-manager' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
                                    </div>
                                </div>
                            </div>
                            <?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
                        </div>
                    </div>
                <div class="text-right"><a href="javascript:void(0);" style="visibility: hidden;">Advance Search</a></div>

                </div>
                <div class="text-center"><a href="javascript:void(0);"  data-toggle="modal" data-target="#ReportThisJob" class="alert btn btn-success">Create a Job Alert</a></div>
            </div>
        </section>
        <section class="dashboard_sec">
            <div class="container">
                <div class="row">
                    <div id="erJobListingTop" class="col-lg-6 col-md-12 col-lg-push-3 col-md-push-0">
                        <div id="searchSec" class="section_title">
                            <h3 class="notFeatured">Featured</h3>
                            <span class="text-warning"><a href="javascript:void(0);" id="getrss" target="_blank"> <i class="fa fa-rss" aria-hidden="true"></i> RSS</a> </span>
                            <div id="getAlllink" style="display:none;">
                                <?php echo job_manager_get_filtered_links(); ?>
                            </div>
                        </div>
                        <div class="filter_loader loader inner-loader" id="loaders" ></div>
                        <div class="jobsearch_results job_listings listingforward">
                        </div>
                        <div id="jobpaginationDiv" class="paginationDiv text-center">
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-lg-pull-6 col-md-pull-0">
                        <h3 class="quick_search">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/filter_icon.png" alt="Img"> Filter Results <!-- Quick Look -->
                        </h3>
                        <div class="light_box quick_links" >
                            <div class="sidebar_title" id="quickCategory">
                                <h4>Category</h4>
                            </div>
                            <div class="text-center">
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm submit_filter_category" rel="submit_filter_category">Search</a>
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm" rel="filter_category" id="catResetSearch">Clear</a>
                            </div>
                        </div>
                        
                        <div class="light_box quick_links">
                            <div class="sidebar_title" id="quickListingtype">
                                <h4>By Type</h4>
                            </div>
                            <div class="text-center">
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm submit_filter_category" rel="submit_filter_category">Search</a>
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm" rel="job_listing_type" id="salResetSearch">Clear</a>
                            </div>
                        </div>
                        <div class="light_box quick_links">
                            <div class="sidebar_title" id="quickjobDistance">
                                <h4>DISTANCE</h4>
                            </div>
                            <div class="text-center">
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm submit_filter_category" rel="submit_filter_category">Search</a>
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm" rel="filter_by_job_distance" id="disResetSearch">Clear</a>
                            </div>
                        </div>

                        <div class="light_box quick_links">
                            <div class="sidebar_title" id="quickCompansation">
                                <h4>Compensation</h4>
                            </div>
                            <div class="text-center">
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm submit_filter_category" rel="submit_filter_category">Search</a>
                              <a href="javascript:void(0);" class="btn btn-primary btn-sm" rel="filter_by_compan_type" id="comResetSearch">Clear</a>
                            </div>
                        </div>


                        <?php 
                            $show_filter_element = false;
                            if($show_filter_element){ 
                        ?>
                        <div class="light_box quick_links include_list benifit_list">
                            <div class="sidebar_title">
                                <h4>BENEFITS</h4>
                            </div>
                            <ul>
                                <li><a href="javascript:void(0);">401k Plan</a></li>
                                <li><a href="javascript:void(0);">Bereavement leave</a></li>
                                <li><a href="javascript:void(0);">Childcare</a></li>
                                <li><a href="javascript:void(0);">Commuting allowance </a></li>
                                <li><a href="javascript:void(0);">Guard Companies</a></li>
                                <li><a href="javascript:void(0);">Company mobile phone </a></li>
                                <li><a href="javascript:void(0);">Company social events</a></li>
                                <li><a href="javascript:void(0);">Dental insurance</a></li>
                                <li><a href="javascript:void(0);">Dependent care</a></li>
                                <li><a href="javascript:void(0);">Disability care</a></li>


                                <li><a href="javascript:void(0);">Disability insurance</a></li>
                                <li><a href="javascript:void(0);">Employee assistance program</a></li>
                                <li><a href="javascript:void(0);">Employee stock purchase</a></li>
                                <li><a href="javascript:void(0);">Equity incentive plan </a></li>
                                <li><a href="javascript:void(0);">Family medical leave</a></li>
                                <li><a href="javascript:void(0);">Free lunch or snacks </a></li>
                                <li><a href="javascript:void(0);">Gym membership</a></li>
                                <li><a href="javascript:void(0);">Health care on site</a></li>
                                <li><a href="javascript:void(0);">Health insurance</a></li>
                                <li><a href="javascript:void(0);">Legal assistance</a></li>

                                <li><a href="javascript:void(0);">Life insurance</a></li>
                                <li><a href="javascript:void(0);">Maternity & paternity leave</a></li>
                                <li><a href="javascript:void(0);">Mental health care</a></li>
                                <li><a href="javascript:void(0);">Paid holidays</a></li>
                                <li><a href="javascript:void(0);">Paid sick days</a></li>
                                <li><a href="javascript:void(0);">Pension plan</a></li>
                                <li><a href="javascript:void(0);">Performance bonus</a></li>
                                <li><a href="javascript:void(0);">Pet friendly workplace</a></li>
                                <li><a href="javascript:void(0);">Reduced or flexible hours</a></li>
                                <li><a href="javascript:void(0);">Relocation bonus</a></li>

                                 <li><a href="javascript:void(0);">Sabbatical</a></li>
                                <li><a href="javascript:void(0);">Stock options</a></li>
                                <li><a href="javascript:void(0);">Tuition reimbursement</a></li>
                                <li><a href="javascript:void(0);">Unpaid extended leave</a></li>
                                <li><a href="javascript:void(0);">Vacation & paid time off</a></li>
                                <li><a href="javascript:void(0);">Vision insurance</a></li>
                                <li><a href="javascript:void(0);">Volunteer time off</a></li>
                                <li><a href="javascript:void(0);">Work from home</a></li>

                            </ul>
                        </div>
                        <?php } ?>

                     

                        <div class="sidebar_title">
                            <a href="javascript:void(0);" class="btn btn-primary" id="resetSearch">Clear All</a>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-lg-pull-0 col-md-pull-0">
                        <?php include('content-find_job_sidebar.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/sweetalert.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/sweetalert.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap-select.min.js"></script>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('.countrycityfieldappend').insertAfter('.countrycityfield');
        jQuery('#job_country').on('change' , function() {
          var country = jQuery('#job_country option:selected').val();
            if ( country == '' || country == 'all' ) {
                jQuery('#job_state option, #job_city option').remove();
                jQuery('#job_state').append('<option value="">Select your state</option>');
                jQuery('#job_city').append('<option value="">Select your city</option>');
                jQuery("#job_state, #job_city").selectpicker("refresh");
            }
            else {
                jQuery('#job_state option').remove();
                jQuery('#job_state').append('<option value="">Please Wait...</option>');
                jQuery('button[data-id="job_state"] span').html('Please Wait...');
                jQuery.ajax({
                    url: '<?php echo admin_url("admin-ajax.php") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'getstatebycountry',
                        country: country
                    },
                    success: function(res){
                        jQuery('#job_state option, #job_city option').remove();
                        jQuery('#job_state').append('<option value="">Select your state</option>'); /*<option value="all">Select all</option>*/
                        jQuery('#job_city').append('<option value="">Select your city</option>');
                        jQuery('#job_state').append(res);
                        jQuery("#job_state, #job_city").selectpicker("refresh");
                    }
                });
            }
        });

        jQuery('#job_state').on('change', function() {
          var state = jQuery(this).val();
           if ( state == '' || state == 'all' ) {
                jQuery('#job_city option').remove();
                jQuery('#job_city').append('<option value="">Select your city</option>');
                jQuery("#job_city").selectpicker("refresh");
            }
            else {
              jQuery('#job_city option').remove();
              jQuery('#job_city').append('<option value="">Please Wait...</option>');
              jQuery('button[data-id="job_city"] span').html('Please Wait...');
              jQuery.ajax({
                url: '<?php echo admin_url("admin-ajax.php") ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                  action: 'getcitybystate',
                  state: state
                },
                success: function(res){
                  jQuery('#job_city option').remove();
                  jQuery('#job_city').append('<option value="">Select your city</option>'); /*<option value="all">Select all</option>*/
                  jQuery('#job_city').append(res);
                  jQuery("#job_city").selectpicker("refresh");
                }
              });
          }
        });
    });
</script>



<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('<button class="btn btn-primary" id="quickSearchButton" name="submit" type="submit">Search</button>').insertAfter('.search_submit input');
        jQuery('.search_submit input').remove();
        setTimeout(function() { 
            //jQuery('.search_region .chosen-single span').html('Location');
        },500);
        jQuery('.filter_by_tag').remove();

        /*jQuery('#resetSearch').on('click', function() {
            window.location = '<?php echo get_the_permalink(); ?>';
        });*/

        jQuery('#getAlllink .reset, #getAlllink .alert').remove();
        var rsshrf = jQuery('#getAlllink .rss_link').attr('href');
        jQuery('#getAlllink .rss_link').hide();
        jQuery('#getrss').attr('href', rsshrf);
        jQuery('#getAlllink').remove();



        /*jQuery( '#resetSearch' ).on( 'click', function () {
            var form = jQuery( this ).closest( 'form' );
            form.find(':input[name="filter_category"]').prop('checked', false);
        });*/
        
        var location = document.location.href.split('#')[0];
        function job_manager_store_state( target, page ) {
            var form  = target.find( '.job_filters' );
            var data  = jQuery( form ).serialize();
            var index = jQuery( 'div.job_listings' ).index( target );
            window.history.replaceState( { id: 'job_manager_state', page: page, data: data, index: index }, '', location + '#s=1' );
        }

        jQuery( '#resetSearch' ).on( 'click', function () {
            jQuery('.des_filter').val('');
            var target = jQuery( this ).closest( 'div.job_listings' );
            var form = jQuery( this ).closest( 'form' );
            
            jQuery('#job_country option, #job_state  option, #job_city  option').removeAttr('selected');
            jQuery('#job_state option, #job_city option').remove();
            jQuery('#job_state').append('<option value="">Select your state</option>');
            jQuery('#job_city').append('<option value="">Select your city</option>');
            jQuery("#job_country, #job_state, #job_city").selectpicker("refresh");

            //form.find( ':input[name="search_keywords"], :input[name="search_location"]' ).not(':input[type="hidden"]').val( '' ).trigger( 'chosen:updated' );
            form.find( ':input[name^="search_categories"]' ).not(':input[type="hidden"]').val( 0 ).trigger( 'chosen:updated' );
            jQuery( ':input[name="filter_job_type[]"]', form ).not(':input[type="hidden"]').attr( 'checked', 'checked' );
            form.find('.custom-job-manager-filter').prop('checked', false);
            target.triggerHandler( 'reset' );
            target.triggerHandler( 'update_results', [ 1, false ] );
            job_manager_store_state( target, 1 );

            return false;
        } );

        jQuery( '#catResetSearch ,#salResetSearch' ).on( 'click', function () {
            var target = jQuery( this ).closest( 'div.job_listings' );
            var form = jQuery( this ).closest( 'form' );
            var curr = jQuery(this).attr('rel');
            jQuery('input[name="'+curr+'[]"]').each( function() {
                form.find(this).prop('checked', false);
            });
            target.triggerHandler( 'reset' );
            target.triggerHandler( 'update_results', [ 1, false ] );
            job_manager_store_state( target, 1 );
            return false;
        } );

        jQuery( '#comResetSearch' ).on( 'click', function () {
            var target = jQuery( this ).closest( 'div.job_listings' );
            var form = jQuery( this ).closest( 'form' );
            var curr = jQuery(this).attr('rel');
            jQuery('input[name="'+curr+'[]"]').each( function() {
                form.find(this).prop('checked', false);
            }); 
            target.triggerHandler( 'reset' );
            target.triggerHandler( 'update_results', [ 1, false ] );
            job_manager_store_state( target, 1 );
            return false;
        } );

          jQuery( '#disResetSearch' ).on( 'click', function () {
            var target = jQuery( this ).closest( 'div.job_listings' );
            var form = jQuery( this ).closest( 'form' );
            var curr = jQuery(this).attr('rel');
            jQuery('input[name="'+curr+'[]"]').each( function() {
                form.find(this).prop('checked', false);
            }); 
            target.triggerHandler( 'reset' );
            target.triggerHandler( 'update_results', [ 1, false ] );
            job_manager_store_state( target, 1 );
            return false;
        } );

        jQuery( '#quickSearchButton, .submit_filter_category' ).on( 'click', function () {
            var target = jQuery( this ).closest( 'div.job_listings' );
            target.triggerHandler( 'update_results', [ 1, false ] );
            job_manager_store_state( target, 1 );
            return false;
        } );

        jQuery('.load_more_jobs').remove();

        jQuery( document.body ).on( 'click', '.load_more_jobs1', function() {
            var target           = jQuery( this ).closest( 'div.job_listings' );
            var page             = parseInt( ( jQuery( this ).data( 'page' ) || 1 ), 10 );
            var loading_previous = false;

            jQuery('.job_listings .job_listing').remove();
            jQuery(this).addClass( 'loading' );

            if ( jQuery(this).is('.load_previous') ) {
                page             = page - 1;
                loading_previous = true;
                if ( page === 1 ) {
                    jQuery(this).remove();
                } else {
                    jQuery( this ).data( 'page', page );
                }
            } else {
                page = page;
                jQuery( this ).data( 'page', page );
                job_manager_store_state( target, page );
            }

            target.triggerHandler( 'update_results', [ page, true, loading_previous ] );
            return false;
        } );
    });
</script>

   
<!-- Save Bookmark -->
<script type="text/javascript">
    jQuery(document).ready( function(){
        jQuery('.jobsearch_results').on('click', '.custSaveBookmark', function() {
            var _this = jQuery(this);
            var postid = _this.attr('postid');
            var userid = '<?php echo get_current_user_id(); ?>';
            jQuery('#loaders').show();
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo admin_url("admin-ajax.php") ?>',
                dataType: 'json',
                data: {
                    action: 'saveCustomBookmarks', //Action in inc/edit_basic_info.php
                    postid: postid,
                    userid: userid
                },
                success:function(data){
                    jQuery('#loaders').hide();
                    if ( data.msg == 'success' ) {
                        var sveurl = "<?php echo site_url(); ?>/preferences/saved-jobs-of-interest/";
                        _this.html('Saved');
                        _this.attr('href', sveurl);
                        _this.removeClass('btn-default custSaveBookmark').addClass('btn-primary');

                        swal({
                            title: "Success", 
                            html: true,
                            text: "<span class='text-center'>SUCCESS! This Job has been successfully saved!  You will be able to find it later by going to your Saved Jobs of Interest from your Dashboard or from Preferences.</span>",
                            type: "success",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                    else if(data.msg == 'exist'){
                        _this.removeClass('btn-default custSaveBookmark').addClass('btn-primary');
                        _this.html('Saved');
                        swal({
                            title: "Warning", 
                            html: true,
                            text: "<span class='text-center'>Job already saved. <br> To check your saved Job <a href='"+sveurl+"'>Click Here</a></span>",
                            type: "warning",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                    else{
                        swal({
                            title: "Error", 
                            html: true,
                            text: "<span class='text-center'>Something Wrong. Please try again!</span>",
                            type: "warning",
                            confirmButtonClass: "btn-primary btn-sm",
                        });
                    }
                }
            });
        });
    });
</script>

<!-- map -->
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;

      function initialize() {

        var lati= parseFloat("<?php echo $lat  ?>");
        var longi=parseFloat("<?php echo $long ?>");
        var pyrmont = {lat:lati , lng:longi};
       
       //  40.7128, -74.0059
        map = new google.maps.Map(document.getElementById('map'), {
          zoom:17,
      center:pyrmont,
      mapTypeId: 'roadmap',
      mapTypeControl: false,
      //draggable: false,
      scaleControl: false,
      scrollwheel: false,
      navigationControl: false,
      streetViewControl: false,
      zoomControl: false,
      styles: [
        {
            "featureType": "all",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#000000"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#000000"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#000000"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#3e5863"
                }
            ]
        }
      ]
    });

      var map_marker = {
      url: '<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/map_marker.png',
      anchor: new google.maps.Point(32, 80)
    };

    var map_marker_sm = {
      url: '<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/map_marker_sm.png',
      anchor: new google.maps.Point(20, 60)
    };

    var icons = {
      iconBig: {
        name: 'iconBig',
        icon: map_marker
      },
      iconSmall: {
        name: 'iconSmall',
        icon: map_marker_sm
      }
    };

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 300,
          type: ['city']
        }, callback);
      }

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            //remove marker creation
            //createMarker(results[i]);
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
        var marker = new google.maps.Marker({
          map: map,
         icon: "<?php echo site_url();  ?>/assets/themes/eye-recruit-2015/img/map_marker_sm.png",
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }
    </script>


   </script>    

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqYTcVKkRqR8O270N1bcMVCCwgxcTclfc&callback=initialize&libraries=places" async defer></script>

   


<!-- Alert -->
<div id="alertMoveToModel">
    <?php if ( is_user_logged_in() ) { ?>
        <?php echo '<div id="removealert"> '. do_shortcode('[job_alerts]') . "</div>"; ?>
        <form method="post" class="job-manager-form wpcf7-form" id="savealertform">
            <div id="userdetail_all_fields">
                <div class="edit-main-dv row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="alert_name">Give your Alert a Name</label>
                            <div class="alert_field">
                                <input type="text" name="alert_name" value="<?php echo esc_attr( $alert_name ); ?>" id="alert_name" class="regular-text code form-control" placeholder="Name">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
                      <div class="form-group has-feedback">
                            <label class="control-label" for="alert_cats">What Category would you like to focus on?</label>
                            <div class="alert_field">
                            <?php
                                wp_enqueue_script( 'wp-job-manager-term-multiselect' );
                                job_manager_dropdown_categories( array(
                                    'taxonomy'     => 'job_listing_category',
                                    'hierarchical' => false,
                                    'name'         => 'alert_cats',
                                    'orderby'      => 'name',
                                    'selected'     => $alert_cats,
                                    'hide_empty'   => false,
                                    'placeholder'  => __( 'Select a Category', 'wp-job-manager' )
                                ) );
                            ?>
                            
                            <span class="fa fa-angle-down form-control-feedback" aria-hidden="true"></span>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                </div>

                <div id="userdetail_pr_1" class="edit-main-dv row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="alertd">How often would you like to be alerted?</label>
                            <div class="alert_field">
                                <select class="form-control" name="alert_frequency" id="alert_frequency">
                                    <?php foreach ( WP_Job_Manager_Alerts_Notifier::get_alert_schedules() as $key => $schedule ) : ?>
                                      <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $alert_frequency, $key ); ?>><?php echo esc_html( $schedule['display'] ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="fa fa-angle-down form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label class="control-label" for="category">What Type of Job Are you looking for?</label>
                            <div class="alert_field">
                                <select name="alert_job_type[]" data-placeholder="<?php _e( 'Select Job Type', 'wp-job-manager-alerts' ); ?>" id="alert_job_type" multiple="multiple" class="job-manager-chosen-select">
                                    <?php
                                    $terms = get_job_listing_types();
                                    foreach ( $terms as $term )
                                    echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( in_array( $term->slug, $alert_job_type ), true, false ) . '>' . esc_html( $term->name ) . '</option>';
                                    ?>
                                </select> 
                                <span class="fa fa-angle-down form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    
            <div class="text-center form-group">
                <?php wp_nonce_field( 'job_manager_alert_actions' ); ?>
                <input type="hidden" name="alert_id" value="<?php echo absint( $alert_id ); ?>" />
                <input type="submit" class="btn btn-success btn-sm" name="submit-job-alert" value="<?php _e( 'Continue', 'wp-job-manager-alerts' ); ?>" />
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><<< Cancel >>></button>
            </div>

            <div class="text-center">
                <p>By Continuing you agree to the Eyerecruit.inc Terms & Conditions & privacy policies.</p>
            </div>
        </form>
    <?php } else { ?>
        <p class="text-center"><a href="<?php echo site_url(); ?>/login" class="button button button-medium">Login To Create job Alert</a></p>
        <p class="text-center">Not Yet a Member?</p>
        <p class="text-center"><a href="<?php echo site_url(); ?>/job-seekers/get-started/" class="button button button-medium">Create a FREE Account</a></p>
    <?php } ?>
</div>


<!-- Modal -->
<div class="modal fade" id="ReportThisJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/themes/eye-recruit-2015/img/message_icon.jpg" class="popup_logo">
                    <h3>Let the jobs come to you</h3>
                    <div class="clearfix"></div>
                    <h4 class="jobs_hd">Be the first to know about, investigate and apply for Jobs on EyeRecruit.com! Tell us what you are looking for and receive email alerts based on your search criteria.</h4>
                    <div class="clearfix"></div>
                    <div id="customAlertform"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="jobs_come_you" tabindex="-1" role="dialog" aria-labelledby="invite_a_colleagueLabel">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg vertical-align-center" role="document">
            <div class="modal-content recommendation_popup">
                <div class="modal-body">
                    <button type="button" id="rfclosepopup" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="<?php  echo site_url();  ?>/assets/themes/eye-recruit-2015/img/message_icon.jpg" class="popup_logo">
                    <h3>Let the jobs come to you</h3>
                    <div class="clearfix"></div>
                    <h4 class="jobs_hd">Be the first to know about, investigate and apply for Jobs on EyeRecruit.com! Tell us what you are looking for and receive email alerts based on your search criteria.</h4>
                    <form class="wpcf7-form">
                        <div id="userdetail_all_fields">
                            <div id="userdetail_pr_1" class="edit-main-dv row">
                                <div class="col-md-6"><div class="form-group">
                                    <label class="control-label" for="name">Give you alert a name</label>
                                    <input id="fname_1" class="regular-text code form-control" name="name" type="text" placeholder="Select a Name">
                                </div></div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="category">What category would you like to focus on?</label>
                                        <select name="" data-placeholder="" id="alert_job_type" multiple="multiple" class="job-manager-chosen-select">
                                            <option>Select a category</option>
                                            <option>1</option>
                                        </select> 
                                        <span class="fa fa-angle-down form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div id="userdetail_pr_1" class="edit-main-dv row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="alertd">How often would you like to be alertd?</label>
                                        <select class="form-control">
                                            <option>Select Frequency</option>
                                            <option>1</option>
                                        </select>
                                        <span class="fa fa-angle-down form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="category">What type of job are you looking for?</label>
                                        <select name="" data-placeholder="" id="alert_job_type" multiple="multiple" class="job-manager-chosen-select">
                                            <option>Select Job Type</option>
                                            <option>1</option>
                                        </select>
                                        <span class="fa fa-angle-down form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center form-group">
                            <button id="inv_a_coll" type="button" class="btn btn-success btn-sm">Continue</button>
                            <a data-dismiss="modal" aria-label="Close"> Cancel </a>
                        </div>
                        <div class="text-center">
                            <p>By Continuing you agree to the EyeRecruit, Inc. Terms & Conditions & privacy policies.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<script type="text/javascript">
  jQuery(document).ready( function() {
    setTimeout( function() {
      jQuery('#alertMoveToModel').appendTo('#customAlertform');
      jQuery('#removealert').remove();
    }, 500); 

    jQuery('input[name="submit-job-alert"]').on('click', function() {

      jQuery('#savealertform').validate({
        rules: {
          alert_name: "required",
        },
        messages: {
          alert_name: "Please enter an alert name.",
        },
        submitHandler: function(form) {
          jQuery('input[name="submit-job-alert"]').val('Please Wait..').attr('disabled', 'disabled');
          jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            dataType: 'json',
            data:{
              action: 'saveAlertforJobs', //Action in inc/edit_basic_info.php file
              getdata: jQuery("#savealertform").serialize()
            },
            success:function(data){
              jQuery('input[name="submit-job-alert"]').val('Save alert').removeAttr('disabled');
              jQuery('#ReportThisJob').modal('hide');
              if ( data.msg == 'success' ) {
                swal({ 
                    title: "Success", 
                    html: true,
                    text: "<span class='text-center'>Job alert successfully added.</span>",
                    type: "success",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
              else{
                swal({
                    title: "Error", 
                    html: true,
                    text: "<span class='text-center'>Something wrong. Please try again !</span>",
                    type: "warning",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
            }
          });
        }
      });
    });
  });
</script>

<!-- Forward Job Pop_up -->
<?php
    $user_id = get_current_user_id();
    if(is_user_logged_in()){
        $getuserdata = get_userdata($user_id);
        $Fname =  get_user_meta($user_id, 'first_name', true);
        $Lname =  get_user_meta($user_id, 'last_name', true);
        $Email =  $getuserdata->user_email;
    }
    else{
        $Fname = '';
        $Lname = '';
        $Email ='';
    }

 ?>

<div class="modal fade" id="shareModalWrap" tabindex="-1" role="dialog" aria-labelledby="shareModalWrapLabel">
  <div class="vertical-alignment-helper">
    <div role="document" class="modal-dialog modal-lg vertical-align-center">
      <div class="modal-content">
        <div class="modal-body">
            <button aria-label="Close" data-dismiss="modal" class="close profile_pic_close_button" type="button"><span aria-hidden="true">×</span>
            </button>
            <img class="popup_logo" src="<?php echo site_url(); ?>/assets/uploads/2016/04/EyeRecruit.com-logo_3-2.jpg">
            <h3>Share Job</h3>
            <div class="clearfix"></div>

            <form method="post" action="" class="wpcf7-form text-left" id="forward_modal_form">
                <h4>Send To</h4>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name (required)</label>
                            <span class="wpcf7-form-control-wrap firstname-to">
                                <input type="text" class="form-control" size="40"  name="firstname_to" id="firstname_to">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Last Name (required)</label>
                            <span class="wpcf7-form-control-wrap lastname-to">
                                <input type="text"  class="form-control" size="40"  name="lastname_to" id="lastname_to">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email (required)</label>
                            <span class="wpcf7-form-control-wrap email-to">
                                <input type="email"  class="form-control" size="40"  name="email_to" id="email_to">
                            </span>
                        </div>
                    </div>
                </div>
                <h4>From</h4>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your First Name (required)</label>
                            <span class="wpcf7-form-control-wrap firstname-from">
                                <input type="text"  class="form-control" size="40" value="<?php echo $Fname; ?>"  name="firstname_from" id="firstname_from">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your Last Name (required)</label>
                            <span class="wpcf7-form-control-wrap lastname-from">
                                <input type="text"  class="form-control" size="40" value="<?php echo $Lname; ?>"  name="lastname_from" id="lastname_from">
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Your Email (required)</label>
                            <span class="wpcf7-form-control-wrap email-from">
                                <input type="email"   class="form-control" size="40" value="<?php echo $Email; ?>"  name="email_from" id="email_from">
                            </span>
                        </div>
                    </div>
                </div>
                <h4>Email Message</h4>
                <div class="form-group">
                    <label>Comments to be included in email message:</label>
                    <span class="wpcf7-form-control-wrap shareMsg">
                        <textarea  class="form-control" rows="10" cols="40" name="shareMsg" id="shareMsg"></textarea>
                    </span>
                </div>
                <p>
                    <input type="hidden" value="theVal" id="shareJobURL" name="shareJobURL">
                </p>
                <div class="text-center">
                    <input type="hidden" value="" name="thisjobid">
                    <input type="submit" class="btn btn-primary btn-sm " value="Send" name="forward_job">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  jQuery(document).ready( function(){
/*    var date1 = new Date();
    var date2 = new Date("04/08/2017");
    var timeDiff = Math.abs(date1.getTime() - date2.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); */
    jQuery('.listingforward').on('click', '.forwardThisjob', function() {
      var _this = jQuery(this);
      var jobid = _this.attr('jobid');
      jQuery('input[name="thisjobid"]').val(jobid);
      jQuery('#shareModalWrap').modal('show');
    });

    jQuery('input[name="forward_job"]').on('click', function() {
      var _this = jQuery(this);
      jQuery("#forward_modal_form").validate({
        rules:{
          firstname_to:{
              required:true
          },
          lastname_to:{
              required:true
          },
          email_to:{
              required:true
          },
          firstname_from:{
              required:true
          },
          lastname_from:{
              required:true
          },
          email_from:{
              required:true
          },
          shareMsg:{
              required:true
          }
        },
        messages:{
          firstname_to:{
              required:"Please enter first name"
          },
          lastname_to:{
              required:"Plese enter last name"
          },
          email_to:{
              required:"Please enter an email address"
          },
          firstname_from:{
              required:"Please enter first name"
          },
          lastname_from:{
              required:"Please enter last name"
          },
          email_from:{
              required:"Please enter an email address"
          },
          shareMsg:{
              required:"Please enter your messages"
          }
        },
        submitHandler: function(form) {
          _this.attr('disabled', 'disabled');
          _this.val('Please Wait...');
          var to_first_name = jQuery("#firstname_to").val();
          var to_last_name  = jQuery("#lastname_to").val();
          var to_email      = jQuery("#email_to").val();
          var from_firstname = jQuery("#firstname_from").val();
          var from_lastname = jQuery("#lastname_from").val();
          var from_email    = jQuery("#email_from").val();
          var share_message  = jQuery("#shareMsg").val();
          var jobid  = jQuery("input[name='thisjobid']").val();
          jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            dataType: 'json',
            data:{
              action: 'forwardThisJob', //Action in inc/edit_basic_info.php file
              'to_first_name': to_first_name,
              'to_last_name' : to_last_name,
              'to_email'     : to_email,
              'from_firstname': from_firstname,
              'from_lastname': from_lastname,
              'from_email':   from_email,
              'share_message': share_message,
              'jobid': jobid
            },
            success:function(data){
              if ( data.msg == 'success' ) {
                jQuery('#forward_modal_form')[0].reset();
                _this.removeAttr('disabled');
                _this.val('Send');
                jQuery('#shareModalWrap').modal('hide');
                swal({
                    title: "Success", 
                    html: true,
                    text: "<span class='text-center'>SUCCESS! You have successfully forwarded this Job Opening! Even if the Job isn't right for you, you can build your professional network by helping someone you know imporve their long term career goals. Great Job!</span>",
                    type: "success",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
              else{
                _this.removeAttr('disabled');
                _this.val('Send');
                jQuery('#shareModalWrap').modal('hide');
                swal({
                    title: "Error", 
                    html: true,
                    text: "<span class='text-center'>Something wrong. Please try again !</span>",
                    type: "warning",
                    confirmButtonClass: "btn-primary btn-sm",
                });
              }
            }
          });
        }
      });
    });
  });
</script>

<style type="text/css">
    a[href^="https://maps.google.com/maps"], a[href^="http://maps.google.com/maps"]{display:none !important}
    .gmnoprint a, .gmnoprint span, .gm-style-cc a { display:none; }
    .gm-style-cc{ display:none}
</style>
