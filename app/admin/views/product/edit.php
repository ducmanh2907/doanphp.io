

<h1>Chỉnh sửa sản phẩm</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f9;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 26px;
    }

    form {
        background-color: #fff;
        padding: 25px 30px;
        max-width: 700px;
        margin: 0 auto;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #444;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.2);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .btn {
        padding: 10px 18px;
        font-size: 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .alert-danger {
        max-width: 700px;
        margin: 0 auto 20px;
        padding: 15px 20px;
        border-radius: 8px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    img {
        margin-top: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    a.btn {
        margin-top: 15px;
    }
</style>

<form method="POST" action="/webbanhang/app/admin/index.php?controller=adminproduct&action=update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $product->id; ?>">

    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo $product->price; ?>" required>
    </div>

    <div class="form-group">
        <label for="image">Ảnh sản phẩm:</label>
        <input type="file" id="image" name="image" class="form-control">
        <?php if (!empty($product->image)): ?>
                            <img src="/webbanhang/public<?php echo htmlspecialchars($product->image); ?>" 
     alt="<?php echo htmlspecialchars($product->name); ?>" 
     width="100" height="100">

                        <?php else: ?>
                            <p>Không có ảnh</p>
                        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" class="form-control" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>" <?php echo ($product->category_id == $category->id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>

<a href="/webbanhang/app/admin/views/product/nguoidung.php" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>


