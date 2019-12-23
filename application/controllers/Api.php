<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('time_helper');
        $this->load->library('GCM');
        $this->load->library('Ios');
        $this->load->library('thsms');
        $this->load->library('upload');
        $this->load->model('Email', '_email');
        date_default_timezone_set('UTC');
    }

    public function getJsondata($url) {
        header('Content-type: application/json');
        $Data = json_decode(file_get_contents($url), true);
        return $Data;
    }

    public function getJsondatafromString($contents) {
        header('Content-type: application/json');
        $Data = json_decode($contents, true);
        return $Data;
    }

    public function index() {
        echo 'success';
    }

    public function pushAppNoti() {
        $allnoti = $this->select_model->getallnotification();
        print_r($allnoti);
        foreach ($allnoti as $noti) {
            $rs = $this->iOSpushNotification($noti->iostoken, $noti->msg, intval($noti->badge), 'prm1', 'prm2');
            print_r($rs);
            if ($rs) {
                $input = array('id' => $noti->id
                    , 'status' => 1);
                $this->update_model->updatebuyernotification($input);
            }
        }
    }

    public function testiosnoti() {
        $rs = $this->iOSpushNotification('879e0369ab69f87da57314664a2d1d6274191b72bf15f34e3e3587ea46a3014e', "title", 0, 'prm1', 'prm2');
        print_r($rs);
    }

    public function iOSpushNotification($devices, $message, $badge, $type, $id) {
        $Ios = new Ios();
        $Ios->type($type);
        $Ios->id($id);
        $Ios->to($devices);
        $Ios->message($message);
        $Ios->badge($badge);
        $rs = $Ios->send();
        return $rs;
    }

    public function testnoti($token) {
//        $msg = array
        //        (
        //            'message'     => 'here is a message. message',
        //            'title'        => 'This is a title. title',
        //            'subtitle'    => 'This is a subtitle. subtitle',
        //            'tickerText'    => 'Ticker text here...Ticker text here...Ticker text here',
        //            'vibrate'    => 1,
        //            'sound'        => 1,
        //            'largeIcon'    => 'large_icon',
        //            'smallIcon'    => 'small_icon'
        //        );
        $msg = 'congratulations';
        $gcm = new GCM();
        $rs = $gcm->send_notification($token, $msg);
        print_r($rs);
    }

    public function login() {
        $data['result'] = null;
        $fbid = $this->input->post('fbid');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($fbid != '') {
            $val = $this->select_model->loginbyfbid($fbid);
            if (count($val) > 0) {
                $data['result'] = $val;
            }
        } else {
            $val = $this->select_model->login(strtolower($email), md5($password));
            if (count($val) > 0) {
                $data['result'] = $val;
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_tripsandfriends() {
        $userid = $this->input->post('userid');

        $data['result_pasttrips'] = $this->select_model->pasttripsbyuserid($userid);
        $data['result_trips'] = $this->select_model->tripsbyuserid($userid);
        $data['result_friends'] = $this->select_model->friends($userid, "");
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function accepttrip() {
        $userid = $this->input->post('userid');
        $tripid = $this->input->post('tripid');
        $data['result'] = null;
        $input = array(
            'trips_id' => $tripid,
            'userid' => $userid,
            'isactive' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        if ($this->update_model->tripmember($input)) {
            $data['result'] = 'success';

            $userdata = $this->select_model->userdetail($userid);
            $tripusers = $this->select_model->tripmembers($tripid);
            foreach ($tripusers as $value) {
                $tripdata = $this->select_model->tripdetail($tripid);
                // ส่ง Push noti
                $this->sendGCM($value->fcmtoken, 'การเข้าร่วม', "$userdata->name ได้เข้าร่วม $tripdata->title");
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function setendtrip() {
        $tripid = $this->input->post('tripid');
        $data['result'] = null;
        $input = array(
            'id' => $tripid,
            'endstatus' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        if ($this->update_model->update_trip($input)) {
            $data['result'] = 'success';
        }

        $tripdata = $this->select_model->tripdetail($tripid);
        $tripusers = $this->select_model->tripmembers($tripid);
        foreach ($tripusers as $value) {
            if ($value->isactive == '1') {
                $userdata = $this->select_model->userdetail($value->id);
                $input = array(
                    'userid' => $value->id,
                    'title' => "ทริป $tripdata->title",
                    'message' => "ได้สิ้นสุดลงแล้ว",
                    'type' => 'ENDTRIP',
                    'createdate' => date('Y-m-d H:i:s'),
                );

                // $this->insert_model->notification($input);
                // ส่ง Push noti
                $this->sendGCM($userdata->fcmtoken, $input['title'], $input['message']);
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function setusertoken() {
        $userid = $this->input->post('userid');
        $token = $this->input->post('token');
        $data['result'] = null;
        $input = array(
            'id' => $userid,
            'fcmtoken' => $token,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        if ($this->update_model->user($input)) {
            $data['result'] = 'success';
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function removeincome() {
        $id = $this->input->post('id');
        $data['result'] = null;
        $input = array(
            'id' => $id,
            'isdelete' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        if ($this->update_model->income($input)) {
            $data['result'] = 'success';
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function rejecttrip() {
        $userid = $this->input->post('userid');
        $tripid = $this->input->post('tripid');
        $data['result'] = null;
        $input = array(
            'trips_id' => $tripid,
            'userid' => $userid,
            'isactive' => -1,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        if ($this->update_model->tripmember($input)) {
            $data['result'] = 'success';
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_notification() {
        $userid = $this->input->post('userid');

        $offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
        $limit = $this->input->post('limit') ? $this->input->post('limit') : 10;

        $data['resultnoti'] = $this->select_model->notification($userid, $offset, $limit);
        $data['result'] = $this->select_model->invitetripmember($userid);
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function getinvitecount() {
        $userid = $this->input->post('userid');

        $data['result'] = count($this->select_model->invitetripmember($userid));
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_tripmembers() {
        $tripid = $this->input->post('tripid');

        $data['result'] = $this->select_model->tripmembers($tripid);
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_useraddmoney() {
        $userid = $this->input->post('userid');
        $tripid = $this->input->post('tripid');

        $data['result'] = $this->select_model->incomehistory($userid, $tripid);
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_trips() {
        $userid = $this->input->post('userid');

        $data['result'] = $this->select_model->tripsbyuserid($userid);
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function serchfriend() {
        $userid = $this->input->post('userid');
        $serchtype = $this->input->post('serchtype');
        $searchtext = $this->input->post('searchtext');
        $data['result'] = "";
        if ($searchtext != "") {
            if ($serchtype == 0) {
                $data['result'] = $this->select_model->serchbyemail($searchtext, $userid);
            }
            if ($serchtype == 1) {
                $data['result'] = $this->select_model->serchbyname($searchtext, $userid);
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function addexpenses() {
        $image = "";
        $id = $this->input->post('id');
        $userid = $this->input->post('userid');
        $tripid = $this->input->post('tripid');
        $typeid = $this->input->post('typeid');
        $amount = $this->input->post('amount');
        $editable = $this->input->post('editable');
        $description = $this->input->post('description');
        $imageData = $this->input->post("imageData");

        $input = array('userid' => $userid
            , 'tripid' => $tripid
            , 'typeid' => $typeid
            , 'value' => str_replace(",", "", $amount)
            , 'description' => $description
            , 'createdate' => date('Y-m-d H:i:s'));

        if (!empty($imageData)) {
            // $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
            $image = $this->base64_to_jpeg($imageData, $tripid);
            $image = $tripid . "/" . $image["upload_data"]["file_name"];
            $input['img'] = $image;
        }
        if ($image == "" && $editable == 'false') {
            $image = "img_blank.jpg";
            $input['img'] = $image;
        }

        $data['result_total'] = [];
        if ($editable == 'false') {
            if ($this->insert_model->expenses($input)) {
                $income = $this->select_model->tripincome($tripid);
                $paid = $this->select_model->trippaid($tripid);
                $data['result_total']['total'] = (floatval($income ? $income->val : 0) - floatval($paid ? $paid->val : 0));

                $data['result_spent'] = $this->select_model->tripspent($tripid);

                $tripdata = $this->select_model->tripdetail($tripid);
                $tripusers = $this->select_model->tripmembers($tripid);
                foreach ($tripusers as $value) {
                    if ($value->isactive == '1') {
                        $userdata = $this->select_model->userdetail($value->id);
                        $input = array(
                            'userid' => $value->id,
                            'title' => "ทริป $tripdata->title",
                            'message' => "ได้ใช้จ่าย $description เป็นจำนวน $tripdata->symbol $amount",
                            'type' => 'EXPENSE',
                            'createdate' => date('Y-m-d H:i:s'),
                        );

                        $this->insert_model->notification($input);
                        // ส่ง Push noti
                        $this->sendGCM($userdata->fcmtoken, $input['title'], $input['message']);
                    }
                }
            }
        } else {
            $input['id'] = $id;
            $this->update_model->expenses($input);
            $income = $this->select_model->tripincome($tripid);
            $paid = $this->select_model->trippaid($tripid);
            $data['result_total']['total'] = (floatval($income ? $income->val : 0) - floatval($paid ? $paid->val : 0));

            $data['result_spent'] = $this->select_model->tripspent($tripid);
        }

        $data["input"] = $image;
        $this->output->set_header('Content-Type: application / json;
                charset = utf-8');
        echo json_encode($data);
    }

    public function addmoney() {

        $userid = $this->input->post('userid');
        $username = $this->input->post('username');
        $tripid = $this->input->post('tripid');
        $amount = $this->input->post('amount');
        $description = $this->input->post('description');

        $input = array('memberid' => $userid
            , 'tripid' => $tripid
            , 'value' => str_replace(",", "", $amount)
            , 'description' => $description
            , 'createdate' => date('Y-m-d H:i:s'));
        $data['result_total'] = [];
        if ($this->insert_model->income($input)) {
            $income = $this->select_model->tripincome($tripid);
            $paid = $this->select_model->trippaid($tripid);
            $data['result_total']['total'] = (floatval($income ? $income->val : 0) - floatval($paid ? $paid->val : 0));

            $data['result_spent'] = $this->select_model->tripspent($tripid);

            $userdata = $this->select_model->userdetail($userid);
            $tripdata = $this->select_model->tripdetail($tripid);

            $tripusers = $this->select_model->tripmembers($tripid);
            foreach ($tripusers as $value) {
                if ($value->isactive == '1') {
                    $user = $this->select_model->userdetail($value->id);
                    $input = array(
                        'userid' => $value->id,
                        'title' => "ทริป $tripdata->title",
                        'message' => "ได้เพิ่มเงินจำนวน $amount บาท จากสมาชิก $userdata->name",
                        'type' => 'ADDMONEY',
                        'createdate' => date('Y-m-d H:i:s'),
                    );

                    $this->insert_model->notification($input);
                    // ส่ง Push noti
                    $this->sendGCM($user->fcmtoken, $input['title'], $input['message']);
                }
            }
        }

        $this->output->set_header('Content-Type: application / json;
                charset = utf-8');
        echo json_encode($data);
    }

    public function addtrip() {
        $userid = $this->input->post('userid');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $tripid = $this->input->post('tripid');
        $currency = $this->input->post('currency');
        $symbol = $this->input->post('symbol');

        $data['result'] = null;

        $input = array(
            'userid' => $userid,
            'currency' => $currency,
            'symbol' => $symbol,
            'title' => $title,
            'description' => $description,
            'startdate' => $startdate,
            'enddate' => $enddate,
        );

        if ($tripid != "") {
            $input['updatedate'] = date('Y-m-d H:i:s');
            $input['id'] = $tripid;
            if ($this->update_model->trips($input)) {
                $data['result'] = 'success';
            }
        } else {
            $input['createdate'] = date('Y-m-d H:i:s');
            $tripid = $this->insert_model->trips($input);

            if ($tripid) {
                $input = array(
                    'trips_id' => $tripid,
                    'userid' => $userid,
                    'isactive' => 1,
                    'createdate' => date('Y-m-d H:i:s'),
                );

                if ($this->insert_model->member($input)) {

                    //                $this->update_model->resetactivetrip($userid);
                    //
                    //                $nowtripid = $this->select_model->nowtrip($userid)->id;
                    //                $this->update_model->setactivetrip($userid, $nowtripid);
                    $data['result'] = 'success';
                }
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function invitetrip() {
        $userid = $this->input->post('userid');
        $inviter = $this->input->post('inviter');
        $tripid = $this->input->post('tripid');
        $data['result'] = null;


        $checkfriend = $this->select_model->checkmember($inviter, $userid);
        if ($checkfriend == 0) {
            $input = array(
                'userid' => $inviter,
                'friendid' => $userid,
                'isactive' => 1,
                'createdate' => date('Y-m-d H:i:s'),
            );

            $this->insert_model->friend($input);
        }


        $input = array(
            'userid' => $userid,
            'trips_id' => $tripid,
            'inviterid' => $inviter,
            'isactive' => 0,
            'createdate' => date('Y-m-d H:i:s'),
        );

        $user = $this->select_model->userdetail($inviter);

        $checkmember = $this->select_model->checkmember($tripid, $userid);
        if ($checkmember == 0) {
            if ($this->insert_model->member($input)) {
                $userdata = $this->select_model->userdetail($userid);
                $tripdata = $this->select_model->tripdetail($tripid);
                // ส่ง Push noti
                $this->sendGCM($userdata->fcmtoken, 'การเชิญชวนเข้าร่วม', "$user->name ได้ชวนคุณเข้าร่วม $tripdata->title");

                $data['result'] = 'success';
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function sendrequest() {
        $userid = $this->input->post('userid');
        $requester = $this->input->post('requester');
        $data['result'] = null;

        $input = array(
            'userid' => $requester,
            'friendid' => $userid,
            'isactive' => 1,
            'createdate' => date('Y-m-d H:i:s'),
        );

        if ($this->insert_model->friend($input)) {
            $data['result'] = 'success';
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

//    function get_activetrip() {
    //        $userid = $this->input->post('userid');
    //        $tripid = $this->input->post('tripid');
    //        $ispassed = $this->input->post('ispassed');
    //        $data['result_chart'] = [];
    //        $data['result_member'] = [];
    //        $data['result_total'] = [];
    //        $data['result_spent'] = [];
    //        if ($ispassed == '1') {
    //            $data['result_trip'] = $this->select_model->activetripsbyuserid($userid, $tripid, '1');
    //        } else {
    //            $data['result_trip'] = $this->select_model->activetripsbyuserid($userid, $tripid, '0');
    //        }
    //
    //        if ($data['result_trip']) {
    //            $data['result_member'] = $this->select_model->tripmembers($data['result_trip']->id);
    //            $income = $this->select_model->tripincome($data['result_trip']->id);
    //            $paid = $this->select_model->trippaid($data['result_trip']->id);
    //            $data['result_total']['total'] = (floatval($income ? $income->val : 0) - floatval($paid ? $paid->val : 0));
    //            $data['result_spent'] = $this->select_model->tripspent($data['result_trip']->id);
    //        }
    //
    //        $this->output->set_header('Content-Type: application / json; charset = utf-8');
    //        echo json_encode($data);
    //    }

    public function get_activetrip() {
        $userid = $this->input->post('userid');
        $tripid = $this->input->post('tripid');
        $ispassed = $this->input->post('ispassed');
        $data['result_chart'] = [];
        $data['result_member'] = [];
        $data['result_total'] = [];
        $data['result_spent'] = [];
        if ($ispassed == '1') {
            $data['result_trip'] = $this->select_model->activetripsbyuserid($userid, $tripid, '1');
        } else {
            $data['result_trip'] = $this->select_model->activetripsbyuserid($userid, $tripid, '0');
        }

        if ($data['result_trip']) {
            $data['result_member'] = $this->select_model->tripmembers($data['result_trip']->id);
            $income = $this->select_model->tripincome($data['result_trip']->id);
            $paid = $this->select_model->trippaid($data['result_trip']->id);
            $data['result_total']['total'] = (floatval($income ? $income->val : 0) - floatval($paid ? $paid->val : 0));
            $data['result_spent'] = $this->select_model->tripspent($data['result_trip']->id);
            $chartdata = $this->select_model->tripchart($data['result_trip']->id);
            foreach ($chartdata as $value) {
                switch ($value->typeid) {
                    case "1":
                        $data['result_chart']["food"] = $value->val;
                        break;
                    case "2":
                        $data['result_chart']["drink"] = $value->val;
                        break;
                    case "3":
                        $data['result_chart']["rest"] = $value->val;
                        break;
                    case "4":
                        $data['result_chart']["power"] = $value->val;
                        break;
                    case "5":
                        $data['result_chart']["ticket"] = $value->val;
                        break;
                    case "6":
                        $data['result_chart']["activity"] = $value->val;
                        break;
                    case "7":
                        $data['result_chart']["other"] = $value->val;
                        break;

                    default:
                        break;
                }
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function get_friends() {
        $userid = $this->input->post('userid');
        $fbids = $this->input->post('fbids');
        $serchwith = $this->input->post('serchwith');
        $tripid = $this->input->post('tripid');

        $thaichar = array('ก', 'ข', 'ค', 'ง', 'จ', 'ฉ', 'ช', 'ซ', 'ฌ', 'ญ', 'ฐ', 'ฑ', 'ฒ'
            , 'ณ', 'ด', 'ต', 'ถ', 'ท', 'ธ', 'น', 'บ', 'ป', 'ผ', 'ฝ', 'พ', 'ฟ', 'ภ', 'ม', 'ย', 'ร', 'ล'
            , 'ว', 'ศ', 'ษ', 'ส', 'ห', 'ฬ', 'อ', 'ฮ', 'เ', 'แ', 'โ', 'ไ');

        $val = null;
        if ($serchwith) {
            $rs = $this->select_model->friends($userid, $serchwith, "", $fbids);
            if ($rs) {
                $val[iconv_substr($serchwith, 0, 1, "UTF-8")] = $rs;
            }
        } else {
            foreach (range('A', 'Z') as $char) {
                $rs = $this->select_model->friends($userid, $char, $tripid, $fbids);
                if ($rs) {
                    $val[$char] = $rs;
                }
            }
            foreach ($thaichar as $char) {
                $rs = $this->select_model->friends($userid, $char, $tripid, $fbids);
                if ($rs) {
                    $val[$char] = $rs;
                }
            }
        }

        $data['result'] = $val;
        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function register() {

        $fbid = $this->input->post('fbid');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $userid = $this->input->post('userid');

        $input = array(
            'fbid' => $fbid,
            'email' => strtolower($email),
            'gender' => $gender,
            'name' => $name,
            'userid' => $userid,
            'createdate' => date('Y-m-d H:i:s'),
        );

        if (count($this->select_model->userbyemail($email)) == 0) {
            if ($fbid != '') {
                if ($password != '') {
                    $input['password'] = md5($password);
                    if ($this->insert_model->user($input)) {
                        $data['result'] = 'success';
                    }
                } else {
                    $data['result'] = 'register';
                }
            } else {
                $input['password'] = md5($password);
                if ($this->insert_model->user($input)) {
                    $data['result'] = 'success';
                }
            }
        } else {
            if ($fbid != '') {
                if ($this->update_model->userbyemail($input)) {
                    $data['result'] = 'success';
                }
            } else {
                $data['result'] = 'unsuccess';
            }
        }

        $this->output->set_header('Content-Type: application / json; charset = utf-8');
        echo json_encode($data);
    }

    public function base64_to_jpeg_normal($data, $path) {
        $temp_file_path = tempnam(sys_get_temp_dir(), 'tempimage'); // might not work on some systems, specify your temp path if system temp dir is not writeable
        file_put_contents($temp_file_path, base64_decode($data));
        $image_info = getimagesize($temp_file_path);
        $_FILES['userfile'] = array(
            'name' => uniqid() . '.' . preg_replace('!\w+/!', '', $image_info['mime']),
            'tmp_name' => $temp_file_path,
            'size' => filesize($temp_file_path),
            'error' => UPLOAD_ERR_OK,
            'type' => $image_info['mime'],
        );

        $config['upload_path'] = 'public/uploads/img/' . $path . "/";
        if (!is_dir($config['upload_path'])) {
            mkdir("public/uploads/img/$path", 0777);
        }

        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $config['overwrite'] = false;
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userfile', true)) {
            return $this->upload->display_errors();
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    public function base64_to_jpeg($data, $tripid) {
        $temp_file_path = tempnam(sys_get_temp_dir(), ' tempimage '); // might not work on some systems, specify your temp path if system temp dir is not writeable
        file_put_contents($temp_file_path, base64_decode($data));
        $image_info = getimagesize($temp_file_path);
        $_FILES['userfile'] = array(
            'name' => uniqid() . '.' . preg_replace('!\w+/!', '', $image_info['mime']),
            'tmp_name' => $temp_file_path,
            'size' => filesize($temp_file_path),
            'error' => UPLOAD_ERR_OK,
            'type' => $image_info['mime'],
        );

        $config['upload_path'] = 'public/uploads/trip_img/' . $tripid . "/";
        if (!is_dir($config['upload_path'])) {
            mkdir("public/uploads/trip_img/$tripid", 0777);
        }

        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $config['overwrite'] = false;
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('userfile', true)) {
            return $this->upload->display_errors();
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    public function testnoti2($token) {
        $this->sendGCM($token, 'xx', 'xx');
    }

    public function sendGCM($fcmtoken, $title, $desc) {
        #API access key from Google API's Console
        $registrationIds = $fcmtoken;
#prep the bundle
        $msg = array
            (
            'body' => $desc,
            'title' => $title,
            'icon' => 'myicon', /* Default Icon */
            'sound' => 'mySound' /* Default sound */,
            'badge' => 1,
        );
        $fields = array
            (
            'to' => $registrationIds,
            'notification' => $msg,
        );

        $headers = array
            (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json',
        );
#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
#Echo Result Of FireBase Server
        // echo $result;
    }

}
