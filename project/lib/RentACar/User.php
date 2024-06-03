<?php
namespace RentACar;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use RentACar\Address;
use RentACar\Profile;

class User extends Profile
{
    use FormValidatorTrait;
    
    protected ?string $passwordHash = null;
    protected ?bool $isAdmin = null;

    public function __construct(
        ?string $name = null,
        ?string $email = null,
        ?string $dateOfBirth = null,
        ?string $phone = null,
        ?bool $isArchived = null,
        ?string $password = null,
        ?bool $isAdmin = null,
        ?int $address_id = null,
        ?int $id = null,
        ?Address $address = null
    ) {
        $this->tableName = 'user';

        parent::__construct(
            $name,
            $email,
            $dateOfBirth,
            $phone,
            $isArchived,
            $address_id,
            $id,
            $address,
        );

        if ($password !== null) {
            $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($isAdmin !== null) {
            $this->isAdmin = $isAdmin;
        }
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPasswordHash($passwordHash): self
    {
        
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): self
    {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    public function checkPassword(string $password): bool
    {
        // echo "<br>Password: $password<br>";
        // echo "this->passwordHash: $this->passwordHash<br>";
        return password_verify($password, $this->passwordHash);
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Fetches the User's reservation revisions
     *
     * @return array
     */ 
    public function fetchCurrentRevisions(): array
    {
        try {
            $userId = $this->getId();
            $revisions = [];
            $stmt = Revision::rawSQL(
                "SELECT revision.* FROM revision
                LEFT OUTER JOIN (
                    SELECT reservation_id, max(submittedTimestamp) as maxSubmittedTimestamp
                        FROM revision
                        GROUP BY reservation_id
                ) latestRevision
                ON revision.reservation_id = latestRevision.reservation_id
                INNER JOIN reservation res
                ON revision.reservation_id = res.id
                WHERE revision.submittedTimestamp = latestRevision.maxSubmittedTimestamp
                AND res.ownerUser_id = $userId
                ORDER BY revision.submittedTimestamp DESC;"
            );
            while($row = $stmt->fetchObject(Revision::class)) {
                $revisions[] = $row;
            }
        } catch(e) {

        }

        return $revisions;
    }

    public static function isLoggedInUser(int $userId) {
        if (empty($_SESSION['logged_id'])) {
            return false;
        }
        return $_SESSION['logged_id'] == $userId;
    }

    /**
     * Get validation rules for customer form fields.
     *
     * @return array
     */ 
    public static function getValidationRules(): array
    {
        $rules = [
            'password' => [
                'name' => 'password',
                'mustMatch' => 'confirmPassword',
                'required' => true
            ],
            'confirmPassword' => [
                'name' => 'confirmPassword',
                'required' => true
            ]
        ];

        $parentRules = parent::getValidationRules();
        return array_merge($parentRules, $rules);
    }
}