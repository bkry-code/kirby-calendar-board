<?php

class CalendarboardFieldController extends Kirby\Panel\Controllers\Field {

  public function getMonthBoard($month, $year) {
    
    // Calendar language
    date_default_timezone_set('UTC');
    $l = panel()->language();
    setlocale(LC_ALL, $l . '_' . str::upper($l)); 
    //setlocale(LC_ALL, 'us_US'); 
    
    // Get spoiler string and extract field keys
    $spoiler__tpl = $this->field()->spoiler();
    preg_match_all('/\{{(.*?)\}}/', $spoiler__tpl, $spoiler__fields); 
    
    // Calendar stuff
    $cal = new Calendarboard\calendar();
    $currentMonth = $cal->month($year, $month);

    return tpl::load(__DIR__ . DS . 'template.php', array(
        'currentMonth' => $currentMonth,
        'get_day_route_url' => purl($this->model(), 'field/' . $this->field()->name . '/calendarboard/get-day/'),
        'calendarboard_url' => $this->model(),
        'year_folder' => '/year-' . $year
    ));   
  }
  
  public function getDay($date) {
    
    $Date = str::split($date, '-');
    
    // If day folder doesn't exists, create it         
    $this->field()->check_day($this->model(), $date);
    
    // Go to day edit page
    go(purl($this->model(), 'year-' . $Date[0] . '/day-' . $date . '/edit/'));  
  }  

}