<?php

function convertYTLinkToEmbed($youtube_link) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"www.youtube.com/embed/$2",
    $youtube_link
	);
}

 ?>
