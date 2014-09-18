<?php
$YOUR_EMAIL = "toto@exemple.com";






$data = $_POST;
$restult_data_decode = json_decode($data['mandrill_events']);
foreach ($restult_data_decode as $event) {
        $status  =  $event->event."".$event->type;
        $title  =  $event->msg->subject;

        $subject = "[".$status."] ". $title;
        $headers   = array();
        if($event->reject != null){
                $headers[] = "From: <".$event->reject->email.">";
        }
        elseif($event->entry != null){
                $headers[] = "From: <".$event->entry->email.">";
        }else{
                $headers[] = "From: <".$event->msg->email.">";
        }
        $headers[] = "X-Mailer: mandrill";
        mail($YOUR_EMAIL, $subject,json_encode($event),implode("\r\n", $headers));
}

?>

