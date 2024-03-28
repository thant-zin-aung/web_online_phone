<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blacksky Online Phone</title>

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/e2c9faac31.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Custom css -->
    <link rel="stylesheet" href="assets/css/app-style.css">
    <!-- Jquer and ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Permanent+Marker&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

    <div class="nav-bar-wrapper">
        <div class="nav-bar">
            <div class="left-side-nav-bar">
                <div class="logo-wrapper">
                    <div class="logo-left logo-blacksky-text">BLACKSKY</div>
                    <div class="logo-right">
                        <div class="logo-online-text">online</div>
                        <div class="logo-image-wrapper"><i class="fa-solid fa-square-phone-flip logo-image"></i></div>
                    </div>
                </div>

                <div class="server-status-wrapper">
                    <div class="up-part">
                        <img src="assets/img/server.png" alt="server-icon">
                        <span class="server-status-text">Server status</span>
                    </div>
                    <div class="down-part">
                        <i class="fa-solid fa-circle server-status-bulb server-status-color"></i>
                        <span class="server-status-text server-status-color">Online</span>
                    </div>
                </div>
            </div>

            <div class="balance-wrapper">
                    <div class="balance-text-wrapper">
                        <div class="available-balance">Available balance</div>
                        <div class="balance-text"></div>
                    </div>
                    <div class="balance-logo-wrapper">
                        <i class="fa-solid fa-coins balance-icon"></i>
                    </div>
            </div>
        </div>
    </div>

    <div class="success-pop-up-box-wrapper pop-up-box">
        <i class="fa-solid fa-circle-check"></i>
        <div class="text"></div>
    </div>
    <div class="fail-pop-up-box-wrapper pop-up-box">
        <i class="fa-solid fa-circle-xmark"></i>
        <div class="text"></div>
    </div>


    <section id="caller-number">
        <div class="caller-number-wrapper make-shadow-box">    
            <i class="fa-solid fa-circle-xmark make-shadow-box close-button"></i>
            <div class="section-label">Please select a caller number</div>
            <div class="available-number-wrappers"></div>
            <div class="call-button-wrapper">Start Call</div>
        </div>
    </section>
