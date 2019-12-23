<?php

class update_model extends CI_Model {

    function user($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('user', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function trips($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('trips', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function income($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('income', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function expenses($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('expenses', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function userbyemail($input) {
        $this->db->where('email', $input['email']);
        if ($this->db->update('user', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_forgotpassword($input) {
        $this->db->where('token', $input['token']);
        if ($this->db->update('forgotpassword', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function resetactivetrip($userid) {
        $this->db->where('userid', $userid);
        $input = array('isactive' => 0);
        if ($this->db->update('member', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setactivetrip($userid, $nowtripid) {
        $sql = "UPDATE member 
SET isactive = 1 
where  userid = '$userid' and trips_id = '$nowtripid'; ";

        $this->db->query($sql);
    }

    function update_reqshopopen($input) {
        $this->db->where('shopid', $input['shopid']);
        if ($this->db->update('requestshopopen', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function tripmember($input) {
        $this->db->where('trips_id', $input['trips_id']);
        $this->db->where('userid', $input['userid']);
        $this->db->where('isactive', '!= -1');
        if ($this->db->update('member', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_trip($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('trips', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function buyeraddress($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('buyeraddress', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setOtp($input) {
        $this->db->where('tel', $input['tel']);
        if ($this->db->update('otpgenerate', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setBuyerbyFbid($input) {
        $this->db->where('fbid', $input['fbid']);
        if ($this->db->update('buyerusers', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setBuyerByID($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('buyerusers', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setBuyer($input) {
        $this->db->where('email', $input['email']);
        if ($this->db->update('buyerusers', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_location($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('user_location', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_like($input) {
        $this->db->where('createby', $input['createby']);
        $this->db->where('postid', $input['postid']);
        if ($this->db->update('post_like', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function updateusersetting($input) {
        $this->db->where('id', $input["id"]);
        if ($this->db->update('users', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function activenotification($input) {
        $this->db->where('status', 1);
        $this->db->where('createto', $input["createto"]);

        if ($this->db->update('notification', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function items($input) {
        $this->db->where('id', $input["id"]);

        if ($this->db->update('items', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function setorder($input) {
        $this->db->where('id', $input["id"]);

        if ($this->db->update('orders', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function updatebuyernotification($input) {
        $this->db->where('id', $input["id"]);

        if ($this->db->update('buyernotification', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function updatenotification($input) {
        $this->db->where('id', $input["id"]);

        if ($this->db->update('notification', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function updateshop($input) {
        $this->db->where('id', $input["id"]);

        if ($this->db->update('shops', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function read_post_notification($input) {
        $this->db->where('createto', $input["createto"]);
        $this->db->where('refid', $input["refid"]);
        if ($this->db->update('notification', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_notification($userid) {

        $query = $this->db->query("SELECT  * from  t_mobile_users a  where id = " . $userid);
        $rs = $query->row();


        $input = array('notification_count' => $rs->notification_count + 1);
        $this->db->where('id', $userid);
        if ($this->db->update('t_mobile_users', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_invite($input) {

        $this->db->where('trips_id', $input["trips_id"]);
        $this->db->where('user_id', $input["user_id"]);
        if ($this->db->update('user_trip_participant', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_lastlocation($input) {

        $this->db->where('id', $input["id"]);
        if ($this->db->update('users', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_accept_friend($input, $userid, $friendid) {

        $this->db->where('userid', $friendid);
        $this->db->where('friendid', $userid);
        if ($this->db->update('t_friend', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_notification_zero($input, $fbid) {

        $this->db->where('fbid', $fbid);
        if ($this->db->update('t_mobile_users', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function set_notification_setting($regid, $input) {

        $this->db->where('gcm_regid', $regid);
        if ($this->db->update('t_gcm_users', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_viewed($input) {

        $value = array(
            'id' => $input['id'],
            'count' => $input['count'],
            'ip_addr' => $input['ip_addr']
        );

        $query = $this->db->query("select ip_addr  from view_history where ip_addr = '" . $value['ip_addr'] . "' and  TO_DAYS(time_stamp) = TO_DAYS(now()) ");

        if ($query->num_rows() == 0) {
            if ($this->db->insert('view_history', $value)):
                return true;
            else:
                return false;
            endif;
        }
    }

    function tmn_redeem($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('tmn_redeem', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_message_read() {
        $value = array('is_read' => '1');
        if ($this->db->update('contact_detail', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function shop_workingtime($input) {
        $this->db->where('shopid', $input['shopid']);
        $this->db->where('workingday', $input['workingday']);
        if ($this->db->update('shop_workingtime', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_membereditprofile($username, $input) {

        $value = array(
            'fullname' => $input['fullname'],
            'email' => $input['email'],
            'birthday' => $input['birthday'],
            'address' => $input['address'],
            'province' => $input['province'],
            'zipcode' => $input['zipcode'],
            'tel' => $input['tel'],
            'sex' => $input['sex'],
            'bankname' => $input['bankname'],
            'bankbranch' => $input['bankbranch'],
            'bankno' => $input['bankno'],
            'bankowner' => $input['bankowner'],
            'banktype' => $input['banktype'],
            'website' => $input['website']
        );
        $this->db->where('username', $username);

        if ($this->db->update('user', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_membereditprofilePW($username, $input) {

        $value = array(
            'password' => md5($input['password'])
        );
        $this->db->where('username', $username);

        if ($this->db->update('user', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Tire($id, $input) {

        $this->db->where('Tire_ID', $id);

        if ($this->db->update('dunlop_tire', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Slide($id, $input) {

        $this->db->where('SLIDE_ID', $id);

        if ($this->db->update('dunlop_slide', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Video($id, $input) {

        $this->db->where('VIDEO_ID', $id);

        if ($this->db->update('dunlop_vdo', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Album($id, $input) {

        $this->db->where('Album_ID', $id);

        if ($this->db->update('dunlop_album', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_pIC($id, $input) {

        $this->db->where('PIC_ID', $id);

        if ($this->db->update('dunlop_pic', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_News($id, $input) {

        $this->db->where('NEWS_ID', $id);

        if ($this->db->update('dunlop_news', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Content($id, $input) {

        $this->db->where('ID', $id);

        if ($this->db->update('t_content', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Highlight($id, $input) {

        $this->db->where('Highlight_ID', $id);

        if ($this->db->update('dunlop_highlight', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Product($id, $input) {

        $this->db->where('Product_ID', $id);

        if ($this->db->update('dunlop_product', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function delete_post($groupid) {

        $this->db->where('groupid', $groupid);

        if ($this->db->delete('post')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_noti($id) {
        $this->db->where('refid', $id);

        if ($this->db->delete('notification')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Dealer($id) {

        $this->db->where('Dealer_ID', $id);

        if ($this->db->delete('dealer_detail')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Slide($id) {

        $this->db->where('SLIDE_ID', $id);

        if ($this->db->delete('dunlop_slide')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Album($id) {

        $this->db->where('Album_ID', $id);

        if ($this->db->delete('dunlop_album')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Pic($id) {

        $this->db->where('PIC_ID', $id);

        if ($this->db->delete('dunlop_pic')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_location($input) {
        $this->db->where('id', $input['id']);

        if ($this->db->delete('user_location')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_postbylocation($input) {
        $this->db->where('location_id', $input['id']);

        if ($this->db->delete('post')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_invite($input) {
        $this->db->where('trips_id', $input['trips_id']);
        $this->db->where('user_id', $input['user_id']);
        if ($this->db->delete('user_trip_participant')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_trip($input) {
        $this->db->where('id', $input['id']);

        if ($this->db->delete('trips')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_following($input) {
        $this->db->where('id', $input['id']);

        if ($this->db->delete('user_following')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Video($id) {

        $this->db->where('VIDEO_ID', $id);

        if ($this->db->delete('dunlop_vdo')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_party($id) {

        $this->db->where('id', $id);
        if ($this->db->delete('user_trip_participant')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Product($id) {

        $this->db->where('product_ID', $id);

        if ($this->db->delete('dunlop_product')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_msg($id) {

        $this->db->where('id', $id);

        if ($this->db->delete('contact_detail')):
            return true;
        else:
            return false;
        endif;
    }

    function update_group($id, $input) {

        $this->db->where('Group_ID', $id);

        if ($this->db->update('dunlop_group', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_category($id, $input) {

        $this->db->where('ID', $id);

        if ($this->db->update('t_category', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_dealer_address($id, $input) {

        $this->db->where('Dealer_ID', $id);

        if ($this->db->update('dealer_detail', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_knowledge_category($id, $input) {

        $this->db->where('Cate_ID', $id);

        if ($this->db->update('dunlop_knowledge_cate', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function update_about_category($id, $input) {

        $this->db->where('Cate_ID', $id);

        if ($this->db->update('dunlop_about_cate', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function delete_group($id) {

        $this->db->where('Group_ID', $id);

        if ($this->db->delete('dunlop_group')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Highlight($id) {

        $this->db->where('Highlight_ID', $id);

        if ($this->db->delete('dunlop_highlight')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_News($id) {

        $this->db->where('NEWS_ID', $id);

        if ($this->db->delete('dunlop_news')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_content($id) {

        $this->db->where('ID', $id);

        if ($this->db->delete('t_content')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_category($id) {

        $this->db->where('ID', $id);

        if ($this->db->delete('t_category')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_knowledge_category($id) {

        $this->db->where('Cate_ID', $id);

        if ($this->db->delete('dunlop_knowledge_cate')):
            return true;
        else:
            return false;
        endif;
    }

    function removefollow($userid, $tripid) {

        $this->db->where('trips_id', $tripid);
        $this->db->where('user_id', $userid);

        if ($this->db->delete('user_following')):
            return true;
        else:
            return false;
        endif;
    }

    function delete_about_category($id) {

        $this->db->where('Cate_ID', $id);

        if ($this->db->delete('dunlop_about_cate')):
            return true;
        else:
            return false;
        endif;
    }

    function update_Order($id, $input) {

        $this->db->where('order_id', $id);

        if ($this->db->update('orders', $input)):
            return true;
        else:
            return false;
        endif;
    }

}

?>