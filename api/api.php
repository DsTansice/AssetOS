<?php
session_start();

// 尝试加载 PHPMailer，如果不存在则忽略
$phpmailer_available = false;
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        $phpmailer_available = true;
    }
}

header('Content-Type: application/json');

// 数据库连接
try {
    $db = new PDO('sqlite:' . __DIR__ . '/../db/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => '数据库连接失败: ' . $e->getMessage()]);
    exit;
}

// 初始化数据库
$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    is_admin BOOLEAN DEFAULT 0,
    email_verified BOOLEAN DEFAULT 0,
    verification_token TEXT
)");
$db->exec("CREATE TABLE IF NOT EXISTS items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    name TEXT NOT NULL,
    category TEXT NOT NULL,
    date DATE NOT NULL,
    price REAL NOT NULL,
    currency TEXT NOT NULL,
    status TEXT DEFAULT 'in_use' CHECK(status IN ('in_use', 'discarded', 'transferred', 'damaged')),
    status_date DATE,
    transfer_price REAL,
    notes TEXT,
    FOREIGN KEY(user_id) REFERENCES users(id)
)");
$db->exec("CREATE TABLE IF NOT EXISTS categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE
)");
$db->exec("CREATE TABLE IF NOT EXISTS smtp_settings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    host TEXT,
    username TEXT,
    password TEXT,
    port INTEGER,
    encryption TEXT
)");
$db->exec("CREATE TABLE IF NOT EXISTS webhooks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    url TEXT NOT NULL,
    secret TEXT NOT NULL,
    events TEXT NOT NULL
)");

// 迁移现有 items 表，添加新字段
try {
    $db->exec("ALTER TABLE items ADD COLUMN status TEXT DEFAULT 'in_use' CHECK(status IN ('in_use', 'discarded', 'transferred', 'damaged'))");
} catch (PDOException $e) {
    // 如果字段已存在，忽略错误
}
try {
    $db->exec("ALTER TABLE items ADD COLUMN status_date DATE");
} catch (PDOException $e) {
}
try {
    $db->exec("ALTER TABLE items ADD COLUMN transfer_price REAL");
} catch (PDOException $e) {
}
try {
    $db->exec("ALTER TABLE items ADD COLUMN notes TEXT");
} catch (PDOException $e) {
    // 如果字段已存在，忽略错误
}

// 处理请求
$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? $_POST['action'] ?? $input['action'] ?? '';
switch ($action) {
    case 'checkAuth':
        $response = ['authenticated' => isset($_SESSION['user_id']), 'username' => $_SESSION['username'] ?? '', 'is_admin' => $_SESSION['is_admin'] ?? false];
        echo json_encode($response);
        break;

    case 'register':
        $data = $input ?: json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $token = bin2hex(random_bytes(16));

        if (empty($username) || empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => '所有字段均为必填']);
            exit;
        }

        try {
            $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$username, $email]);
            if ($stmt->fetchColumn() > 0) {
                echo json_encode(['success' => false, 'message' => '用户名或邮箱已存在']);
                exit;
            }

            // 检查是否为第一个用户，如果是则设为管理员
            $countStmt = $db->query('SELECT COUNT(*) FROM users');
            $userCount = $countStmt->fetchColumn();
            $isFirstUser = ($userCount == 0);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare('INSERT INTO users (username, email, password, verification_token, email_verified, is_admin) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$username, $email, $hashedPassword, $token, 1, $isFirstUser ? 1 : 0]); // 暂时设置为已验证

            // 尝试发送邮件，如果 PHPMailer 可用
            if ($phpmailer_available) {
                $smtpStmt = $db->query('SELECT host, username, password, port, encryption FROM smtp_settings LIMIT 1');
                $smtp = $smtpStmt->fetch(PDO::FETCH_ASSOC);
                if ($smtp && $smtp['host']) {
                    try {
                        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = $smtp['host'];
                        $mail->SMTPAuth = true;
                        $mail->Username = $smtp['username'];
                        $mail->Password = $smtp['password'] ?: '';
                        $mail->SMTPSecure = $smtp['encryption'];
                        $mail->Port = $smtp['port'];
                        $mail->setFrom($smtp['username'], 'AssetOS');
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = 'AssetOS 邮箱验证';
                        $mail->Body = "请点击以下链接验证您的邮箱：<a href='http://localhost:8000/api/api.php?action=verify&token=$token'>验证</a>";
                        $mail->send();
                    } catch (Exception $e) {
                        // 邮件发送失败，但注册仍然成功
                        error_log('邮件发送失败: ' . $e->getMessage());
                    }
                }
            }

            // 尝试发送webhook，如果失败也不影响注册
            try {
                sendWebhook('user_registered', ['username' => $username, 'email' => $email], $db);
            } catch (Exception $e) {
                error_log('Webhook发送失败: ' . $e->getMessage());
            }

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => '注册失败: ' . $e->getMessage()]);
        }
        break;

    case 'verify':
        $token = $_GET['token'] ?? '';
        try {
            $stmt = $db->prepare('UPDATE users SET email_verified = 1, verification_token = NULL WHERE verification_token = ?');
            $stmt->execute([$token]);
            echo json_encode(['success' => $stmt->rowCount() > 0, 'message' => $stmt->rowCount() > 0 ? '邮箱验证成功' : '无效的验证链接']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '验证失败: ' . $e->getMessage()]);
        }
        break;

    case 'login':
        $data = json_decode(file_get_contents('php://input'), true);
        $loginInput = $data['loginInput'] ?? '';
        $password = $data['password'] ?? '';

        try {
            $stmt = $db->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
            $stmt->execute([$loginInput, $loginInput]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                if (!$user['email_verified']) {
                    echo json_encode(['success' => false, 'message' => '邮箱未验证，请检查您的邮箱']);
                    exit;
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_admin'] = (bool)$user['is_admin'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => '用户名或密码错误']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '登录失败: ' . $e->getMessage()]);
        }
        break;

    case 'logout':
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    case 'add':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        $category = $data['category'] ?? '';
        $date = $data['date'] ?? '';
        $price = $data['price'] ?? 0;
        $currency = $data['currency'] ?? '';
        $status = $data['status'] ?? 'in_use';
        $status_date = $data['status_date'] ?? null;
        $transfer_price = $data['transfer_price'] ?? null;
        $notes = $data['notes'] ?? null; // 添加备注字段

        if (empty($name) || empty($category) || empty($date) || empty($price) || empty($currency)) {
            echo json_encode(['success' => false, 'message' => '所有字段均为必填']);
            exit;
        }

        try {
            // 更新 SQL 语句，包含备注字段
            $stmt = $db->prepare('INSERT INTO items (user_id, name, category, date, price, currency, status, status_date, transfer_price, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$_SESSION['user_id'], $name, $category, $date, $price, $currency, $status, $status_date, $transfer_price, $notes]);
            sendWebhook('item_added', ['name' => $name, 'category' => $category, 'user_id' => $_SESSION['user_id']], $db);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '添加失败: ' . $e->getMessage()]);
        }
        break;

    case 'updateItem':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? 0;
        $name = $data['name'] ?? '';
        $category = $data['category'] ?? '';
        $date = $data['date'] ?? '';
        $price = $data['price'] ?? 0;
        $currency = $data['currency'] ?? '';
        $status = $data['status'] ?? 'in_use';
        $status_date = $data['status_date'] ?? null;
        $transfer_price = $data['transfer_price'] ?? null;
        $notes = $data['notes'] ?? null;

        if (empty($id) || empty($name) || empty($category) || empty($date) || empty($price) || empty($currency)) {
            echo json_encode(['success' => false, 'message' => '所有字段均为必填']);
            exit;
        }

        try {
            $stmt = $db->prepare('UPDATE items SET name = ?, category = ?, date = ?, price = ?, currency = ?, status = ?, status_date = ?, transfer_price = ?, notes = ? WHERE id = ? AND user_id = ?');
            $stmt->execute([$name, $category, $date, $price, $currency, $status, $status_date, $transfer_price, $notes, $id, $_SESSION['user_id']]);
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => '物品不存在或无权限修改']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '更新失败: ' . $e->getMessage()]);
        }
        break;

    case 'delete':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? 0;
        try {
            $stmt = $db->prepare('DELETE FROM items WHERE id = ? AND user_id = ?');
            $stmt->execute([$id, $_SESSION['user_id']]);
            echo json_encode(['success' => $stmt->rowCount() > 0]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '删除失败: ' . $e->getMessage()]);
        }
        break;

    case 'list':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        $category = $_GET['category'] ?? 'all';
        $sortBy = $_GET['sortBy'] ?? 'name';
        $status = $_GET['status'] ?? 'all';
        $query = 'SELECT * FROM items WHERE user_id = ?';
        $params = [$_SESSION['user_id']];
        
        if ($category !== 'all') {
            $query .= ' AND category = ?';
            $params[] = $category;
        }
        if ($status !== 'all') {
            $query .= ' AND status = ?';
            $params[] = $status;
        }

        if ($sortBy === 'dailyCost') {
            $query .= ' ORDER BY (price / ((CASE WHEN status != "in_use" AND status_date IS NOT NULL THEN JULIANDAY(status_date) ELSE JULIANDAY("now") END) - JULIANDAY(date))) DESC';
        } else {
            $sortBy = in_array($sortBy, ['name', 'date', 'price']) ? $sortBy : 'name';
            $query .= " ORDER BY $sortBy";
        }

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($items);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '获取列表失败: ' . $e->getMessage()]);
        }
        break;

    case 'import':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        if (!isset($_FILES['file'])) {
            echo json_encode(['success' => false, 'message' => '未上传文件']);
            exit;
        }

        $file = $_FILES['file']['tmp_name'];
        $imported = 0;
        $errors = 0;
        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle); // 跳过标题行
            $db->beginTransaction();
            try {
                $stmt = $db->prepare('INSERT INTO items (user_id, name, category, date, price, currency, status, status_date, transfer_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
                while (($row = fgetcsv($handle)) !== false) {
                    if (count($row) >= 5) {
                        $name = $row[0];
                        $category = $row[1];
                        $date = $row[2];
                        $price = floatval($row[3]);
                        $currency = $row[4];
                        $status = $row[5] ?? 'in_use';
                        $status_date = $row[6] ?? null;
                        $transfer_price = isset($row[7]) ? floatval($row[7]) : null;

                        if (in_array($status, ['in_use', 'discarded', 'transferred', 'damaged']) && $name && $category && $date && $price && $currency) {
                            $stmt->execute([$_SESSION['user_id'], $name, $category, $date, $price, $currency, $status, $status_date, $transfer_price]);
                            $imported++;
                            sendWebhook('item_added', ['name' => $name, 'category' => $category, 'user_id' => $_SESSION['user_id']], $db);
                        } else {
                            $errors++;
                        }
                    } else {
                        $errors++;
                    }
                }
                $db->commit();
                echo json_encode(['success' => true, 'imported' => $imported, 'errors' => $errors]);
            } catch (PDOException $e) {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => '导入失败: ' . $e->getMessage()]);
            }
            fclose($handle);
        } else {
            echo json_encode(['success' => false, 'message' => '无法读取文件']);
        }
        break;

    case 'export':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="items_export.csv"');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['name', 'category', 'date', 'price', 'currency', 'status', 'status_date', 'transfer_price']);
        $stmt = $db->prepare('SELECT name, category, date, price, currency, status, status_date, transfer_price FROM items WHERE user_id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;

    case 'listCategories':
        $isAdmin = $_GET['admin'] ?? 'false';
        if ($isAdmin === 'true') {
            // 管理员模式：返回所有分类
            $query = 'SELECT name FROM categories';
            $params = [];
        } else {
            // 普通用户模式：返回所有分类（允许用户选择任何分类添加物品）
            $query = 'SELECT name FROM categories';
            $params = [];
        }
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($params);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($categories);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '获取分类失败: ' . $e->getMessage()]);
        }
        break;

    case 'addCategory':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        if (empty($name)) {
            echo json_encode(['success' => false, 'message' => '分类名称不能为空']);
            exit;
        }
        try {
            $stmt = $db->prepare('INSERT INTO categories (name) VALUES (?)');
            $stmt->execute([$name]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '添加分类失败: ' . $e->getMessage()]);
        }
        break;

    case 'deleteCategory':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        try {
            $stmt = $db->prepare('DELETE FROM categories WHERE name = ?');
            $stmt->execute([$name]);
            echo json_encode(['success' => $stmt->rowCount() > 0]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '删除分类失败: ' . $e->getMessage()]);
        }
        break;

    case 'listUsers':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        try {
            $stmt = $db->query('SELECT id, username, email, is_admin, email_verified FROM users');
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($users);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '获取用户列表失败: ' . $e->getMessage()]);
        }
        break;

    case 'toggleAdmin':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $data['user_id'] ?? 0;
        $isAdmin = $data['is_admin'] ?? false;
        try {
            $stmt = $db->prepare('UPDATE users SET is_admin = ? WHERE id = ?');
            $stmt->execute([(int)$isAdmin, $userId]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '操作失败: ' . $e->getMessage()]);
        }
        break;

    case 'deleteUser':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $data['user_id'] ?? 0;
        try {
            $stmt = $db->prepare('DELETE FROM items WHERE user_id = ?');
            $stmt->execute([$userId]);
            $stmt = $db->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$userId]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '删除用户失败: ' . $e->getMessage()]);
        }
        break;

    case 'getSmtpSettings':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        try {
            $stmt = $db->query('SELECT host, username, port, encryption FROM smtp_settings LIMIT 1');
            $settings = $stmt->fetch(PDO::FETCH_ASSOC) ?: ['host' => '', 'username' => '', 'port' => '', 'encryption' => ''];
            echo json_encode(['success' => true, 'settings' => $settings]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '获取SMTP设置失败: ' . $e->getMessage()]);
        }
        break;

    case 'saveSmtpSettings':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $host = $data['host'] ?? '';
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $port = $data['port'] ?? 0;
        $encryption = $data['encryption'] ?? '';

        try {
            $stmt = $db->query('SELECT COUNT(*) FROM smtp_settings');
            if ($stmt->fetchColumn() > 0) {
                $stmt = $db->prepare('UPDATE smtp_settings SET host = ?, username = ?, password = ?, port = ?, encryption = ?');
                $stmt->execute([$host, $username, $password ?: null, $port, $encryption]);
            } else {
                $stmt = $db->prepare('INSERT INTO smtp_settings (host, username, password, port, encryption) VALUES (?, ?, ?, ?, ?)');
                $stmt->execute([$host, $username, $password ?: null, $port, $encryption]);
            }
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '保存SMTP设置失败: ' . $e->getMessage()]);
        }
        break;

    case 'saveWebhook':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        $data = json_decode(file_get_contents('php://input'), true);
        $url = $data['url'] ?? '';
        $secret = $data['secret'] ?? '';
        $events = json_encode($data['events'] ?? []);

        try {
            $stmt = $db->query('SELECT COUNT(*) FROM webhooks');
            if ($stmt->fetchColumn() > 0) {
                $stmt = $db->prepare('UPDATE webhooks SET url = ?, secret = ?, events = ?');
                $stmt->execute([$url, $secret, $events]);
            } else {
                $stmt = $db->prepare('INSERT INTO webhooks (url, secret, events) VALUES (?, ?, ?)');
                $stmt->execute([$url, $secret, $events]);
            }
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '保存Webhook失败: ' . $e->getMessage()]);
        }
        break;

    case 'backup':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        
        $dbPath = '../db/database.sqlite';
        $backupFile = '../db/backup_' . date('YmdHis') . '.sqlite';
        
        // 检查数据库文件是否存在
        if (!file_exists($dbPath)) {
            echo json_encode(['success' => false, 'message' => '数据库文件不存在']);
            exit;
        }
        
        // 检查db目录是否可写
        if (!is_writable('../db/')) {
            echo json_encode(['success' => false, 'message' => 'db目录不可写']);
            exit;
        }
        
        if (copy($dbPath, $backupFile)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
            readfile($backupFile);
            unlink($backupFile);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => '备份失败']);
        }
        break;

    case 'restore_database':
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            echo json_encode(['success' => false, 'message' => '无权限']);
            exit;
        }
        
        // 检查是否有上传的文件
        if (!isset($_FILES['backup_file']) || $_FILES['backup_file']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => '文件上传失败']);
            exit;
        }
        
        $uploadedFile = $_FILES['backup_file'];
        $tmpFilePath = $uploadedFile['tmp_name'];
        $dbPath = '../db/database.sqlite';
        
        // 验证文件类型（检查SQLite文件头）
        $fileHeader = file_get_contents($tmpFilePath, false, null, 0, 16);
        if (substr($fileHeader, 0, 13) !== 'SQLite format') {
            echo json_encode(['success' => false, 'message' => '无效的SQLite数据库文件']);
            exit;
        }
        
        try {
            // 备份当前数据库
            $currentBackup = '../db/database_backup_before_restore_' . date('YmdHis') . '.sqlite';
            if (file_exists($dbPath)) {
                copy($dbPath, $currentBackup);
            }
            
            // 测试上传的数据库文件是否有效
            $testDb = new PDO("sqlite:" . $tmpFilePath);
            $testDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // 简单检查数据库结构（检查是否有items表）
            $stmt = $testDb->query("SELECT name FROM sqlite_master WHERE type='table' AND name='items'");
            if (!$stmt->fetch()) {
                echo json_encode(['success' => false, 'message' => '数据库结构不匹配，缺少items表']);
                exit;
            }
            
            // 关闭测试连接
            $testDb = null;
            
            // 替换数据库文件
            if (copy($tmpFilePath, $dbPath)) {
                // 设置正确的权限
                chmod($dbPath, 0644);
                
                // 删除临时文件
                @unlink($tmpFilePath);
                
                echo json_encode(['success' => true, 'message' => '数据库恢复成功']);
            } else {
                // 如果恢复失败，尝试恢复原数据库
                if (file_exists($currentBackup)) {
                    copy($currentBackup, $dbPath);
                }
                echo json_encode(['success' => false, 'message' => '文件复制失败']);
            }
            
        } catch (Exception $e) {
            // 如果出错，尝试恢复原数据库
            if (file_exists($currentBackup)) {
                copy($currentBackup, $dbPath);
            }
            echo json_encode(['success' => false, 'message' => '数据库恢复失败: ' . $e->getMessage()]);
        }
        break;

    case 'statistics':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        
        try {
            // 获取基本统计
            $stmt = $db->prepare('SELECT COUNT(*) as totalItems, SUM(price) as totalValue FROM items WHERE user_id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            $basicStats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 获取在用物品数
            $stmt = $db->prepare('SELECT COUNT(*) as inUseItems FROM items WHERE user_id = ? AND status = "in_use"');
            $stmt->execute([$_SESSION['user_id']]);
            $inUseStats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 计算平均每日成本
            $stmt = $db->prepare('SELECT AVG(price / (julianday("now") - julianday(date))) as avgDailyCost FROM items WHERE user_id = ? AND status = "in_use"');
            $stmt->execute([$_SESSION['user_id']]);
            $avgCostStats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 分类统计
            $stmt = $db->prepare('SELECT category, COUNT(*) as count FROM items WHERE user_id = ? GROUP BY category');
            $stmt->execute([$_SESSION['user_id']]);
            $categoryStats = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoryStats[$row['category']] = $row['count'];
            }
            
            // 状态统计
            $stmt = $db->prepare('SELECT status, COUNT(*) as count FROM items WHERE user_id = ? GROUP BY status');
            $stmt->execute([$_SESSION['user_id']]);
            $statusStats = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $statusStats[$row['status']] = $row['count'];
            }
            
            // 月度支出统计
            $stmt = $db->prepare('SELECT strftime("%Y-%m", date) as month, SUM(price) as amount FROM items WHERE user_id = ? GROUP BY strftime("%Y-%m", date) ORDER BY month DESC LIMIT 12');
            $stmt->execute([$_SESSION['user_id']]);
            $monthlyExpenses = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $monthlyExpenses[$row['month']] = floatval($row['amount']);
            }
            
            $stats = [
                'totalItems' => intval($basicStats['totalItems']),
                'totalValue' => floatval($basicStats['totalValue']),
                'inUseItems' => intval($inUseStats['inUseItems']),
                'avgDailyCost' => floatval($avgCostStats['avgDailyCost']),
                'categoryStats' => $categoryStats,
                'statusStats' => $statusStats,
                'monthlyExpenses' => $monthlyExpenses
            ];
            
            echo json_encode(['success' => true, 'stats' => $stats]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '获取统计失败: ' . $e->getMessage()]);
        }
        break;

    case 'changePassword':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        
        $data = $input ?: json_decode(file_get_contents('php://input'), true);
        $currentPassword = $data['currentPassword'] ?? '';
        $newPassword = $data['newPassword'] ?? '';
        
        if (empty($currentPassword) || empty($newPassword)) {
            echo json_encode(['success' => false, 'message' => '请填写所有字段']);
            exit;
        }
        
        try {
            // 验证当前密码
            $stmt = $db->prepare('SELECT password FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user || !password_verify($currentPassword, $user['password'])) {
                echo json_encode(['success' => false, 'message' => '当前密码错误']);
                exit;
            }
            
            // 更新密码
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
            $stmt->execute([$hashedPassword, $_SESSION['user_id']]);
            
            echo json_encode(['success' => true, 'message' => '密码修改成功']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '密码修改失败: ' . $e->getMessage()]);
        }
        break;

    case 'deleteAccount':
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => '未登录']);
            exit;
        }
        
        try {
            // 删除用户的所有物品
            $stmt = $db->prepare('DELETE FROM items WHERE user_id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            
            // 删除用户账户
            $stmt = $db->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$_SESSION['user_id']]);
            
            // 销毁会话
            session_destroy();
            
            echo json_encode(['success' => true, 'message' => '账户删除成功']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => '删除账户失败: ' . $e->getMessage()]);
        }
        break;

    case 'getVersion':
        require_once '../version.php';
        $versionInfo = getVersionInfo();
        echo json_encode([
            'success' => true, 
            'version' => $versionInfo['version'],
            'full_name' => $versionInfo['full_name'],
            'release_date' => $versionInfo['release_date'],
            'code_name' => $versionInfo['code_name']
        ]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => '无效的操作']);
        break;
}

function sendWebhook($event, $data, $db) {
    $stmt = $db->query('SELECT url, secret, events FROM webhooks');
    $webhook = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($webhook && in_array($event, json_decode($webhook['events'], true))) {
        $payload = json_encode(array_merge(['event' => $event], $data));
        $signature = hash_hmac('sha256', $payload, $webhook['secret']);
        $ch = curl_init($webhook['url']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Signature: ' . $signature
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
?>