<h2>Chỉnh Sửa Người Dùng</h2>
<form method="POST" action="/admin/user/update/<?= $user['id'] ?>">
    <label>Tên:</label>
    <input type="text" name="name" value="<?= $user['name'] ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>

    <button type="submit">Lưu</button>
</form>
