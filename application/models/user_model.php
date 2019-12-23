<?php

class user_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->library(array('encrypt'));
        $this->load->helper(array('cookie', 'url'));
        $this->db = $this->load->database('default', TRUE);
    }

    function user_login($user_id = '', $password = '', $remember_me = '') {
        $query = $this->db->query("SELECT * FROM admin_users where user_login = '" . $user_id . "'  and user_pass = '" . $password . "'  LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            if ($remember_me == 'on') {
                $expires = ( 60 * 60 * 24 * 365) / 12;
            } else {
                $expires = ( 60 * 60 * 24);
            }
            $query2 = $this->db->query("SELECT umeta_id,meta_value FROM admin_usermeta  where user_id = '" . $row->ID . "' AND meta_key = 'user_logindate'");
            $query3 = $this->db->query("SELECT umeta_id,meta_value FROM admin_usermeta  where user_id = '" . $row->ID . "' AND meta_key = 'user_logoutdate'");
            $row2 = $query2->row();
            $row3 = $query3->row();

            $set_cm_account['admin_id'] = $row->ID;
            $set_cm_account['admin_username'] = $row->user_login;
            $set_cm_account['admin_fullname'] = $row->user_nicename;
            $set_cm_account['admin_login'] = $row2->meta_value;
            $set_cm_account['admin_logout'] = $row3->meta_value;
            $set_cm_account['umeta_loginid'] = $row2->umeta_id;
            $set_cm_account['umeta_logoutid'] = $row3->umeta_id;
            $set_cm_account['is_admin'] = 1;
            $set_cm_account = $this->encrypt->encode(serialize($set_cm_account));
            set_cookie('user_account', $set_cm_account, $expires);

            $time = date('Y-m-d H:i:s');
            $cm_account = $this->get_account_cookie();
            $row = array('meta_value' => $time);
            $this->db->where('umeta_id', $cm_account['umeta_loginid']);
            $this->db->update('admin_usermeta', $row);

            return true;
        } else {
            return false;
        }
    }

    function get_account_cookie() {
        $this->load->library(array('encrypt'));
        // get cookie
        $c_account = get_cookie('user_account', true);
        if ($c_account != null) {
            $c_account = $this->encrypt->decode($c_account);
            $c_account = @unserialize($c_account);
            return $c_account;
        }
        return null;
    }

    function logout() {
        $time = date('Y-m-d H:i:s');
        $cm_account = $this->get_account_cookie();
        $row = array('meta_value' => $time);
        $this->db->where('umeta_id', $cm_account['umeta_logoutid']);
        $this->db->update('admin_usermeta', $row);
        $this->load->helper(array('cookie'));
        delete_cookie('user_account');
    }

    function is_login() {
        $cm_account = $this->get_account_cookie();
        if (!isset($cm_account['admin_username']) || !isset($cm_account['admin_id'])) {
            return false;
        } else
        if ($this->get_by_id($cm_account['admin_id']) != false)
            return true;
        else
            return false;
    }

    function get_by_id($id) {
        $this->db->where('ID', $id);
        return $this->db->get('admin_users');
    }

    public function get_notification_setting($regid) {
        $query = $this->db->query("SELECT  * from t_gcm_users WHERE gcm_regid = '" . $regid . "'");
        $result = $query->row();

        return $result;
    }

    public function storeUser($input) {
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT  * from t_gcm_users WHERE gcm_regid = '" . $input['gcm_regid'] . "'");
        $result = $query->num_rows();
        if ($result == 0) {
            if ($this->db->insert('t_gcm_users', $input)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function user_register($input) {
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT  * from t_mobile_users WHERE fbid = '" . $input['fbid'] . "'");
        $result = $query->num_rows();
        if ($result == 0) {
            if ($this->db->insert('t_mobile_users', $input)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM gcm_users");
        return $result;
    }

}
