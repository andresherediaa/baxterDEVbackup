/*------------------------------------------------------------------------------
 Admin JS file for baxter theme
----------------------------------------------------------------------------- */

(function($) {

  $('#baxter-featured-image-2 .upload-btn').click(function(e) {
    console.log('click');
    window.send_to_editor = function(html) {
      imgurl = $('img', html).attr('src');
      $('#baxter-featured-image-2 .upload-txt').val(imgurl);
      $('#baxter-featured-image-2 .upload-img').html('<img src="' + imgurl + '">');
      tb_remove();
    }	
    tb_show('', 'media-upload.php?post_id=' + $('input#post_ID').val() + '&amp;type=image&amp;TB_iframe=true');
    return false;
  });

  $('#baxter-featured-image-2 .remove-btn').click(function(e) {
    $('#baxter-featured-image-2 .upload-txt').val('');
    $('#baxter-featured-image-2 .upload-img').html('');
  });

})(jQuery)


