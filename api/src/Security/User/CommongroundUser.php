<?php

// src/Security/User/WebserviceUser.php
namespace App\Security\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class CommongroundUser implements UserInterface, EquatableInterface
{
	private $username;
	private $password;
	private $salt;
	private $roles;
	
	public function __construct(string $username = '', string $password = '', string $salt = null, array $roles = [])
	{
		$this->username = $username;
		$this->password = $password;
		$this->salt = $salt;
		$this->roles = $roles;
	}
	
	public function getRoles()
	{
		return $this->roles;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
	
	public function getSalt()
	{
		return $this->salt;
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function eraseCredentials()
	{
	}
	
	public function isEqualTo(UserInterface $user)
	{
		if (!$user instanceof CommongroundUser) {
			return false;
		}
		
		if ($this->password !== $user->getPassword()) {
			return false;
		}
		
		if ($this->salt !== $user->getSalt()) {
			return false;
		}
		
		if ($this->username !== $user->getUsername()) {
			return false;
		}
		
		return true;
	}
}