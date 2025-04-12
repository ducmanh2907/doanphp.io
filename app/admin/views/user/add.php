<form action="/admin/user/store" method="POST">
    <label for="name">Tên:</label>
    <input type="text" name="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Mật khẩu:</label>
    <input type="password" name="password" required>

    <label for="phone">Số điện thoại:</label>
    <input type="text" name="phone">

    <label for="address">Địa chỉ:</label>
    <input type="text" name="address">

    <label for="role">Vai trò:</label>
    <select name="role">
        <option value="customer">Khách hàng</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Thêm người dùng</button>
</form>
