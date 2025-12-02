<?php

namespace App\Models;

use CodeIgniter\Model;

class Member extends Model
{
    public function user_login($email, $password)
    {
        $db = db_connect();
        $query = "SELECT * FROM members WHERE memberEmail = ?";
        $result = $db->query($query, [ $email ]);
        $row = $result->getFirstRow();
        if ($row == null) return false; // email not in db

        $dbPassword = $row->memberPassword;
        $dbMemberKey = $row->memberKey;
        $hashedPassword = md5($password . $dbMemberKey);

        if ($dbPassword != $hashedPassword) return false; // incorrect pw entered


        $this->session = service('session');
        $this->session->start();

        $this->session->set('roleID', $row->roleID);
        $this->session->set('memberID', $row->memberID);
        $this->session->set('memberKey', $row->memberKey);
        $this->session->set('roleID', $row->roleID);

        return true;
    }

    public function has_access($memberKey, $raceID)
    {
        try {
            $db = db_connect();
            $query = "SELECT r.raceID FROM race r JOIN member_race mr on r.raceID = mr.raceID Join members m on mr.memberID = m.memberID WHERE memberKey = '87115B95-654C-43E9-94A8-CCB325FD129A' AND mr.roleID > 1 AND mr.roleID = 3;";
            $result = $db->query($query, [ $memberKey, $raceID ]);
            $row = $result->getFirstRow();
            return $row != null;
        }
        catch (Exception $ex) {

        }
    }
}