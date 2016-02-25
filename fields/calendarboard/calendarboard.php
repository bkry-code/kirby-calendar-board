<?php
/**
 * Calendar Board Field Light for Kirby CMS (v. 2.2.3)
 *
 * @author    Marco Oliva - team@moloc.net
 * @version   0.6
 *
 */
 
include_once "lib/calendar.php";

class CalendarboardField extends BaseField {
  
  static public $assets = array(
      'js' => array(
          'calendarboard.js'
      ),
      'css' => array(
          'calendarboard.css'
      )
  );
  
  public function check_day($calendarboard_url, $date){

    $Date   = str::split($date, '-');
    $year   = $Date[0];
    $month  = $Date[1];
    $day    = $Date[2];
    
    $year_folder  = 'year-' . $year;
    $day_folder   = 'day-' . $date;
    
    // Check Year folder existence
    if(!site()->find($calendarboard_url . '/' . $year_folder)){
      page($calendarboard_url)->children()->create($year_folder, 'calendar-board-year', array(
        'title' => 'year-' . $year
      ));
    }     

    // Check Day folder existence 
    if(!site()->find($calendarboard_url . '/' . $year_folder . '/' . $day_folder)){
      page($calendarboard_url . '/' . $year_folder)->children()->create($day_folder, 'calendar-board-day', array(
        'title' => $day . '-' . $month . '-' . $year
      ));
    }   
  }  
  
  public function routes() {
    return array(
      array(
        'pattern' => 'get-month-board/(:num)/(:num)',
        'method'  => 'get',
        'action'  => 'getMonthBoard'
      ),
      array(
        'pattern' => 'get-day/(:any)',
        'method'  => 'get',
        'action'  => 'getDay'
      )
    );
  }  

  public function __construct() {
    $this->type   = 'calendarboard';
    $this->label  = l::get('fields.calendarboard.label', 'Calendar Board');
  }
    
  public function content() {  
    $calendarBoard = brick('div');
    $calendarBoard->attr('id','calendarboard');
    $calendarBoard->data("name", $this->name);
    $calendarBoard->data("month", date("m"));
    $calendarBoard->data("year", date("Y"));
    $calendarBoard->data("field", "createCalendar");   

    return $calendarBoard;
  }
}
