<?php
require_once ("bootstrap.php");

if(!empty($_POST["email"]) && !empty($_POST["password"])) {
// Create tables if not exist
    create_tables_if_not_exist();
    $user_id=register_user();
    echo register_event($user_id);
}

function register_event($user_id) {
    global $con;

    $event_title=isset($_POST["event_title"]) ? filterData($_POST["event_title"]) : "";
    $event_head=isset($_POST["event_head"]) ? filterData($_POST["event_head"]) : "";
    $contact_no=isset($_POST["contact_no"]) ? filterData($_POST["contact_no"]) : "";
    $event_date=isset($_POST["event_date"]) ? filterData($_POST["event_date"]) : "";
    $event_start_time=isset($_POST["event_start_time"]) ? filterData($_POST["event_start_time"]) : "";
    $event_end_time=isset($_POST["event_end_time"]) ? filterData($_POST["event_end_time"]) : "";
    $event_description=isset($_POST["event_description"]) ? filterData($_POST["event_description"]) : "";
    $event_category=isset($_POST["event_category"]) ? filterData($_POST["event_category"]) : "";
    $event_ticket_status=isset($_POST["event_ticket_status"]) ? filterData($_POST["event_ticket_status"]) : "";
    $event_ticket_price=isset($_POST["event_ticket_price"]) ? filterData($_POST["event_ticket_price"]) : "";

    mysqli_stmt_init($con);
    $stmt = mysqli_prepare($con,"INSERT INTO events (user_id, title, head, contact_no, date, start_time, end_time, description, category, ticket_status, ticket_price) VALUES ( ? , ? , ? , ? , ? , ? , ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt,"issssssssss",$user_id, $event_title,$event_head, $contact_no, $event_date, $event_start_time, $event_end_time, $event_description, $event_category, $event_ticket_status, $event_ticket_price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return mysqli_insert_id($con);
}

function register_user() {
    global $con;

    $account_type=isset($_POST["account_type"]) ? filterData($_POST["account_type"]) : "";
    $name=isset($_POST["name"]) ? filterData($_POST["name"]) : "";
    $email=isset($_POST["email"]) ? filterData($_POST["email"]) : "";
    $password=isset($_POST["password"]) ? filterData($_POST["password"]) : "";
    $phone_number=isset($_POST["phone_number"]) ? filterData($_POST["phone_number"]) : "";
    $cms_id=isset($_POST["cms_id"]) ? filterData($_POST["cms_id"]) : "";
    $gender=isset($_POST["gender"]) ? filterData($_POST["gender"]) : "";

    mysqli_stmt_init($con);
    $stmt = mysqli_prepare($con,"INSERT INTO users ( account_type , name , email , password , phone_number , cms_id , gender) VALUES ( ? , ? , ? , ? , ? , ? , ?)");
    mysqli_stmt_bind_param($stmt,"sssssss",$account_type,$name, $email, $password, $phone_number, $cms_id, $gender);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return mysqli_insert_id($con);
}

function create_tables_if_not_exist() {
    global $con;

    mysqli_query($con,"
    CREATE TABLE IF NOT EXISTS users (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `account_type` varchar(50) DEFAULT NULL,
              `name` varchar(50) DEFAULT NULL,
              `email` varchar(50) DEFAULT NULL,
              `password` LONGTEXT DEFAULT NULL,
              `phone_number` varchar(50) DEFAULT NULL,
              `cms_id` varchar(50) DEFAULT NULL,
              `gender` varchar(50) DEFAULT NULL,
              `created` datetime DEFAULT current_timestamp(),
              `last_mod` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
    ");

    mysqli_query($con,"
    CREATE TABLE IF NOT EXISTS events (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) DEFAULT 0,
              `title` varchar(50) DEFAULT NULL,
              `head` varchar(50) DEFAULT NULL,
              `contact_no` varchar(50) DEFAULT NULL,
              `date` varchar(50) DEFAULT NULL,
              `start_time` varchar(50) DEFAULT NULL,
              `end_time` varchar(50) DEFAULT NULL,
              `description` varchar(300) DEFAULT NULL,
              `category` varchar(50) DEFAULT NULL,
              `ticket_status` varchar(50) DEFAULT NULL,
              `ticket_price` varchar(50) DEFAULT NULL,
              `created` datetime DEFAULT current_timestamp(),
              `last_mod` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
    ");

}

mysqli_close($con);
