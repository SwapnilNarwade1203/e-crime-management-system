<!DOCTYPE html>
<html>
<head>
    <title>Official Login</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: linear-gradient(to right, #33AEFF);
            margin: 0;
            padding: 60px;
            background-size: cover;
            background-image: url(office.jpeg);
            background-position: center;
        }
        .navbar {
            border-radius: 0;
            margin-bottom: 0;
            background: rgba(0, 0, 0, 0.9);
        }
        .navbar-brand {
            color: #fff !important;
        }
        .navbar-nav > li > a {
            color: #fff !important;
        }
        .navbar-nav > li > a:hover {
            color: #ddd !important;
        }
        .hero-feature {
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .thumbnail {
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .thumbnail .caption {
            text-align: center;
            padding: 20px;
        }
        .thumbnail .caption h3 {
            color: #0062E6;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #0062E6;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #004bb5;
        }
        .container {
            margin-top: 5px;
        }
        @media (max-width: 767px) {
            .hero-feature {
                margin-top: 10%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><b>Crime Management System</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li><a href="home.php">HOME</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 col-sm-12 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Police Login</h3>
                        <p>
                            <a href="policelogin.php" class="btn btn-primary">Police Login</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-12 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Incharge Login</h3>
                        <p>
                            <a href="inchargelogin.php" class="btn btn-primary">Incharge Login</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>HQ Login</h3>
                        <p>
                            <a href="headlogin.php" class="btn btn-primary">HQ Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
