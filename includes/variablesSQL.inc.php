<?php
//where the last room contract and the last apartament contract and the last apartament contract is greather than todays date and room id is equal to...
$displayInfoApartments = "SELECT *
                        FROM apartaments
                        right join room
                        on room.apts_fk = apartaments.apts_id
                        INNER JOIN aptocontract
                        on aptocontract.apts_fk = apartaments.apts_id
                        inner join room_users
                        on room_users.room_fk = room.room_id
                        where room_users.ru_endD in (
                                        select MAX(ru_endD)
                                        from room_users
                                        group by room_fk) AND aptocontract.ac_endD in (
                                                                select MAX(ac_endD)
                                                                FROM aptocontract
                                                                group by apts_fk) AND aptocontract.ac_endD > curdate() AND room.room_id = ?";

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