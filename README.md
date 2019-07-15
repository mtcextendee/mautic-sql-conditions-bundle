# MauticSqlConditionsBundle

SQL conditions for Mautic

## Support

https://mtcextendee.com/plugins

## Installation

### Command line
- `composer require mtcextendee/mautic-sql-conditions-bundle`
- `php app/console mautic:plugins:reload`
-  Go to /s/plugins and setup SQL Conditionsł

### Manual 
- Download last version https://github.com/mtcextendee/mautic-sql-conditions-bundle/releases
- Unzip files to plugins/MauticSqlConditionsBundle
- Clear cache (app/cache/prod/)
- Go to /s/plugins/reload
- Setup SQL Conditions integration

## Usage

1, See new item on left menu:

![image](https://user-images.githubusercontent.com/462477/61192212-1567ed00-a6b3-11e9-971e-eb3ab3df6beb.png)

2, Setup SQL conditions

3, Parameters for SQL

- :contactId
- :campaignId
- :eventId
- :rotation

4, Condition return true If there is results

## Examples

Condition for contacts with ID greather like 2000

`SELECT l.id FROM leads l WHERE l.id = :contactId and l.id > 2000`

## Credits

Icons made by <a href="https://www.flaticon.com/authors/eleonor-wang" title="Eleonor Wang">Eleonor Wang</a> from <a href="https://www.flaticon.com/" 		    title="Flaticon">www.flaticon.com</a> 
