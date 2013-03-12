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
    location.href = split[1] + 'PROXY' + split[2];
})();
EOD;
  return make_bookmarklet($code);
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Proxifier bookmarklet</title>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
var bookmarklet = "<?php echo proxifier(); ?>";
</script>
<script src="proxifier.js"></script>
<style>
.bookmarklet {
  border: 3px solid #005000;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  background-color: #ccffcc;
  padding: 5px;
  text-decoration: none;
  color: black;
}
.bookmarklet:hover {
  background-color: #ddffcc;
}
.marg {
  display: block;
  margin-top: 20px;
}
</style>
</head>
<body>

<p>My university has a proxy that lets you access journals they
subscribe to by appending <tt>.ezproxy.its.uu.se</tt> to the host part
of the URL (and then log in). I bet there are lots of similar
services. I wrote a little bookmarklet to add such proxy endings to
URLs with a single click. (<a
href="https://github.com/skagedal/proxifier">Code at Github.</a>)</p>

<p>URL to append (including initial dot): 
<input type="text" id="proxy"></input>
<button id="create">Create bookmarklet</button>
</p>

<div id="bookmarklets"></div>
<!-- <a href="<?php echo proxifier(); ?>">Proxify</a> -->

<p id="info">(Bookmark above link, go to the page whose URL you want to modify,
click bookmark!)</p>

</body>
</html>
