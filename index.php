<?php
error_reporting(E_ALL);

require_once 'jsmin.php';

function make_bookmarklet($code) {
	return 'javascript:'.rawurlencode(str_replace("\n", "", JSMin::minify($code)));
}

function proxifier() {
   $code = <<<'EOD'
(function () { 
    var re = /^([^\/]*\/\/[^\/]*)(.*)$/;
    var split = re.exec(location.href);
    location.href = split[1] + '.ezproxy.its.uu.se' + split[2];
})();
EOD;
  return make_bookmarklet($code);
}


?>
<html>
<head><title>Proxifier bookmarklet</title></head>
<body>
<a href="<?php echo proxifier(); ?>">Proxify</a>
</body>
</html>
