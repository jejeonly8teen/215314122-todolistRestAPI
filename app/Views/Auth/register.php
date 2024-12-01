<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: row;
        }

        /* Registration Form Styles */
        .registration-section {
            flex: 1;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.95);
            border-top-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
            position: relative;
            z-index: 2;
        }

        .registration-section h3 {
            color: #ff6392;
            margin-bottom: 10px;
            font-weight: 600;
            text-align: center;
            font-size: 25px;
        }

        .registration-section p {
            color: #706f6f;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            color: #ff6392;
            margin-bottom: 5px;
            display: block;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background-color: #fef7f2;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #d6a2e8;
            outline: none;
            background-color: #fff0e6;
        }

        .btn {
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 20px;
            background-color: #ff6392;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #d94877;
            transform: translateY(-2px);
        }

        .link {
            margin-top: 20px;
            text-align: center;
        }

        .link span {
            color: #000000; /* Black color for the "Already have an account?" text */
        }

        .link a {
            color: #ff6392; /* Pink color for the "Log in here" link */
            text-decoration: none;
            font-weight: 500;
        }

        .link a:hover {
            text-decoration: underline;
        }

        /* Illustration Section */
        .illustration-section {
            flex: 1;
            background: linear-gradient(135deg, rgba(255, 165, 243, 0.5), rgba(180, 175, 255, 0.5));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 20px;
            text-align: center;
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: url('todolist.jpg') repeat;
            opacity: 0.1;
            z-index: 0;
            transform: rotate(45deg);
        }

        .illustration-section h3 {
            color: #ff6392;
            font-size: 24px;
            margin-bottom: 10px;
            z-index: 1;
        }

        .illustration-section p {
            color: #b37da9;
            line-height: 1.5;
            z-index: 1;
        }

        /* Alert Styles */
        .alert {
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .alert-danger {
            background-color: #ffcccc;
            color: #d9534f;
            border: 1px solid #d9534f;
        }

        .alert-success {
            background-color: #ccffcc;
            color: #3c763d;
            border: 1px solid #3c763d;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .registration-section {
                border-radius: 20px 20px 0 0;
                padding: 30px 20px;
            }

            .illustration-section {
                border-radius: 0 0 20px 20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="registration-section">
            <h3>Registration</h3>

            <!-- Pesan sukses jika registrasi berhasil -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="/auth/register" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
                </div>

                <div class="text-center">
                    <button class="btn" type="submit">Registrasi</button>
                </div>

                <div class="link">
                    <span>Already have an account? </span><a href="/login">Log in here</a>
                </div>
            </form>
        </div>

        <div class="illustration-section">
            <h3>Get Started on Your Organized Journey!</h3>
            <p>Take the first step towards a more organized life. Register now to plan your tasks and achieve your goals with clarity!</p>
        </div>
    </div>

</body>

</html>
