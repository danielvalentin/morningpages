define(["knockout","jquery","autogrow","validate"],function(n,$){n.bindingHandlers.autogrow={init:function(o,i,a){n.applyBindingsToNode(o,{value:i()}),n.utils.domNodeDisposal.addDisposeCallback(o,function(){$(o).data("autosize").remove()}),$(o).autosize({append:"\n"}),$(o).focus(function(){$(o).trigger("autosize")})}},n.bindingHandlers.tabs={init:function(n,o){console.log("Works so far"),$(n).find("a").each(function(){console.log("found an a"),$(this).on("click",function(){console.log("clicked an a");var i=$("."+o()).hide();$(n).find("active-tab").removeClass("active-tab"),$(this).parent().addClass("active-tab"),$($(this).attr("href")).show()})})}},n.bindingHandlers.showModal={init:function(n,o){$(n).on("click",function(){return $("#"+o()).show("fast"),$(".modal-overlay").css({display:"block",background:"rgba(0,0,0,.25)"}),!1})}},n.bindingHandlers.hideModal={init:function(n,o){$(n).on("click",function(){return $("#"+o()+", .shortcuts-modal, .modal-overlay").hide("fast"),$(".modal-overlay").css({display:"none",background:"rgba(0,0,0,0)"}),!1})}},n.bindingHandlers.validateForm={init:function(n,o){$(n).on("submit",function(){return $(n).valid()?o()():console.log("not valid"),!1})}}});