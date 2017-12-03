<?php

namespace App\Model;

use Nette;
use Nette\Security;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;


/**
 * Users authenticator.
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{
	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * @return Identity
     * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table('uzivatel')->where('username', $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('Špatné uživatelské jméno.', self::IDENTITY_NOT_FOUND);
		}
        if ($row->password !== sha1($password . UzivatelManager::$user_salt)) {
            throw new AuthenticationException("Špatné uživatelské heslo.", self::INVALID_CREDENTIAL);
        }

		$arr = $row->toArray();
		unset($arr['password']);

		return new Identity($row->uzivatelID, $row->roleID, $arr);
	}
}
