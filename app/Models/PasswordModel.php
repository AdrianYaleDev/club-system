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
		$strHashedPass = '';

		if($strPass && $strSalt) {
			$strCombinedPassword = $strPass . $strSalt;
			$strHashedPass = $strCombinedPassword;
			$strHashedPass = hash('sha256',$strCombinedPassword);

		}
		
		return $strHashedPass;

	}

	public function checkPassword($strHashedPass, $strUserId)
	{
		
		$bResult = false;
		$db = db_connect();

		$strSQL = 'SELECT u.pass FROM users u WHERE u.id = ?';

		$query = $db->query($strSQL, [$strUserId]);
		$arrResults = $query->getResult();

		echo '<pre>'.print_r($arrResults[0]->pass,1) . '</pre>';

		if($strHashedPass == $arrResults[0]->pass) {
			$bResult = true;
		}

		return $bResult;
	}


}