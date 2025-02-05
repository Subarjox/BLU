<?php

define('base_url', '/blu/');
function redirect($url=''){
	if(!empty($url))
	echo '<script> location.href="'.base_url .$url.'"</script>';
}

redirect('pages');

?>