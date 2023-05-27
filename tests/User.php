<?php

namespace App;

class User
{
    private $con;

    public function __construct()
    {
        $this->con = mysqli_connect("localhost", "root", "root", "ACQTX");
    }

    public function insert_user($name, $email, $password, $is_admin, $is_verified)
    {
        $query = "INSERT INTO users (name, email, password, is_admin, is_verified) VALUES ('$name', '$email', '$password', $is_admin, $is_verified);";
        $res = $this->con->query($query);
        if ($this->con->affected_rows != 0)
            return 1;
        return 0;
    }
}