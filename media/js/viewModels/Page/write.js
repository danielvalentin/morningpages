define([
	'knockout',
	'jquery',
	'site',
	'models/modal',
	'models/autosave'
], function(ko, $, site, modal, autosave){
	
	var writeModel = function(){
		var self = this;
		
		self.writtenwords = ko.observable('');
		self.totalwords = ko.observable(0);
		self.wordcount = ko.computed(function(){
			var total = $.trim(self.writtenwords()).split(/\s+/).length;
			if(self.writtenwords().length == 0) total = 0;
			if(site.user.logged())
			{
				total += parseInt(site.user.wordcount());
			}
			self.totalwords(total);
			return total;
		}, this);
		
		if(site.user.logged())
		{
			site.user.getInfo().then(function(){
				self.writtenwords('');
				if(site.user.options.hemingwaymode())
				{
					$('#morningpage-content').on('keydown',function(e){
						if(e.keyCode == 8 || e.keyCode == 46)
						{
							return false;
						}
					});
				}
			});
			
			self.autosaver = new autosave($('#morningpage-content'));
			self.autosaver.get().then(function(reply){
				self.autosaver.element.val(reply.content);
				 $('#morningpage-content').trigger('autosize');
			});
			
		}
		
		self.submitPage = function(){
			if(!site.user.logged())
			{
				return false;
			}
		};
		
		$(document).on("keydown", function(e){
			if(e.ctrlKey && e.keyCode == 32)
			{
				$('#page-content').toggle();
				$('#writeform').toggle();
				$('#dummy-content').toggle();
				$('#sidebar').toggle();
				$('#header').toggle();
				$('#user-options').hide();
				$('footer').toggle();
			}
		});
		
		var isFullscreen = false;
		self.fullscreen = function(){
			if(isFullscreen)
			{
				$('.container').removeClass('not-relative');
				$('#morningpage-content').removeClass('fullscreen').trigger('autosize');
				$('#fullscreen-toolbar').removeClass('fullscreen-toolbar');
				isFullscreen = false;
			}
			else
			{
				$('.container').addClass('not-relative');
				$('#morningpage-content').trigger('autosize.destroy').addClass('fullscreen');
				$('#fullscreen-toolbar').addClass('fullscreen-toolbar');
				isFullscreen = true;
			}
		};
		
	};
	
	ko.applyBindings(new writeModel(),$('#writing-container')[0]);
	
});

