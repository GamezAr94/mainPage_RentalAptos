<?php
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
                                                                group by apts_fk) AND aptocontract.ac_endD > CAST(CURRENT_TIMESTAMP AS DATE) AND room.room_id = ?";
    $allApartmentsSQL = "SELECT *
                FROM apartaments
                Inner join room
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
                                                        group by apts_fk) AND aptocontract.ac_endD > CAST(CURRENT_TIMESTAMP AS DATE)
                order by room.room_price asc;";

//this sql display the current date, but CURDATE() only works in MySQL
    $thisMonthApartments = "SELECT *
    FROM apartaments
    Inner join room
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
                                            group by apts_fk) AND aptocontract.ac_endD > CAST(CURRENT_TIMESTAMP AS DATE) AND room_users.ru_endD < curdate()
                    order by room.room_price asc;";