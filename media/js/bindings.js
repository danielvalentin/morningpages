define([
	'knockout',
	'jquery',
	'autogrow',
	'validate'
], function(ko, $){
	
	ko.bindingHandlers.autogrow = {
	    init: function (element, valueAccessor, allBindingsAccessor) {
	        ko.applyBindingsToNode(element, { value: valueAccessor() });        
	        
	        ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
	            $(element).data('autosize').remove();
	        });
	        
	        $(element).autosize({ append: "\n" });
	        
	        $(element).focus(function () {
	            $(element).trigger('autosize');
	        });
	    }
	};
	
	ko.bindingHandlers.tabs = {
        init:function(element, targets){
            console.log('Works so far');
            $(element).find('a').each(function(){
                console.log('found an a');
                $(this).on('click', function(){
                    console.log('clicked an a');
                    var $targets = $('.'+targets()).hide();
                    $(element).find('active-tab').removeClass('active-tab');
                    $(this).parent().addClass('active-tab');
                    $($(this).attr('href')).show();
                });
            });
        }
    };

	ko.bindingHandlers.showModal = {
		init:function(element, valueAccessor){
			$(element).on('click',function(){
				$('#'+valueAccessor()).show( "fast" );
				$( ".modal-overlay" ).css({
					"display": "block", 
					"background": "rgba(0,0,0,.25)"
				});
				return false;
			});
		}
	};
	ko.bindingHandlers.hideModal = {
		init:function(element, valueAccessor){
			$(element).on('click',function(){
				$( "#"+valueAccessor()+", .shortcuts-modal, .modal-overlay" ).hide( "fast" );
				$( ".modal-overlay" ).css({
					"display": "none", 
					"background": "rgba(0,0,0,0)"
				});
				return false;
			});
		}
	};
	
	ko.bindingHandlers.validateForm = {
		init:function(element, valueAccessor){
			$(element).on('submit', function(){
				if($(element).valid())
				{
					valueAccessor()();
				}
				else
				{
					console.log('not valid');
				}
				return false;
			});
		}
	};
	
});


