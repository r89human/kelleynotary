<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email() {
      $data = array('name'=>"Kelleysmobilenotary");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('orders@kmnsteam.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('orders@kmnsteam.com','Kelleysmobilenotary');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

   public function html_email($data = [], $to, $from, $subject, $template_name) {

      $status = Mail::send($template_name, $data, function($message) {
         $message->to($to)->subject($subject);
         $message->from($from);
      });

      return $status;
      
   }


   public function attachment_email() {
      $data = array('name'=>"Kelleysmobilenotary");
      Mail::send('mail', $data, function($message) {
         $message->to('orders@kmnsteam.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('orders@kmnsteam.com','Kelleysmobilenotary');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }





}