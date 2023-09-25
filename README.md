# SQLi

On this repository I will show a little example of a SQL Injection.

<br>What I want to achieve?</br>

I want to see if I’m able get confidential data from a web app by interfering with queries. 

<br>How I will achieve it?</b>

By using SQL attacks to a simple web that connects to a MySQL DB.

<br>Procedure:</br>

I’ve created the data base using MySQL Workbench 8.0. The DB consists of 2 basic tables, USERS and NEWS.
The USERS table contains the following user information:
Email Address
    • User Name
    • Password
    • Account ID
    • News ID
![sql_1](sql_1.png)
The News table contains:
    • News ID
    • News Title
    • News Text
    • Date
![sql_2](sql_2.png)
Web environment creation:
I’ve used Visual Studio Code with a PHP extension. The code will be available separately in this repo.

Differences between SQLi and BLIND SQLi?
SQLi (SQL Injection) and Blind SQLi (Blind SQL Injection) are both types of security vulnerabilities that occur in web applications and can be exploited by attackers to gain unauthorized access to a database or retrieve sensitive information. However, they differ in how they are executed and the level of information an attacker can extract.
SQL Injection (SQLi): SQL Injection is a common web application vulnerability that occurs when an attacker can manipulate or inject malicious SQL code into an application's input fields. This happens when the application does not properly validate or sanitize user input before using it in SQL queries. As a result, the attacker can modify the SQL query to execute arbitrary database commands.
Example: Consider a login form where a user enters their username and password. If the application does not validate user input properly, an attacker can enter the following in the password field:
```
' OR '1'='1
```

If the application concatenates the input directly into the SQL query, this input would make the query always return true, allowing the attacker to log in without a valid password.

Blind SQL Injection (Blind SQLi): Blind SQL Injection is a variation of SQL Injection where the application does not directly display the results of the SQL query to the attacker. In this case, the attacker can still inject malicious SQL code, but they may not see the results directly. Instead, they use Boolean-based or time-based techniques to infer information from the application's behavior.
Example: In a blind SQLi attack, an attacker may inject code that checks whether a specific condition is true or false. For instance:
```
' OR 1=1 --
```
The attacker may not see the query results, but if the application behaves differently when the condition is true (e.g., a page loads successfully) or false (e.g., an error message appears), they can deduce information about the database structure or data.
In summary, the main difference between SQL Injection and Blind SQL Injection is in how the attacker interacts with the application's response. SQL Injection allows the attacker to directly see and manipulate the query results, while Blind SQL Injection relies on the attacker inferring information from the application's behavior without direct access to the results. Both vulnerabilities are serious security threats and should be mitigated through proper input validation and parameterized queries in web applications.
