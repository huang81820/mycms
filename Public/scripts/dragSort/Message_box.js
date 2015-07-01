


	
var Message = function(text) {
    showCartbox(text);
    var close = setTimeout(function() {
        showCartbox("", 1);
    }, 800);
};
showCartbox = function(text, r) {
    if (r) {
        $(".cartprop").remove();
        return false;
    }
    if (!$(".cartprop").length) {
		var style="";
		style+=' padding: 20px;';
		style+=' position: fixed;';
		style+=' z-index: 2000;';
		style+=' background: rgba(0,0,0,.8);';
		style+=' top: 50%;';
		style+=' left: 50%;';
				
		style+=' -webkit-transform: translate(-50%,-50%);';
		style+=' transform: translate(-50%,-50%);';
		style+=' color: #fff;';
		style+=' border-radius: 4px;';
		style+=' text-align: center;';
		style+=' line-height: 2;';
		style+=' text-shadow: 1px 1px 1px rgba(0,0,0,.5);';	
		
        var cartbox = '<div class="cartprop" style="'+style+'" >' + text + '</div>';
    }
    $("body").append(cartbox);
};