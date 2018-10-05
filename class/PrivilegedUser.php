<?php

class PrivilegedUser extends User
{
    private $link;
    private $roles;

    public function __construct($link) {
        parent::__construct();
        $this->link = $link;
    }

    public function getByUsername($username) {
        $sql = "
            SELECT 
                user_id,
                username,
                password,
                email_address
            FROM 
                user 
            WHERE 
                username = ?
            LIMIT 1
        ";

        if ($stmt = mysqli_prepare($this->link, $sql)) {

            $stmt->bind_param("s", $p_username);

            $p_username = $username;

            if ($stmt->execute()) {

                $stmt->store_result();

                if ($stmt->num_rows() > 0) {

                    $stmt->bind_result($user_id, $username, $password, $email_address);

                    $pu = new PrivilegedUser($this->link);

                    while ($stmt->fetch()) {
                        $pu->user_id = $user_id;
                        $pu->username = $username;
                        $pu->password = $password;
                        $pu->email_address = $email_address;
                        $pu->initRoles();
                    }                    

                    return $pu;

                } else {

                    return false;

                }

            } else {

                return false;

            }

        }
        
        /*$sth = $GLOBALS["DB"]->prepare($sql);
        $sth->execute(array(":username" => $username));
        $result = $sth->fetchAll();

        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->user_id = $result[0]["user_id"];
            $privUser->username = $username;
            $privUser->password = $result[0]["password"];
            $privUser->email_address = $result[0]["email_address"];
            $privUser->initRoles();
            return $privUser;
        } else {
            return false;
        }*/
    }

    protected function initRoles() {
        $this->roles = array();
        
        $sql = "
            SELECT 
                t1.role_id, 
                t2.role_name 
            FROM 
                user_role as t1
            INNER JOIN role as t2 ON t1.role_id = t2.role_id
            WHERE 
                t1.user_id = ?
        ";

        if ($stmt = mysqli_prepare($this->link, $sql)) {

            $stmt->bind_param("i", $p_user_id);

            $p_user_id = $this->user_id;

            if ($stmt->execute()) {

                $stmt->store_result();

                if ($stmt->num_rows() > 0) {

                    $stmt->bind_result($role_id, $role_name);

                    $role = new Role($this->link);

                    while($stmt->fetch()) {
                        $this->roles[$role_name] = $role->getRolePerms($role_id);
                    }

                } else {

                    return false;

                }

            } else {

                return false;

            }

        }
        
        /*$sth = $GLOBALS["DB"]->prepare($sql);
        $sth->execute(array(":user_id" => $this->user_id));

        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
        }*/
    }

    public function hasPrivilege($permission) {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($permission)) {
                return true;
            }
        }
        
        return false;
    }

    public function hasRole($role_name) {
        return isset($this->roles[$role_name]);
    }

    public function insertPermission($role_id, $permission_id) {
        $sql = "
            INSERT INTO role_permission 
            (role_id, permission_id) 
            VALUES 
            (:role_id, :permission_id)
        ";
        
        $sth = $GLOBALS["DB"]->prepare($sql);

        return $sth->execute(array(":role_id" => $role_id, ":permission_id" => $permission_id));
    }

    public function deletePermission() {
        $sql = "TRUNCATE role_permission";
        $sth = $GLOBALS["DB"]->prepare($sql);

        return $sth->execute();
    }
}