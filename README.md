# Webinar Registration Date Generator
### Description
[Lien Solutions](https://www.liensolutions.com/) needed a quick way to generate an excel spreadsheet with webinar registration dates so that users could review the times and days that webinars were being offered.

Creating this spreadsheet by hand would take a few hours for somebody to finalize. I created this semi-independent application using [Carbon](https://carbon.nesbot.com/) to loop through the 365 days in the year and output a static page and ``.xlsx`` file to review the dates.

This script will output webinar dates for each Tuesday and Wednesday of the current year for each type of class.

### Output

|WebinarDay|WebinarName|WebinarStart|WebinarEnd|WebinarClose|
|----------|-----------|------------|----------|------------|
|Wednesday|January 10, 2018 - iLien Beginners Filing|1/10/2018 14:30|1/10/2018 15:30|1/10/2018 0:00|
|Thursday|January 11, 2018 - iLien Beginners Filing|1/11/2018 10:30|1/11/2018 11:30|1/11/2018 0:00|
|Wednesday|January 10, 2018 - iLien Beginners Searching|1/10/2018 10:30|1/10/2018 11:30|5/24/2018 0:00|
|Thursday|January 11, 2018 - iLien Beginners Searching|1/11/2018 14:30|1/11/2018 15:30|5/25/2018 0:00|

### Bugs? Suggestions?
Create a new issue so that I can review
