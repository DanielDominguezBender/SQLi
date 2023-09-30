# SQLi

On this repository I will show a little example of a SQL Injection.

## What I want to achieve?

I want to see if I’m able get confidential data from a web app by interfering with queries. 

## How I will achieve it?

By using SQL attacks to a simple web that connects to a MySQL DB.

<b>DB creation</b>

I’ve created the data base using MySQL Workbench 8.0. The DB consists of 2 basic tables, USERS and NEWS.
The USERS table contains the following user information:
- Email Address
- User Name
- Password
- Account ID
- News ID
  
![sql_1](imgs/sql_1.png)

The News table contains:
- News ID
- News Title
- News Text
- Date

![sql_2](imgs/sql_2.png)

<b>Web environment creation</b><br>
I’ve used Visual Studio Code with a PHP extension. The code will be available separately in this repo.

![sql_3](imgs/sql_3.png)

A local version of the web can be launched via the PHP extension in Visual Studio Code:

![sql_4](imgs/sql_4.png)

The INDEX of the page would look like this:

![sql_5](imgs/sql_5.png)

Snapshot of part of the code:

```
<?php
// Get parameter
$id=$_GET['id'];
$sql = "SELECT * FROM News WHERE Id=$id;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0){
while($row = mysqli_fetch_assoc($result)){
echo $row['Title']."<br><br>";;
echo $row['DateTime']."<br><br>";
echo $row['Body']."<br>";
}
}
?>
```

Before proceeding further on my example, I would like to explain I bit what exactly is SQLi and the differences it has with Blind SQLi.

## SQLi vs BLIND SQLi?

SQLi (SQL Injection) and Blind SQLi (Blind SQL Injection) are both types of security vulnerabilities that occur in web applications and can be exploited by attackers to gain unauthorized access to a database or retrieve sensitive information. However, they differ in how they are executed and the level of information an attacker can extract.  

<b>SQL Injection (SQLi):</b> SQL Injection is a common web application vulnerability that occurs when an attacker can manipulate or inject malicious SQL code into an application's input fields. This happens when the application does not properly validate or sanitize user input before using it in SQL queries. As a result, the attacker can modify the SQL query to execute arbitrary database commands.  
Example: Consider a login form where a user enters their username and password. If the application does not validate user input properly, an attacker can enter the following in the password field:
```
' OR '1'='1
```
If the application concatenates the input directly into the SQL query, this input would make the query always return true, allowing the attacker to log in without a valid password.

<b>Blind SQL Injection (Blind SQLi):</b> Blind SQL Injection is a variation of SQL Injection where the application does not directly display the results of the SQL query to the attacker. In this case, the attacker can still inject malicious SQL code, but they may not see the results directly. Instead, they use Boolean-based or time-based techniques to infer information from the application's behavior.  
Example: In a blind SQLi attack, an attacker may inject code that checks whether a specific condition is true or false. For instance:
```
' OR 1=1 --
```
The attacker may not see the query results, but if the application behaves differently when the condition is true (e.g., a page loads successfully) or false (e.g., an error message appears), they can deduce information about the database structure or data.
In summary, the main difference between SQL Injection and Blind SQL Injection is in how the attacker interacts with the application's response. SQL Injection allows the attacker to directly see and manipulate the query results, while Blind SQL Injection relies on the attacker inferring information from the application's behavior without direct access to the results. Both vulnerabilities are serious security threats and should be mitigated through proper input validation and parameterized queries in web applications.

So, after this short explanation, let's go back to track! 😄
As previously explained, the main purpose of this repository was to show a little example on how an SQLi attack behave.
On the following image we can see a typical NEWS page.

![sql_9](imgs/sql_9.png)

As you can see, on the URL it shows the ID related to PIZZAGATE.
```
/news.php?id=2
```
Now let's check if the web app is vulnerable and that it can be explotable with SQLi.
Let's try playing around with some SQL statements on the URL.

First I will try to use some TRUE statements.
```
[...]?id=2 and 1=1
```
![sql_10](imgs/sql_10.png)

```
[...]?id=2 or 1=10
```
![sql_11](imgs/sql_11.png)

Now I will try with some FALSE statements (it should not show any information).

![sql_12](imgs/sql_12.png)

After this testing, I arrived to the following conclusion:

- That applying <i>true</i> statements it showed the information related to the ID.
- That pplying <i>false</i> statements I was not able to get any relevant information.

Which means that this web app is vulnerable to BLIND SQLi attacks. :sunglasses:
