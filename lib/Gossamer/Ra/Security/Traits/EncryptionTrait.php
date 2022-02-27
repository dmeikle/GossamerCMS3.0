<?php
/*
 *  This file is part of the Quantum Unit Solutions development package.
 *
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */


namespace Gossamer\Ra\Security\Traits;


use Nzo\UrlEncryptorBundle\Encryptor\Encryptor;

trait EncryptionTrait
{
    protected Encryptor $encryptor;

    protected function encrypt(string $data) {
        return $this->encryptor->encrypt($data);
    }

    private function decrypt($encryptedData) {
        return $this->encryptor->decrypt($encryptedData);
    }
}
