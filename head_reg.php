<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <style>
        /* General body styling */
        body {
            font-family: 'Lato', sans-serif;
            background: url('locker.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Navbar styling */
        .navbar {
            border-radius: 0;
            margin-bottom: 0;
            background: rgba(0, 0, 0, 0.9);
        }

        .navbar-brand {
            color: #fff !important;
        }

        /* Form container styling */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 40px); /* Adjust height considering navbar height */
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-container h1 {
            color: #0062E6;
            margin-bottom: 20px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            color: #333;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #0062E6;
            box-shadow: 0 0 5px rgba(0, 98, 230, 0.5);
        }

        .btn-primary {
            background-color: #0062E6;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #004bb5;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div>
            <div>
                <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h1>Head Registration</h1>
            <form id="registrationForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="id">HQ Id</label>
                    <input type="text" id="id" name="id" class="form-control" placeholder="Enter HQ Id" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label for="number">Phone Number</label>
                    <input type="text" id="number" name="number" class="form-control" placeholder="Enter phone number" required>
                </div>
                <button type="button" class="btn btn-primary" onclick="sendOtp()">Send OTP</button>
            </form>
        </div>
    </div>

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="otpModalLabel">Verify OTP</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="otp">OTP</label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="verifyOtp()">Verify OTP</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        let otpCode;

        function sendOtp() {
            const number = document.getElementById('number').value;

            if (!number) {
                alert('Please enter a phone number.');
                return;
            }

            // Simulating OTP sending
            otpCode = Math.floor(100000 + Math.random() * 900000);
            console.log('Generated OTP:', otpCode); // For testing purpose

            // Show the OTP modal
            $('#otpModal').modal('show');
        }

        function verifyOtp() {
            const enteredOtp = document.getElementById('otp').value;

            if (enteredOtp == otpCode) {
                alert('OTP verified successfully. Registration complete!');
                // Here you would normally submit the form data to the server
                // For now, we are just showing an alert
                $('#otpModal').modal('hide');
            } else {
                alert('Invalid OTP. Please try again.');
            }
        }
    </script>
</body>
</html>
