<?php

namespace Gossamer\Ra\Security\Traits;

use AESKW\A128KW;
use PHPUnit\Framework\TestCase;

class EncryptionTraitTest extends TestCase
{

//    public function testEncrypt() : void {
//        // The Key Encryption Key
//        $kek  = hex2bin("000102030405060708090A0B0C0D0E0F");
//
//// The key we want to wrap. Please note that the size is not exactly a 64 bits-block
//        //$key  = hex2bin("0011223344");
//        $key = hex2bin("davidm");
//// We wrap the key. Please note that the third parameter enable the key padding (RFC6549)
//        $wrapped_key = A128KW::wrap($kek, $key, true); // Must return "9E53E571ED4669A51A4B8724788F8C80"
//
//// We unwrap the key. Please note that the third parameter enable the key padding (RFC6549)
//        $unwrapped_key = A128KW::unwrap($kek, $wrapped_key, true); // The result must be the same value as the key
//
//        $this->assertEquals( $unwrapped_key, $key);
//    }
}
