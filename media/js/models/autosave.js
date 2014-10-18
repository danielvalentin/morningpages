define(['jquery'],function($){
	
	var autosave = function(element){
		var self = this;
		
		self.element = element;
		self.content = self.element.val();
		
		self.get = function(){
			return $.getJSON('/ajax/pages/getautosave',function(reply){
				self.content = reply.content;
			});
		};
		
		self.savetimer = setInterval(function(){
			self.save();
		}, 10000);
		
		self.save = function(){
			var newcontent = self.element.val();
			if(newcontent && newcontent.length > 1 && newcontent != self.content)
			{
				self.content = newcontent;
				$.post('/ajax/pages/autosave',{
					'content':self.content
				}, function(reply){
					
				},'json');
			}
		};
		
	};
	
	return autosave;
	
});
