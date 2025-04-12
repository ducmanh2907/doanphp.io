<?php include __DIR__ . '/shares/header.php'; ?>

<title>Bộ Sưu Tập Thời Trang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
    }
    .collection-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s;
    }
    .collection-card:hover {
        transform: scale(1.05);
    }
    .collection-img {
        height: 250px;
        object-fit: cover;
    }
</style>

<!-- Header -->
<header class="text-center my-4">
    <h1>Bộ Sưu Tập Thời Trang</h1>
    <p class="text-muted">Cập nhật những bộ sưu tập mới nhất từ các thương hiệu hàng đầu.</p>
</header>

<!-- Danh sách Bộ Sưu Tập -->
<div class="container">
    <div class="row">
        <!-- Collection 1 -->
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/17/649556/lacoste-1.jpg" class="card-img-top collection-img" alt="BST Xuân Hè">
                <div class="card-body">
                    <h5 class="card-title">BST Lacoste Thu – Đông 2025: Cuộc hợp nhất ngoạn mục</h5>
                    <p class="card-text text-muted">Khám phá phong cách nhẹ nhàng và thanh lịch của mùa xuân hè.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <!-- Collection 2 -->
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/14/649017/sandro.jpg" class="card-img-top collection-img" alt="BST Thu Đông">
                <div class="card-body">
                    <h5 class="card-title">BST Sandro Thu-Đông 2025: “Bộc lộ cái tôi” tối giản</h5>
                    <p class="card-text text-muted">Phong cách sang trọng và ấm áp cho mùa thu đông.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <!-- Collection 3 -->
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/13/648742/chanel-7.jpg" class="card-img-top collection-img" alt="BST Thời Trang Nam">
                <div class="card-body">
                    <h5 class="card-title">BST Chanel Thu-Đông 2025: Dấu ấn của sự chuyển giao</h5>
                    <p class="card-text text-muted">BST mới nhất với phong cách lịch lãm và cá tính.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/13/648161/miu-miu-fw25-3.jpg" class="card-img-top collection-img" alt="BST Thời Trang Nam">
                <div class="card-body">
                    <h5 class="card-title">BST Miu Miu Thu-Đông 2025: Vẻ thanh lịch đến từ những điều đơn giản nhất</h5>
                    <p class="card-text text-muted">BST mới nhất với phong cách lịch lãm và cá tính.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/10/647428/valentino-1.jpg" class="card-img-top collection-img" alt="BST Thời Trang Nam">
                <div class="card-body">
                    <h5 class="card-title">BST Valentino Thu-Đông 2025: Sân khấu chân thực của tâm hồn</h5>
                    <p class="card-text text-muted">BST mới nhất với phong cách lịch lãm và cá tính.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card collection-card">
                <img src="https://www.elle.vn/app/uploads/2025/03/05/645973/dior-4.jpg" class="card-img-top collection-img" alt="BST Thời Trang Nam">
                <div class="card-body">
                    <h5 class="card-title">BST Chanel Thu-Đông 2025: Dấu ấn của sự chuyển giao</h5>
                    <p class="card-text text-muted">BST mới nhất với phong cách lịch lãm và cá tính.</p>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4 mt-5 bg-light">
    <p class="text-muted">&copy; 2025 Fashion Store | Bộ sưu tập thời trang mới nhất</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
