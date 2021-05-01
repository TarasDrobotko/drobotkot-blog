//http://www.designchemical.com/lab/jquery-vertical-accordion-menu-plugin/getting-started/
jQuery(document).ready(function( $ ) {
    $('ul.accordion').dcAccordion({
    	hoverDelay: wfm_obj.hoverDelay,
    	eventType: wfm_obj.eventType,
      disableLink: true,
      speed: wfm_obj.speed
    });
});