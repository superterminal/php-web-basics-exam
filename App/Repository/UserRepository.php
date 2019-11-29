<?php

namespace App\Repository;


use App\Data\UserDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;

class UserRepository extends DatabaseAbstract implements UserRepositoryInterface
{

    public function __construct(DatabaseInterface $database,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($database, $dataBinder);
    }

    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "INSERT INTO users
                    (username, 
                     password, 
                     first_name, 
                     last_name,
                     money_spent)
                  VALUES(?,?,?,?,?)
             "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            0
        ]);

        return true;
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query(
            "
                UPDATE users
                SET 
                  username = ?,
                  password = ?,
                  first_name = ?,
                  last_name = ?
                WHERE id = ? 
            "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $id
        ]);

        return true;
    }

    public function delete(int $id): bool
    {
        $this->db->query("DELETE FROM users WHERE id = ?")
            ->execute([$id]);

        return true;
    }

    public function findOneByUsername(string $username): ?UserDTO
    {
        return $this->db->query(
            "SELECT id, 
                    username, 
                    password, 
                    first_name AS firstName,
                    last_name AS lastName
                  FROM users
                  WHERE username = ?
             "
        )->execute([$username])
            ->fetch(UserDTO::class)
            ->current();

    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    username, 
                    password, 
                    first_name AS firstName,
                    last_name AS lastName,
                    money_spent AS moneySpent
                  FROM users
                  WHERE id = ?
             "
        )->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }

    /**
     * @return \Generator|UserDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                  SELECT id, 
                      username, 
                      password, 
                      first_name AS firstName, 
                      last_name AS lastName 
                  FROM users
            "
        )->execute()
            ->fetch(UserDTO::class);
    }

    public function addMoney(UserDTO $user): bool
    {
        $this->db->query(
            "
                UPDATE users
                SET money_spent = ?
                WHERE id = ?
            ")->execute([$user->getMoneySpent(), $user->getId()]);

        return true;
    }
}