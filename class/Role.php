<?php
class Role
{
    protected $permissions;

    public function __construct($link) {
        $this->permissions = array();
        $this->link = $link;
    }

    public function getRolePerms($role_id) {
        $role = new Role($this->link);
        
        $sql = "
            SELECT 
                t2.permission_name 
            FROM 
                role_permission as t1
            INNER JOIN permission as t2 ON t1.permission_id = t2.permission_id
            WHERE 
                t1.role_id = ?
        ";

        if ($stmt = mysqli_prepare($this->link, $sql)) {

            $stmt->bind_param("i", $p_role_id);

            $p_role_id = $role_id;

            if ($stmt->execute()) {

                $stmt->store_result();

                if ($stmt->num_rows() > 0) {

                    $stmt->bind_result($permission_name);

                    $role = new Role($this->link);

                    while($stmt->fetch()) {
                        $role->permissions[$permission_name] = true;
                    }

                    return $role;

                } else {

                    return false;

                }

            } else {

                return false;

            }

        }
        
        /*$sth = $GLOBALS["DB"]->prepare($sql);
        $sth->execute(array(":role_id" => $role_id));

        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $role->permissions[$row["permission_name"]] = true;
        }
        
        return $role;*/
    }

    public function hasPerm($permission) {
        return isset($this->permissions[$permission]);
    }

    /*public static function insertRole($role_name) {
        $sql = "
            INSERT INTO role
            (role_name) 
            VALUES 
            (:role_name)
        ";
        
        $sth = $GLOBALS["DB"]->prepare($sql);

        return $sth->execute(array(":role_name" => $role_name));
    }

    public static function insertUserRoles($user_id, $roles) {        
        foreach ($roles as $role_id) {
            $sql = "
                INSERT INTO user_role 
                (user_id, role_id) 
                VALUES (:user_id, :role_id)
            ";
            
            $sth = $GLOBALS["DB"]->prepare($sql);
            $sth->bindParam(":user_id", $user_id, PDO::PARAM_STR);
            $sth->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $sth->execute();
        }
        
        return true;
    }

    public static function deleteRoles($roles) {            
        foreach ($roles as $role_id) {
            $sql = "
                DELETE 
                    t1, t2, t3 
                FROM 
                    role as t1
                JOIN user_role as t2 on t1.role_id = t2.role_id
                JOIN role_permission as t3 on t1.role_id = t3.role_id
                WHERE t1.role_id = :role_id
            ";
            
            $sth = $GLOBALS["DB"]->prepare($sql);
            $sth->bindParam(":role_id", $role_id, PDO::PARAM_INT);
            $sth->execute();
        }
        
        return true;
    }

    public static function deleteUserRoles($user_id) {
        $sql = "
            DELETE FROM user_role 
            WHERE user_id = :user_id
        ";
        
        $sth = $GLOBALS["DB"]->prepare($sql);

        return $sth->execute(array(":user_id" => $user_id));
    }*/
}