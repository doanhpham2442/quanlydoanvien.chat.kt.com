<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');

define('BACKEND_DIRECTORY', 'admin');

define('AUTH', 'QLDVKT_');
define('ASSET_BACKEND', 'public/backend/');

define('BASE_URL', 'http://quanlydoanvien.chat.kt.com/');
define('HTSUFFIX', '.html');
define('NAME_TITLE', 'Quản lý Đoàn Viên Kiến Trúc');

define('ADDRESS', 0);

define('DEBUG', 0);
define('COMPRESS', 0);
define('CMS_NAME', 'Quản lý Đoàn Viên Kiến Trúc');
define('API_WIDGET', 'http://widget.htweb.vn');

define('HTSEARCH', 'tim-kiem');
define('HTCONTACT', 'contact-us');
define('HTMAP', 'contact-map');

define('HTDBHOST', 'localhost');
define('HTDBUSER', 'root');
define('HTDBPASS', 'root');
define('HTDBNAME', 'demo_qldv');



const PASSWORD = 'dvkt@123';

const YES_OR_NO = [
   '0' => 'Không',
   '1' => 'Có',
];

const GENDER = [
   '0' => 'Giới Tính',
   '1' => 'Nữ',
   '2' => 'Nam',
];
const PROFESSION = [
   '0' => '------ Chọn ------',
   '1' => 'Sinh Viên',
   '2' => 'Giảng Viên',
];
const LEVEL_EDUCATION = [
   '0' => '------ Chọn ------',
   '1' => 'Tiểu học',
   '2' => 'Trung học cơ sở',
   '3' => 'Trung học phổ thông hệ 10/10',
   '4' => 'Trung học phổ thông hệ 12/12',
];
const LEVEL_SPECIALIZE = [
   '0' => '------ Chọn ------',
   '1' => 'Chưa có',
   '2' => 'Sơ cấp',
   '3' => 'Trung cấp',
   '4' => 'Cao đẳng',
   '5' => 'Cử nhân',
   '6' => 'Thạc sĩ',
   '7' => 'Tiến sĩ',
];
const LEVEL_POLITICS = [
   '0' => '------ Chọn ------',
   '1' => 'Chưa có',
   '2' => 'Sơ cấp',
   '3' => 'Trung cấp',
   '4' => 'Cao cấp',
   '5' => 'Cử nhân',
];
const LEVEL_COMPUTER = [
   '0' => '------ Chọn ------',
   '1' => 'Chưa có',
   '2' => 'Chuẩn kỹ năng sử dụng CNTT cơ bản',
   '3' => 'Chuẩn kỹ năng sử dụng CNTT nâng cao',
];
const LEVEL_LANGUAGE = [
   '0' => '------ Chọn ------',
   '1' => 'Chưa có',
   '2' => 'Bậc 1',
   '3' => 'Bậc 2',
   '4' => 'Bậc 3',
   '5' => 'Bậc 4',
   '6' => 'Bậc 5',
   '7' => 'Bậc 6',
];
const UNION_POSITION = [
   '0' => '------ Chọn chức vụ ------',
   '1' => 'Bí thư Đoàn trường',
   '2' => 'Phó bí thư Đoàn trường',
   '3' => 'Ủy viên BTV Đoàn trường',
   '4' => 'Ủy viên BCH Đoàn trường',
   '5' => 'Bí thư Liên chi Đoàn',
   '6' => 'Phó bí thư Liên chi Đoàn',
   '7' => 'Ủy viên BCH Liên chi Đoàn',
   '8' => 'Bí thư Chi Đoàn',
   '9' => 'Phó bí thư Chi Đoàn',
   '10' => 'Đoàn viên',
];
const EVENT_USER = [
   '0' => '------ Chọn trạng thái duyệt ------',
   '1' => 'Chờ duyệt',
   '2' => 'Đã duyệt',
   '3' => 'Bị loại',
];
const PERPAGE = [
   '20' => '20 bản ghi',
   '40' => '40 bản ghi',
   '60' => '60 bản ghi',
   '80' => '80 bản ghi',
   '100' => '100 bản ghi',
   '120' => '120 bản ghi',
   '140' => '140 bản ghi',
   '160' => '160 bản ghi',
   '180' => '180 bản ghi',
   '200' => '200 bản ghi',
];
