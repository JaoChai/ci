var textarea;
function doAddTags(tag1,tag2){
	if(document.selection){
		textarea.focus();
		var sel = document.selection.createRange();
		sel.text = tag1 + sel.text + tag2;
		delete sel;
	}else{
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;
        var sel = textarea.value.substring(start, end);
		var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		delete len,start,end,scrollTop,scrollLeft,sel,rep;
	}
}
function doImage(){
	var url = prompt(repeat('-',50)+' Image URL '+repeat('-',50),'http://');
	var scrollTop = textarea.scrollTop;
	var scrollLeft = textarea.scrollLeft;
	if(url){
		if(document.selection){
			textarea.focus();
			var sel = document.selection.createRange();
			sel.text = '<img src="' + url + '" />';
			delete sel;
		}else{
			var len = textarea.value.length;
			var start = textarea.selectionStart;
			var end = textarea.selectionEnd;
			var sel = textarea.value.substring(start, end);
			var rep = '<img src="' + url + '" />';
			textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
			textarea.scrollTop = scrollTop;
			textarea.scrollLeft = scrollLeft;
			delete len,start,end,sel,rep;
		}
	}
	delete url,scrollTop,scrollLeft;
}
function repeat(pattern,count){
    if(count<1) return'';
    var result='';
    while(count>0){
        if(count & 1)result += pattern;
        count >>= 1,pattern += pattern;
    };
    return result;
}
function get_emo(url){
	var scrollTop = textarea.scrollTop;
	var scrollLeft = textarea.scrollLeft;
	if(document.selection){
		textarea.focus();
		var sel = document.selection.createRange();
		sel.text = '<img src="'+base_url+url+'" />';
		delete sel;
	}else{
		var len = textarea.value.length;
	    var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
        var sel = textarea.value.substring(start, end);
		var rep = '<img src="'+base_url+url+'" />';
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		delete len,start,end,sel,rep;
	}
	delete scrollTop,scrollLeft;
	$('.close a').click();
}
function msg_delete(dby,id){
	$.ajax({type:'POST',url:site_url+'/forum/msg_delete',data:'id='+id+'&dby='+dby,success:function(data){
		alert(data);
	}});
}
function refer(id){
	$('#reply_detail').val('<blockquote>'+char_to_html($('#refer_'+id).html())+'</blockquote>');
}
function char_to_html(text){
	return text.replace(/<(p|P)>|<\/(p|P)>|<(br|BR)>|  /g,'');
}
function reply_review(){
	$('#row_reply_review').show();
	$('#reply_review').html('<article>'+char_to_html($('#reply_detail').val())+'</article>');	
}
function thanks(id){
	$.ajax({type:'POST',url:site_url+'/users/thanks',data:'id='+id,success:function(data){
		alert(data);			
	}});
}