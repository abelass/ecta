/*
 * Ce fichier peut contenir toutes les scripts custom
 * @requires jQuery v1.4 or later
*/
$(document).ready(function() {
	$('a[rel*=facebox]').facebox({
    loading_image : 'squelettes/images/loading.gif',
    close_image   : 'squelettes/images/closelabel.gif'
  }) 
});