<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .box {
            width: 200px;
            height: 200px;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .box:hover {
            background-color: #e9ecef;
        }

        .box img {
            max-width: 100%;
            max-height: 100%;
        }

        .box a {
            text-decoration: none;
            color: #212529;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center d-flex justify-content-center">
                <div class="box mx-2">
                    <a href="/register-medecin.php">
                        <img src="photo/medecins-dessin.avif" alt="Medecin">
                        <p>Medecin</p>
                    </a>
                </div>
                <div class="box mx-2">
                    <a href="/register-patient.php">
                        <img src="photo/personne-malade-dessin.jpg" alt="Patient">
                        <p>Patient</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
