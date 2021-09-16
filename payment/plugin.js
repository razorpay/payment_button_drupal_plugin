/*
* Razorpay Payment Button Plugin
* @author Razorpay <neeraj.s@razorpay.com>
* @version 1.0
*/
(function ($) {
	/**
	 * Initialize button widget to ckeditor
	**/
	CKEDITOR.plugins.add('payment', {
		lang: [ 'en'],
		init: function (editor) {
			editor.addCommand('payment', new CKEDITOR.dialogCommand('payment', {
			 allowedContent: true,
			}));
			
			editor.ui.addButton('PaymentButton', {
				label : editor.lang.payment.button,
				toolbar : 'insert',
				command : 'payment',
				icon : this.path + 'images/icon.png'
			});

			CKEDITOR.dialog.add('payment', function (instance) {
				var video,
					disabled = editor.config.payment_disabled_fields || [];

				return {
					title : editor.lang.payment.title,
					minWidth : 510,
					minHeight : 200,
					onShow: function () {
						for (var i = 0; i < disabled.length; i++) {
							this.getContentElement('paymentButtonPlugin', disabled[i]).disable();
						}
					},
					contents :
						[{
							id : 'paymentButtonPlugin',
							expand : true,
							elements :
								[
								{
									type: 'select',
									id: 'paymentbutton',
									label: 'Select Payment Button',
									items: this.get_payment_buttons(),
									'default': '',
									onChange: function( api ) {
									}
								},
								
							]
						}
					],
					onOk: function()
					{
						var content = '';
						var paymentId ='';
						/**
						 * Initialize razorpay buttons from api
						**/
						if (this.getContentElement('paymentButtonPlugin', 'paymentbutton').isEnabled()) 
						{
							paymentId = this.getValueOf('paymentButtonPlugin', 'paymentbutton');
							content += '<div>Use Below Button to pay<form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id=' + paymentId +' async> </script> </form></div>';
						
						}
						else {
						}

						var element = CKEDITOR.dom.element.createFromHtml(content);
						var instance = this.getParentEditor();
						instance.insertElement(element);
					}
				};
			});
		}
	});
})(jQuery);

/**
 *  * getting json of buttons data from  button_json page
**/

function get_payment_buttons(){
	
	var buttondata = CKEDITOR.ajax.load(Drupal.url('button_json'));

	buttondata=JSON.parse(buttondata);
	
	let mainArray=[['Select Payment Button','']];
	buttondata.map(function(ele){
		let childArray=[];
		childArray.push(ele.title);
		childArray.push(ele.id);
		mainArray.push(childArray);
	})
	return mainArray;	
	
	
}

