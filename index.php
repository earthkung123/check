<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
            <title>
                Login Form
            </title>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" rel="stylesheet">
                <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet prefetch">
                    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet prefetch">
                        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet prefetch">
                            <link href="css/style.css" rel="stylesheet">
                            </link>
                        </link>
                    </link>
                </link>
            </link>
        </meta>
    </head>
    <body>
        <div class="container">
            <div class="info">
                <h1>
                    ระบบการเข้าชั้นเรียน</h1>
            </div>
        </div>
        <div class="form">
            <div class="thumbnail">
                <img src="img/LOGO-RMUTR.png"/>
            </div>
            <form action="check-login.php" class="login-form" method="post">
                <input name="username" placeholder="Username" required="" type="text">
                    <input name="pass" placeholder="Password" required="" type="password">
                        <button>
                            Login
                        </button>
                    </input>
                </input>
            </form>
        </div>
        <video autoplay="" id="video" loop="" poster="polina.jpg">
            <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4">
            </source>
        </video>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
        <script src="js/index.js">
        </script>
    </body>
</html>
