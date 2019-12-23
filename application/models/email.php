<?php

class Email extends CI_Model {

    public function sendinfo($msg, $email, $subject) {

          //config
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'localhost';
        $config['smtp_user'] = 'foodhall@servewellsolution.com';
        $config['smtp_pass'] = 'R4NvZh2s';
       // $config['smtp_port'] = 465;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        //config
        $this->email->from('foodhall@servewellsolution.com', 'ServeWellSolution,.Co.ltd.');
        $this->email->to($email); //ส่งถึงใคร
        $this->email->subject($subject); //หัวข้อของอีเมล
        $this->email->message($msg); //เนื้อหาของอีเมล
       return  $this->email->send();


//         echo $this->email->print_debugger();
    }


    public function sendemail($msg, $email, $subject) {

        //config
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'localhost';
        $config['smtp_user'] = 'foodhall@servewellsolution.com';
        $config['smtp_pass'] = 'R4NvZh2s';
       // $config['smtp_port'] = 465;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        //config
        $this->email->from('foodhall@servewellsolution.com', 'FoodHall');
        $this->email->to($email); //ส่งถึงใคร
        $this->email->subject($subject); //หัวข้อของอีเมล
        $this->email->message($msg); //เนื้อหาของอีเมล
        return  $this->email->send();


        //  echo $this->email->print_debugger();
    }

}
