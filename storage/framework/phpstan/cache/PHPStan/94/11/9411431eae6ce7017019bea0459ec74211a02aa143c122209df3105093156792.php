<?php declare(strict_types = 1);

// osfsl-C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/vendor/composer/../milon/barcode/src/Milon/Barcode/DNS1D.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Milon\Barcode\DNS1D
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-ae74320abafff99dcc0753ab1de6a2abb3a4f0f1640df21de758464b5650b085-8.2.26-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Milon\\Barcode\\DNS1D',
        'filename' => 'C:/Users/shehr/OneDrive/Desktop/Personal Projects/PesticidesManagmentSystem/vendor/composer/../milon/barcode/src/Milon/Barcode/DNS1D.php',
      ),
    ),
    'namespace' => 'Milon\\Barcode',
    'name' => 'Milon\\Barcode\\DNS1D',
    'shortName' => 'DNS1D',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Description of DNS1D
 *
 * @author dinesh
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 65,
    'endLine' => 2832,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'barcode_array' => 
      array (
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'name' => 'barcode_array',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * Array representation of barcode.
 * @protected
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 71,
        'endLine' => 71,
        'startColumn' => 5,
        'endColumn' => 29,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'store_path' => 
      array (
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'name' => 'store_path',
        'modifiers' => 2,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * path to save png in getBarcodePNGPath
 * @var <type>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 77,
        'endLine' => 77,
        'startColumn' => 5,
        'endColumn' => 26,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'getBarcodeSVG' => 
      array (
        'name' => 'getBarcodeSVG',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 35,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 89,
                'endLine' => 89,
                'startTokenPos' => 127,
                'startFilePos' => 3959,
                'endTokenPos' => 127,
                'endFilePos' => 3959,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 49,
            'endColumn' => 54,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 89,
                'endLine' => 89,
                'startTokenPos' => 134,
                'startFilePos' => 3967,
                'endTokenPos' => 134,
                'endFilePos' => 3968,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 57,
            'endColumn' => 63,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => '\'black\'',
              'attributes' => 
              array (
                'startLine' => 89,
                'endLine' => 89,
                'startTokenPos' => 141,
                'startFilePos' => 3980,
                'endTokenPos' => 141,
                'endFilePos' => 3986,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 66,
            'endColumn' => 81,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 89,
                'endLine' => 89,
                'startTokenPos' => 148,
                'startFilePos' => 4001,
                'endTokenPos' => 148,
                'endFilePos' => 4004,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 84,
            'endColumn' => 99,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
          'inline' => 
          array (
            'name' => 'inline',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 89,
                'endLine' => 89,
                'startTokenPos' => 155,
                'startFilePos' => 4017,
                'endTokenPos' => 155,
                'endFilePos' => 4021,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 89,
            'endLine' => 89,
            'startColumn' => 102,
            'endColumn' => 116,
            'parameterIndex' => 6,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a SVG string representation of barcode.
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Minimum width of a single bar in user units.
 * @param $h (int) Height of barcode in user units.
 * @param $color (string) Foreground color (in SVG format) for bar elements (background is transparent).
 * @return string SVG code.
 * @protected
 */',
        'startLine' => 89,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodeHTML' => 
      array (
        'name' => 'getBarcodeHTML',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 43,
            'endColumn' => 47,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 137,
                'endLine' => 137,
                'startTokenPos' => 679,
                'startFilePos' => 7403,
                'endTokenPos' => 679,
                'endFilePos' => 7403,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 50,
            'endColumn' => 55,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 137,
                'endLine' => 137,
                'startTokenPos' => 686,
                'startFilePos' => 7411,
                'endTokenPos' => 686,
                'endFilePos' => 7412,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 58,
            'endColumn' => 64,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => '\'black\'',
              'attributes' => 
              array (
                'startLine' => 137,
                'endLine' => 137,
                'startTokenPos' => 693,
                'startFilePos' => 7424,
                'endTokenPos' => 693,
                'endFilePos' => 7430,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 67,
            'endColumn' => 82,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => '0',
              'attributes' => 
              array (
                'startLine' => 137,
                'endLine' => 137,
                'startTokenPos' => 699,
                'startFilePos' => 7444,
                'endTokenPos' => 699,
                'endFilePos' => 7444,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 137,
            'endLine' => 137,
            'startColumn' => 85,
            'endColumn' => 96,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return an HTML representation of barcode.
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (string) Foreground color for bar elements (background is transparent).
 * @param $showcode (int) font size of the shown code, default 0.
 * @return string HTML code.
 * @protected
 */',
        'startLine' => 137,
        'endLine' => 163,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodePNG' => 
      array (
        'name' => 'getBarcodePNG',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 35,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 175,
                'endLine' => 175,
                'startTokenPos' => 1093,
                'startFilePos' => 10412,
                'endTokenPos' => 1093,
                'endFilePos' => 10412,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 49,
            'endColumn' => 54,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 175,
                'endLine' => 175,
                'startTokenPos' => 1100,
                'startFilePos' => 10420,
                'endTokenPos' => 1100,
                'endFilePos' => 10421,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 57,
            'endColumn' => 63,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 175,
                'endLine' => 175,
                'startTokenPos' => 1107,
                'startFilePos' => 10433,
                'endTokenPos' => 1116,
                'endFilePos' => 10446,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 66,
            'endColumn' => 88,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 175,
                'endLine' => 175,
                'startTokenPos' => 1123,
                'startFilePos' => 10461,
                'endTokenPos' => 1123,
                'endFilePos' => 10465,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 175,
            'endLine' => 175,
            'startColumn' => 91,
            'endColumn' => 107,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a PNG image representation of barcode (requires GD or Imagick library).
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return string|false in case of error.
 * @protected
 */',
        'startLine' => 175,
        'endLine' => 244,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodeArray' => 
      array (
        'name' => 'getBarcodeArray',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the array representation of last generated barcode.
 *
 * @return array
 */',
        'startLine' => 251,
        'endLine' => 254,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodePNGPath' => 
      array (
        'name' => 'getBarcodePNGPath',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 49,
            'endColumn' => 53,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 266,
                'endLine' => 266,
                'startTokenPos' => 1898,
                'startFilePos' => 14905,
                'endTokenPos' => 1898,
                'endFilePos' => 14905,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 56,
            'endColumn' => 61,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 266,
                'endLine' => 266,
                'startTokenPos' => 1905,
                'startFilePos' => 14913,
                'endTokenPos' => 1905,
                'endFilePos' => 14914,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 64,
            'endColumn' => 70,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 266,
                'endLine' => 266,
                'startTokenPos' => 1912,
                'startFilePos' => 14926,
                'endTokenPos' => 1921,
                'endFilePos' => 14939,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 73,
            'endColumn' => 95,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 266,
                'endLine' => 266,
                'startTokenPos' => 1928,
                'startFilePos' => 14954,
                'endTokenPos' => 1928,
                'endFilePos' => 14958,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 266,
            'endLine' => 266,
            'startColumn' => 98,
            'endColumn' => 114,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a .png file path which create in server
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return path or false in case of error.
 * @protected
 */',
        'startLine' => 266,
        'endLine' => 335,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodePNGUri' => 
      array (
        'name' => 'getBarcodePNGUri',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 41,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 48,
            'endColumn' => 52,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 347,
                'endLine' => 347,
                'startTokenPos' => 2714,
                'startFilePos' => 19239,
                'endTokenPos' => 2714,
                'endFilePos' => 19239,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 55,
            'endColumn' => 60,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 347,
                'endLine' => 347,
                'startTokenPos' => 2721,
                'startFilePos' => 19247,
                'endTokenPos' => 2721,
                'endFilePos' => 19248,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 63,
            'endColumn' => 69,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 347,
                'endLine' => 347,
                'startTokenPos' => 2728,
                'startFilePos' => 19260,
                'endTokenPos' => 2737,
                'endFilePos' => 19273,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 72,
            'endColumn' => 94,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a .png file path which create in server
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return url or false in case of error.
 * @protected
 */',
        'startLine' => 347,
        'endLine' => 351,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'setBarcode' => 
      array (
        'name' => 'setBarcode',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 360,
            'endLine' => 360,
            'startColumn' => 35,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 360,
            'endLine' => 360,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the barcode.
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @return array barcode array
 * @protected
 */',
        'startLine' => 360,
        'endLine' => 493,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_code39' => 
      array (
        'name' => 'barcode_code39',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 504,
            'endLine' => 504,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'extended' => 
          array (
            'name' => 'extended',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 504,
                'endLine' => 504,
                'startTokenPos' => 3756,
                'startFilePos' => 26487,
                'endTokenPos' => 3756,
                'endFilePos' => 26491,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 504,
            'endLine' => 504,
            'startColumn' => 46,
            'endColumn' => 62,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
          'checksum' => 
          array (
            'name' => 'checksum',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 504,
                'endLine' => 504,
                'startTokenPos' => 3763,
                'startFilePos' => 26506,
                'endTokenPos' => 3763,
                'endFilePos' => 26510,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 504,
            'endLine' => 504,
            'startColumn' => 65,
            'endColumn' => 81,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
 * General-purpose code in very wide use world-wide
 * @param $code (string) code to represent.
 * @param $extended (boolean) if true uses the extended mode.
 * @param $checksum (boolean) if true add a checksum to the code.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 504,
        'endLine' => 589,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'encode_code39_ext' => 
      array (
        'name' => 'encode_code39_ext',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 597,
            'endLine' => 597,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Encode a string to be used for CODE 39 Extended mode.
 * @param $code (string) code to represent.
 * @return encoded string.
 * @protected
 */',
        'startLine' => 597,
        'endLine' => 640,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'checksum_code39' => 
      array (
        'name' => 'checksum_code39',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 648,
            'endLine' => 648,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calculate CODE 39 checksum (modulo 43).
 * @param $code (string) code to represent.
 * @return char checksum.
 * @protected
 */',
        'startLine' => 648,
        'endLine' => 662,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_code93' => 
      array (
        'name' => 'barcode_code93',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 671,
            'endLine' => 671,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * CODE 93 - USS-93
 * Compact code similar to Code 39
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 671,
        'endLine' => 791,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'checksum_code93' => 
      array (
        'name' => 'checksum_code93',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 799,
            'endLine' => 799,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Calculate CODE 93 checksum (modulo 47).
 * @param $code (string) code to represent.
 * @return string checksum code.
 * @protected
 */',
        'startLine' => 799,
        'endLine' => 840,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'checksum_s25' => 
      array (
        'name' => 'checksum_s25',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 848,
            'endLine' => 848,
            'startColumn' => 37,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Checksum for standard 2 of 5 barcodes.
 * @param $code (string) code to process.
 * @return int checksum.
 * @protected
 */',
        'startLine' => 848,
        'endLine' => 863,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_msi' => 
      array (
        'name' => 'barcode_msi',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 874,
            'endLine' => 874,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'checksum' => 
          array (
            'name' => 'checksum',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 874,
                'endLine' => 874,
                'startTokenPos' => 9862,
                'startFilePos' => 42313,
                'endTokenPos' => 9862,
                'endFilePos' => 42317,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 874,
            'endLine' => 874,
            'startColumn' => 43,
            'endColumn' => 59,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * MSI.
 * Variation of Plessey code, with similar applications
 * Contains digits (0 to 9) and encodes the data only in the width of bars.
 * @param $code (string) code to represent.
 * @param $checksum (boolean) if true add a checksum to the code (modulo 11)
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 874,
        'endLine' => 922,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_s25' => 
      array (
        'name' => 'barcode_s25',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 933,
            'endLine' => 933,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'checksum' => 
          array (
            'name' => 'checksum',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 933,
                'endLine' => 933,
                'startTokenPos' => 10341,
                'startFilePos' => 44307,
                'endTokenPos' => 10341,
                'endFilePos' => 44311,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 933,
            'endLine' => 933,
            'startColumn' => 43,
            'endColumn' => 59,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Standard 2 of 5 barcodes.
 * Used in airline ticket marking, photofinishing
 * Contains digits (0 to 9) and encodes the data only in the width of bars.
 * @param $code (string) code to represent.
 * @param $checksum (boolean) if true add a checksum to the code
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 933,
        'endLine' => 965,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'binseq_to_array' => 
      array (
        'name' => 'binseq_to_array',
        'parameters' => 
        array (
          'seq' => 
          array (
            'name' => 'seq',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 975,
            'endLine' => 975,
            'startColumn' => 40,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'bararray' => 
          array (
            'name' => 'bararray',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 975,
            'endLine' => 975,
            'startColumn' => 46,
            'endColumn' => 54,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert binary barcode sequence to DNS1DBarcode barcode array.
 * @param $seq (string) barcode as binary sequence.
 * @param $bararray (array) barcode array.
 * òparam array $bararray DNS1DBarcode barcode array to fill up
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 975,
        'endLine' => 994,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_i25' => 
      array (
        'name' => 'barcode_i25',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1005,
            'endLine' => 1005,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'checksum' => 
          array (
            'name' => 'checksum',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 1005,
                'endLine' => 1005,
                'startTokenPos' => 10910,
                'startFilePos' => 46852,
                'endTokenPos' => 10910,
                'endFilePos' => 46856,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1005,
            'endLine' => 1005,
            'startColumn' => 43,
            'endColumn' => 59,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Interleaved 2 of 5 barcodes.
 * Compact numeric code, widely used in industry, air cargo
 * Contains digits (0 to 9) and encodes the data in the width of both bars and spaces.
 * @param $code (string) code to represent.
 * @param $checksum (boolean) if true add a checksum to the code
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1005,
        'endLine' => 1059,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_c128' => 
      array (
        'name' => 'barcode_c128',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1069,
            'endLine' => 1069,
            'startColumn' => 37,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => 
            array (
              'code' => '\'\'',
              'attributes' => 
              array (
                'startLine' => 1069,
                'endLine' => 1069,
                'startTokenPos' => 11502,
                'startFilePos' => 49068,
                'endTokenPos' => 11502,
                'endFilePos' => 49069,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1069,
            'endLine' => 1069,
            'startColumn' => 44,
            'endColumn' => 53,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * C128 barcodes.
 * Very capable code, excellent density, high reliability; in very wide use world-wide
 * @param $code (string) code to represent.
 * @param $type (string) barcode type: A, B, C or empty for automatic switch (AUTO mode)
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1069,
        'endLine' => 1391,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcodeGs1128' => 
      array (
        'name' => 'barcodeGs1128',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1401,
            'endLine' => 1401,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * GS1_128 barcodes.
 * Very capable code, excellent density, high reliability; in very wide use world-wide
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1401,
        'endLine' => 1532,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'get128ABsequence' => 
      array (
        'name' => 'get128ABsequence',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1540,
            'endLine' => 1540,
            'startColumn' => 41,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Split text code in A/B sequence for 128 code
 * @param $code (string) code to split.
 * @return array sequence
 * @protected
 */',
        'startLine' => 1540,
        'endLine' => 1567,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_eanupc' => 
      array (
        'name' => 'barcode_eanupc',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1579,
            'endLine' => 1579,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'len' => 
          array (
            'name' => 'len',
            'default' => 
            array (
              'code' => '13',
              'attributes' => 
              array (
                'startLine' => 1579,
                'endLine' => 1579,
                'startTokenPos' => 15597,
                'startFilePos' => 69762,
                'endTokenPos' => 15597,
                'endFilePos' => 69763,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1579,
            'endLine' => 1579,
            'startColumn' => 46,
            'endColumn' => 54,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * EAN13 and UPC-A barcodes.
 * EAN13: European Article Numbering international retail product code
 * UPC-A: Universal product code seen on almost all retail products in the USA and Canada
 * UPC-E: Short version of UPC symbol
 * @param $code (string) code to represent.
 * @param $len (string) barcode type: 6 = UPC-E, 8 = EAN8, 13 = EAN13, 12 = UPC-A
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1579,
        'endLine' => 1768,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_eanext' => 
      array (
        'name' => 'barcode_eanext',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1779,
            'endLine' => 1779,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'len' => 
          array (
            'name' => 'len',
            'default' => 
            array (
              'code' => '5',
              'attributes' => 
              array (
                'startLine' => 1779,
                'endLine' => 1779,
                'startTokenPos' => 17944,
                'startFilePos' => 77345,
                'endTokenPos' => 17944,
                'endFilePos' => 77345,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1779,
            'endLine' => 1779,
            'startColumn' => 46,
            'endColumn' => 53,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * UPC-Based Extentions
 * 2-Digit Ext.: Used to indicate magazines and newspaper issue numbers
 * 5-Digit Ext.: Used to mark suggested retail price of books
 * @param $code (string) code to represent.
 * @param $len (string) barcode type: 2 = 2-Digit, 5 = 5-Digit
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1779,
        'endLine' => 1844,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_postnet' => 
      array (
        'name' => 'barcode_postnet',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1854,
            'endLine' => 1854,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'planet' => 
          array (
            'name' => 'planet',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 1854,
                'endLine' => 1854,
                'startTokenPos' => 18718,
                'startFilePos' => 80157,
                'endTokenPos' => 18718,
                'endFilePos' => 80161,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1854,
            'endLine' => 1854,
            'startColumn' => 47,
            'endColumn' => 61,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * POSTNET and PLANET barcodes.
 * Used by U.S. Postal Service for automated mail sorting
 * @param $code (string) zip code to represent. Must be a string containing a zip code of the form DDDDD or DDDDD-DDDD.
 * @param $planet (boolean) if true print the PLANET barcode, otherwise print POSTNET
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1854,
        'endLine' => 1916,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_rms4cc' => 
      array (
        'name' => 'barcode_rms4cc',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1927,
            'endLine' => 1927,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'kix' => 
          array (
            'name' => 'kix',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 1927,
                'endLine' => 1927,
                'startTokenPos' => 19735,
                'startFilePos' => 83117,
                'endTokenPos' => 19735,
                'endFilePos' => 83121,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 1927,
            'endLine' => 1927,
            'startColumn' => 46,
            'endColumn' => 57,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * RMS4CC - CBC - KIX
 * RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code) - KIX (Klant index - Customer index)
 * RM4SCC is the name of the barcode symbology used by the Royal Mail for its Cleanmail service.
 * @param $code (string) code to print
 * @param $kix (boolean) if true prints the KIX variation (doesn\'t use the start and end symbols, and the checksum) - in this case the house number must be sufficed with an X and placed at the end of the code.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 1927,
        'endLine' => 2069,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_codabar' => 
      array (
        'name' => 'barcode_codabar',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2078,
            'endLine' => 2078,
            'startColumn' => 40,
            'endColumn' => 44,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * CODABAR barcodes.
 * Older code often used in library systems, sometimes in blood banks
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 2078,
        'endLine' => 2125,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_code11' => 
      array (
        'name' => 'barcode_code11',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2134,
            'endLine' => 2134,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * CODE11 barcodes.
 * Used primarily for labeling telecommunications equipment
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 2134,
        'endLine' => 2216,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_pharmacode' => 
      array (
        'name' => 'barcode_pharmacode',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2225,
            'endLine' => 2225,
            'startColumn' => 43,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Pharmacode
 * Contains digits (0 to 9)
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 2225,
        'endLine' => 2242,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_pharmacode2t' => 
      array (
        'name' => 'barcode_pharmacode2t',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2251,
            'endLine' => 2251,
            'startColumn' => 45,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Pharmacode two-track
 * Contains digits (0 to 9)
 * @param $code (string) code to represent.
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 2251,
        'endLine' => 2302,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'barcode_imb' => 
      array (
        'name' => 'barcode_imb',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2313,
            'endLine' => 2313,
            'startColumn' => 36,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200
 * (requires PHP bcmath extension)
 * Intelligent Mail barcode is a 65-bar code for use on mail in the United States.
 * The fields are described as follows:<ul><li>The Barcode Identifier shall be assigned by USPS to encode the presort identification that is currently printed in human readable form on the optional endorsement line (OEL) as well as for future USPS use. This shall be two digits, with the second digit in the range of 0–4. The allowable encoding ranges shall be 00–04, 10–14, 20–24, 30–34, 40–44, 50–54, 60–64, 70–74, 80–84, and 90–94.</li><li>The Service Type Identifier shall be assigned by USPS for any combination of services requested on the mailpiece. The allowable encoding range shall be 000http://it2.php.net/manual/en/function.dechex.php–999. Each 3-digit value shall correspond to a particular mail class with a particular combination of service(s). Each service program, such as OneCode Confirm and OneCode ACS, shall provide the list of Service Type Identifier values.</li><li>The Mailer or Customer Identifier shall be assigned by USPS as a unique, 6 or 9 digit number that identifies a business entity. The allowable encoding range for the 6 digit Mailer ID shall be 000000- 899999, while the allowable encoding range for the 9 digit Mailer ID shall be 900000000-999999999.</li><li>The Serial or Sequence Number shall be assigned by the mailer for uniquely identifying and tracking mailpieces. The allowable encoding range shall be 000000000–999999999 when used with a 6 digit Mailer ID and 000000-999999 when used with a 9 digit Mailer ID. e. The Delivery Point ZIP Code shall be assigned by the mailer for routing the mailpiece. This shall replace POSTNET for routing the mailpiece to its final delivery point. The length may be 0, 5, 9, or 11 digits. The allowable encoding ranges shall be no ZIP Code, 00000–99999,  000000000–999999999, and 00000000000–99999999999.</li></ul>
 * @param $code (string) code to print, separate the ZIP (routing code) from the rest using a minus char \'-\' (BarcodeID_ServiceTypeID_MailerID_SerialNumber-RoutingCode)
 * @return array barcode representation.
 * @protected
 */',
        'startLine' => 2313,
        'endLine' => 2429,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'dec_to_hex' => 
      array (
        'name' => 'dec_to_hex',
        'parameters' => 
        array (
          'number' => 
          array (
            'name' => 'number',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2437,
            'endLine' => 2437,
            'startColumn' => 35,
            'endColumn' => 41,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert large integer number to hexadecimal representation.
 * (requires PHP bcmath extension)
 * @param $number (string) number to convert specified as a string
 * @return string hexadecimal representation
 */',
        'startLine' => 2437,
        'endLine' => 2453,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'hex_to_dec' => 
      array (
        'name' => 'hex_to_dec',
        'parameters' => 
        array (
          'hex' => 
          array (
            'name' => 'hex',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2461,
            'endLine' => 2461,
            'startColumn' => 35,
            'endColumn' => 38,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert large hexadecimal number to decimal representation (string).
 * (requires PHP bcmath extension)
 * @param $hex (string) hexadecimal number to convert specified as a string
 * @return string hexadecimal representation
 */',
        'startLine' => 2461,
        'endLine' => 2470,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'imb_crc11fcs' => 
      array (
        'name' => 'imb_crc11fcs',
        'parameters' => 
        array (
          'code_arr' => 
          array (
            'name' => 'code_arr',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2478,
            'endLine' => 2478,
            'startColumn' => 37,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Intelligent Mail Barcode calculation of Frame Check Sequence
 * @param $code_arr (string) array of hexadecimal values (13 bytes holding 102 bits right justified).
 * @return int 11 bit Frame Check Sequence as integer (decimal base)
 * @protected
 */',
        'startLine' => 2478,
        'endLine' => 2506,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'imb_reverse_us' => 
      array (
        'name' => 'imb_reverse_us',
        'parameters' => 
        array (
          'num' => 
          array (
            'name' => 'num',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2514,
            'endLine' => 2514,
            'startColumn' => 39,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Reverse unsigned short value
 * @param $num (int) value to reversr
 * @return int reversed value
 * @protected
 */',
        'startLine' => 2514,
        'endLine' => 2522,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'imb_tables' => 
      array (
        'name' => 'imb_tables',
        'parameters' => 
        array (
          'n' => 
          array (
            'name' => 'n',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2531,
            'endLine' => 2531,
            'startColumn' => 35,
            'endColumn' => 36,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'size' => 
          array (
            'name' => 'size',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2531,
            'endLine' => 2531,
            'startColumn' => 39,
            'endColumn' => 43,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * generate Nof13 tables used for Intelligent Mail Barcode
 * @param $n (int) is the type of table: 2 for 2of13 table, 5 for 5of13table
 * @param $size (int) size of table (78 for n=2 and 1287 for n=5)
 * @return array requested table
 * @protected
 */',
        'startLine' => 2531,
        'endLine' => 2560,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'checkfile' => 
      array (
        'name' => 'checkfile',
        'parameters' => 
        array (
          'path' => 
          array (
            'name' => 'path',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2562,
            'endLine' => 2562,
            'startColumn' => 34,
            'endColumn' => 38,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 2562,
        'endLine' => 2567,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'setStorPath' => 
      array (
        'name' => 'setStorPath',
        'parameters' => 
        array (
          'path' => 
          array (
            'name' => 'path',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2569,
            'endLine' => 2569,
            'startColumn' => 33,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 2569,
        'endLine' => 2572,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'upce2a' => 
      array (
        'name' => 'upce2a',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2580,
            'endLine' => 2580,
            'startColumn' => 31,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Convert UPC-E to UPC-A
 * @param $code (string) code to represent.
 * @return string upc-a value of upc-e
 * @protected
 */',
        'startLine' => 2580,
        'endLine' => 2626,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodeJPG' => 
      array (
        'name' => 'getBarcodeJPG',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 35,
            'endColumn' => 39,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 2639,
                'endLine' => 2639,
                'startTokenPos' => 26762,
                'startFilePos' => 110876,
                'endTokenPos' => 26762,
                'endFilePos' => 110876,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 49,
            'endColumn' => 54,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 2639,
                'endLine' => 2639,
                'startTokenPos' => 26769,
                'startFilePos' => 110884,
                'endTokenPos' => 26769,
                'endFilePos' => 110885,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 57,
            'endColumn' => 63,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 2639,
                'endLine' => 2639,
                'startTokenPos' => 26776,
                'startFilePos' => 110897,
                'endTokenPos' => 26785,
                'endFilePos' => 110910,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 66,
            'endColumn' => 88,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 2639,
                'endLine' => 2639,
                'startTokenPos' => 26792,
                'startFilePos' => 110925,
                'endTokenPos' => 26792,
                'endFilePos' => 110929,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2639,
            'endLine' => 2639,
            'startColumn' => 91,
            'endColumn' => 107,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a JPG image representation of barcode (requires GD or Imagick library).
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return string|false in case of error.
 * @protected
 */',
        'startLine' => 2639,
        'endLine' => 2709,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodeJPGPath' => 
      array (
        'name' => 'getBarcodeJPGPath',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 42,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 49,
            'endColumn' => 53,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 2722,
                'endLine' => 2722,
                'startTokenPos' => 27526,
                'startFilePos' => 115166,
                'endTokenPos' => 27526,
                'endFilePos' => 115166,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 56,
            'endColumn' => 61,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 2722,
                'endLine' => 2722,
                'startTokenPos' => 27533,
                'startFilePos' => 115174,
                'endTokenPos' => 27533,
                'endFilePos' => 115175,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 64,
            'endColumn' => 70,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 2722,
                'endLine' => 2722,
                'startTokenPos' => 27540,
                'startFilePos' => 115187,
                'endTokenPos' => 27549,
                'endFilePos' => 115200,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 73,
            'endColumn' => 95,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
          'showCode' => 
          array (
            'name' => 'showCode',
            'default' => 
            array (
              'code' => 'false',
              'attributes' => 
              array (
                'startLine' => 2722,
                'endLine' => 2722,
                'startTokenPos' => 27556,
                'startFilePos' => 115215,
                'endTokenPos' => 27556,
                'endFilePos' => 115219,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2722,
            'endLine' => 2722,
            'startColumn' => 98,
            'endColumn' => 114,
            'parameterIndex' => 5,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a .jpg file path which create in server
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return path or false in case of error.
 * @protected
 */',
        'startLine' => 2722,
        'endLine' => 2791,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      'getBarcodeJPGUri' => 
      array (
        'name' => 'getBarcodeJPGUri',
        'parameters' => 
        array (
          'code' => 
          array (
            'name' => 'code',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2803,
            'endLine' => 2803,
            'startColumn' => 41,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2803,
            'endLine' => 2803,
            'startColumn' => 48,
            'endColumn' => 52,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'w' => 
          array (
            'name' => 'w',
            'default' => 
            array (
              'code' => '2',
              'attributes' => 
              array (
                'startLine' => 2803,
                'endLine' => 2803,
                'startTokenPos' => 28322,
                'startFilePos' => 119477,
                'endTokenPos' => 28322,
                'endFilePos' => 119477,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2803,
            'endLine' => 2803,
            'startColumn' => 55,
            'endColumn' => 60,
            'parameterIndex' => 2,
            'isOptional' => true,
          ),
          'h' => 
          array (
            'name' => 'h',
            'default' => 
            array (
              'code' => '30',
              'attributes' => 
              array (
                'startLine' => 2803,
                'endLine' => 2803,
                'startTokenPos' => 28329,
                'startFilePos' => 119485,
                'endTokenPos' => 28329,
                'endFilePos' => 119486,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2803,
            'endLine' => 2803,
            'startColumn' => 63,
            'endColumn' => 69,
            'parameterIndex' => 3,
            'isOptional' => true,
          ),
          'color' => 
          array (
            'name' => 'color',
            'default' => 
            array (
              'code' => 'array(0, 0, 0)',
              'attributes' => 
              array (
                'startLine' => 2803,
                'endLine' => 2803,
                'startTokenPos' => 28336,
                'startFilePos' => 119498,
                'endTokenPos' => 28345,
                'endFilePos' => 119511,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2803,
            'endLine' => 2803,
            'startColumn' => 72,
            'endColumn' => 94,
            'parameterIndex' => 4,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return a .jpg file path which create in server
 * @param $code (string) code to print
 * @param $type (string) type of barcode: <ul><li>C39 : CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.</li><li>C39+ : CODE 39 with checksum</li><li>C39E : CODE 39 EXTENDED</li><li>C39E+ : CODE 39 EXTENDED + CHECKSUM</li><li>C93 : CODE 93 - USS-93</li><li>S25 : Standard 2 of 5</li><li>S25+ : Standard 2 of 5 + CHECKSUM</li><li>I25 : Interleaved 2 of 5</li><li>I25+ : Interleaved 2 of 5 + CHECKSUM</li><li>C128 : CODE 128</li><li>C128A : CODE 128 A</li><li>C128B : CODE 128 B</li><li>C128C : CODE 128 C</li><li>EAN2 : 2-Digits UPC-Based Extention</li><li>EAN5 : 5-Digits UPC-Based Extention</li><li>EAN8 : EAN 8</li><li>EAN13 : EAN 13</li><li>UPCA : UPC-A</li><li>UPCE : UPC-E</li><li>MSI : MSI (Variation of Plessey code)</li><li>MSI+ : MSI + CHECKSUM (modulo 11)</li><li>POSTNET : POSTNET</li><li>PLANET : PLANET</li><li>RMS4CC : RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)</li><li>KIX : KIX (Klant index - Customer index)</li><li>IMB: Intelligent Mail Barcode - Onecode - USPS-B-3200</li><li>CODABAR : CODABAR</li><li>CODE11 : CODE 11</li><li>PHARMA : PHARMACODE</li><li>PHARMA2T : PHARMACODE TWO-TRACKS</li></ul>
 * @param $w (int) Width of a single bar element in pixels.
 * @param $h (int) Height of a single bar element in pixels.
 * @param $color (array) RGB (0-255) foreground color for bar elements (background is transparent).
 * @return url or false in case of error.
 * @protected
 */',
        'startLine' => 2803,
        'endLine' => 2807,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      '__call' => 
      array (
        'name' => '__call',
        'parameters' => 
        array (
          'method' => 
          array (
            'name' => 'method',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2816,
            'endLine' => 2816,
            'startColumn' => 28,
            'endColumn' => 34,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2816,
            'endLine' => 2816,
            'startColumn' => 37,
            'endColumn' => 47,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Handle dynamic method calls.
 *
 * @param  string  $method
 * @param  array  $parameters
 * @return mixed
 */',
        'startLine' => 2816,
        'endLine' => 2819,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
      '__callStatic' => 
      array (
        'name' => '__callStatic',
        'parameters' => 
        array (
          'method' => 
          array (
            'name' => 'method',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2828,
            'endLine' => 2828,
            'startColumn' => 41,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'parameters' => 
          array (
            'name' => 'parameters',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 2828,
            'endLine' => 2828,
            'startColumn' => 50,
            'endColumn' => 60,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Handle dynamic static method calls.
 *
 * @param  string  $method
 * @param  array  $parameters
 * @return mixed
 */',
        'startLine' => 2828,
        'endLine' => 2831,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Milon\\Barcode',
        'declaringClassName' => 'Milon\\Barcode\\DNS1D',
        'implementingClassName' => 'Milon\\Barcode\\DNS1D',
        'currentClassName' => 'Milon\\Barcode\\DNS1D',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));