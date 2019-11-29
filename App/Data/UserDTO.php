<?php

namespace App\Data;


class UserDTO
{
    private const USERNAME_MIN_LENGTH = 4;
    private const USERNAME_MAX_LENGTH = 255;

    private const PASSWORD_MIN_LENGTH = 4;
    private const PASSWORD_MAX_LENGTH = 255;

    private const FIRST_NAME_MIN_LENGTH = 4;
    private const FIRST_NAME_MAX_LENGTH = 255;

    private const LAST_NAME_MIN_LENGTH = 4;
    private const LAST_NAME_MAX_LENGTH = 255;

    private $id;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $moneySpent;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return UserDTO
     * @throws \Exception
     */
    public function setUsername($username): UserDTO
    {
        DTOValidator::validate(self::USERNAME_MIN_LENGTH, self::USERNAME_MAX_LENGTH,
            $username, "text", "Username");
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return UserDTO
     * @throws \Exception
     */
    public function setPassword($password): UserDTO
    {
        DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,
            $password, "text", "Password");
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $firstName
     * @return UserDTO
     * @throws \Exception
     */
    public function setFirstName($firstName): UserDTO
    {
        DTOValidator::validate(self::FIRST_NAME_MIN_LENGTH, self::FIRST_NAME_MAX_LENGTH,
            $firstName, "text", "First Name");
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     * @return UserDTO
     * @throws \Exception
     */
    public function setLastName($lastName): UserDTO
    {
        DTOValidator::validate(self::LAST_NAME_MIN_LENGTH, self::LAST_NAME_MAX_LENGTH,
            $lastName, "text", "Last Name");
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMoneySpent()
    {
        return $this->moneySpent;
    }

    /**
     * @param $moneySpent
     * @return UserDTO
     */
    public function setMoneySpent($moneySpent): UserDTO
    {
        $this->moneySpent = $moneySpent;

        return $this;
    }
}