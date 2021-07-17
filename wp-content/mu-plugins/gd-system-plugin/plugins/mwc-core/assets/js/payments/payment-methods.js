jQuery(function($) {
	"use strict";

	let params = MWCPaymentsPaymentMethods;

	if (! params.allowManage) {
		$('tr[data-gateway_id="'+params.gatewayId+'"] td.name a').replaceWith(function() {
			return $("<span>" + $(this).html() + "</span>");
		});
	}

	if (! params.allowButton) {
		$('tr[data-gateway_id="'+params.gatewayId+'"] .onboarding-action a').css('pointer-events','none').css('opacity', '0.2');
	}

	if (! params.allowEnable) {
		$('tr[data-gateway_id="'+params.gatewayId+'"] .wc-payment-gateway-method-toggle-enabled').css('pointer-events','none').css('opacity', '0.2');
	}

	$('tr[data-gateway_id="'+params.gatewayId+'"] .onboarding-action a.start, tr[data-gateway_id="'+params.gatewayId+'"] .onboarding-action a.disconnected').on('click', function(event){

		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: params.setupIntentAction,
				setupIntentNonce: params.setupIntentNonce,
			}
		});

		new $.WCBackboneModal.View({
			target: 'mwc-payments-godaddy-onboarding-start'
		});
	});

	$('tr[data-gateway_id="'+params.gatewayId+'"] .onboarding-action a.remove').on('click', function(event){

		event.preventDefault();

		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: params.removePaymentMethodAction,
				nonce: params.removePaymentMethodNonce,
			}
		});

		$('tr[data-gateway_id="'+params.gatewayId+'"]').remove();
	});

	$('#woocommerce_'+params.gatewayId+'_transaction_type').on('change', function(){

		if ($(this).val() === 'authorization') {
			$('#woocommerce_'+params.gatewayId+'_charge_virtual_orders, #woocommerce_'+params.gatewayId+'_capture_paid_orders').closest('tr').show();
		} else {
			$('#woocommerce_'+params.gatewayId+'_charge_virtual_orders, #woocommerce_'+params.gatewayId+'_capture_paid_orders').closest('tr').hide();
		}

	}).change();

});
