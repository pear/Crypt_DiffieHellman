<?php
require_once('PEAR/PackageFileManager2.php');
PEAR::setErrorHandling(PEAR_ERROR_DIE);
//require_once 'PEAR/Config.php';
//PEAR_Config::singleton('/path/to/unusualpearconfig.ini');
// use the above lines if the channel information is not validating
$packagexml = new PEAR_PackageFileManager2;
// for an existing package.xml use
// $packagexml = {@link importOptions()} instead
$e = $packagexml->setOptions(
    array('baseinstalldir' => 'Crypt',
     'packagedirectory' => 'D:/xampp/htdocs/projects/pear/trunk/Crypt_DiffieHellman',
     'filelistgenerator' => 'file',
     'dir_roles' => array('docs' => 'doc', 'tests' => 'test'),
     'ignore' => array('generate_package_xml.php', '.svn', '.cvs')
    )
);
$packagexml->setPackage('Crypt_DiffieHellman');
$packagexml->setSummary('Implementation of Diffie-Hellman Key Exchange cryptographic protocol for PHP5');
$packagexml->setDescription("Implementation of the Diffie-Hellman Key Exchange cryptographic protocol\nin PHP5. Enables two parties without any prior knowledge of each other\nestablish a secure shared secret key across an insecure channel\nof communication.");
$packagexml->setChannel('pear.php.net');
$packagexml->setAPIVersion('0.1.0');
$packagexml->setReleaseVersion('0.1.0a3');
$packagexml->setReleaseStability('alpha');
$packagexml->setAPIStability('alpha');
$packagexml->setNotes("* Updated tests location inside directory hierarchy for easier running\n* Fixed a PHP variable undefined notice\n* Full support for three input/output modes: Number (big integer string, Binary and Btwoc (big-endian two's complement)\n* Allowed for a specific BigInteger extension to be selected for use from the Crypt_DiffieHellman contructor\n* Minor typo fixes against PEAR Coding Standard\n* ");
$packagexml->setPackageType('php');
$packagexml->setPhpDep('5.0.0');
$packagexml->setPearinstallerDep('1.4.0');
$packagexml->addMaintainer('lead', 'padraic', 'Pádraic Brady', 'padraic@php.net');
$packagexml->setLicense('New BSD License', 'http://opensource.org/licenses/bsd-license.php');
$packagexml->generateContents();

//$pkg = &$packagexml->exportCompatiblePackageFile1(); // get a PEAR_PackageFile object

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    //$pkg->writePackageFile();
    $packagexml->writePackageFile();
} else {
    //$pkg->debugPackageFile();
    $packagexml->debugPackageFile();
}
?>