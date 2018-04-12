/**
  * Mageants ShippingTracker Magento2 Extension                           
*/
require(["jquery","shippingtracker"], function($) {
	$(document).ready(function(){
		$(document).on("submit", "#shipping-tracking", function($){
			jQuery(".block-content").css('opacity', 0.3);
			jQuery(".tracking-loader").show();
			jQuery.ajax({
				url:'/shippingtracker/index/trackingDetails',
				data:jQuery(this).serialize(),
				type: 'POST',
				success:function(result){
					jQuery(".block-content").css('opacity', 1);
					jQuery(".tracking-loader").hide();
					if(result.tracking_error_message!==undefined){
						jQuery(".order_tracking_details").hide();	
						jQuery(".no-tracking-details").show();
						return;
					}
					jQuery(".no-tracking-details").hide();
					jQuery(".status").text(result.status);
					jQuery(".order-id").text(result.id);
					jQuery("#order_tracking").attr('href', result.trackingurl);
					jQuery(".order_tracking_details").show();
					if(result.tracking_count){
						jQuery("#linkId").attr('href', result.shippingurl); 
						jQuery(".no-shipping-detail").hide();
						jQuery(".shipping-info").show();

					}
					else{
						jQuery(".no-shipping-detail").show();
						jQuery(".shipping-info").hide();

					}
				}
			});
		})
	});

});	