<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['group_id', 'nip'];

    /**
     * -------------------------------------------------------------------
     * setGroup($nip, $groupID)
     * -------------------------------------------------------------------
     * Merubah role dari user, dari role X menjadi role Y
     */
    public function setGroup(string $nip, string $groupID)
    {
        $data = ['group_id' => $groupID];
        return $this->db->table('users')->where(['nip' => $nip])->update($data);
    }

    /**
     * -------------------------------------------------------------------
     * getGroup($nip)
     * -------------------------------------------------------------------
     * Merubah role dari user, dari role X menjadi role Y
     */
    public function getGroup(string $nip)
    {
        return $this->db->table('users')
            ->join('auth_groups', 'users.group_id = auth_groups.id')
            ->where(['nip' => $nip])->get()->getResultArray()[0];
    }
}
