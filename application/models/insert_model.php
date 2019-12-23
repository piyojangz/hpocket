<?php

class Insert_model extends CI_Model {

    function user($input) {
        if ($this->db->insert('user', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function notification($input) {
        if ($this->db->insert('notification', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function friend($input) {
        if ($this->db->insert('friend', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function expenses($input) {
        if ($this->db->insert('expenses', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function income($input) {
        if ($this->db->insert('income', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function member($input) {
        if ($this->db->insert('member', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

    function trips($input) {
        if ($this->db->insert('trips', $input)):
            return $this->db->insert_id();
        else:
            return false;
        endif;
    }

}

?>