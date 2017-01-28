# Setup

1. Download and install [SQL Server 2016 Developer Edition][sql-server-2016], creating SQL Server Authentication credentials.
1. Download and install [SQL Server Management Studio][ssms].
1. Download, install and run [Wamp Server][wamp].
1. Make sure Wamp icon at taskbar is green. For example, use port other than 80 for Apache if you have Skype installed
(Right click -> "Tools" -> "Use a port other than 80") and test if it works (Right Click -> "Tools" -> "Test port used: PORT").
1. Left click on Wamp -> "www directory". Create a new folder there and name it `workofart`. This will be the `PROJECT_PATH`.
1. Clone the remote repository to the local one at `PROJECT_PATH` and verify that project's code was pulled successfully.
1. Copy "workofart.mdf" from `PROJECT_PATH\database` to `MSSQLSERVER_INSTALLATION_PATH\MSSQL\DATA`.
1. Open SSMS and connect with the SQL Server Authentication credentials you previously created.
1. In SSMS, Right click on "Databases" -> "Attach..." -> "Add..." -> "workofart.mdf" -> OK (x2). If you get an error, try running SSMS as Administrator.
1. Run the query "initialize.sql" located in `PROJECT_PATH\database` within SSMS. Note your `SERVER_NAME`, disconnect and exit SSMS.
1. Download [Microsoft Driver for PHP for SQL Server (v4.0)][microsoft-driver] and run it, setting the extraction path of the files to `WAMP_INSTALLATION_PATH\bin\php\PHP7.X.XX\ext`
1. Left click on Wamp -> "PHP" -> "Version" -> "7.X.XX."
1. Left click on Wamp -> "PHP" -> "php.ini". At "Dynamic Extensions" add the following lines below the existing extensions:

        extension=php_sqlsrv_7_ts_x64.dll  
        extension=php_sqlsrv_7_nts_x64.dll  
        extension=php_pdo_sqlsrv_7_ts_x64.dll  
        extension=php_pdo_sqlsrv_7_nts_x64.dll  

1. Right click on Wamp -> "Wamp Settings". Make sure "VirtualHosts sub-menu" is checked.
1. Left click on Wamp -> "Localhost". On the opened page click "Add a Virtual Host" (if the button "Start the automatic correction of errors inside the green
borders panel" appears, just click it). Fill the required fields with `workofart` as the name and `PROJECT_PATH` as the path. Finally, click "Start the Creation of the VirtualHost".
1. Right Click on Wamp Icon -> "Tools" -> "Restart DNS" and wait for Wamp to turn green.
1. Go to `PROJECT_PATH`, create a copy of "database_initial.php" and name it "database.php". In the first lines of database.php set your own serverName, admin and adminpass
(e.g. "`SERVER_NAME`", "sa", "sapassword").
1. Left click on Wamp -> "Restart All Services" and wait for Wamp to turn green.
1. To quickly open the site in browser, Left click on Wamp -> "Your Virtual hosts" -> `workofart`

[sql-server-2016]: https://msdn.microsoft.com/library/dd206988.aspx
[ssms]: https://msdn.microsoft.com/en-us/library/mt238290.aspx
[wamp]: http://www.wampserver.com/en/#download-wrapper
[microsoft-driver]: https://www.microsoft.com/en-us/download/details.aspx?id=20098
