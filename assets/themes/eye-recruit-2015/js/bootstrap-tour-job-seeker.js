function seekerDashboardBootstrapTour(){
	// Instance the tour.
var tour = new Tour({
  steps: [
  {
    element: "#profilePic",
    title: "Professional Photo",
    content: "As they are the most important, first impressions are in your control. Simple details like adding a professional photograph makes the experience not only more professional, but more personal."
  },
  {
    element: "#quick_links",
    title: "Preferences",
    content: "What you want other people to view, to see or know… is your choice. We have provided a robust Preferences area that you can modify settings to match your needs and desires, even if they change."
  },
  {
    element: "#visibility_settings",
    title: "Visibility Settings",
    content: "As an example, you can quickly become invisible right from your home page."
  },
  {
    element: "li#currEmp",
    title: "Confidentiality",
    content: "Confidentiality here is important, so don’t worry…your current employer cannot see your profile or search for you by name.  We built that in too!"
  },
  {
    element: "#btn-employer-pov",
    title: "Employer Point of View",
    content: "Another great feature allow you to view for yourself exactly how Employers & Recruiters see you by clicking this button."
  },
  {
    element: "#yourRecruiter",
    title: "Your Recruiter",
    content: "As a Member of EyeRecruit.com, you are automatically assigned to a lead recruiter. He or she will be available to answer any questions you have and will also send you recommendations when they see a job that you might be interested in or when they speak to an Employer who has a Job where you might excel.",
	placement: "auto left"
  },
  {
    element: "#importantDocs",
    title: "Important Documents",
    content: "This area has been designed specifically for you to store and share your important Career Related documents. You can not only manage your resume and have a single location to store licensing, certifications, and awards, but an easier way to ask for and receive referrals. We suggest keeping this updated as the country’s top recruiters in our industry will have access as they learn about you."
  },
  {
    element: "#assesSection",
    title: "Self Assessments",
    content: "Next is one of the keys to your career success: “the self-assessment” section. Here you will provide your current experience in exacting detail. There area lot of specific experience related questions here, so don’t worry just select what applies to you. As your career progresses, this is where you would update your level of experience and proficiency. The important part is that your responses become immediately searchable… so be honest in your evaluation as it will help you get hired in the right position faster based on your experience."
  },
  {
    element: "#nav-video-interview-mgt",
    title: "Video Interview Management",
    content: "One of the most advanced benefits of EyeRecruit.com is your ability to provide your responses to basic interview questions on video. Once you have completed the Questions, Employers and Recruiters will be able to learn more about you in a more mutually beneficial way. When there is interest shown, a meeting is scheduled or an interview is requested, chances are you’re already a finalist!"
  }
  
  
],
storage:false,
backdrop: true,
onEnd: function (tour) {
	
	var oldCookie = jQuery.cookie('seekerTourStep');
	var newCookie; 
	
	if( typeof oldCookie === 'undefined'  ){
		newCookie = 'assessments';
		jQuery('#WelcomeJobSee3').modal('show');
	}else if(oldCookie == 'initial'){
		newCookie = 'assessments';
		jQuery('#WelcomeJobSee2').modal('show');
	}else if(oldCookie == 'assessments'){
		newCookie = 'docs';
		jQuery('#WelcomeJobSee4').modal('show');
	}else{
		newCookie = 'finishedIntro';
	}
	console.log('oldcookie: '+oldCookie);
	//jQuery.cookie('seekerTourStep', newCookie, { expires: 30 });
	//console.log('oldcookie: '+oldCookie+" new: "+newCookie);
	/*
	if(jQuery.cookie('seekerTourStep') == 'initial'){
		jQuery.cookie('seekerTourStep', 'assessments', { expires: 30 });
	}
	if(jQuery.cookie('seekerTourStep') == 'assessments'){
		jQuery.cookie('seekerTourStep', 'docs', { expires: 30 });
	}
	if(jQuery.cookie('seekerTourStep') == 'docs'){
		jQuery.cookie('seekerTourStep', 'finishedIntro', { expires: 30 });
	}
	*/
	//showTourStepModalScreen(); 
	}
});

// Initialize the tour
tour.init();
tour.start(); 
}

////REGISTER BUTTON CLICK
jQuery("#btn-seekerDashboardTour").click(function(e) {
	seekerDashboardBootstrapTour();
	// Start the tour   
});
///shows at the end of the tour
function showTourStepModalScreen(){
	var cVal = jQuery.cookie('seekerTourStep');
	
	console.log('showTourStepModalScreen for: ' + cVal );
	
	if(jQuery.cookie('seekerTourStep') == 'docs'){
		//jQuery.cookie('seekerTourStep', 'finishedIntro', { expires: 30 });
		jQuery("#WelcomeJobSee4").modal("show");
		return;
	}
	if(jQuery.cookie('seekerTourStep') == 'assessments'){
		jQuery("#WelcomeJobSee2").modal("show");
		//docs
		//jQuery("#WelcomeJobSee4").modal("show");
		//jQuery.cookie('seekerTourStep', 'docs', { expires: 30 });
		return;
	}
	if(jQuery.cookie('seekerTourStep') == 'initial'){
		jQuery("#WelcomeJobSee1").modal("show");
		//jQuery.cookie('seekerTourStep', 'docs', { expires: 30 });
		return;
	}
	if( typeof jQuery.cookie('seekerTourStep') === 'undefined'  ){
		console.log('show assessments modal');
		jQuery("#WelcomeJobSee1").modal("show");
		//jQuery.cookie('seekerTourStep', 'assessments', { expires: 30 });
		return;
	}
///something else
jQuery("#WelcomeJobSee1,#WelcomeJobSee2,#WelcomeJobSee3,#WelcomeJobSee4").modal("hide");
	 
}
///initial bootstrap tour
jQuery(document).ready(function(){
	//showTourStepModalScreen();
		jQuery('#btn-seekerDashboardTourInitial').on('click', function() {
			 jQuery('#WelcomeJobSee3').modal('hide');
			 seekerDashboardBootstrapTour();
					
			//jQuery('#WelcomeJobSee1, #WelcomeJobSee2 ,#WelcomeJobSee3').modal('hide');
			jQuery.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				data: {
					action: 'seeker_dashboard_tour_meta_update'
				},
				success: function(res){
					console.log('good');
					jQuery.cookie('seekerTourStep', 'initial', { expires: 30 });
				}
			});
		});
		
		jQuery("#btn-seekerDashboardTourRepeat").click(function(e) {
            e.preventDefault();
			jQuery('#WelcomeJobSee2').modal('hide');
					seekerDashboardBootstrapTour();
        });
		
		
		
});//end doc ready
