<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            position: relative;
        }

        .container {
            width: 80%;
            max-width: 900px;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.95);
            border-top-left-radius: 50% 20%;
            border-bottom-right-radius: 50% 20%;
        }

        h2 {
            color: #ff6392;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }

        /* Form Styles */
        .form-inline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
        }

        .form-group {
            flex: 1;
            margin-right: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background-color: #fef7f2;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #d6a2e8;
            background-color: #fff0e6;
        }

        /* General Button Styles */
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 1rem; /* Ensure consistent font size */
        }

        .btn-primary {
            background-color: #ff6392;
            color: #fff;
            width: auto;
        }

        .btn-primary:hover {
            background-color: #d94877;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background-color: #ff6392;
            color: #fff;
            width: auto;
        }

        .btn-danger:hover {
            background-color: #d94877;
            transform: translateY(-2px);
        }

        .todo-item {
            background-color: #fafafa;
            border: 1px solid #eee;
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .task {
            font-size: 1rem;
            color: #333;
            flex: 1;
        }

        .actions {
            display: flex;
            justify-content: flex-end; /* Ensure buttons are aligned to the right */
            gap: 10px;
        }

        .alert {
            background-color: #ffebf0;
            border: 1px solid #ffccd5;
            color: #ff6392;
            border-radius: 20px;
            padding: 15px;
            text-align: center;
            font-size: 1rem;
        }

        /* Completed Task Styles */
        .completed .task {
            text-decoration: line-through;
            color: #888;
        }

        /* Completed Task Button Styles */
        .btn-completed {
            background-color: #9b59b6; /* Purple color */
            color: #fff;
        }
        
        /* Responsive Design */
        @media (max-width: 576px) {
            .form-inline {
                flex-direction: column;
            }

            .form-group {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .actions .btn {
                margin-left: 0;
                margin-top: 10px;
            }

            .todo-item {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Logout Button Styles */
        .btn-logout-container {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .btn-logout {
            background-color: #ff6392;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-logout:hover {
            background-color: #d94877;
            transform: translateY(-2px);
        }

    </style>

</head>
<body>

<div class="container">
    <h2>To Do List</h2>

    <!-- Form to add new tasks -->
    <form action="<?= site_url('/todo/add') ?>" method="POST" class="form-inline mb-4 justify-content-center">
      <div class="form-group flex-fill">
        <input type="text" name="task" class="form-control w-75" placeholder="<Teks to do>" required>
      </div>
      <button type="submit" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Display messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Display todo list -->
    <?php if (!empty($todos)): ?>
      <?php foreach ($todos as $todo): ?>
        <div class="todo-item <?= $todo['status'] == 'completed' ? 'completed' : '' ?>">
          <div class="task">
            <?= esc($todo['task']) ?>
          </div>
          <div class="actions">
            <?php if ($todo['status'] == 'pending'): ?>
                <a href="<?= site_url('/todo/complete/' . $todo['id']) ?>" class="btn btn-primary btn-sm">Selesai</a>
            <?php else: ?>
                <button class="btn btn-primary btn-sm" disabled>Selesai</button>
            <?php endif; ?>
            <a href="<?= site_url('/todo/delete/' . $todo['id']) ?>" class="btn btn-danger btn-sm">Hapus</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info" role="alert">
        Tidak ada tugas saat ini
      </div>
    <?php endif; ?>
  </div>

  <!-- Logout Button -->
  <div class="btn-logout-container">
      <a href="<?= site_url('/logout') ?>" class="btn btn-logout">Log Out</a>
  </div>

</body>
</html>
