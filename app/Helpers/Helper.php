<?php

namespace App\Helpers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;


use App\Http\Requests;



use DB;
use App\User;
use Auth;

class Helper{


  static public function get_specifi_table_data($table_name, $field_val_array){



    $data = DB::table($table_name)->where($field_val_array)->get();
    return $data;


  }


  static protected function word_teaser($string, $count){
    $original_string = $string;
    $words = explode(' ', $original_string);
   
    if (count($words) > $count){
     $words = array_slice($words, 0, $count);
     $string = implode(' ', $words);
    }
   
    return $string;
  }


  static public function slugify($get_text)
  {

    $prob = new Prob;

    $text = Self::word_teaser($get_text, 5);

    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return null;
    }

    return $text;
  }




//Count total view
static public function viewCount($table, $Where_f_name, $where_f_value, $field_name){

  DB::table($table)
        ->where($Where_f_name, $where_f_value)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->increment($field_name, 1);  // update the record in the DB.
  }


//total row count from a column
  static public function total_row_count($table, $where){
    $Count = DB::table($table)->where($where)->count();
    return $Count;
  }

/**get faculty review rating
 @based on 6 factors
 @sum all ratings / total num of rows / 6
*/

 static public function faculty_rating_sum($table, $where, $field){
    $data = DB::table($table)
                ->where($where)
                ->sum($field);
                return $data;
 }



//Get user id
//return user details 
//using in problem/single.blade.php

  static public function my_profile($id, $field){
     $userdata = User::find($id);
    
      $data = $userdata->$field;
      return $data;
    
  }

//Get field name
//return field  details 
//using in 

  static public function single_column($table, $where, $limit = null){
  
    $query = DB::table($table)
            ->where($where)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();  //the very first row
    return $query;
  }

  static public function single_column_raw($table, $where, $rawOrder, $limit = null){
  
    $query = DB::table($table)
            ->where($where)
            ->orderByRaw($rawOrder)
            ->limit($limit)
            ->get();  //the very first row
    return $query;
  }

  static public function single_column_paginate($table, $where, $rawOrder, $paginate){
  
    $query = DB::table($table)
            ->where($where)
            ->orderByRaw($rawOrder)
            ->paginate($paginate);
    return $query;
  }

  static public function single_column_order($table, $where, $orderBy, $orderDesc, $limit = null){
  
    $query = DB::table($table)
            ->where($where)
            ->orderBy($orderBy, $orderDesc)
            ->limit($limit)
            ->get();  //the very first row
    return $query;
  }

  static public function single_column_first($table, $where){
  
    $query = DB::table($table)
            ->where($where)
            ->orderBy('id', 'desc')
            ->first();  //the very first row
    return $query;
  }

  // ->whereIn('id', [1, 2, 3])
  //where 2 is other where option
  static public function multiple_where($table, $where_for, $where){
    $qry = DB::table($table)
              ->whereIn($where_for, $where)
              ->get();
    return $qry;
  }


  //get user ip
  static public function getClientIP() {

  if (isset($_SERVER)) {

      if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
          return $_SERVER["HTTP_X_FORWARDED_FOR"];

      if (isset($_SERVER["HTTP_CLIENT_IP"]))
          return $_SERVER["HTTP_CLIENT_IP"];

      return $_SERVER["REMOTE_ADDR"];
  }

  if (getenv('HTTP_X_FORWARDED_FOR'))
      return getenv('HTTP_X_FORWARDED_FOR');

  if (getenv('HTTP_CLIENT_IP'))
      return getenv('HTTP_CLIENT_IP');

  return getenv('REMOTE_ADDR');
  }

  #get broser data 
  static public function getBrowser() {

    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

  }

  #get browser
  static public function getOS() { 

    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

  }

  #detect mobile or laptop

  static public function pc_mobile_detect(){
    if (stristr($_SERVER['HTTP_USER_AGENT'],'mobi')!==FALSE) {
        return 'mobile';
    }else{
      return 'desktop';
    }

  }

  #insert visitor data everytime people come and visit a page
  static public function visitor_data($url){


    DB::table('visitorprofile')->insert([
        [
          'page_url'      => $url,
          'page_date'     => date('Y-m-d'),
          'u_ip'   => Self::getClientIP(),
          'full_time' => time(),
          'visitor_os'=> Self::getOS(),
          'visitor_browser' => Self::getBrowser(),
          'visitor_device' => Self::pc_mobile_detect()
        ]
    ]);

  }



  #html select option  first value
  static public function select_option($HasSession, $val = null){

    if($HasSession){

      if($HasSession == 'st-8-930'){
        return '<option value="st-8-930">ST 08:00 AM - 09:30 AM</option>';
      }elseif($HasSession == 'st-940-1110'){
        return '<option value="st-940-1110">ST 09:40 AM - 11:10 AM</option>';
      }elseif($HasSession == 'st-1120-1250'){
        return '<option value="st-1120-1250">ST 11:20 AM - 12:50 PM</option>';
      }elseif($HasSession == 'st-1-230'){
        return '<option value="st-1-230">ST 01:00 PM - 02:30 PM</option>';
      }elseif($HasSession == 'st-240-410'){
        return '<option value="st-240-410">ST 02:40 PM - 04:10 PM</option>';
      }elseif($HasSession == 'st-420-550'){
        return '<option value="st-420-550">ST 04:20 PM - 05:50 PM</option>';
      }elseif($HasSession == 'mw-8-930'){
        return '<option value="mw-8-930">MW 08:00 AM - 09:30 AM</option>';
      }elseif($HasSession == 'mw-940-1110'){
        return '<option value="mw-940-1110">MW 09:40 AM - 11:10 AM</option>';
      }elseif($HasSession == 'mw-1120-1250'){
        return '<option value="mw-1120-1250">MW 11:20 AM - 12:50 PM</option>';
      }elseif($HasSession == 'mw-1-230'){
        return '<option value="mw-1-230">MW 01:00 PM - 02:30 PM</option>';
      }elseif($HasSession == 'mw-240-410'){
        return '<option value="mw-240-410">MW 02:40 PM - 04:10 PM</option>';
      }elseif($HasSession == 'mw-420-550'){
        return '<option value="mw-420-550">MW 04:20 PM - 05:50 PM</option>';
      }elseif($HasSession == 'ra-8-930'){
        return '<option value="ra-8-930">RA 08:00 AM - 09:30 AM</option>';
      }elseif($HasSession == 'ra-940-1110'){
        return '<option value="ra-940-1110">RA 09:40 AM - 11:10 AM</option>';
      }elseif($HasSession == 'ra-1120-1250'){
        return '<option value="ra-1120-1250">RA 11:20 AM - 12:50 PM</option>';
      }elseif($HasSession == 'ra-1-230'){
        return '<option value="ra-1-230">RA 01:00 PM - 02:30 PM</option>';
      }elseif($HasSession == 'ra-240-410'){
        return '<option value="ra-240-410">RA 02:40 PM - 04:10 PM</option>';
      }elseif($HasSession == 'ra-420-550'){
        return '<option value="ra-420-550">RA 04:20 PM - 05:50 PM</option>';
      }else{
        return "<option value='".$HasSession."'>".$HasSession."</option>";
      }


    }else{
      if($val){
        return "<option value='0'>".$val."</option>";
      }else{
        return "<option value='0'> Please select from dropdown </option>";
      }
    }

  }//end select_option class



static public function get_previous_date($howmuch){
  $m= date("m"); // Month value
  $de= date("d"); //today's date
  $y= date("Y"); // Year value
  return date('Y-m-d', mktime(0,0,0,$m,($de-$howmuch),$y)); 
}


//unique visitor count rows today
static public function unique_visitor_count_by_custom_date($TableName, $cusDate){
  
  $disval = DB::table($TableName)->distinct('u_ip')->where('page_date', $cusDate)->count('u_ip');
  return $disval;
}

//user count rows
static public function count_rows($TableName, $data, $value){
  $count_total_rows = DB::table($TableName)->where($data, $value)->count();
  return $count_total_rows;
}



//user count rows
static public function count_rows_like($TableName, $field_like, $field_val){

    $count_total_rows_like = DB::table($TableName)
                ->where($field_like, 'like', '%'.$field_val.'%')
                ->count();

  return $count_total_rows_like;

}



static public function daily_visitor_generate(){

  for ($i=1; $i < 8; $i++){

          $customDates = self::get_previous_date($i); 

            $query = DB::table('daily_visitor_count')
            ->where('regularDate', $customDates)
            ->get();  //the very first row



        //Check whether the query was successful or not
        if($query->count() == 1) {


        }else{


        $get_UV_1 = self::unique_visitor_count_by_custom_date('visitorprofile', $customDates);

        $get_TV_1 = self::count_rows('visitorprofile', 'page_date', $customDates);



        $CountTotalNews = self::count_rows_like('products', 'created_at', $customDates);
          

          DB::table('daily_visitor_count')->insert([
              [
                'regularDate'      => $customDates,
                'UniqueVisitor'      => $get_UV_1,
                'TotalClick'      => $get_TV_1,
                'totalPublishedProducts'      => $CountTotalNews
              ]
          ]);
 
        }



 } 

}




//post modification - remove last word
static public function rmv_lst_wrd($text){
  return preg_replace('~\\s+\\S+$~', '', $text);
}

static public function getTotalView(){
    return DB::table('visitorprofile')->orderBy('id', 'DESC')->limit(1)->first();
}



}//end helper class

?>