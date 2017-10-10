// JavaScript Document
jQuery(document).ready(function(e) {
   
   homeHeight();
   pageHight();
});

jQuery(window).resize(function(e) {
   pageHight();
   homeHeight();
});

function pageHight(){
	jQuery('.sidebar').css('height','auto');
	jQuery('.content').css('height','auto');
	 var contentH = jQuery('.content').outerHeight();
	var sidebarH = jQuery('.sidebar').outerHeight();
	if(contentH > sidebarH){
		jQuery('.sidebar').height(contentH);
	}
	else{
		jQuery('.content').height(sidebarH);
	}	
}

function homeHeight(){
	var windowH = $(window).height(); 
	var search_footerH = $('.search_footer').outerHeight();
	var headerH = $('.header').outerHeight();
	var footerH = $('footer').outerHeight();
	var mainH = windowH - search_footerH;
	var contentH = windowH - footerH - headerH;
	jQuery('.search_main').height(mainH);
	
	jQuery('.content').height(contentH);
}