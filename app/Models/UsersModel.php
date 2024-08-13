<?php
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';

    public function checkForExistingUser($strEmail)
    {
		$db = db_connect();

		$strSQL = 'SELECT u.id FROM users u WHERE u.email = ?';

		$query = $db->query($strSQL, [$strEmail]);
		$arrResults = $query->getResult();
		return $arrResults;
    }



	public function createUser($arrUserData)
	{
		$db = db_connect();

		// Prepare the Query
		$pQuery = $db->prepare(static function ($db) {
			return $db->table('users')->insert([
				'first_name'    => 'x',
				'last_name'    => '',
				'salt'   => '',
				'pass' => '',
				'email' => '',
				'creation_date' => ''
			]);
		});

		// Collect the Data
		$strFirstName    = $arrUserData['first_name'];
		$strLastName    = $arrUserData['last_name'];
		$strSalt    = $arrUserData['salt'];
		$strPass    = $arrUserData['pass'];
		$strEmail    = $arrUserData['email'];
		$dDate = date('Y-m-d');

		// Run the Query
		$result = $pQuery->execute($strFirstName, $strLastName, $strSalt, $strPass, $strEmail, $dDate);

		// If the result is True get the User ID that was just inserted.
		if($result) {
			$strSQL = 'SELECT u.id FROM users u WHERE u.email = ?';

			$query = $db->query($strSQL, [$arrUserData['email']]);
			$result = $query->getResult()[0]->id;

		}		

		return $result;
	}


	// Associate a user with a Club.

	public function createClubAssociation($iUserID, $iClubId, $bIsAdmin = false)
	{
		$db = db_connect();

		$pQuery = $db->prepare(static function ($db) {
			return $db->table('user_club_association')->insert([
				'user_id'    => 'x',
				'club_id'    => '',
				'is_admin'   => '',
			]);
		});

		// Collect the Data
		$iUserId    = $iUserID;
		$iClubId    = $iClubId;
		$iIsAdmin    = $bIsAdmin ? true : false;

		// Run the Query
		$result = $pQuery->execute($iUserId, $iClubId, $iIsAdmin);

		return $result;


	}

	public function checkClubAssociation($iUserId, $iClubId)
	{
		$db = db_connect();

		$strSQL = 'SELECT uca.user_id FROM user_club_association uca WHERE uca.user_id = ? AND uca.club_id = ?';

		$query = $db->query($strSQL, [$iUserId, $iClubId]);
		$arrResults = $query->getResult();


		return $arrResults;
	}

	public function getUserSalt($iUserID) 
	{
		$db = db_connect();

		$strSQL = 'SELECT u.salt FROM users u WHERE u.id = ?';

		$query = $db->query($strSQL, [$iUserID]);
		$strSalt = $query->getResult()[0]->salt;
		return $strSalt;


	}


}