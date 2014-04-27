<?php


	//////////////////////////////////////////////////////////////////////////////////////////
	// New format_comment code 

	$bbcode_tags = array(
		"b_open"	=> '<strong>',
		"b_close"	=> '</strong>',
		"i_open"	=> '<i>',
		"i_close"	=> '</i>',
		"u_open"	=> '<u>',
		"u_close"	=> '</u>',
		"pre_open"	=> '<tt><span style="white-space: nowrap;">',
		"pre_close"	=> '</span></tt>',
		"code_open"	=> '',
		"code_close"	=> '',
		"color_open_v"	=> '<font color="\1">',
		"color_open_m"	=> '(([a-z]+)|(#[a-f0-9]{6}))',
		"color_close"	=> '</font>',
		"size_open_v"	=> '<font size="\1">',
		"size_open_m"	=> '([1-7])',
		"size_close"	=> '</font>',
		"font_open_v"	=> '<font face="\1">',
		"font_open_m"	=> '([a-z ,]+)',
		"font_close"	=> '</font>',
		"quote_open"	=> '<div class="quote">'
					.'<p class="sub"><b>Quote:</b></p>'
					.'<table class="main" border="1" cellspacing="0" cellpadding="10">'
					.'<tr><td style="border: 1px black dotted">',
	  	"quote_open_v"	=> '<div class="quote">'
					.'<p class="sub"><b>\1 wrote:</b></p>'
					.'<table class="main" border="1" cellspacing="0" cellpadding="10">'
					.'<tr><td style="border: 1px black dotted">',
		"quote_open_m"	=> '(.+?)',
		"quote_close"	=> '</td></tr></table></div><br />',
	);

	// This isn't just a set of preg_replace()'s, since preg_replace() barfs when
	// it matches really large blocks of text - something you get with [pre] and
	// [quote] quite often.
	function format_block($s, $bbcode) {
		global $bbcode_tags;

		while ($old_s != $s) {
			$old_s = $s;

			//find first occurrence of [/bbcode]
			$close = stripos($s, "[/".$bbcode."]");
			if ($close === false)
				return $s;

			//find last [bbcode] before first [/bbcode]
			$open = strripos(substr($s,0,$close), "[".$bbcode);
			if ($open === false)
				return $s;

			// Break out the block of text to work on.
			$block = substr($s,$open,$close - $open + strlen($bbcode) + 3); // 3 = "[/]"

			// Build a pattern for the opening tag to test its validity
			$pattern = "";
			if (isset($bbcode_tags[$bbcode . "_open_v"])) {
				$pattern = "=" . $bbcode_tags[$bbcode . "_open_m"];
				if (isset($bbcode_tags[$bbcode . "_open"])) {
					$pattern = "(" . $pattern . ")?";
				}
			}
			$pattern = "/^\[" . $bbcode . $pattern . "\]/i";

			// Now we test that validity, and act appropriately
			if (preg_match($pattern, $block)) {

				//replace "[bbcode]"
				if (isset($bbcode_tags[$bbcode . "_open"])) {
					$block = str_ireplace( "[" . $bbcode . "]", $bbcode_tags[$bbcode . "_open"], $block);
				}

				//replace "[bbcode=Text]"
				if (isset($bbcode_tags[$bbcode . "_open_v"])) {
					$block = preg_replace(
						"/\[".$bbcode."=".$bbcode_tags[$bbcode . "_open_m"]."\]/i",
						$bbcode_tags[$bbcode . "_open_v"],
						$block);
				}

				//replace "[/bbcode]"
				$block = str_ireplace( "[/" . $bbcode . "]", $bbcode_tags[$bbcode . "_close"], $block);

			} else {
				// Tag(s) is/are invalid, so we replace it/them with html entities to avoid further parsing of it.
				$block = preg_replace(":\[(/?$bbcode):i", "&#91;\\1", $block);
			}

			$s = substr($s,0,$open) . $block . substr($s,$close + strlen($bbcode) + 3);
		}

		return $s;
	}

	function format_uris($s) {
		// Since URIs are not "long", or large blocks of text, we shouldn't need to
		// Jump through the hoops that we do for other types of blocks - but we need to
		// process them seperately, since we do manipulate the content in between the tags.

		// find bare URLs, and prepare them for encoding into links as well
		$s =  preg_replace(
		"/(\A|[^=\]'\">a-zA-Z0-9])([(]?(http|ftp|irc)s?:\/\/[^<>\s]+)/i",
		    "\\1[url]\\2[/url]", $s);

		// Search for URL tags to manipulate
		while (preg_match('/\[url(=([^()<>\s]+?)\](.+?)|\]([^<>\s]+?))\[\/url\]/i', $s, $matches)) {
			$has_parens = false;

			if ($matches[1][0] == '=') {
				// We have a "[url=..]..[/url]" match
				$url = $matches[2];
				$text = $matches[3];
			} else {
				$url = $text = $matches[4];
				// Strip any bounding parenthesis..
				if (preg_match('/^\((.*)\)$/', $url, $m)) {
					$url = $text = $m[1];
					$has_parens = true;
				}
				if (strlen($text) > 60) {
					$text = substr($text,0,35) . "..." . substr($text,-15);
				}
			}

			// If we're 'local', remove the proto://host part, otherwise use redir script.
			// Or, if there's no protocol at the start, we just link it - it'll be local by
			// the user.
			if (preg_match("#^https?://".$_SERVER["HTTP_HOST"]."#i", $url, $match)) {
				$url = str_replace($match[0], "", $url);
			//} elseif ($url[0] != '/') {
			} elseif (preg_match("#^https?://#i", $url)) {
				$url = str_replace("#", "%23", $url);
				$url = '/redir.php?url=&quot;' . $url . '&quot;';
			}

			$html = '<a class="plain" style="text-decoration: underline;" href="'.$url.'">'.$text.'</a>';
			if ($has_parens) $html = '(' . $html . ')';

			// Replace with html!
			$s = str_replace($matches[0], $html, $s);
		}

		// Search for image tags to manipulate
		while (preg_match('/\[img(=([^()<>\s]+?)\]|\]([^()<>\s]+?)\[\/img\])/i', $s, $matches)) {

			$idx = ($matches[1][0] == '=') ? 2 : 3;
			$img = $alt = $matches[$idx];

			// If we're 'local', remove the proto://host part, otherwise use redir script.
			// Or, if there's no protocol at the start, we just link it - it'll be local by
			// the user.
			if (preg_match("#^https?://".$_SERVER["HTTP_HOST"]."#i", $img, $match)) {
				$img = str_replace($match[0], "", $img);
			//} elseif (preg_match("#^https?://#i", $url)) {
			//	$img = '/imgredir.php?img=&quot;' . $img . '&quot;';
			}

			// Replace with html!
			$s = str_replace($matches[0], "<img border=\"0\" src=\"$img\" alt=\"$alt\" />", $s);
		}

		return $s;
	}

	function format_comment($text, $strip_html = true) {

		$s = $text;

		if ($strip_html)
			$s = htmlspecialchars($s);

		// Now we convert those 'escaped' bbcodes so that they won't be parsed
		$s = str_replace(array("\\:","\\["), array("&#58;","&#91;"), $s);

		// [*]
		$s = preg_replace("/\[\*\]/", "<li>", $s);

		$s = format_block($s, "b");
		$s = format_block($s, "i");
		$s = format_block($s, "u");
		$s = format_block($s, "color");
		$s = format_block($s, "size");
		$s = format_block($s, "font");
		$s = format_block($s, "quote");
		$s = format_block($s, "pre");

		// URLs
		$s = format_uris($s);

		// Linebreaks
		$s = nl2br($s);

		// Maintain spacing
		$s = str_replace("  ", " &nbsp;", $s);

		return $s;
	}
?>
