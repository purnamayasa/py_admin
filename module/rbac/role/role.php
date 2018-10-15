<?php

if (isset($rbac) && $rbac->hasPrivilege("rbac.role")) { 

    if ($action == "data" && $rbac->hasPrivilege("rbac.role.crud.data")) {

        require_once "data.php";

    } else if ($action == "create" && $rbac->hasPrivilege("rbac.role.crud.create")) {

        require_once "form.php";

    } else if ($action == "read" && $rbac->hasPrivilege("rbac.role.crud.read")) {

        require_once "form.php";

    } else if ($action == "update" && $rbac->hasPrivilege("rbac.role.crud.update")) {

        require_once "form.php";

    } else if ($action == "delete" && $rbac->hasPrivilege("rbac.role.crud.delete")) {

        require_once "action.php";

    } else if ($action == "save" && $rbac->hasPrivilege("rbac.role.crud.save")) {

        require_once "action.php";

    } else {

        if ($action === "data" || $action === "create" || $action === "read" || $action === "update" || $action === "delete" || $action === "save") {

            require_once "template/default/error_permission.php";

        } else {

            require_once "template/default/error_404.php";

        }

    }

} else { 

    require_once "template/default/error_permission.php";

}