(function(){
	var editor;
	KindEditor.ready(function(K) {
	editor = K.create('#edictor', {
		resizeType : 1,
		allowFileManager : true,
		allowUpload : true,
		});
	});
})();

