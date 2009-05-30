<?php
require_once('PEAR/PackageFileManager2.php');
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$options = array(
    'filelistgenerator' => 'cvs',
    'changelogoldtonew' => false,
    'simpleoutput'      => true,
    'baseinstalldir'    => 'Crypt',
    'packagedirectory'  => dirname(__FILE__),
    'clearcontents'     => true,
    'ignore'            => array('generate_package_xml.php', '.svn', '.cvs*'),
    'dir_roles'         => array(
        'docs'     => 'doc',
        'examples' => 'doc',
        'tests'    => 'test',
    ),
);

$packagexml = &PEAR_PackageFileManager2::importOptions('package.xml', $options);
$packagexml->setPackageType('php');

$packagexml->setPackage('Crypt_DiffieHellman');
$packagexml->setSummary('Implementation of Diffie-Hellman Key Exchange cryptographic protocol for PHP5');
$packagexml->setDescription("Implementation of the Diffie-Hellman Key Exchange cryptographic protocol\nin PHP5. Enables two parties without any prior knowledge of each other\nestablish a secure shared secret key across an insecure channel\nof communication.");

$packagexml->setChannel('pear.php.net');

$notes = <<<EOT
* Fixed Bug #16214
* Fixed Bug #15682
EOT;
$packagexml->setNotes($notes);

$packagexml->detectDependencies();

$packagexml->addMaintainer('lead', 'shupp', 'Bill Shupp', 'shupp@php.net');
$packagexml->setLicense('New BSD License', 'http://opensource.org/licenses/bsd-license.php');

$packagexml->addRelease();
$packagexml->generateContents();

$packagexml->setAPIVersion('0.2.2');
$packagexml->setReleaseVersion('0.2.2');
$packagexml->setReleaseStability('beta');
$packagexml->setAPIStability('beta');

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $packagexml->writePackageFile();
} else {
    $packagexml->debugPackageFile();
}
