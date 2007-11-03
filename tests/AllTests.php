<?php

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Crypt_DiffieHellman_AllTests::main');
}

require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

require_once 'TestHelper.php';
require_once 'DiffieHellmanTest.php';

class Crypt_DiffieHellman_AllTests
{
    public static function main()
    {
        $parameters = array();

        if (TESTS_GENERATE_REPORT && extension_loaded('xdebug')) {
            $parameters['reportDirectory'] = TESTS_GENERATE_REPORT_TARGET;
        }
        PHPUnit_TextUI_TestRunner::run(self::suite(), $parameters);
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PEAR - Crypt_DiffieHellman');

        $suite->addTestSuite('Crypt_DiffieHellmanTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'Crypt_DiffieHellman_AllTests::main') {
    Crypt_DiffieHellman_AllTests::main();
}
