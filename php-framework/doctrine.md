# Doctrine Bundle and MySQL

## MySQL
### Temporary Table

You can use the TEMPORARY keyword when creating a table. A TEMPORARY table is visible only to the current session, and is dropped automatically when the session is closed. This means that two different sessions can use the same temporary table name without conflicting with each other or with an existing non-TEMPORARY table of the same name. (The existing table is hidden until the temporary table is dropped.) 

<p class="tip">
    To create temporary tables, you must have the CREATE TEMPORARY TABLES privilege.
</p>


```sql
-- table: customer(id, gender, name)
CREATE temporary TABLE IF NOT EXISTS female_customers AS 
 (  SELECT c.id 
    FROM customer AS c
    AND c.gender === 'F'
 ) 
```

