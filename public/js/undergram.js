var blocks,data,currentBlock;function get_instagram_data(e,t,a=""){var n=new XMLHttpRequest;n.open("POST",instagram_data.ajax_url),n.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),n.onload=function(){200===n.status&&(response=JSON.parse(n.response),document.getElementById(a).insertAdjacentHTML("beforeend",response.data.html))},n.send("action=undergram&_ajax_nonce="+instagram_data.nonce+"&user="+e+"&posts_number="+t)}function build_undergram_blocks(){for(var e=0,t=(blocks=document.getElementsByClassName("undergram-box")).length;e<t;e++)get_instagram_data((currentBlock=blocks[e].childNodes[0]).dataset.user,currentBlock.dataset.postsnumber,currentBlock.id)}