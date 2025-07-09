const currencySymbols = { CNY: '￥', USD: '$', EUR: '€' };

const translations = {
  'zh-CN': {
    'title': '物品持有成本追踪',
    'subtitle': '轻松管理您的资产，追踪持有成本',
    'welcome': '欢迎, ',
    'sponsor': '赞助',
    'admin_panel': '管理员面板',
    'logout': '退出',
    'stats_total_value': '物品总价值',
    'stats_daily_cost': '每日总成本',
    'stats_category_values': '分类价值统计',
    'add_item': '添加物品',
    'item_name': '物品名称',
    'item_name_placeholder': '请输入物品名称',
    'purchase_date': '购买日期',
    'purchase_price': '购买价格',
    'purchase_price_placeholder': '请输入价格',
    'currency': '货币',
    'category': '分类',
    'status': '状态',
    'status_in_use': '在用',
    'status_discarded': '已丢弃',
    'status_transferred': '已转手',
    'status_damaged': '已损坏',
    'status_date': '状态日期',
    'status_date_placeholder': '状态变更日期',
    'transfer_price': '转手价格',
    'transfer_price_placeholder': '请输入转手价格',
    'add_item_button': '添加物品',
    'import_csv': '导入 CSV',
    'import_csv_button': '导入 CSV',
    'csv_format': 'CSV 格式：name,category,date,price,currency,status,status_date,transfer_price (如：手机,电子产品,2023-10-01,1000,CNY,in_use,,)',
    'filter_category': '过滤分类',
    'filter_category_all': '所有分类',
    'filter_status': '过滤状态',
    'filter_status_all': '所有状态',
    'sort_by': '排序方式',
    'sort_name': '按名称排序',
    'sort_date': '按购买日期排序',
    'sort_price': '按购买价格排序',
    'sort_daily_cost': '按每日成本排序',
    'export_csv': '导出 CSV',
    'category_label': '分类',
    'purchase_date_label': '购买日期',
    'purchase_price_label': '购买价格',
    'holding_days': '持有天数',
    'daily_cost': '每日成本',
    'delete': '删除',
    'sponsor_title': '赞助 AssetOS',
    'sponsor_subtitle': '支持我们的项目，保持持续开发',
    'sponsor_wechat': '通过微信赞助',
    'sponsor_instructions': '扫描下方二维码，通过微信支持我们的项目。您的支持将帮助我们改进 AssetOS！',
    'sponsor_thank_you': '感谢您的慷慨支持！',
    'return_home': '返回主页',
    'admin_title': '管理员面板',
    'admin_subtitle': '管理用户、分类和系统设置',
    'user_management': '用户管理',
    'username_label': '用户名',
    'email_label': '邮箱',
    'admin_status': '管理员',
    'email_verified': '邮箱验证',
    'verified': '已验证',
    'not_verified': '未验证',
    'set_admin': '设为管理员',
    'remove_admin': '取消管理员',
    'category_management': '自定义分类',
    'new_category': '新分类名称',
    'new_category_placeholder': '请输入分类名称',
    'add_category': '添加分类',
    'smtp_settings': 'SMTP 设置',
    'smtp_host': 'SMTP 主机',
    'smtp_host_placeholder': '如 smtp.gmail.com',
    'smtp_username': 'SMTP 用户名',
    'smtp_username_placeholder': '请输入用户名',
    'smtp_password': 'SMTP 密码',
    'smtp_password_placeholder': '留空保持不变',
    'smtp_port': 'SMTP 端口',
    'smtp_port_placeholder': '如 465',
    'smtp_encryption': '加密方式',
    'save_smtp': '保存 SMTP 设置',
    'data_backup': '数据备份',
    'data_backup_restore': '数据备份与恢复',
    'data_restore': '数据恢复',
    'backup_description': '下载当前数据库的完整备份文件',
    'restore_description': '上传备份文件恢复数据库（此操作将覆盖现有数据）',
    'select_backup_file': '选择备份文件',
    'restore_database': '恢复数据库',
    'restore_warning': '⚠️ 警告：此操作将完全覆盖现有数据，请确保已做好当前数据备份',
    'download_backup': '下载备份',
    'webhook_settings': 'Webhook 通知设置',
    'webhook_url': 'Webhook URL',
    'webhook_url_placeholder': 'https://...',
    'webhook_secret': 'Webhook 密钥',
    'webhook_secret_placeholder': '请输入密钥',
    'webhook_events': '通知事件',
    'event_item_added': '物品添加',
    'event_user_registered': '用户注册',
    'save_webhook': '保存 Webhook',
    'register_title': '注册 - AssetOS',
    'register_subtitle': '创建一个账户来管理您的资产',
    'username': '用户名',
    'enter_username': '请输入用户名',
    'email': '邮箱',
    'enter_email': '请输入邮箱',
    'password': '密码',
    'enter_password': '请输入密码',
    'register': '注册',
    'registration_success': '注册成功，请检查邮箱验证',
    'have_account': '已有账户？去登录',
    'project_description': '开源物品持有成本追踪系统',
    'feedback': '反馈',
    'documentation': '文档',
    'first_user_admin': '第一个注册的用户将自动成为管理员',
    'login_title': '登录 - AssetOS',
    'login_subtitle': '登录以管理您的资产',
    'login_input': '用户名或邮箱',
    'login_input_placeholder': '请输入用户名或邮箱',
    'login_button': '登录',
    'register_link': '没有账户？注册',
    'language_toggle': 'English',
    'days': '天',
    'back_to_menu': '返回菜单',
    'manage_items': '管理物品',
    'view_items': '查看物品',
    'view_reports': '统计报告',
    'add_category_success': '分类添加成功',
    'fetch_categories_error': '获取分类失败',
    'add_category_error': '添加分类失败',
    'delete_category_error': '删除分类失败',
    'category_name_error': '请输入分类名称',
    'server_error': '无法连接到服务器，请检查网络或服务器状态',
    'smtp_fetch_error': '获取SMTP设置失败',
    'smtp_save_success': 'SMTP设置已保存',
    'smtp_save_error': '保存SMTP设置失败',
    'sponsor_qr_error': '无法加载赞助二维码，请稍后再试',
    'menu_title': 'AssetOS 菜单',
    'menu_subtitle': '选择您要使用的功能',
    'view_items_desc': '查看和管理您的所有物品',
    'manage_items_desc': '添加新物品，导入/导出CSV',
    'enter': '进入',
    'settings_title': '个人设置',
    'settings_subtitle': '管理您的账户信息和偏好设置',
    'manage_page_title': '物品管理 - AssetOS',
    'manage_title': '物品管理',
    'manage_subtitle': '添加新物品、导入导出数据',
    'notes': '备注信息',
    'item_notes_placeholder': '添加关于该物品的备注信息（可选）',
    'notes_help': '您可以在此添加任何关于物品的额外信息，如使用体验、保修信息等',
    'csv_format_title': 'CSV 格式说明',
    'csv_example': '示例：手机,电子产品,2023-10-01,1000,CNY,in_use,,,备注内容',
    'export_description': '导出所有物品数据为 CSV 文件，可用于备份或在其他程序中使用。',
    'export_csv_button': '导出 CSV',
    'settings_page_title': '个人设置 - AssetOS',
    'account_info': '账户信息',
    'account_type': '账户类型',
    'change_password': '修改密码',
    'current_password': '当前密码',
    'current_password_placeholder': '请输入当前密码',
    'new_password': '新密码',
    'new_password_placeholder': '请输入新密码',
    'confirm_password': '确认新密码',
    'confirm_password_placeholder': '请再次输入新密码',
    'change_password_button': '修改密码',
    'preferences': '偏好设置',
    'default_currency': '默认货币',
    'date_format': '日期格式',
    'save_preferences': '保存偏好设置',
    'danger_zone': '危险操作',
    'danger_warning': '以下操作将永久删除您的账户和所有数据，请谨慎操作！',
    'delete_account': '删除账户',
    'menu_page_title': '菜单 - AssetOS',
    'view_reports': '统计报告',
    'view_reports_desc': '查看资产统计和成本分析',
    'sponsor_support': '赞助支持',
    'sponsor_support_desc': '支持项目发展',
    'admin_panel_desc': '用户管理、系统设置',
    'personal_settings_desc': '账户设置、密码修改',
    'tg_group': '交流',
    'tg_channel': '频道',
    'footer_title': 'AssetOS - 开源物品持有成本追踪系统',
    'footer_subtitle': '轻松管理您的资产，追踪持有成本',
    'connect_with_us': '联系我们',
    'help_support': '帮助与支持',
    'version_label': '版本',
    'release_date_label': '发布时间',
    'license_label': '开源许可',
    'commercial_license': '商业许可'
  },
  'en': {
    'title': 'Item Holding Cost Tracker',
    'subtitle': 'Easily manage your assets and track holding costs',
    'welcome': 'Welcome, ',
    'sponsor': 'Sponsor',
    'admin_panel': 'Admin Panel',
    'logout': 'Logout',
    'stats_total_value': 'Total Item Value',
    'stats_daily_cost': 'Total Daily Cost',
    'stats_category_values': 'Category Value Statistics',
    'add_item': 'Add Item',
    'item_name': 'Item Name',
    'item_name_placeholder': 'Enter item name',
    'purchase_date': 'Purchase Date',
    'purchase_price': 'Purchase Price',
    'purchase_price_placeholder': 'Enter price',
    'currency': 'Currency',
    'category': 'Category',
    'status': 'Status',
    'status_in_use': 'In Use',
    'status_discarded': 'Discarded',
    'status_transferred': 'Transferred',
    'status_damaged': 'Damaged',
    'status_date': 'Status Date',
    'status_date_placeholder': 'Status change date',
    'transfer_price': 'Transfer Price',
    'transfer_price_placeholder': 'Enter transfer price',
    'add_item_button': 'Add Item',
    'import_csv': 'Import CSV',
    'import_csv_button': 'Import CSV',
    'csv_format': 'CSV format: name,category,date,price,currency,status,status_date,transfer_price (e.g., Phone,Electronics,2023-10-01,1000,CNY,in_use,,)',
    'filter_category': 'Filter Category',
    'filter_category_all': 'All Categories',
    'filter_status': 'Filter Status',
    'filter_status_all': 'All Statuses',
    'sort_by': 'Sort By',
    'sort_name': 'Sort by Name',
    'sort_date': 'Sort by Purchase Date',
    'sort_price': 'Sort by Purchase Price',
    'sort_daily_cost': 'Sort by Daily Cost',
    'export_csv': 'Export CSV',
    'category_label': 'Category',
    'purchase_date_label': 'Purchase Date',
    'purchase_price_label': 'Purchase Price',
    'holding_days': 'Holding Days',
    'daily_cost': 'Daily Cost',
    'delete': 'Delete',
    'sponsor_title': 'Sponsor AssetOS',
    'sponsor_subtitle': 'Support our project to keep development ongoing',
    'sponsor_wechat': 'Sponsor via WeChat',
    'sponsor_instructions': 'Scan the QR code below to support our project via WeChat. Your support will help us improve AssetOS!',
    'sponsor_thank_you': 'Thank you for your generous support!',
    'return_home': 'Return to Home',
    'admin_title': 'Admin Panel',
    'admin_subtitle': 'Manage users, categories, and system settings',
    'user_management': 'User Management',
    'username_label': 'Username',
    'email_label': 'Email',
    'admin_status': 'Admin',
    'email_verified': 'Email Verified',
    'verified': 'Verified',
    'not_verified': 'Not Verified',
    'set_admin': 'Set as Admin',
    'remove_admin': 'Remove Admin',
    'category_management': 'Custom Categories',
    'new_category': 'New Category Name',
    'new_category_placeholder': 'Enter category name',
    'add_category': 'Add Category',
    'smtp_settings': 'SMTP Settings',
    'smtp_host': 'SMTP Host',
    'smtp_host_placeholder': 'e.g., smtp.gmail.com',
    'smtp_username': 'SMTP Username',
    'smtp_username_placeholder': 'Enter username',
    'smtp_password': 'SMTP Password',
    'smtp_password_placeholder': 'Leave blank to keep unchanged',
    'smtp_port': 'SMTP Port',
    'smtp_port_placeholder': 'e.g., 465',
    'smtp_encryption': 'Encryption',
    'save_smtp': 'Save SMTP Settings',
    'data_backup': 'Data Backup',
    'data_backup_restore': 'Data Backup & Restore',
    'data_restore': 'Data Restore',
    'backup_description': 'Download complete backup file of current database',
    'restore_description': 'Upload backup file to restore database (this will overwrite existing data)',
    'select_backup_file': 'Select Backup File',
    'restore_database': 'Restore Database',
    'restore_warning': '⚠️ Warning: This operation will completely overwrite existing data. Please ensure you have backed up current data',
    'download_backup': 'Download Backup',
    'webhook_settings': 'Webhook Notification Settings',
    'webhook_url': 'Webhook URL',
    'webhook_url_placeholder': 'https://...',
    'webhook_secret': 'Webhook Secret',
    'webhook_secret_placeholder': 'Enter secret',
    'webhook_events': 'Notification Events',
    'event_item_added': 'Item Added',
    'event_user_registered': 'User Registered',
    'save_webhook': 'Save Webhook',
    'register_title': 'Register - AssetOS',
    'register_subtitle': 'Create an account to manage your assets',
    'username': 'Username',
    'username_placeholder': 'Enter username',
    'email': 'Email',
    'email_placeholder': 'Enter email',
    'password': 'Password',
    'password_placeholder': 'Enter password',
    'register_button': 'Register',
    'email_verification_message': 'Registration successful! Please check your email to verify your account',
    'login_link': 'Already have an account? Login',
    'login_title': 'Login - AssetOS',
    'login_subtitle': 'Login to manage your assets',
    'login_input': 'Username or Email',
    'login_input_placeholder': 'Enter username or email',
    'login_button': 'Login',
    'register_link': 'Don\'t have an account? Register',
    'language_toggle': '中文',
    'enter_username': 'Enter username',
    'enter_email': 'Enter email',
    'enter_password': 'Enter password',
    'register': 'Register',
    'registration_success': 'Registration successful, please check your email for verification',
    'have_account': 'Already have an account? Login',
    'project_description': 'Open-source asset holding cost tracking system',
    'feedback': 'Feedback',
    'documentation': 'Documentation',
    'first_user_admin': 'The first registered user will automatically become an administrator',
    'days': 'days',
    'back_to_menu': 'Back to Menu',
    'manage_items': 'Manage Items',
    'view_items': 'View Items',
    'view_reports': 'View Reports',
    'add_category_success': 'Category added successfully',
    'fetch_categories_error': 'Failed to fetch categories',
    'add_category_error': 'Failed to add category',
    'delete_category_error': 'Failed to delete category',
    'category_name_error': 'Please enter category name',
    'server_error': 'Cannot connect to server, please check network or server status',
    'smtp_fetch_error': 'Failed to fetch SMTP settings',
    'smtp_save_success': 'SMTP settings saved',
    'smtp_save_error': 'Failed to save SMTP settings',
    'sponsor_qr_error': 'Unable to load sponsor QR code, please try again later',
    'menu_title': 'AssetOS Menu',
    'menu_subtitle': 'Choose the function you want to use',
    'view_items_desc': 'View and manage all your items',
    'manage_items_desc': 'Add new items, import/export CSV',
    'enter': 'Enter',
    'settings_title': 'Personal Settings',
    'settings_subtitle': 'Manage your account information and preferences',
    'manage_page_title': 'Item Management - AssetOS',
    'manage_title': 'Item Management',
    'manage_subtitle': 'Add new items, import and export data',
    'notes': 'Notes',
    'item_notes_placeholder': 'Add notes about this item (optional)',
    'notes_help': 'You can add any additional information about the item here, such as usage experience, warranty information, etc.',
    'csv_format_title': 'CSV Format Description',
    'csv_example': 'Example: Phone,Electronics,2023-10-01,1000,CNY,in_use,,,Note content',
    'export_description': 'Export all item data as a CSV file for backup or use in other programs.',
    'export_csv_button': 'Export CSV',
    'settings_page_title': 'Personal Settings - AssetOS',
    'account_info': 'Account Information',
    'account_type': 'Account Type',
    'change_password': 'Change Password',
    'current_password': 'Current Password',
    'current_password_placeholder': 'Enter current password',
    'new_password': 'New Password',
    'new_password_placeholder': 'Enter new password',
    'confirm_password': 'Confirm New Password',
    'confirm_password_placeholder': 'Re-enter new password',
    'change_password_button': 'Change Password',
    'preferences': 'Preferences',
    'default_currency': 'Default Currency',
    'date_format': 'Date Format',
    'save_preferences': 'Save Preferences',
    'danger_zone': 'Danger Zone',
    'danger_warning': 'The following operations will permanently delete your account and all data. Please proceed with caution!',
    'delete_account': 'Delete Account',
    'menu_page_title': 'Menu - AssetOS',
    'view_reports': 'View Reports',
    'view_reports_desc': 'View asset statistics and cost analysis',
    'sponsor_support': 'Sponsor Support',
    'sponsor_support_desc': 'Support project development',
    'admin_panel_desc': 'User management, system settings',
    'personal_settings_desc': 'Account settings, password change',
    'tg_group': 'Chat',
    'tg_channel': 'Channel',
    'footer_title': 'AssetOS - Open-source Asset Holding Cost Tracker',
    'footer_subtitle': 'Easily manage your assets and track holding costs',
    'connect_with_us': 'Connect with Us',
    'help_support': 'Help & Support',
    'version_label': 'Version',
    'release_date_label': 'Release Date',
    'license_label': 'License',
    'commercial_license': 'Commercial License'
  }
};

// 设置语言
function setLanguage(lang) {
  console.log('Setting language to:', lang);
  localStorage.setItem('language', lang);
  document.documentElement.lang = lang;
  
  // 调用翻译更新
  updateTranslations();
  
  // 在翻译更新后，再次设置语言切换按钮文本
  // 这是因为按钮有data-i18n属性，会被翻译系统覆盖
  setTimeout(() => {
    const languageToggle = document.getElementById('languageToggle');
    if (languageToggle) {
      // 按钮显示的是"下一个"语言，不是当前语言
      if (lang === 'zh-CN') {
        languageToggle.textContent = 'English';  // 中文状态下显示"English"
      } else {
        languageToggle.textContent = '中文';      // 英文状态下显示"中文"
      }
    }
  }, 10);
}

// 更新页面翻译
function updateTranslations() {
  const lang = localStorage.getItem('language') || 'zh-CN';
  console.log('updateTranslations called with language:', lang);
  
  // 检查翻译对象是否存在
  if (!translations || !translations[lang]) {
    console.error('Translation object not found for language:', lang);
    return;
  }
  
  // 更新所有带有 data-i18n 属性的元素（除了语言切换按钮）
  const elements = document.querySelectorAll('[data-i18n]');
  console.log('Found', elements.length, 'elements with data-i18n attribute');
  
  elements.forEach(element => {
    // 跳过语言切换按钮，因为它需要特殊处理
    if (element.id === 'languageToggle') {
      return;
    }
    
    const key = element.getAttribute('data-i18n');
    console.log('Processing element with key:', key);
    
    if (translations[lang] && translations[lang][key]) {
      const oldText = element.textContent;
      element.textContent = translations[lang][key];
      console.log('Updated', key + ':', oldText, '->', translations[lang][key]);
    } else {
      console.warn('Missing translation for key:', key, 'in language:', lang);
    }
  });
  
  // 更新所有带有 data-i18n-placeholder 属性的元素
  document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
    const key = element.getAttribute('data-i18n-placeholder');
    if (translations[lang] && translations[lang][key]) {
      element.placeholder = translations[lang][key];
    }
  });
  
  // 更新页面标题
  const titleElement = document.querySelector('title');
  if (titleElement) {
    const titleKey = titleElement.getAttribute('data-i18n');
    if (titleKey && translations[lang] && translations[lang][titleKey]) {
      titleElement.textContent = translations[lang][titleKey];
    }
  }
}

// 显示加载动画
function showSpinner() {
  const spinners = document.querySelectorAll('.spinner');
  spinners.forEach(spinner => spinner.style.display = 'block');
}

// 隐藏加载动画
function hideSpinner() {
  const spinners = document.querySelectorAll('.spinner');
  spinners.forEach(spinner => spinner.style.display = 'none');
}

// 加载赞助二维码图片
function loadSponsorImage() {
  const qrCode = document.getElementById('sponsorQrCode');
  if (qrCode) {
    showSpinner();
    const encodedUrl = qrCode.getAttribute('data-encoded-url');
    const decodedUrl = atob(encodedUrl);
    qrCode.src = decodedUrl;
    qrCode.onload = () => hideSpinner();
    qrCode.onerror = () => {
      hideSpinner();
      alert(translations[localStorage.getItem('language') || 'zh-CN'].sponsor_qr_error || '无法加载赞助二维码，请稍后再试');
    };
  }
}

// 检查登录状态
async function checkAuth() {
  showSpinner();
  try {
    const response = await fetch('api/api.php?action=checkAuth');
    if (!response.ok) throw new Error(`HTTP错误: ${response.status}`);
    const data = await response.json();
    console.log('检查认证状态:', data);
    if (data.authenticated) {
      if (document.getElementById('usernameDisplay')) {
        document.getElementById('usernameDisplay').textContent = `${translations[localStorage.getItem('language') || 'zh-CN'].welcome}${data.username}`;
      }
      if (document.getElementById('itemManager')) {
        document.getElementById('itemManager').classList.remove('hidden');
        fetchCategories(data.is_admin);
        fetchItems();
      }
      // 在manage.php页面加载分类
      if (window.location.pathname.includes('manage.php')) {
        fetchCategories(false);
      }
      // 在index.php页面加载分类用于过滤
      if (window.location.pathname.includes('index.php')) {
        fetchCategories(false);
      }
      // 在reports.php页面生成统计报告
      if (window.location.pathname.includes('reports.php')) {
        generateReports();
      }
      if (document.getElementById('adminPanel') && data.is_admin) {
        document.getElementById('adminPanel').classList.remove('hidden');
        fetchUsers();
        fetchCategories(true);
        fetchSmtpSettings();
      }
      if (document.getElementById('sponsorQrCode')) {
        loadSponsorImage();
      }
    } else if (window.location.pathname !== '/login.php' && window.location.pathname !== '/register.php' && window.location.pathname !== '/sponsor.php') {
      window.location.href = 'login.php';
    }
  } catch (error) {
    console.error('检查认证失败:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].server_error || '无法连接到服务器，请检查网络或服务器状态');
  } finally {
    hideSpinner();
  }
}

// 获取并填充 SMTP 设置
async function fetchSmtpSettings() {
  showSpinner();
  try {
    const response = await fetch('api/api.php?action=getSmtpSettings');
    const data = await response.json();
    console.log('获取SMTP设置:', data);
    if (data.success) {
      document.getElementById('smtpHost').value = data.settings.host || '';
      document.getElementById('smtpUsername').value = data.settings.username || '';
      document.getElementById('smtpPort').value = data.settings.port || '';
      document.getElementById('smtpEncryption').value = data.settings.encryption || 'ssl';
    } else {
      alert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].smtp_fetch_error || '获取SMTP设置失败');
    }
  } catch (error) {
    console.error('获取SMTP设置错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].smtp_fetch_error || '获取SMTP设置失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 保存 SMTP 设置
async function saveSmtpSettings() {
  const host = document.getElementById('smtpHost').value;
  const username = document.getElementById('smtpUsername').value;
  const password = document.getElementById('smtpPassword').value;
  const port = parseInt(document.getElementById('smtpPort').value);
  const encryption = document.getElementById('smtpEncryption').value;
  if (host && username && port && ['ssl', 'tls'].includes(encryption)) {
    showSpinner();
    try {
      const response = await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'saveSmtpSettings', host, username, password, port, encryption })
      });
      const data = await response.json();
      console.log('保存SMTP设置响应:', data);
      if (data.success) {
        alert(translations[localStorage.getItem('language') || 'zh-CN'].smtp_save_success || 'SMTP设置已保存');
        document.getElementById('smtpPassword').value = '';
      } else {
        alert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].smtp_save_error || '保存SMTP设置失败');
      }
    } catch (error) {
      console.error('保存SMTP设置错误:', error);
      alert(translations[localStorage.getItem('language') || 'zh-CN'].smtp_save_error || '保存SMTP设置失败，请检查网络或服务器');
    } finally {
      hideSpinner();
    }
  } else {
    alert(translations[localStorage.getItem('language') || 'zh-CN'].smtp_fields_error || '请填写所有必填SMTP字段（密码可选）');
  }
}

// 登录
async function login() {
  console.log('点击了登录');
  const loginInput = document.getElementById('loginInput').value;
  const password = document.getElementById('password').value;
  if (loginInput && password) {
    showSpinner();
    try {
      const response = await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'login', loginInput, password })
      });
      const data = await response.json();
      console.log('登录响应:', data);
      if (data.success) {
        window.location.href = 'menu.php';
      } else {
        document.getElementById('emailVerificationMessage').classList.toggle('hidden', !data.message.includes('邮箱未验证'));
        alert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].login_error || '登录失败');
      }
    } catch (error) {
      console.error('登录错误:', error);
      alert(translations[localStorage.getItem('language') || 'zh-CN'].login_request_error || '登录请求失败，请检查网络或服务器');
    } finally {
      hideSpinner();
    }
  } else {
    alert(translations[localStorage.getItem('language') || 'zh-CN'].login_fields_error || '请填写用户名/邮箱和密码');
  }
}

// 注册
async function register() {
  console.log('点击了注册');
  const username = document.getElementById('username').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  if (username && email && password) {
    showSpinner();
    try {
      const response = await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'register', username, email, password })
      });
      const data = await response.json();
      console.log('注册响应:', data);
      if (data.success) {
        // 使用自定义弹窗替代原生alert
        showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].registration_success || '注册成功！请检查您的邮箱以验证账户', 'success');
        document.getElementById('username').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
      } else {
        showCustomAlert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].register_error || '注册失败', 'error');
      }
    } catch (error) {
      console.error('注册错误:', error);
      showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].register_request_error || '注册请求失败，请检查网络或服务器', 'error');
    } finally {
      hideSpinner();
    }
  } else {
    showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].register_fields_error || '请填写所有字段', 'error');
  }
}

// 退出
async function logout() {
  showSpinner();
  try {
    await fetch('api/api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'logout' })
    });
    window.location.href = 'login.php';
  } catch (error) {
    console.error('退出错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].logout_error || '退出请求失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 计算持有天数
function calculateDaysHeld(purchaseDate, status, statusDate) {
  const endDate = (status !== 'in_use' && statusDate) ? new Date(statusDate) : new Date();
  const purchase = new Date(purchaseDate);
  const diffTime = endDate - purchase;
  return Math.max(1, Math.floor(diffTime / (1000 * 60 * 60 * 24)));
}

// 计算每日持有成本
function calculateDailyCost(price, days, status, transferPrice) {
  if (status === 'transferred' && transferPrice !== null) {
    return days > 0 ? ((price - transferPrice) / days).toFixed(2) : 'N/A';
  }
  return days > 0 ? (price / days).toFixed(2) : 'N/A';
}

// 显示自定义弹窗
function showCustomAlert(message, type = 'info', options = {}) {
  const alertEl = document.getElementById('custom-alert');
  const messageEl = document.getElementById('alert-message');
  const closeBtn = document.getElementById('alert-close-btn');
  const iconEl = document.getElementById('alert-icon');
  const buttonsEl = document.getElementById('alert-buttons');
  
  if (!alertEl || !messageEl) return;
  
  // 根据类型设置不同的样式
  messageEl.innerHTML = message; // 使用innerHTML以支持格式化文本
  
  // 清除之前的类型样式
  alertEl.classList.remove('alert-info', 'alert-success', 'alert-error', 'alert-warning');
  
  // 设置图标
  let icon = '';
  
  // 设置新的类型样式
  if (type === 'error') {
    alertEl.classList.add('alert-error');
    messageEl.className = 'text-red-600 font-medium';
    icon = '<svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
  } else if (type === 'success') {
    alertEl.classList.add('alert-success');
    messageEl.className = 'text-green-600 font-medium';
    icon = '<svg class="w-12 h-12 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
  } else if (type === 'warning') {
    alertEl.classList.add('alert-warning');
    messageEl.className = 'text-yellow-600 font-medium';
    icon = '<svg class="w-12 h-12 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>';
  } else {
    alertEl.classList.add('alert-info');
    messageEl.className = 'text-blue-600 font-medium';
    icon = '<svg class="w-12 h-12 mx-auto text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
  }
  
  // 显示图标
  if (options.hideIcon) {
    iconEl.style.display = 'none';
  } else {
    iconEl.style.display = 'block';
    iconEl.innerHTML = icon;
  }
  
  // 处理按钮
  buttonsEl.innerHTML = '';
  if (options.buttons && options.buttons.length > 0) {
    options.buttons.forEach(button => {
      const btnEl = document.createElement('button');
      btnEl.className = `btn ${button.class || 'btn-primary'}`;
      btnEl.textContent = button.text;
      btnEl.onclick = () => {
        if (button.onClick) button.onClick();
        if (button.closeOnClick !== false) {
          alertEl.classList.add('hidden');
        }
      };
      buttonsEl.appendChild(btnEl);
    });
  } else {
    buttonsEl.style.display = 'none';
  }
  
  alertEl.classList.remove('hidden');
  
  // 添加关闭按钮事件
  closeBtn.onclick = function() {
    alertEl.classList.add('hidden');
  };
  
  // 点击弹窗背景也可关闭
  alertEl.onclick = function(e) {
    if (e.target === alertEl) {
      alertEl.classList.add('hidden');
    }
  };
  
  // 自动关闭设置
  if (options.autoClose !== false) {
    const timeout = options.timeout || 5000;
    setTimeout(() => {
      alertEl.classList.add('hidden');
    }, timeout);
  }
}

// 获取并显示版本号
async function fetchVersion() {
  if (document.getElementById('version-info')) {
    try {
      const response = await fetch('api/api.php?action=getVersion');
      const data = await response.json();
      if (data.success && data.version) {
        document.getElementById('version-info').textContent = `版本: ${data.version}`;
      }
    } catch (error) {
      console.error('获取版本信息失败:', error);
    }
  }
}

// 添加物品
async function addItem() {
  const name = document.getElementById('itemName').value;
  const date = document.getElementById('purchaseDate').value;
  const price = parseFloat(document.getElementById('purchasePrice').value);
  const currency = document.getElementById('currency').value;
  const category = document.getElementById('category').value;
  const status = document.getElementById('itemStatus').value;
  const statusDate = document.getElementById('statusDate').value || null;
  const transferPrice = status === 'transferred' ? parseFloat(document.getElementById('transferPrice').value) || null : null;
  const notes = document.getElementById('itemNotes').value || null; // 添加备注字段

  if (name && date && price && currency && category && (status !== 'transferred' || (status === 'transferred' && transferPrice !== null))) {
    showSpinner();
    try {
      // 发送请求，包含备注信息
      const response = await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 
          action: 'add', 
          name, 
          date, 
          price, 
          currency, 
          category, 
          status, 
          status_date: statusDate, 
          transfer_price: transferPrice,
          notes: notes // 添加备注字段
        })
      });

      if (!response.ok) {
        throw new Error('服务器响应错误');
      }
      
      const result = await response.json();
      
      if (result.success) {
        showCustomAlert('物品添加成功', 'success');
        fetchItems();
        clearForm();
      } else {
        showCustomAlert(result.message || '添加失败', 'error');
      }
    } catch (error) {
      console.error('添加物品错误:', error);
      showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].add_item_error || '添加物品失败，请检查网络或服务器', 'error');
    } finally {
      hideSpinner();
    }
  } else {
    showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].add_item_fields_error || '请填写所有必填字段！' + (status === 'transferred' ? '（转手状态需要转手价格）' : ''), 'warning');
  }
}

// 清空表单
function clearForm() {
  document.getElementById('itemName').value = '';
  document.getElementById('purchaseDate').value = '';
  document.getElementById('purchasePrice').value = '';
  document.getElementById('currency').value = 'CNY';
  document.getElementById('category').value = '';
  document.getElementById('itemStatus').value = 'in_use';
  document.getElementById('statusDate').value = '';
  document.getElementById('transferPrice').value = '';
  document.getElementById('itemNotes').value = ''; // 清空备注字段
  document.getElementById('transferPriceContainer').classList.add('hidden');
}

// 删除物品
async function deleteItem(id) {
  const lang = localStorage.getItem('language') || 'zh-CN';
  const confirmMessage = lang === 'zh-CN' ? '确定要删除这个物品吗？' : 'Are you sure you want to delete this item?';
  const confirmText = lang === 'zh-CN' ? '确认删除' : 'Confirm';
  const cancelText = lang === 'zh-CN' ? '取消' : 'Cancel';
  
  showCustomAlert(confirmMessage, 'warning', {
    hideIcon: false,
    autoClose: false,
    buttons: [
      {
        text: confirmText,
        class: 'bg-red-500 text-white hover:bg-red-600',
        onClick: async () => {
          showSpinner();
          try {
            const response = await fetch('api/api.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ action: 'delete', id })
            });
            
            if (response.ok) {
              const successMessage = lang === 'zh-CN' ? '物品删除成功' : 'Item deleted successfully';
              showCustomAlert(successMessage, 'success');
              fetchItems();
            } else {
              throw new Error('删除失败');
            }
          } catch (error) {
            console.error('删除物品错误:', error);
            showCustomAlert(translations[lang]?.delete_item_error || '删除物品失败，请检查网络或服务器', 'error');
          } finally {
            hideSpinner();
          }
        },
        closeOnClick: true
      },
      {
        text: cancelText,
        class: 'bg-gray-500 text-white hover:bg-gray-600 cancel-btn',
        onClick: () => {},
        closeOnClick: true
      }
    ]
  });
}

// 导入CSV
async function importCSV() {
  const fileInput = document.getElementById('csvFile');
  const file = fileInput.files[0];
  if (!file) {
    showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].csv_file_error || '请选择CSV文件！', 'warning');
    return;
  }

  const formData = new FormData();
  formData.append('file', file);
  formData.append('action', 'import');

  showSpinner();
  try {
    const response = await fetch('api/api.php', {
      method: 'POST',
      body: formData
    });
    const data = await response.json();
    console.log('导入CSV响应:', data);
    if (data.success) {
      showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].csv_import_success || `成功导入 ${data.imported} 条记录，${data.errors} 条错误`, 'success');
      fetchItems();
      fileInput.value = '';
    } else {
      showCustomAlert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].csv_import_error || '导入失败', 'error');
    }
  } catch (error) {
    console.error('导入CSV错误:', error);
    showCustomAlert(translations[localStorage.getItem('language') || 'zh-CN'].csv_import_request_error || '导入CSV失败，请检查网络或服务器', 'error');
  } finally {
    hideSpinner();
  }
}

// 获取并渲染物品
async function fetchItems() {
  const filterCategory = document.getElementById('filterCategory')?.value || 'all';
  const filterStatus = document.getElementById('filterStatus')?.value || 'all';
  const sortBy = document.getElementById('sortBy')?.value || 'name';
  showSpinner();
  try {
    const response = await fetch(`api/api.php?action=list&category=${filterCategory}&status=${filterStatus}&sortBy=${sortBy}`);
    const items = await response.json();
    console.log('获取物品列表:', items);
    if (items.error) {
      alert(items.error);
      return;
    }
    
    const itemList = document.getElementById('itemList');
    const statsContainer = document.getElementById('statsContainer');
    if (itemList && statsContainer) {
      itemList.innerHTML = '';
      let totalValue = 0;
      let totalDailyCost = 0;
      const categoryValues = {};

      items.forEach(item => {
        const daysHeld = calculateDaysHeld(item.date, item.status, item.status_date);
        const dailyCost = calculateDailyCost(item.price, daysHeld, item.status, item.transfer_price);
        totalValue += parseFloat(item.price);
        if (dailyCost !== 'N/A') totalDailyCost += parseFloat(dailyCost);
        categoryValues[item.category] = (categoryValues[item.category] || 0) + parseFloat(item.price);

        const statusText = translations[localStorage.getItem('language') || 'zh-CN'][`status_${item.status}`];

        const itemDiv = document.createElement('div');
        itemDiv.className = 'item-card fade-in';
        
        // 准备悬浮提示内容
        const tooltipContent = [];
        if (item.status_date) {
          tooltipContent.push(`<div class="tooltip-item"><span class="tooltip-label">状态日期:</span> <span class="tooltip-value">${item.status_date}</span></div>`);
        }
        if (item.transfer_price !== null) {
          tooltipContent.push(`<div class="tooltip-item"><span class="tooltip-label">转手价格:</span> <span class="tooltip-value">${currencySymbols[item.currency]}${parseFloat(item.transfer_price).toFixed(2)}</span></div>`);
        }
        if (item.notes) {
          tooltipContent.push(`<div class="tooltip-item"><span class="tooltip-label">备注:</span> <span class="tooltip-value">${item.notes}</span></div>`);
        }
        
        const tooltipHtml = tooltipContent.length > 0 ? 
          `<div class="tooltip-content">${tooltipContent.join('')}</div>` : '';
        
        itemDiv.innerHTML = `
          <div class="item-actions">
            <button onclick="editItem(${item.id})" class="edit-btn" title="编辑">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L10.5 8.207l-3-3L12.146.146zM11.207 9L14 6.207l-3-3L8.207 6 11.207 9zM7.5 7.293L4 10.793V13.5a.5.5 0 0 0 .5.5h2.707l3.5-3.5-3.207-3.207z"/>
              </svg>
            </button>
            <button onclick="deleteItem(${item.id})" class="delete-btn" title="删除">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
              </svg>
            </button>
          </div>
          <div class="flex items-center gap-2 mb-3">
            <h3 class="font-semibold text-lg text-gray-900">${item.name}</h3>
            <span class="tag tag-${item.status} ${tooltipContent.length > 0 ? 'has-tooltip' : ''}" data-i18n="status_${item.status}">${statusText}${tooltipContent.length > 0 ? tooltipHtml : ''}</span>
          </div>
          <div class="space-y-2">
            <p class="item-info"><span class="info-label" data-i18n="category_label">${translations[localStorage.getItem('language') || 'zh-CN'].category_label}</span>: ${item.category}</p>
            <p class="item-info"><span class="info-label" data-i18n="purchase_date_label">${translations[localStorage.getItem('language') || 'zh-CN'].purchase_date_label}</span>: <span class="date-highlight">${item.date}</span></p>
            <p class="item-info"><span class="info-label" data-i18n="purchase_price_label">${translations[localStorage.getItem('language') || 'zh-CN'].purchase_price_label}</span>: <span class="price-highlight">${currencySymbols[item.currency]}${parseFloat(item.price).toFixed(2)}</span></p>
            <p class="item-info"><span class="info-label" data-i18n="holding_days">${translations[localStorage.getItem('language') || 'zh-CN'].holding_days}</span>: <span class="days-highlight">${daysHeld} <span data-i18n="days">${translations[localStorage.getItem('language') || 'zh-CN'].days || '天'}</span></span></p>
            <p class="item-info"><span class="info-label" data-i18n="daily_cost">${translations[localStorage.getItem('language') || 'zh-CN'].daily_cost}</span>: <span class="cost-highlight">${currencySymbols[item.currency]}${dailyCost}</span></p>
          </div>
        `;
        itemList.appendChild(itemDiv);
      });

      // 渲染统计信息
      statsContainer.innerHTML = `
        <div class="stats-card mb-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="text-center">
              <div class="stats-label" data-i18n="stats_total_value">${translations[localStorage.getItem('language') || 'zh-CN'].stats_total_value}</div>
              <div class="stats-value">${currencySymbols[items[0]?.currency || 'CNY']}${totalValue.toFixed(2)}</div>
            </div>
            <div class="text-center">
              <div class="stats-label" data-i18n="stats_daily_cost">${translations[localStorage.getItem('language') || 'zh-CN'].stats_daily_cost}</div>
              <div class="stats-value">${currencySymbols[items[0]?.currency || 'CNY']}${totalDailyCost.toFixed(2)}</div>
            </div>
          </div>
        </div>
      `;
    }
  } catch (error) {
    console.error('获取物品错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].fetch_items_error || '获取物品列表失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 导出CSV
async function exportToCSV() {
  showSpinner();
  try {
    window.location.href = 'api/api.php?action=export';
  } finally {
    hideSpinner();
  }
}

// 获取并渲染分类
async function fetchCategories(isAdmin) {
  console.log('开始获取分类, isAdmin:', isAdmin);
  showSpinner();
  try {
    const response = await fetch(`api/api.php?action=listCategories&admin=${isAdmin}`);
    console.log('分类API响应状态:', response.status);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    console.log('获取分类数据:', data);
    
    // 检查是否有错误
    if (data.success === false) {
      throw new Error(data.message || '获取分类失败');
    }
    
    // 如果是错误数组，转换为空数组
    const categories = Array.isArray(data) ? data : [];
    console.log('处理后的分类数组:', categories);
    
    const lang = localStorage.getItem('language') || 'zh-CN';
    const categorySelect = document.getElementById('category');
    const filterCategorySelect = document.getElementById('filterCategory');
    
    // 更新添加物品的分类选择框
    if (categorySelect) {
      console.log('更新分类选择框');
      categorySelect.innerHTML = '';
      categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.name;
        option.textContent = category.name;
        categorySelect.appendChild(option);
      });
      console.log('分类选择框更新完成，选项数量:', categorySelect.options.length);
    } else {
      console.log('未找到分类选择框元素');
    }
    
    // 更新过滤器的分类选择框
    if (filterCategorySelect) {
      filterCategorySelect.innerHTML = `<option value="all" data-i18n="filter_category_all">${translations[lang].filter_category_all}</option>`;
      categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.name;
        option.textContent = category.name;
        filterCategorySelect.appendChild(option);
      });
    }
    
    // 更新管理员页面的分类列表
    const categoryList = document.getElementById('categoryList');
    if (categoryList) {
      categoryList.innerHTML = '';
      categories.forEach(category => {
        const div = document.createElement('div');
        div.className = 'admin-item';
        div.innerHTML = `
          <div class="flex justify-between items-center">
            <span class="font-medium">${category.name}</span>
            <button onclick="deleteCategory('${category.name}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" data-i18n="delete">${translations[lang].delete}</button>
          </div>
        `;
        categoryList.appendChild(div);
      });
    }
  } catch (error) {
    console.error('获取分类错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].fetch_categories_error || '获取分类失败，请检查网络或服务器: ' + error.message);
  } finally {
    hideSpinner();
  }
}

// 添加分类
async function addCategory() {
  const categoryName = document.getElementById('newCategory').value.trim();
  if (!categoryName) {
    alert(translations[localStorage.getItem('language') || 'zh-CN'].category_name_error || '请输入分类名称');
    return;
  }
  
  showSpinner();
  try {
    const response = await fetch('api/api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'addCategory', name: categoryName })
    });
    
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    const data = await response.json();
    console.log('添加分类响应:', data);
    
    if (data.success) {
      document.getElementById('newCategory').value = '';
      alert(translations[localStorage.getItem('language') || 'zh-CN'].add_category_success || '分类添加成功');
      fetchCategories(true);
    } else {
      alert(data.message || translations[localStorage.getItem('language') || 'zh-CN'].add_category_error || '添加分类失败');
    }
  } catch (error) {
    console.error('添加分类错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].add_category_error || '添加分类失败，请检查网络或服务器: ' + error.message);
  } finally {
    hideSpinner();
  }
}

// 删除分类
async function deleteCategory(name) {
  showSpinner();
  try {
    await fetch('api/api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'deleteCategory', name })
    });
    fetchCategories(true);
  } catch (error) {
    console.error('删除分类错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].delete_category_error || '删除分类失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 获取并渲染用户列表（管理员）
async function fetchUsers() {
  showSpinner();
  try {
    const response = await fetch('api/api.php?action=listUsers');
    const users = await response.json();
    const lang = localStorage.getItem('language') || 'zh-CN';
    const userList = document.getElementById('userList');
    if (userList) {
      userList.innerHTML = '';
      users.forEach(user => {
        const div = document.createElement('div');
        div.className = 'admin-item';
        div.innerHTML = `
          <div class="flex justify-between items-center">
            <div>
              <p class="font-medium"><span data-i18n="username_label">${translations[lang].username_label}</span>: ${user.username}</p>
              <p class="text-sm text-gray-600"><span data-i18n="email_label">${translations[lang].email_label}</span>: ${user.email}</p>
              <p class="text-sm"><span data-i18n="admin_status">${translations[lang].admin_status}</span>: ${user.is_admin ? translations[lang].verified : translations[lang].not_verified}</p>
              <p class="text-sm"><span data-i18n="email_verified">${translations[lang].email_verified}</span>: ${user.email_verified ? translations[lang].verified : translations[lang].not_verified}</p>
            </div>
            <div class="flex gap-2">
              <button onclick="toggleAdmin(${user.id}, ${!user.is_admin})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600" data-i18n="${user.is_admin ? 'remove_admin' : 'set_admin'}">${translations[lang][user.is_admin ? 'remove_admin' : 'set_admin']}</button>
              <button onclick="deleteUser(${user.id})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" data-i18n="delete">${translations[lang].delete}</button>
            </div>
          </div>
        `;
        userList.appendChild(div);
      });
    }
  } catch (error) {
    console.error('获取用户错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].fetch_users_error || '获取用户列表失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 切换管理员状态
async function toggleAdmin(userId, isAdmin) {
  showSpinner();
  try {
    await fetch('api/api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'toggleAdmin', user_id: userId, is_admin: isAdmin })
    });
    fetchUsers();
  } catch (error) {
    console.error('切换管理员状态错误:', error);
    alert(translations[localStorage.getItem('language') || 'zh-CN'].toggle_admin_error || '操作失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 删除用户
async function deleteUser(userId) {
  if (confirm(translations[localStorage.getItem('language') || 'zh-CN'].confirm_delete_user || '确定删除此用户？')) {
    showSpinner();
    try {
      await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'deleteUser', user_id: userId })
      });
      fetchUsers();
    } catch (error) {
      console.error('删除用户错误:', error);
      alert(translations[localStorage.getItem('language') || 'zh-CN'].delete_user_error || '删除用户失败，请检查网络或服务器');
    } finally {
      hideSpinner();
    }
  }
}

// 备份数据库
async function backupDatabase() {
  showSpinner();
  try {
    const response = await fetch('api/api.php?action=backup', {
      method: 'GET',
      credentials: 'same-origin'
    });
    
    // 检查响应是否成功
    if (!response.ok) {
      throw new Error('网络请求失败');
    }
    
    // 检查content-type，如果是JSON则说明有错误
    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
      const result = await response.json();
      throw new Error(result.message || '备份失败');
    }
    
    // 如果是文件，则下载
    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.style.display = 'none';
    a.href = url;
    a.download = 'backup_' + new Date().toISOString().slice(0,19).replace(/[:-]/g, '') + '.sqlite';
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
    
    showAlert('备份下载成功', 'success');
  } catch (error) {
    console.error('备份失败:', error);
    showAlert('备份失败: ' + error.message, 'error');
  } finally {
    hideSpinner();
  }
}

// 保存Webhook设置
async function saveWebhook() {
  const url = document.getElementById('webhookUrl').value;
  const secret = document.getElementById('webhookSecret').value;
  const events = Array.from(document.getElementById('webhookEvents').selectedOptions).map(opt => opt.value);
  if (url && secret && events.length > 0) {
    showSpinner();
    try {
      await fetch('api/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'saveWebhook', url, secret, events })
      });
      alert(translations[localStorage.getItem('language') || 'zh-CN'].webhook_save_success || 'Webhook设置已保存');
    } catch (error) {
      console.error('保存Webhook错误:', error);
      alert(translations[localStorage.getItem('language') || 'zh-CN'].webhook_save_error || '保存Webhook失败，请检查网络或服务器');
    } finally {
      hideSpinner();
    }
  } else {
    alert(translations[localStorage.getItem('language') || 'zh-CN'].webhook_fields_error || '请填写所有Webhook字段');
  }
}

// 动态显示/隐藏转手价格字段
function toggleTransferPrice() {
  const status = document.getElementById('itemStatus').value;
  const transferPriceContainer = document.getElementById('transferPriceContainer');
  transferPriceContainer.classList.toggle('hidden', status !== 'transferred');
}

// 生成统计报告
async function generateReports() {
  console.log('开始生成统计报告');
  showSpinner();
  try {
    const response = await fetch('api/api.php?action=getItems');
    if (!response.ok) throw new Error(`HTTP错误: ${response.status}`);
    const items = await response.json();
    console.log('获取物品数据:', items);

    if (!items || items.length === 0) {
      document.getElementById('statsContainer').innerHTML = '<p class="text-gray-500">暂无物品数据</p>';
      return;
    }

    const lang = localStorage.getItem('language') || 'zh-CN';
    let totalValue = 0;
    let totalDailyCost = 0;
    const categoryValues = {};
    const statusCounts = {};
    const monthlyExpenses = {};

    items.forEach(item => {
      const daysHeld = calculateDaysHeld(item.date, item.status, item.status_date);
      const dailyCost = calculateDailyCost(item.price, daysHeld, item.status, item.transfer_price);
      totalValue += parseFloat(item.price);
      if (dailyCost !== 'N/A') totalDailyCost += parseFloat(dailyCost);
      
      // 分类统计
      categoryValues[item.category] = (categoryValues[item.category] || 0) + parseFloat(item.price);
      
      // 状态统计
      statusCounts[item.status] = (statusCounts[item.status] || 0) + 1;
      
      // 月度支出统计
      const month = item.date.substring(0, 7); // YYYY-MM 格式
      monthlyExpenses[month] = (monthlyExpenses[month] || 0) + parseFloat(item.price);
    });

    // 渲染统计概览
    const statsContainer = document.getElementById('statsContainer');
    if (statsContainer) {
      statsContainer.innerHTML = `
        <div class="stats-card">
          <div class="stats-label" data-i18n="stats_total_value">${translations[lang].stats_total_value}</div>
          <div class="stats-value">${currencySymbols[items[0]?.currency || 'CNY']}${totalValue.toFixed(2)}</div>
        </div>
        <div class="stats-card">
          <div class="stats-label" data-i18n="stats_daily_cost">${translations[lang].stats_daily_cost}</div>
          <div class="stats-value">${currencySymbols[items[0]?.currency || 'CNY']}${totalDailyCost.toFixed(2)}</div>
        </div>
        <div class="stats-card">
          <div class="stats-label">物品总数</div>
          <div class="stats-value">${items.length}</div>
        </div>
        <div class="stats-card">
          <div class="stats-label">平均每日成本</div>
          <div class="stats-value">${currencySymbols[items[0]?.currency || 'CNY']}${(totalDailyCost / items.length).toFixed(2)}</div>
        </div>
      `;
    }

    // 渲染分类统计
    const categoryStats = document.getElementById('categoryStats');
    if (categoryStats) {
      categoryStats.innerHTML = Object.entries(categoryValues)
        .sort(([,a], [,b]) => b - a)
        .map(([category, value]) => `
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
            <span class="font-medium">${category}</span>
            <span class="text-lg font-semibold text-blue-600">${currencySymbols[items[0]?.currency || 'CNY']}${value.toFixed(2)}</span>
          </div>
        `).join('');
    }

    // 渲染状态统计
    const statusStats = document.getElementById('statusStats');
    if (statusStats) {
      statusStats.innerHTML = Object.entries(statusCounts)
        .map(([status, count]) => `
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
            <span class="font-medium" data-i18n="status_${status}">${translations[lang][`status_${status}`] || status}</span>
            <span class="text-lg font-semibold text-green-600">${count}</span>
          </div>
        `).join('');
    }

    // 渲染月度支出
    const monthlyExpensesContainer = document.getElementById('monthlyExpenses');
    if (monthlyExpensesContainer) {
      monthlyExpensesContainer.innerHTML = Object.entries(monthlyExpenses)
        .sort(([a], [b]) => b.localeCompare(a))
        .slice(0, 6) // 显示最近6个月
        .map(([month, expense]) => `
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
            <span class="font-medium">${month}</span>
            <span class="text-lg font-semibold text-purple-600">${currencySymbols[items[0]?.currency || 'CNY']}${expense.toFixed(2)}</span>
          </div>
        `).join('');
    }

  } catch (error) {
    console.error('生成统计报告错误:', error);
    alert('生成统计报告失败，请检查网络或服务器');
  } finally {
    hideSpinner();
  }
}

// 页面加载时检查认证状态并初始化语言
window.onload = () => {
  // 初始化语言
  const lang = localStorage.getItem('language') || 'zh-CN';
  setLanguage(lang);
  
  // 检查认证状态
  checkAuth();
  
  // 绑定状态变更事件
  const itemStatus = document.getElementById('itemStatus');
  if (itemStatus) {
    itemStatus.addEventListener('change', toggleTransferPrice);
    toggleTransferPrice();
  }
  
  // 为页面添加渐入动画
  document.body.classList.add('fade-in');
};

// 编辑物品函数
async function editItem(itemId) {
  showSpinner();
  try {
    // 首先获取物品详情
    const response = await fetch('api/api.php?action=list');
    if (!response.ok) throw new Error(`HTTP错误: ${response.status}`);
    const items = await response.json();
    
    const item = items.find(i => i.id == itemId);
    if (!item) {
      showCustomAlert('物品不存在', 'error');
      return;
    }

    // 创建编辑模态框
    const modal = document.createElement('div');
    modal.className = 'edit-modal';
    modal.id = 'edit-modal';
    modal.innerHTML = `
      <div class="edit-modal-content">
        <button class="alert-close-btn" onclick="closeEditModal()">&times;</button>
        <h3 class="mb-4">编辑物品信息</h3>
        <div class="space-y-4">
          <div>
            <label class="form-label">物品名称 <span class="text-red-500">*</span></label>
            <input id="editItemName" type="text" value="${item.name}" class="input-field" placeholder="输入物品名称">
          </div>
          <div>
            <label class="form-label">物品分类 <span class="text-red-500">*</span></label>
            <select id="editCategory" class="input-field">
              <!-- 动态加载分类 -->
            </select>
          </div>
          <div>
            <label class="form-label">购买日期 <span class="text-red-500">*</span></label>
            <input id="editPurchaseDate" type="date" value="${item.date}" class="input-field">
          </div>
          <div>
            <label class="form-label">购买价格 <span class="text-red-500">*</span></label>
            <input id="editPurchasePrice" type="number" step="0.01" value="${item.price}" class="input-field" placeholder="输入购买价格">
          </div>
          <div>
            <label class="form-label">货币类型</label>
            <select id="editCurrency" class="input-field">
              <option value="CNY" ${item.currency === 'CNY' ? 'selected' : ''}>人民币 (￥)</option>
              <option value="USD" ${item.currency === 'USD' ? 'selected' : ''}>美元 ($)</option>
              <option value="EUR" ${item.currency === 'EUR' ? 'selected' : ''}>欧元 (€)</option>
            </select>
          </div>
          <div>
            <label class="form-label">物品状态</label>
            <select id="editStatus" class="input-field">
              <option value="in_use" ${item.status === 'in_use' ? 'selected' : ''}>在用</option>
              <option value="discarded" ${item.status === 'discarded' ? 'selected' : ''}>已丢弃</option>
              <option value="transferred" ${item.status === 'transferred' ? 'selected' : ''}>已转手</option>
              <option value="damaged" ${item.status === 'damaged' ? 'selected' : ''}>已损坏</option>
            </select>
          </div>
          <div>
            <label class="form-label">状态变更日期</label>
            <input id="editStatusDate" type="date" value="${item.status_date || ''}" class="input-field">
            <p class="text-xs text-gray-500 mt-1">物品状态变更的日期（可选）</p>
          </div>
          <div id="editTransferPriceContainer" class="${item.status === 'transferred' ? '' : 'hidden'}">
            <label class="form-label">转手价格</label>
            <input id="editTransferPrice" type="number" step="0.01" value="${item.transfer_price || ''}" class="input-field" placeholder="输入转手价格">
            <p class="text-xs text-gray-500 mt-1">仅在物品状态为"已转手"时需要填写</p>
          </div>
          <div>
            <label class="form-label">备注信息</label>
            <textarea id="editNotes" class="input-field h-24" placeholder="添加关于该物品的备注信息（可选）">${item.notes || ''}</textarea>
            <p class="text-xs text-gray-500 mt-1">可以记录物品的使用体验、维修记录、购买原因等</p>
          </div>
        </div>
        <p class="text-xs text-red-500 mt-3 mb-3">* 表示必填字段</p>
        <div class="flex flex-row justify-center gap-6 mt-6">
          <button onclick="saveEditedItem(${itemId})" class="btn bg-green-500 text-white hover:bg-green-600 rounded-md px-8 py-3 w-1/3">保存修改</button>
          <button onclick="closeEditModal()" class="btn bg-gray-500 text-white hover:bg-gray-600 rounded-md px-8 py-3 w-1/3 cancel-btn">取消</button>
        </div>
      </div>
    `;

    // 确保模态框添加到 document.body，并且总是显示在最上层
    document.body.appendChild(modal);
    
    // 点击背景可关闭弹窗
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeEditModal();
      }
    });

    // 加载分类到下拉框
    const categorySelect = document.getElementById('editCategory');
    const categoriesResponse = await fetch('api/api.php?action=listCategories&admin=false');
    const categories = await categoriesResponse.json();
    categorySelect.innerHTML = '';
    categories.forEach(category => {
      const option = document.createElement('option');
      option.value = category.name;
      option.textContent = category.name;
      option.selected = category.name === item.category;
      categorySelect.appendChild(option);
    });

    // 绑定状态变更事件
    document.getElementById('editStatus').addEventListener('change', function() {
      const transferContainer = document.getElementById('editTransferPriceContainer');
      if (this.value === 'transferred') {
        transferContainer.classList.remove('hidden');
      } else {
        transferContainer.classList.add('hidden');
      }
    });

  } catch (error) {
    console.error('编辑物品错误:', error);
    showCustomAlert('编辑物品失败，请检查网络或服务器', 'error');
  } finally {
    hideSpinner();
  }
}

// 保存编辑的物品
async function saveEditedItem(itemId) {
  showSpinner();
  try {
    const name = document.getElementById('editItemName').value.trim();
    const category = document.getElementById('editCategory').value;
    const date = document.getElementById('editPurchaseDate').value;
    const price = document.getElementById('editPurchasePrice').value;
    const currency = document.getElementById('editCurrency').value;
    const status = document.getElementById('editStatus').value;
    const statusDate = document.getElementById('editStatusDate').value;
    const transferPrice = document.getElementById('editTransferPrice').value;
    const notes = document.getElementById('editNotes').value;

    if (!name || !category || !date || !price) {
      showCustomAlert('请填写所有必填字段（物品名称、分类、购买日期和购买价格）', 'error', {
        timeout: 4000
      });
      return;
    }

    const updateData = {
      action: 'updateItem',
      id: itemId,
      name,
      category,
      date,
      price: parseFloat(price),
      currency,
      status,
      status_date: statusDate || null,
      transfer_price: transferPrice ? parseFloat(transferPrice) : null,
      notes: notes || null
    };

    const response = await fetch('api/api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updateData)
    });

    if (response.ok) {
      const result = await response.json();
      if (result.success) {
        showCustomAlert('物品更新成功', 'success');
        closeEditModal();
        fetchItems(); // 刷新物品列表
      } else {
        showCustomAlert(result.message || '更新失败', 'error');
      }
    } else {
      throw new Error('网络错误');
    }
  } catch (error) {
    console.error('保存编辑错误:', error);
    showCustomAlert('保存失败，请检查网络或服务器', 'error');
  } finally {
    hideSpinner();
  }
}

// 关闭编辑模态框
function closeEditModal() {
  const modal = document.getElementById('edit-modal');
  if (modal) {
    modal.remove();
  }
}


// 页面初始化将在后面统一处理






























// 页面初始化
document.addEventListener('DOMContentLoaded', function() {
  // 处理CSV文件上传
  const csvFileInput = document.getElementById('csvFile');
  const selectedFileName = document.getElementById('selectedFileName');
  
  if (csvFileInput && selectedFileName) {
    csvFileInput.addEventListener('change', function() {
      if (this.files.length > 0) {
        selectedFileName.textContent = this.files[0].name;
      } else {
        const lang = localStorage.getItem('language') || 'zh-CN';
        selectedFileName.textContent = lang === 'zh-CN' ? '未选择文件' : 'No file selected';
      }
    });
  }
  
  // 初始化语言切换按钮
  const languageToggle = document.getElementById('languageToggle');
  console.log('Language toggle button found:', !!languageToggle);
  
  if (languageToggle) {
    // 移除可能存在的旧事件监听器
    languageToggle.replaceWith(languageToggle.cloneNode(true));
    const newLanguageToggle = document.getElementById('languageToggle');
    
    console.log('Adding click event to language toggle');
    newLanguageToggle.addEventListener('click', function(e) {
      console.log('Language toggle clicked!');
      e.preventDefault();
      e.stopPropagation();
      
      const currentLang = localStorage.getItem('language') || 'zh-CN';
      const newLang = currentLang === 'zh-CN' ? 'en' : 'zh-CN';
      console.log('Switching language from', currentLang, 'to', newLang);
      setLanguage(newLang);
    });
  }
  
  // 初始化页面翻译
  updateTranslations();
  
  // 初始化语言切换按钮文本（在翻译更新后）
  if (languageToggle) {
    const currentLang = localStorage.getItem('language') || 'zh-CN';
    const finalLanguageToggle = document.getElementById('languageToggle');
    if (currentLang === 'zh-CN') {
      finalLanguageToggle.textContent = 'English';
    } else {
      finalLanguageToggle.textContent = '中文';
    }
  }
  
  // 初始化用户下拉菜单
  if (typeof initUserDropdown === 'function') {
    initUserDropdown();
  }
});