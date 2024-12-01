<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        /* Login Form Styles */
        .login-section {
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

        .login-section h2 {
            color: #ff6392;
            margin-bottom: 0px;
            font-weight: 600;
        }

        .login-section p {
            color: #706f6f;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            color: #ff6392;
            margin-bottom: 5px;
            display: block;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background-color: #fef7f2;
            transition: all 0.3s;
        }

        input:focus {
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

        .register-link {
            margin-top: 20px;
            text-align: center;
        }

        .register-link a {
            color: #ff6392;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
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
            text-align: center;
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

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .login-section {
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
        <div class="login-section">
            <h2>Welcome Back!</h2>
            <p>Please login to your account</p>

            <!-- Username or Password Wrong Notification -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="/auth/process" method="post">
                <?= csrf_field() ?>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Log In</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="/register">Create new</a></p>
                </div>
            </form>
        </div>
        <div class="illustration-section">
            <h3>Plan, Organize, Achieve!</h3>
            <p>Embrace each day with a clear plan and organized tasks. Log in and start organizing your life better!</p>
        </div>
    </div>
</body>
</html>
