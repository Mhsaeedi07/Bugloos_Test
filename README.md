# Bugloos Test!

Tasks
--------------------------------
1 - Create a console command that parses the log file and inserts the data into the database.

2 - Design a REST API endpoint `/logs/count` which returns a count of rows that match the filter criteria. This endpoint accepts filters via GET HTTP verb and allows zero or more filter parameters.
The filter include:
- serviceNames
- statusCode
- startDate
- endDate

	The result of `/logs/count` is:
```
	{
		“count”: 50
	}
```





Command Line 
--------------------------------

```
php artisan Bugloos:log 
```
The default path is defined as `storage/app/logs.txt` but you can use `--path=` to define the path where you put the log.

like
```
php artisan Bugloos:log --path=storage/logs.txt
```





Idea
--------------
To improve the code, you can assign several workers to the job and make different Process of the log be written simultaneously. 
You can also keep the status of each queue so that you know the status of each file at the end
# Bugloos_Test
