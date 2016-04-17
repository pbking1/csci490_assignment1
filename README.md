##reference searching engine

####project description
- The project is used for searching information about reference.

####file description
- The following folder is the main code file
    - index.html
        - **This file contain the code that call the file in the pages folder**
    - keyword_2show
        - This file contain the keyword in the selection in search page.
    - pages
        - db_connect.php
            - **This file contain the way to access the database**
        - index.html
            - **This file will contain the code of dash broad**
            - **The contain can be redefined in the future**
        - search.php
    - database_design
        - data
            - data_csv
                - author_data.csv
                - institution_data.csv
                - journal_data.csv
                - keyword_data.csv
                - paper_author_data.csv
                - paper_data.csv
                - paper_institution_data.csv
            - data.xlsx
                - **The data file in the data_csv file is generated using this xlsx file**
            - sql_script
                - create_table.sql
                    - **When try to import the data into database, use the command**
                        - **mysql -uroot -p < create_table.sql**
        - database_schema.png
            - **The schema of the database design**

####database set up
- The way we start the mysql database is using the description in
    - http://webmaster.iu.edu/tools-and-guides/mysql/mysql-setup-guide-old.phtml
- After that import the create_table.sql schema into the database

####FAQ
- Where is the porject located in the server?
    - The project is located in the webserve.iu.edu:~/www
    - use the command "ssh scimap@webserve.iu.edu" to login

- how to access the web page after deploying the project?
    - go to "www.iu.edu/~scimap"

####future work
- 1.Add more search option
- 2.Search through more table

