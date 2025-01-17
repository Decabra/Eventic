<?php
require_once('api/bootstrap.php');

$sql=mysqli_query($con, "SELECT date FROM events");
if($sql) {
    $events_data=mysqli_fetch_all($sql, MYSQLI_ASSOC);
} else {
    $events_data=[];
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Eventic</title>
    <link rel="stylesheet" href="assets/css/poppins.css">
    <link rel="stylesheet" href="assets/css/flexer.css">
    <link rel="stylesheet" href="assets/css/simple-calendar.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body id="home">
<header id="site-header" >
    <nav class="fx-row">
        <div class=" nav-sect-one logo fx-col-7">LOGO</div>
        <div class="nav-sect-two fx-row justify-even fx-col-5 align-center">
            <a href="home.html">Home</a>
            <a href="#/">About</a>
            <a href="#/">Sign in</a>
            <a href="register.html" class="butn">Register</a>
        </div>
    </nav>
</header>
<main>
    <section class="fx-row align-center fx-nowrap">
        <div class="home-content fx-col-3">
            <div class="title">EVENTIC</div>
            <h3>A celebration of sucess</h3>
            <p>Lorem ipsum dolor sit amet, consectetur<br> adipisicing elit. Dolor ea, expedita om<br>nis quia earum esse ipsa ipsum.</p>
            <div class="fx-row justify-between">
                <a href="register.html" class="butn reg">Get Registered</a>
                <a href="" class="lm-butn">Learn More</a>
            </div>
        </div>
        <div class="home-img fx-col-9">
            <img src="assets/img/main illustration.svg" alt="">
        </div>
    </section>
    <a id="upcoming-event-divider" class="divider fx-row justify-center align-center" href="#event-calender">
        <div>
            <img src="assets/img/chevron_highlight.png" alt="">
        </div>
        <div>View upcoming events</div>
    </a>
    <section>
        <div id="event-calender" class="fx-row calendar-container fx-col"></div>
    </section>
</main>
<script src="assets/libs/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/js/jquery.simple-calendar.js"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
<script src="assets/js/jquery.js"></script>

<script>
    $(document).ready(function () {
        const f_events_data=[];
        const events_data=JSON.parse('<?php echo json_encode($events_data); ?>');
        if(events_data) {
            for (const event_key in events_data) {
                if(events_data.hasOwnProperty(event_key)) {
                    f_events_data[event_key]= {};
                    f_events_data[event_key].startDate= new Date(events_data[event_key].date).toDateString();
                    f_events_data[event_key].endDate= new Date(events_data[event_key].date).toDateString();
                }
            }
        }

        $("#event-calender").simpleCalendar({
            fixedStartDay: 1, // begin weeks by monday
            disableEmptyDetails: true,
            onDateSelect: function (date, events) {
                const year = date.getUTCFullYear();
                const month = date.getUTCMonth() + 1;
                const day = date.getUTCDate();
                window.location = "event_view.php?id="+year+"-"+month+"-"+day;
            },
            displayEvent:true,
            events: f_events_data
        });

        $("#upcoming-event-divider").on('click', function (e) {
            const href=$(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top
            }, 600);
            e.preventDefault();
        });
    });
</script>

</body>
</html>
