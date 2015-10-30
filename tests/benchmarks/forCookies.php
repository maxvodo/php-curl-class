<?php

call_user_func(function ($bs) {

	abstract class CookiesConsts {
		private static $RFC2616;  private static $RFC6265;
		private static $RFC2616v; private static $RFC6265v;

		public static function Init() {
			self::$RFC2616v = array(
				// RFC2616: "any CHAR except CTLs or separators".
				'!', '#', '$', '%', '&', "'", '*', '+', '-', '.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A',
				'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
				'W', 'X', 'Y', 'Z', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
				'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '|', '~',
			);
			self::$RFC2616 = array_fill_keys(self::$RFC2616v, true);

			self::$RFC6265v = array(
				// RFC6265: "US-ASCII characters excluding CTLs, whitespace DQUOTE, comma, semicolon, and backslash".
				// %x21
				'!',
				// %x23-2B
				'#', '$', '%', '&', "'", '(', ')', '*', '+',
				// %x2D-3A
				'-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':',
				// %x3C-5B
				'<', '=', '>', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
				'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[',
				// %x5D-7E
				']', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q',
				'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~',
			);
			self::$RFC6265 = array_fill_keys(self::$RFC6265v, true);
		}

		public static function RFC2616() {
			return self::$RFC2616;
		}
		public static function RFC2616v() {
			return self::$RFC2616v;
		}

		public static function RFC6265() {
			return self::$RFC6265;
		}
		public static function RFC6265v() {
			return self::$RFC6265v;
		}
	}

	// Output lead tiem for CookiesConsts::Init() method
	{
		$initializeOnce = false;
		$benchmarkSuite = new \Lavoiesl\PhpBenchmark\Benchmark;
		$benchmarkSuite->add(' call CookiesConsts::Init()', function() use(&$initializeOnce) {
			if (!$initializeOnce) {
				$initializeOnce = true;
				CookiesConsts::Init();
			}
		});
		$benchmarkSuite->run();
		echo PHP_EOL;
	}

	function charGenerator() {
		return chr(mt_rand(0, 127));
	};

	$bs->add(' in_array RFC2616', function() {
		$name_char = charGenerator();
		$inArray = in_array($name_char, array(
			// RFC2616: "any CHAR except CTLs or separators".
			'!', '#', '$', '%', '&', "'", '*', '+', '-', '.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A',
			'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
			'W', 'X', 'Y', 'Z', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
			'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '|', '~',) ,
		true);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' array_key_exists RFC2616', function() {
		$name_char = charGenerator();
		$inArray = array_key_exists($name_char, array_fill_keys(array(
			// RFC2616: "any CHAR except CTLs or separators".
			'!', '#', '$', '%', '&', "'", '*', '+', '-', '.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A',
			'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
			'W', 'X', 'Y', 'Z', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
			'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '|', '~',), true)
		);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' predefined in_array RFC2616', function() {
		$name_char = charGenerator();
		$inArray = in_array($name_char, CookiesConsts::RFC2616v(), true);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' predefined array_key_exists RFC2616', function() {
		$name_char = charGenerator();
		$inArray = array_key_exists($name_char, CookiesConsts::RFC2616());
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' in_array RFC6265', function() {
		$name_char = charGenerator();
		$inArray = in_array($name_char, array(
			// RFC6265: "US-ASCII characters excluding CTLs, whitespace DQUOTE, comma, semicolon, and backslash".
			// %x21
			'!',
			// %x23-2B
			'#', '$', '%', '&', "'", '(', ')', '*', '+',
			// %x2D-3A
			'-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':',
			// %x3C-5B
			'<', '=', '>', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
			'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[',
			// %x5D-7E
			']', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q',
			'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~',) ,
		true);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' array_key_exists RFC6265', function() {
		$name_char = charGenerator();
		$inArray = array_key_exists($name_char, array_fill_keys(array(
			// RFC6265: "US-ASCII characters excluding CTLs, whitespace DQUOTE, comma, semicolon, and backslash".
			// %x21
			'!',
			// %x23-2B
			'#', '$', '%', '&', "'", '(', ')', '*', '+',
			// %x2D-3A
			'-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':',
			// %x3C-5B
			'<', '=', '>', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
			'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[',
			// %x5D-7E
			']', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q',
			'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~',), true)
		);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' predefined in_array RFC6265', function() {
		$name_char = charGenerator();
		$inArray = in_array($name_char, CookiesConsts::RFC6265v(), true);
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

	$bs->add(' predefined array_key_exists RFC6265', function() {
		$name_char = charGenerator();
		$inArray = array_key_exists($name_char, CookiesConsts::RFC6265());
		$encoded_char = !$inArray ? rawurlencode($name_char) : $name_char;
	});

}, $benchmarkSuite);