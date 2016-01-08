a.
SELECT r.name, r.type, r.url, l.first_open_date, l.manager, l.phone_number, l.street_address, l.hour_open, l.hour_close FROM Restaurant R 
         JOIN Location L ON R.restaurantid = L.restaurantid
         WHERE R.restaurantid=1;

b.
SELECT m.name, m.category, m.description, m.price FROM menuitem M
         WHERE m.restaurantid=1
         ORDER BY m.category;

c.
SELECT l.manager, l.first_open_date FROM location l, restaurant r
         WHERE r.restaurantid = l.restaurantid
         AND r.type='mexican';

d.
SELECT DISTINCT m.name, l.manager, l.hour_open, l.hour_close, r.url FROM menuitem m, location l, restaurant r
WHERE m.restaurantid=1 AND l.restaurantid=1 AND r.restaurantid=1 AND m.price >= ALL (SELECT m2.price FROM menuitem m2 WHERE restaurantid=1);

g.
SELECT DISTINCT r.name, r.type,l.phone_number  FROM restaurant r
                JOIN location l ON r.restaurantid = l.restaurantid
                WHERE r.restaurantid NOT IN (SELECT ra.restaurantid FROM rating ra
                                             WHERE ra.date_submitted >= '2015-01-01'
                                             AND ra.date_submitted <= '2015-01-31');
           
h.
SELECT DISTINCT r.name, l.first_open_date FROM restaurant r, location l, rating ra
                WHERE ra.staff < ALL (SELECT ra2.price FROM rating ra2 WHERE ra2.userid=7)
                OR    ra.staff < ALL (SELECT ra3.food FROM rating ra3 WHERE ra3.userid=7)
                OR    ra.staff < ALL (SELECT ra4.mood FROM rating ra4 WHERE ra4.userid=7)
                OR    ra.staff < ALL (SELECT ra5.price FROM rating ra5 WHERE ra5.userid=7)
                OR    ra.staff < ALL (SELECT ra6.staff FROM rating ra6 WHERE ra6.userid=7);
How could you order by something you haven’t selected??      

I+j:
SELECT r.type FROM restaurant r, rating ra
              WHERE r.type=r.type AND  

              (SELECT SUM(ra.food) FROM rating ra, restaurant r
                            WHERE r.type=r.type) > ALL (
              
                           (SELECT SUM(ra2.food) FROM rating ra2, restaurant r2
                            WHERE r2.type=r2.type GROUP BY r2.type));


K:
SELECT r.name, r.join_date, r.reputation, ra.date_submitted, re.name FROM rater r, rating ra
               JOIN restaurant re ON re.restaurantid = ra.restaurantid
               WHERE r.userid=ra.userid AND ra.food='5' AND ra.mood='5'
               GROUP BY r.name, r.join_date, r.reputation, ra.date_submitted, re.name;

L:
SELECT r.name, r.reputation, ra.date_submitted, re.name FROM rater r, rating ra
               JOIN restaurant re ON re.restaurantid = ra.restaurantid
               WHERE r.userid=ra.userid AND ra.food='5' OR ra.mood='5'
               GROUP BY r.name, r.reputation, ra.date_submitted, re.name;
           
              
n:
SELECT rater.name, rater.email FROM rater 
WHERE 
(SELECT ra1.price+ra1.food+ra1.mood+ra1.staff FROM rating ra1,rater rat1 WHERE ra1.userid=rat1.userid AND rat1.name=rater.name)
< ALL
(SELECT ra.price+ra.food+ra.mood+ra.staff FROM rating ra,rater rat WHERE rat.name='howzlife' AND ra.userid=rat.userid);