<?php include __DIR__ . '/shares/header.php'; ?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Phong Cách Thời Trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(90deg,rgb(180, 51, 12) 0%,rgb(204, 123, 1) 10%,rgb(116, 113, 110) 50%,rgb(210, 130, 2) 90%, rgb(221, 82, 2) 100%);
        }
        .blog-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }
        .blog-card:hover {
            transform: scale(1.05);
        }
        .blog-img {
            height: 200px;
            object-fit: cover;
        }
        .btn-primary {
            background-color:rgb(7, 6, 6);
            border-color: #ff758c;
            transition: background 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #e64a6d;
            border-color:rgb(7, 4, 5);
        }
       .container{
            background-image: url(https://image4.slideserve.com/7704377/paris-fashion-week-l.jpg);
            background-repeat: no-repeat;
            background-size: contain;
        }
    </style>
</head>
<body>

    <!-- Phần giới thiệu -->
    <header class="text-center my-4">
        <h1>Khám phá phong cách thời trang của người nổi tiếng</h1>
        <p class="text-muted">Cập nhật những xu hướng thời trang mới nhất từ các ngôi sao hàng đầu thế giới.</p>
    </header>

    <!-- Danh sách blog -->
    <div class="container">
        <div class="row">
            <!-- Bài blog 1 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://dep.com.vn/wp-content/uploads/2021/09/phong-cach-thoi-trang-cua-sieu-mau-gigi-hadid-9.jpg" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">Gigi Hadid - Streetwear Cá Tính</h5>
                        <p class="card-text text-muted">Gigi Hadid luôn nổi bật với phong cách streetwear cá tính và thời thượng.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Bài blog 2 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPbQqmRRI-KZZqAgD9OVxR08WaZIuVneE4IvJJbzy_IU7XDqmEW_zXIjsJVdj3Siwuzx8&usqp=CAU" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">Gigi Hadid - Thời Trang Đường Phố</h5>
                        <p class="card-text text-muted">Sự kết hợp giữa thể thao và thời trang của Gigi luôn được yêu thích.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Bài blog 3 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://icdn.dantri.com.vn/kvQpnUqsv918uIS3qnCP/Image/2014/09/01/da11092-d4e7a.jpg" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">David Beckham - Biểu Tượng Lịch Lãm</h5>
                        <p class="card-text text-muted">Phong cách lịch lãm của Beckham giúp anh luôn nổi bật trong mọi sự kiện.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Bài blog 4 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://file.hstatic.net/200000410665/file/giay-tay-nam-3_44088f359e6348b4865019ad8b07c427_grande.jpg" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">David Beckham - Thời Trang Giày Tây</h5>
                        <p class="card-text text-muted">Những mẫu giày da cao cấp luôn được Beckham lựa chọn.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Bài blog 5 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2022/11/12/1115884/Blackpink---HYLT-6C.jpg" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">BLACKPINK - Biểu Tượng Thời Trang</h5>
                        <p class="card-text text-muted">BLACKPINK không chỉ là nhóm nhạc mà còn là biểu tượng thời trang toàn cầu.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Bài blog 6 -->
            <div class="col-md-4 mb-4">
                <div class="card blog-card">
                    <img src="https://image.phunuonline.com.vn/fckeditor/upload/2023/20230302/images/10-phong-cach-thoi-trang-mang-_931677719683.jpg" class="card-img-top blog-img" alt="Phong cách thời trang">
                    <div class="card-body">
                        <h5 class="card-title">BLACKPINK - Phong Cách Nữ Tính</h5>
                        <p class="card-text text-muted">Từ phong cách nữ tính đến cá tính, BLACKPINK luôn tạo nên xu hướng.</p>
                        <a href="#" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5 bg-light">
        <p class="text-muted">&copy; 2025 Fashion Blog | Cập nhật xu hướng thời trang mới nhất</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
