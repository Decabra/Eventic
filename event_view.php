<?php
require_once('api/bootstrap.php');

if(!empty($_GET["id"])) {
    $id=filterData($_GET["id"]);
    if (DateTime::createFromFormat('Y-m-d', $id) !== FALSE) {
        $sql=mysqli_query($con, "SELECT * FROM events WHERE date between curdate() and '{$id}'");
    } else {
        $sql=mysqli_query($con, "SELECT * FROM events WHERE id={$id}");
    }
    if($sql) $data=mysqli_fetch_array($sql);
    if(!empty($data)) {
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Eventic</title>
            <link rel="stylesheet" href="assets/css/poppins.css">
            <link rel="stylesheet" href="assets/css/flexer.css">
            <link rel="stylesheet" href="assets/css/style.css">
        </head>
        <body class="event-view">
        <header id="site-header" >
            <nav class="fx-row justify-between">
                <div class="nav-sect-one logo eventic fx-col-5">EVEN<span class="tic">TIC</span></div>
                <div class="nav-sect-two fx-row justify-even fx-col-7 align-center">
                    <a href="#/">Home</a>
                    <a href="#/">About Us</a>
                    <a href="#/">Create Event</a>
                    <a href="#/">Sign in</a>
                    <a href="register.html" class="butn">Register</a>
                </div>
            </nav>
        </header>
        <main>
            <section class="fx-row align-center ">
                <div class="sib-one fx-col-5">
                    <div class="event-title"><?php echo $data["title"]; ?></div>
                    <div class="organise-by">ORGANISED BY:</div>
                    <div class="event-organiser"><?php echo $data["head"]; ?></div>
                    <div class="hor-rule"></div>
                    <a href="register.html" class="butn reg">Get Tickets</a>
                    <div class="eve-overview">Event Overview</div>
                    <div class="event-detail">Event Type: <?php echo ucfirst($data["category"]); ?> | Ticket Price: <?php echo $data["ticket_price"] ? $data["ticket_price"] : 'Free'?></div>
                    <p class="event-description"><?php echo $data["description"]; ?></p>
                </div>
                <div class="sib-two fx-row fx-col-7 justify-fx-end  ">
                    <div class="widget-cont m-r-3">
                        <div class="widgets m-r-3">
                            <div id="counter" class="time-cont fx-row justify-between">
                            </div>
                            <div class="time-letter fx-row justify-between">
                                <div class="d-letter">DAYS</div>
                                <div class="h-letter">HOURS</div>
                                <div class="m-letter">MINUTES</div>
                                <div class="s-letter">SECONDS</div>
                            </div>
                        </div>
                        <div class="fx-row justify-between event-img-cont">
                            <div class="widget-calendr text-center">
                                <img src="assets/img/calendar.png" alt="">
                                <div><?php echo $data["date"]; ?></div>
                            </div>
                            <div class="widget-time text-center">
                                <img src="assets/img/time.png" alt="">
                                <div><?php echo $data["start_time"]; ?>-<?php echo $data["end_time"]; ?></div>
                            </div>
                            <div class="widget-hall text-center">
                                <img src="assets/img/venue.png" alt="">
                                <div >SEECS Seminar Hall</div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </main>

        <script src="assets/libs/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
        <script src="assets/js/jquery.js"></script>

        <script>
            // Set the date we're counting down to
            const countDownDate = new Date("<?php echo $data["date"]; ?>").getTime();

            // Update the count down every 1 second
            const x = setInterval(function () {

                // Get today's date and time
                const now = new Date().getTime();

                // Find the distance between now and the count down date
                const distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("counter").innerHTML = "<span>"+ days + "</span><span>" + hours + "</span><span>:</span><span>"
                    + minutes + "</span><span>:</span><span>" + seconds + "</span>";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("counter").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
        </body>
        </html>

        <?php
    } else {
        echo "Invalid event id";
    }
} else {
    echo "Event not found";
}
?>
