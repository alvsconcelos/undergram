var blocks, data, currentBlock;

function get_instagram_data(user, posts_number, element = "") {
    var request = new XMLHttpRequest();
    request.open('POST', instagram_data.ajax_url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onload = function() {
        if (request.status === 200) {
            response = JSON.parse(request.response);
            // return response.data.html;
            document.getElementById(element).insertAdjacentHTML( 'beforeend', response.data.html );
        }
    };
    request.send('action=undergram&_ajax_nonce=' + instagram_data.nonce + '&user=' + user + '&posts_number=' + posts_number);
}

function build_undergram_blocks() {
    // var currentBlock;
    blocks = document.getElementsByClassName("undergram-box");
    if(blocks.length < 1) return false;

    for (var i = 0, len = blocks.length; i < len; i++) {
        currentBlock = blocks[i].childNodes[0];
        get_instagram_data(currentBlock.dataset.user, currentBlock.dataset.postsnumber, currentBlock.id);
    }

}

document.addEventListener('DOMContentLoaded', function(){ 
    build_undergram_blocks();
}, false);