<?php
require_once('PEAR/PackageFileManager2.php');
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$packagefile = './package.xml';

$options = array(
    'filelistgenerator' => 'cvs',
    'changelogoldtonew' => false,
    'simpleoutput'      => true,
    'baseinstalldir'    => '/',
    'packagedirectory'  => './',
    'packagefile'       => $packagefile,
    'clearcontents'     => false,
    'ignore'            => array('generate_package_xml.php', '.svn', '.cvs*'),
    'dir_roles'         => array(
        'docs'     => 'doc',
        'examples' => 'doc',
        'tests'    => 'test',
    ),
);

$packagexml = &PEAR_PackageFileManager2::importOptions($packagefile, $options);
$packagexml->setPackageType('php');

$packagexml->setPackage('Crypt_DiffieHellman');
$packagexml->setSummary('Implementation of Diffie-Hellman Key Exchange cryptographic protocol for PHP5');
$packagexml->setDescription("Implementation of the Diffie-Hellman Key Exchange cryptographic protocol\nin PHP5. Enables two parties without any prior knowledge of each other\nestablish a secure shared secret key across an insecure channel\nof communication.");

$packagexml->setChannel('pear.php.net');

$notes = <<EOT
* Initial release!
* Updated tests location inside directory hierarchy for easier running
* Fixed a PHP variable undefined notice
* Full support for three input/output modes: Number (big integer string, Binary and Btwoc (big-endian twos complement)
* Allowed for a specific BigInteger extension to be selected for use from the Crypt_DiffieHellman contructor
* Minor typo fixes against PEAR Coding Standard
EOT;
$packagexml->setNotes($notes);

$packagexml->setPhpDep('5.0.0');
$packagexml->setPearinstallerDep('1.4.0b1');
$packagexml->addPackageDepWithChannel('required', 'PEAR', 'pear.php.net', '1.3.6');

$packagexml->addMaintainer('lead', 'padraic', 'Pádraic Brady', 'padraic@php.net');
$packagexml->setLicense('New BSD License', 'http://opensource.org/licenses/bsd-license.php');

$packagexml->addRelease();
$packagexml->generateContents();

$packagexml->setAPIVersion('0.2.0');
$packagexml->setReleaseVersion('0.2.0');
$packagexml->setReleaseStability('beta');
$packagexml->setAPIStability('beta');

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $packagexml->writePackageFile();
} else {
    $packagexml->debugPackageFile();
}