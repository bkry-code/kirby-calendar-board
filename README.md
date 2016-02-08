# Calendar board for Kirby
**Calendar board** is a custom form field for [Kirby CMS](https://getkirby.com/).
This plugin provides an easy way to add and manage events, activities or bookings in the panel through an intuitive calendar board interface.

![calendar_panel](https://cloud.githubusercontent.com/assets/11831276/12880868/2321bb78-ce45-11e5-8367-99a0be2abf50.png)

## How it works
You can navigate calendar board month by month and every day cell visualizes the number of events of that day through some little dots.

Everytime you click on a day cell a little imp creates a day subpage (or edits it if the page already exists) slugging it in a ```day-yyyy-mm-dd``` format, then opens that page detail.

The events in this page are stored into a structure field named ```events```.

For performance reasons also years folders are created (if they don't exist) in a ```year-yyyy``` format.
The days folders are stored in them. See below for more infos about years folders.

## Installation
If not already existing, add a new ```fields``` folder to ```site``` directory.
Put ```calendarboard``` folder and all its contents into ```/site/fields/```.

(Optional: add ```calendar-board-year.yaml``` into ```blueprints``` folder).

Then add ```calendar-board-day.php``` file into ```blueprints``` folder.
This is the blueprint for day detail subpage.

You can freely change this blueprint and in particular the structure field of the events.
**The only thing you can't do is to modify ```events:``` field name and type (structure).**

Moreover it's better to make title field readonly.

## Usage within blueprints
After installing the custom form field, you can use the new ```type``` field ```calendarboard```.

```
title: Page title
pages: false
files: false
deletable: false
fields:
  title:
    label: Title
    type:  text   
  calendar:
    label: Job meetings
    type:  calendarboard
```

This will create a calendar board interface in panel page detail.

## Usage within templates
Long story short: events are stored in a structure field into a subpage named with ```day-yyyy-mm-dd``` format.
You can access to those through a standard Kirby code:

```php
foreach(page('[your-page]/[year-yyyy]/[day-yyyy-mm-dd]')->events()->toStructure() as $event){
    echo $event->hour()->html()
}
```

If you need a calendar view also in the website, you can use, for example, the great [Calendar library](https://github.com/bastianallgeier/calendar) by Bastian Allgeier and get something like this:

![calendar_website](https://cloud.githubusercontent.com/assets/11831276/12672797/1022b3fc-c679-11e5-81d2-a65be9c15e1a.png)

##About performance, breadcrumb and hack

Years folders are useful because they allow to split the day folders in more directories avoiding performance issues.
The con is that you will see the years breadcrumb in the panel header and you could open their pages.

![download](https://cloud.githubusercontent.com/assets/11831276/12788147/c333bb3a-ca98-11e5-9e84-ec1398095a56.png)

At the end years pages are almost useless and if you think that this could confound the user you can hide them.

**How to hide years breadcrumb:**

- create a panel.css file
- copy ``` nav.breadcrumb a[title^="year-"]{display:none} ``` in it
- upload panel.css into ``` www.yousite.com/assets/css/ ``` folder
- link to this css file in the config file with ```c::set('panel.stylesheet', '/assets/css/panel.css'); ```


## Author
Marco Oliva <team@moloc.net>. 
For suggestions or help [refer to the little imp](https://github.com/molocLab/kirby-calendar-board/issues/new).

## Credits
Thanks to [@bastianallgeier](https://github.com/bastianallgeier) for Kirby and [Calendar library](https://github.com/bastianallgeier/calendar) that is used by Calendar board
