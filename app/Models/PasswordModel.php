<?php
namespace App\Models;

use CodeIgniter\Model;

class PasswordModel extends Model
{
    
    public function createSalt()
    {
		$strSalt = bin2hex(random_bytes(16));
		return $strSalt;
    }

	public function createHashedPassword($strPass, $strSalt){
		
		$strHash = '';
		$strHashedPass = 'test';

		if($strPass && $strSalt) {
			$strCombinedPassword = $strPass . $strSalt;
			$strHashedPass = $strCombinedPassword;
			$strHashedPass = hash('sha256',$strCombinedPassword);

		}
		
		return $strHashedPass;

	}


}