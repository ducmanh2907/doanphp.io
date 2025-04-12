<?php include 'app/views/shares/header.php'; ?>

<h1>Chi tiết sản phẩm</h1>

<?php if ($product): ?>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
            <p><strong>Giá:</strong> <?php echo number_format($product->price, 2); ?> đ</p>
            
            <td>
     <?php if (!empty($product->image)): ?>
<img src="/webbanhang/public/<?= htmlspecialchars($product->image) ?>" 
     alt="<?= htmlspecialchars($product->name) ?>" 
     width="150" height="150">

            <?php else: ?>
                <p>Không có ảnh</p>
            <?php endif; ?>
</td>

            <p><strong>Ngày tạo:</strong> <?php echo $product->created_at; ?></p>

            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
            <a href="/webbanhang/Product/list" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
<?php else: ?>
    <p class="text-danger">Sản phẩm không tồn tại.</p>
<?php endif; ?>

<?php include 'app/views/shares/footer.php'; ?>
