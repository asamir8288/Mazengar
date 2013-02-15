<?php

/*
 * email and inbox notification.
 */

function outlookfilter($text) {
    $text = str_replace("<br />", "<br>", $text);
    $text = str_replace("&nbsp;", "", $text);
    $text = str_replace("&#39;", "'", $text);

    return $text;
}

function send_email($email, $subject, $body, $sender = 'Mazengar', $template = 'emails/notification', $from = 'system@mazengar.com', $reply_to = '', $reply_to_name = '', $type = 'html') {
    $CI = & get_instance();

    $CI->load->library('email');

    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['smtp_port'] = 25;
    $config['smtp_timeout'] = '7';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['mailtype'] = 'html';

    $CI->email->initialize($config);

    $data['subject'] = $subject;
    $data['body'] = $body;
    $data['email'] = $email;

    $CI->email->from($from, $sender);
    $CI->email->to($email);
    $CI->email->reply_to($reply_to, $reply_to_name);

    $CI->email->subject($subject);
    $html_email = $CI->load->view($template, $data, true);
    $html_email = outlookfilter($html_email);

    $CI->email->message($html_email);
    $CI->email->send();
}

function inbox() {
    $inbox = new AccountInbox();
    $inbox->save();
}

?>
