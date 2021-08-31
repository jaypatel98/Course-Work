# Homework 3 -- Group Work

## File Processing

In this assignment you will need to perform file I/O to create files
that can be used to populate a database with values. While it is not too
terribly time consuming to create an empty database, it can take hours
(days, weeks, ...) to fill a database with data so that we can practice
writing queries on the database. We will use PHP to create random data
that can fill our database.

For the database we used in prior semesters I have two examples below of
movie descriptions that were created for the "sakila" database.

A Epic Drama of a Feminist And a Mad Scientist who must Battle a Teacher
in The Canadian Rockies

A Astounding Epistle of a Database Administrator And a Explorer who must
Find a Car in Ancient China

These both have the format:

A \_\_\_\_\_\_ of a \_\_\_\_\_ and a \_\_\_\_\_\_ who must \_\_\_\_\_\_
in \_\_\_\_\_\_.

The blanks are filled in with random data from a list of potential
values. For this assignment you will be creating random customers and
addresses. (In a future assignment you will use this assignment as a
template to create items or inventory for a store, as well as some other
data to insert into a database).

## Tasks

1)  I have provided you with several text files in the hw3 folder (where
    you found this document). Open these files up in a text editor (not
    Windows notepad), and study the format of these files. Some files
    have delimiters, some have a new value on each row. These files
    provide you with a list of first names, last names, domains, street
    names, and street types -- such as "drive", "lane", "circle". You
    may NOT ALTER these files. You must read them into memory as they
    are given to you.

2)  Write an HTML page called **start.html** that has a single submit
    button that will start the processing in a php file that you will
    create. Your form should start a php script called
    **create_data.php**.

3)  **create_data.php** will read the data from the text files into an
    arrays (you can split this among team members). (Note for the
    domains, you will need to combine hotmail and com into
    "hotmail.com"). Each element in each array should be a single field
    from the text file. (The exception is the domain file wherein you
    need to combine two fields into a single value as specified by
    hotmail.com above).

4)  You should use the html **\<pre> \</pre>** tag and the **print_r**
    function to print each of these arrays. Print a heading above each
    array to label them (i.e. first names, last names, etc ...).

5)  You will now need to generate an html table of customer information.
    You will use the first names, last names, domain names, street names
    and street types to generate random customer data from your input
    data. You need to generate data for 25 people. Every name should be
    unique, and every address should be unique. A sample table with 2
    customers is given below.

![image](https://user-images.githubusercontent.com/35778319/131586521-42b5cec3-f234-4a39-aa17-1e0537a06d66.png)


6)  The final task is to write your customer data to a file called
    "**customers.txt**" The file should be formatted as shown below for
    the two customers shown in the table above.

Amanda:McCarter:248 Alleppey Street:Amanda.McCarter\@exhange.com

Roger:Duggan:16 Mandaluyong Drive:Roger.Duggan\@gmail.com
