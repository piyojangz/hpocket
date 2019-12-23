<?php

class select_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function login($email, $password) {
        $query = $this->db->query("SELECT  * FROM user where email = '$email' and password = '$password'");
        return $query->row();
    }

    function loginbyfbid($fbid) {
        $query = $this->db->query("SELECT  * FROM user where  fbid = '$fbid'");
        return $query->row();
    }

    function invitetripmember($userid) {
        $query = $this->db->query("SELECT m.isactive,m.trips_id,DATE_FORMAT(DATE_ADD(m.createdate, INTERVAL 7 HOUR), '%d %b %Y %H:%i:%S') as dateadd , (SELECT uu.name from user uu where uu.id = t.userid ) as inviter
, (SELECT uu.fbid from user uu where uu.id = t.userid ) as fbid  
, (SELECT uu.userimg from user uu where uu.id = t.userid ) as userimg 
, t.title , t.description , date(t.createdate) as createdate
, date(t.startdate) as startdate
, date(t.enddate) as enddate
, t.img FROM  member m 
inner JOIN user u on m.userid = u.id
inner join trips t on m.trips_id = t.id
where   m.userid = '$userid'
and m.isactive = 0
and m.trips_id not in (select a.id from trips a where a.userid = '$userid')");
        return $query->result();
    }

    function userbyemail($email) {
        $query = $this->db->query("SELECT  * FROM user where email = '$email'");
        return $query->row();
    }

    function serchbyemail($searchtext, $userid) {
        $query = $this->db->query("SELECT  u.* ,
IF( EXISTS(
             SELECT * 
             FROM friend f
             WHERE f.friendid =  u.id AND f.userid = $userid), 1, 0) as isfriend
                 ,
(
             SELECT ff.isactive 
             FROM friend ff
             WHERE ff.friendid =  u.id AND ff.userid = 1) as isactive
FROM user u where u.email like '%$searchtext%'");
        return $query->row();
    }

    function serchbyname($searchtext, $userid) {
        $query = $this->db->query("SELECT  u.* ,
IF( EXISTS(
             SELECT * 
             FROM friend f
             WHERE f.friendid =  u.id AND f.userid = $userid), 1, 0) as isfriend
                 ,
(
             SELECT ff.isactive 
             FROM friend ff
             WHERE ff.friendid =  u.id AND ff.userid = 1) as isactive
FROM user u where u.name like '%$searchtext%'");
        return $query->row();
    }

    function nowtrip($userid) {
        $query = $this->db->query("select t.id FROM trips t
where t.startdate = (select min(startdate)
            FROM trips a
            inner join member b
            on a.id = b.trips_id
            WHERE b.userid = '$userid'
            and a.enddate >= CURDATE())");
        return $query->row();
    }

    function notification($userid,$offset = 0,$limit = 10) {
        $query = $this->db->query("SELECT a.*,DATE_FORMAT(DATE_ADD(a.createdate, INTERVAL 7 HOUR), '%d %b %Y %H:%i:%S') as dateadd from notification a 
where a.userid =  '$userid' order by a.createdate desc limit $offset , $limit");
        return $query->result();
    }

    function pasttripsbyuserid($userid) {
        $query = $this->db->query("SELECT 1 as ispassed,a.*,(a.userid = b.userid) as ishosted , DATE_FORMAT(DATE_ADD(a.startdate, INTERVAL 7 HOUR), '%d %b %Y') as time FROM 	trips  a
inner join member b
on a.id = b.trips_id 
where b.userid =  '$userid' and b.isactive = 1  and (a.enddate < CURDATE() or a.endstatus = 1) order by a.startdate");
        return $query->result();
    }

    function tripsbyuserid($userid) {
        $query = $this->db->query("SELECT 0 as ispassed,a.*,(a.userid = b.userid) as ishosted , DATE_FORMAT(DATE_ADD(a.startdate, INTERVAL 7 HOUR), '%d %b %Y')  as time FROM 	trips  a
inner join member b
on a.id = b.trips_id 
where b.userid =  '$userid' and b.isactive = 1  and a.endstatus != 1 and a.enddate >= CURDATE() order by a.startdate");
        return $query->result();
    }

    function activetripsbyuserid($userid, $tripid = "", $ispassed = "0") {
        $where = "";
        if ($ispassed == '1') {
          $where = "and ( a.enddate >= CURDATE() or endstatus in (0,1))";
        } else {
              $where = "and a.enddate >= CURDATE()";
        }
        if ($tripid != "") {
            $query = $this->db->query("SELECT IF(a.enddate >= CURDATE(),0,1) as ispassed , a.*,(a.userid = b.userid) as ishosted , DATE_FORMAT(DATE_ADD(a.startdate, INTERVAL 7 HOUR), '%d %b %Y') as time FROM 	trips  a
inner join member b
on a.id = b.trips_id 
where  a.id = '$tripid'     order by a.startdate");
        } else {
            $query = $this->db->query("SELECT  IF(a.enddate >= CURDATE(),0,1) as ispassed , a.*,(a.userid = b.userid) as ishosted , DATE_FORMAT(DATE_ADD(a.startdate, INTERVAL 7 HOUR), '%d %b %Y') as time FROM 	trips  a
inner join member b
on a.id = b.trips_id 
where b.userid =  '$userid' and b.isactive = 1  and endstatus != 1  $where  order by a.startdate");
        }

        return $query->row();
    }

    function friends($userid, $startwith, $tripid = "",$fbids="") {
        $and = "";
        $unionfb = "";
        if ($startwith != "") {
            $and = " and b.name  like '$startwith%' ";
        }
        if($fbids != ""){
           $unionfb =  " union  SELECT b.*,1 as isactive,
IF( EXISTS(select * from member where trips_id = '$tripid'  and userid = b.id and isactive != -1), 1, 0) as ismember 
    from user b
WHERE b.fbid in ($fbids)  $and ";
        }
        $query = $this->db->query("select DISTINCT  tb.id,tb.fbid,tb.isactive,tb.ismember,tb.name,tb.name,tb.userimg   from (SELECT b.*,a.isactive,
IF( EXISTS(select * from member where trips_id = '$tripid' and userid = b.id and isactive != -1), 1, 0) as ismember 
    FROM friend a 
inner join user b 
on a.friendid = b.id 
WHERE a.userid = '$userid'  $and    "
                . " union SELECT b.*,a.isactive,
IF( EXISTS(select *  from member where trips_id = '$tripid' and userid = b.id and isactive != -1), 1, 0) as ismember 
FROM friend a 
inner join user b 
on a.userid = b.id 
WHERE a.friendid = '$userid'  $and "
                . "$unionfb) as tb");
        return $query->result();
    }

    function tripmembers($tripid) {
        $query = $this->db->query("SELECT c.* ,b.isactive , 
IFNULL((SELECT  sum(i.value) as total FROM  income i 
where i.tripid = '$tripid' and  i.memberid = c.id and i.isdelete =  0
GROUP by i.tripid), 0)  as total

FROM  trips a 
inner join member b 
on 
a.id = b.trips_id
inner join user c
on b.userid = c.id
where a.id   =    '$tripid'  and b.isactive != -1");
        return $query->result();
    }

    function tripdetail($tripid) {
        $query = $this->db->query("SELECT  a.* from trips a
where a.id =  '$tripid'");
        return $query->row();
    }

    function userdetail($userid) {
        $query = $this->db->query("SELECT  a.* from user a
where a.id =  '$userid'");
        return $query->row();
    }

    function tripincome($tripid) {
        $query = $this->db->query("SELECT IFNULL(sum(a.value),0) as val FROM  income a 
            inner join member b on a.memberid = b.userid
where a.tripid =  '$tripid'
    and a.isdelete = 0 
    and b.trips_id = '$tripid'
        and b.isactive = 1
GROUP by tripid");
        return $query->row();
    }

    function trippaid($tripid) {
        $query = $this->db->query("select IFNULL(sum(c.value),0) as val from expenses c where c.tripid = '$tripid'");
        return $query->row();
    }

    function tripspent($tripid) {
        $query = $this->db->query("SELECT * FROM  expenses a 
where a.tripid =  '$tripid'");
        return $query->result();
    }
    
      function tripchart($tripid) {
        $query = $this->db->query("SELECT  t1.typeid , 
    (SELECT sum(t2.value) FROM expenses AS t2  WHERE t2.typeid = t1.typeid and t2.tripid = t1.tripid ORDER BY t2.createdate DESC LIMIT 1) as val
FROM expenses AS t1
where t1.tripid = '$tripid'
GROUP BY t1.typeid");
        return $query->result();
    }
    

    function incomehistory($userid, $tripid) {
        $query = $this->db->query("SELECT a.*,DATE_FORMAT(DATE_ADD(a.createdate, INTERVAL 7 HOUR), '%d %b %Y %H:%i:%S') as dateadd FROM  income a 
where a.tripid =  '$tripid' and a.isdelete = 0 and a.memberid = '$userid' order by createdate desc");
        return $query->result();
    }

    
    function checkmember($tripid,$userid) {
        $query = $this->db->query("SELECT * from member a where a.trips_id = '$tripid' and userid = '$userid' and isactive != -1");
        return $query->num_rows();
    }
    
       function checkfriend($inviter,$userid) {
        $query = $this->db->query("SELECT * from friend a where a.userid = '$inviter' and friendid = '$userid' and isactive = 1");
        return $query->num_rows();
    }
    
}

?>