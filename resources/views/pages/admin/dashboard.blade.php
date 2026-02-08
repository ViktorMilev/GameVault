<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b1b2f;
            color: #f5f5f5;
        }

        .sidebar {
            background-color: #4b0082;
            min-height: 100vh;
            color: #fff;
            padding-top: 2rem;
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 0.75rem 1rem;
            text-decoration: none;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            background-color: #6a0dad;
        }

        .sidebar .active {
            background-color: #8000ff;
        }

        .content {
            padding: 2rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .card-custom {
            background-color: #2b2b4a;
            border: none;
            border-radius: 12px;
        }

        .card-custom h5 {
            color: #ffccff;
        }

        .logout-btn {
            background-color: #8000ff;
            border: none;
        }

        .logout-btn:hover {
            background-color: #a64dff;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <nav class="sidebar flex-shrink-0">
            <div class="text-center mb-4">
                <h3>GameVault Admin</h3>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
            <a href="#">Игри</a>
            <a href="#">Платформи</a>
            <a href="#">Потребители</a>
            <a href="#">Категории</a>
            <a href="#">Подкатегории</a>
            <a href="#">Системни настройки</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-3 px-3">
                @csrf
                <button type="submit" class="btn w-100 logout-btn">Logout</button>
            </form>
        </nav>

        {{-- Main content --}}
        <div class="content flex-grow-1">
            <div class="dashboard-header">
                <h1>Добре дошъл, Admin!</h1>
                <span>Статус: <strong>Online</strong></span>
            </div>

            {{-- Stats cards --}}
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Общо Игри</h5>
                        <p class="fs-3">120</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Платформи</h5>
                        <p class="fs-3">8</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Потребители</h5>
                        <p class="fs-3">540</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom p-3">
                        <h5>Категории</h5>
                        <p class="fs-3">12</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Добави нова игра</h5>
                        <p>Бързо добавяне на нови заглавия в сайта.</p>
                        <a href="#" class="btn btn-light w-100">Добави</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Управление на потребители</h5>
                        <p>Редакция и преглед на всички потребители.</p>
                        <a href="#" class="btn btn-light w-100">Управлявай</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <h5>Системни настройки</h5>
                        <p>Промени настройки и конфигурации на сайта.</p>
                        <a href="#" class="btn btn-light w-100">Настройки</a>
                    </div>
                </div>
            </div>

            {{-- Table example --}}
            <div class="mt-5">
                <h3>Последни игри</h3>
                <table class="table table-dark table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Име</th>
                            <th>Платформи</th>
                            <th>Категория</th>
                            <th>Дата на добавяне</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cyber Adventure</td>
                            <td>Windows, Android</td>
                            <td>Action</td>
                            <td>2026-02-08</td>
                        </tr>
                        <tr>
                            <td>Pixel Quest</td>
                            <td>Windows</td>
                            <td>Indie</td>
                            <td>2026-02-07</td>
                        </tr>
                        <tr>
                            <td>Galaxy Raiders</td>
                            <td>Windows, Android</td>
                            <td>RPG</td>
                            <td>2026-02-05</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>