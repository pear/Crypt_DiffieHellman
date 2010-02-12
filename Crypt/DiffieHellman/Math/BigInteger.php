<?php
/**
 * Math extension wrapper for DiffieHellman with some additional helper
 * methods for RNG and binary conversion.
 *
 * PHP version 5
 *
 * LICENSE:
 * 
 * Copyright (c) 2005-2007, Pádraic Brady <padraic.brady@yahoo.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the 
 *      documentation and/or other materials provided with the distribution.
 *    * The name of the author may not be used to endorse or promote products 
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category    Encryption
 * @package     Crypt_DiffieHellman
 * @author      Pádraic Brady <padraic.brady@yahoo.com>
 * @license     http://opensource.org/licenses/bsd-license.php New BSD License
 * @version     $Id$
 * @link        http://
 */

/** Crypt_DiffieHellman_Math_BigInteger_Interface */
require_once 'Crypt/DiffieHellman/Math/BigInteger/Interface.php';

/**
 * Crypt_DiffieHellman_Math_BigInteger class
 * 
 * @category   Encryption
 * @package    Crypt_DiffieHellman
 * @author     Pádraic Brady <padraic.brady@yahoo.com>
 * @copyright  2005-2007 Pádraic Brady
 * @license    http://opensource.org/licenses/bsd-license.php New BSD License
 * @link       http://
 * @version    @package_version@
 * @access     public
 */
class Crypt_DiffieHellman_Math_BigInteger
{

    /**
     * Holds an instance of one of the three arbitrary precision wrappers.
     *
     * @var Crypt_DiffieHellman_Math_BigInteger_Interface
     */
    protected $_math = null;

    /**
     * Constructor; a Factory which detects a suitable PHP extension for
     * arbitrary precision math and instantiates the suitable wrapper
     * object.
     *
     * @todo add big_int support
     * @throws  Crypt_DiffieHellman_Math_BigInteger_Exception
     * @return void
     */
    public function __construct($extension = null)
    {
        if ($extension == 'gmp' || (extension_loaded('gmp') || @dl('gmp.' . PHP_SHLIB_SUFFIX) || @dl('php_gmp.' . PHP_SHLIB_SUFFIX))) {
            require_once 'Crypt/DiffieHellman/Math/BigInteger/Gmp.php';
            $this->_math = new Crypt_DiffieHellman_Math_BigInteger_Gmp();
        } elseif ($extension == 'bcmath' || (extension_loaded('bcmath') || @dl('bcmath.' . PHP_SHLIB_SUFFIX) || @dl('php_bcmath.' . PHP_SHLIB_SUFFIX))) {
            require_once 'Crypt/DiffieHellman/Math/BigInteger/Bcmath.php';
            $this->_math = new Crypt_DiffieHellman_Math_BigInteger_Bcmath();
        } else {
            require_once 'Crypt/DiffieHellman/Math/BigInteger/Exception.php';
            throw new Crypt_DiffieHellman_Math_BigInteger_Exception('no big integer precision math support detected');
        }
    }

    /**
     * Redirect all public method calls to the wrapped extension object.
     *
     * @param   string $methodName
     * @param   array $args
     * @throws  Zend_Math_BigInteger_Exception
     */
    public function __call($methodName, $args)
    {
        if (!method_exists($this->_math, $methodName)) {
            require_once 'Crypt/DiffieHellman/Math/BigInteger/Exception.php';
            throw new Crypt_DiffieHellman_Math_BigInteger_Exception('invalid method call: ' . get_class($this->_math) . '::' . $methodName . '() does not exist');
        }
        return call_user_func_array(array($this->_math, $methodName), $args);
    }

}