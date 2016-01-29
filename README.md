# Calendar board for Kirby
**Calendar board** is a custom form field for [Kirby CMS](https://getkirby.com/).
This plugin provides an easy way to add and manage events, activities or booking in the panel through an intuitive calendar board interface.

![calendar_panel](https://cloud.githubusercontent.com/assets/11831276/12672758/d4f6b954-c678-11e5-9dd7-60a4e67c2f71.png)

## How it works
You can navigate calendar board month by month and every day cell visualizes the number of events of that day through some little dots.

Everytime you click on a day cell a little imp creates a day subpage (or edits it if the page already exists) slugging it in a ```day-yyyy-mm-dd``` format, then opens that page detail.

The events in this page are stored into a structure field named ```events```.

## Installation
If not already existing, add a new ```fields``` folder to ```site``` directory.
Put ```calendarboard``` folder and all its contents into ```/site/fields/```.

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
foreach(page('page/day-yyyy-mm-dd')->events()->toStructure() as $event){
    echo $event->hour()->html()
}
```

If you need a calendar view also in the website, you can use, for example, the great [Calendar library](https://github.com/bastianallgeier/calendar) by Bastian Allgeier and get something like this:

![calendar_website](https://cloud.githubusercontent.com/assets/11831276/12672797/1022b3fc-c679-11e5-81d2-a65be9c15e1a.png)

For suggestions or help [please let me know](https://github.com/molocLab/kirby-calendar-board/issues/new).


## Author
Marco Oliva <team@moloc.net>

## Credits
Thanks to [@bastianallgeier](https://github.com/bastianallgeier) for Kirby and [Calendar library](https://github.com/bastianallgeier/calendar) that is used by Calendar board
