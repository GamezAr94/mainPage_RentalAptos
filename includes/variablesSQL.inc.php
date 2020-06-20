<?php
//where the last room contract or the last contract is null and the last apartament contract and the last apartament contract is greather than todays date and room id is equal to...
//this sql to avoid inyections, the user only can display the info from the room contract from url 
$displayInfoApartments = "SELECT *
FROM apartaments
inner join room
on room.apts_fk = apartaments.apts_id
INNER JOIN aptocontract
on aptocontract.apts_fk = apartaments.apts_id
left join room_users
on room_users.room_fk = room.room_id
where (room_users.ru_endD in (
                select MAX(ru_endD)
                from room_users
                group by room_fk) is null or
                room_users.ru_endD in (
                select MAX(ru_endD)
                from room_users
                group by room_fk) )
                AND aptocontract.ac_endD in (
                                        select MAX(ac_endD)
                                        FROM aptocontract
                                        group by apts_fk) AND aptocontract.ac_endD > curdate() AND room.room_id = ?;";

//this sql display the current date, but CURDATE() only works in MySQL++++++++++++++++++++++++++++++++++
//where the last contract of the room and the contract of the apartment is current, and that last contract is greather than todays date, or the contract room is empty
$allApartmentsSQL = "SELECT *
                FROM apartaments
                Inner join room
                on room.apts_fk = apartaments.apts_id
                INNER JOIN aptocontract
                on aptocontract.apts_fk = apartaments.apts_id
                left join room_users
                on room_users.room_fk = room.room_id
                where room_users.ru_endD in (
                                select MAX(ru_endD)
                                from room_users
                                group by room_fk) AND aptocontract.ac_endD in (
                                                        select MAX(ac_endD)
                                                        FROM aptocontract
                                                        group by apts_fk) AND aptocontract.ac_endD > curdate() OR room_users.ru_startD is NULL
                                                        order by room_users.ru_endD asc;";

//this sql display the current date, but CURDATE() only works in MySQL++++++++++++++++++++++++++++++++++
//where the last contract to expire by each room, and the contract of the apartment is current and the last contract of the apartment is greather than todays date or the contract in the room is null
    $thisMonthApartments = "SELECT *
    FROM apartaments
    Inner join room
    on room.apts_fk = apartaments.apts_id
    INNER JOIN aptocontract
    on aptocontract.apts_fk = apartaments.apts_id
    left join room_users
    on room_users.room_fk = room.room_id
    where room_users.ru_endD in (
                    select MAX(ru_endD)
                    from room_users
                    group by room_fk) AND aptocontract.ac_endD in (
                                            select MAX(ac_endD)
                                            FROM aptocontract
                                            group by apts_fk) AND aptocontract.ac_endD > curdate() AND room_users.ru_endD < curdate() OR room_users.ru_startD is NULL
                    order by room.room_price asc;";

//Full apartment query
//this query checks the last contract of each room in an apartment and checks if the last contract is null (that means that all the rooms are null) and checks if the apartment still with a current contract
$fullApto = "SELECT *
FROM apartaments
inner join room
on room.apts_fk = apartaments.apts_id
INNER JOIN aptocontract
on aptocontract.apts_fk = apartaments.apts_id
left join room_users
on room_users.room_fk = room.room_id
where (room_users.ru_endD in (
                select MAX(ru_endD) 
                from room_users
                left join room
                on room.room_id = room_users.room_fk
                inner join apartaments
                on apartaments.apts_id = room.apts_fk
                group by apartaments.apts_id) is null or room_users.ru_endD in (
													select MAX(ru_endD) 
													from room_users
													left join room
													on room.room_id = room_users.room_fk
													inner join apartaments
													on apartaments.apts_id = room.apts_fk
													group by apartaments.apts_id)) AND aptocontract.ac_endD > curdate()
                                                    order by room_users.ru_endD asc;";