<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @Language Tiếng Việt
 * @License CC BY-SA (http://creativecommons.org/licenses/by-sa/4.0/)
 * @Createdate Mar 04, 2010, 03:22:00 PM
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    die('Stop!!!');
}

$lang_translator['author'] = 'VINADES.,JSC <contact@vinades.vn>';
$lang_translator['createdate'] = '04/03/2010, 15:22';
$lang_translator['copyright'] = '@Copyright (C) 2012 VINADES.,JSC. All rights reserved';
$lang_translator['info'] = '';
$lang_translator['langtype'] = 'lang_global';

$lang_global['mod_authors'] = 'Quản trị';
$lang_global['mod_groups'] = 'Nhóm thành viên';
$lang_global['mod_database'] = 'CSDL';
$lang_global['mod_settings'] = 'Cấu hình';
$lang_global['mod_cronjobs'] = 'Tiến trình tự động';
$lang_global['mod_modules'] = 'Quản lý Modules';
$lang_global['mod_themes'] = 'Quản lý giao diện';
$lang_global['mod_siteinfo'] = 'Thông tin';
$lang_global['mod_language'] = 'Ngôn ngữ';
$lang_global['mod_upload'] = 'Quản lý File';
$lang_global['mod_webtools'] = 'Công cụ web';
$lang_global['mod_seotools'] = 'Công cụ SEO';
$lang_global['mod_subsite'] = 'Quản lý site con';
$lang_global['mod_extensions'] = 'Mở rộng';
$lang_global['mod_emailtemplates'] = 'Mẫu email';
$lang_global['go_clientsector'] = 'Trang chủ site';
$lang_global['go_clientmod'] = 'Xem ngoài site';
$lang_global['go_instrucion'] = 'Tài liệu hướng dẫn';
$lang_global['please_select'] = 'Hãy lựa chọn';
$lang_global['admin_password_empty'] = 'Mật khẩu quản trị của bạn chưa được khai báo';
$lang_global['adminpassincorrect'] = 'Mật khẩu quản trị &ldquo;<strong>%s</strong>&rdquo; không chính xác. Hãy thử lại lần nữa';
$lang_global['admin_password'] = 'Mật khẩu của bạn';
$lang_global['admin_no_allow_func'] = 'Bạn không có quyền truy cập chức năng này';
$lang_global['admin_suspend'] = 'Tài khoản Bị đình chỉ';

$lang_global['block_modules'] = 'Block của modules';
$lang_global['hello_admin1'] = 'Lần đăng nhập Quản trị trước vào %1$s';
$lang_global['hello_admin2'] = 'Bạn đã đăng nhập Quản trị cách đây %1$s';
$lang_global['hello_admin3'] = 'Đây là lần đăng nhập Quản trị đầu tiên của bạn';
$lang_global['ftp_error_account'] = 'Lỗi: hệ thống không kết nối được FTP server vui lòng kiểm tra lại các thông số FTP';
$lang_global['ftp_error_path'] = 'Lỗi: thông số Remote path không đúng';
$lang_global['login_error_account'] = 'Lỗi: Tên đăng nhập tài khoản Admin chưa được khai báo hoặc khai báo không hợp lệ! (Không ít hơn %1$s ký tự, không nhiều hơn %2$s ký tự. Chỉ chứa các ký tự có trong bảng chữ cái latin, số và dấu gạch dưới)';
$lang_global['login_error_password'] = 'Lỗi: Password của Admin chưa được khai báo hoặc khai báo không hợp lệ! (Không ít hơn %1$s ký tự, không nhiều hơn %2$s ký tự. Chỉ chứa các ký tự có trong bảng chữ cái latin, số và dấu gạch dưới)';
$lang_global['login_error_security'] = 'Lỗi: Mã kiểm tra chưa được khai báo hoặc khai báo không hợp lệ! (Phải có %1$s ký tự. Chỉ chứa các ký tự có trong bảng chữ cái latin và số)';
$lang_global['error_zlib_support'] = 'Lỗi: Máy chủ của bạn không hỗ trợ thư viện zlib, bạn cần liên hệ với nhà cung cấp dịch vụ hosting bật thư viện zlib để có thể sử dụng tính năng này.';
$lang_global['error_zip_extension'] = 'Lỗi: Máy chủ của bạn không hỗ trợ extension ZIP, bạn cần liên hệ với nhà cung cấp dịch vụ hosting bật extension ZIP để có thể sử dụng tính năng này.';

$lang_global['length_characters'] = 'Số ký tự';
$lang_global['length_suggest_max'] = 'Nên nhập tối đa %s ký tự';

$lang_global['error_code_1'] = 'Địa chỉ truy vấn không hợp lệ, vui lòng kiểm tra lại';
$lang_global['error_code_2'] = 'Giao thức HTTP bị cấm đối với truy vấn này.';
$lang_global['error_code_3'] = 'Thư mục chứa tệp tin sẽ được lưu không thể ghi được.';
$lang_global['error_code_4'] = 'Không có tiện ích nào hỗ trợ giao thức HTTP.';
$lang_global['error_code_5'] = 'Có quá nhiều chuyển hướng xảy ra.';
$lang_global['error_code_6'] = 'Chứng chỉ SSL không thể kiểm tra được.';
$lang_global['error_code_7'] = 'Truy vấn HTTP thất bại.';
$lang_global['error_code_8'] = 'Không thể lưu dữ liệu vào tệp tin tạm thời.';
$lang_global['error_code_9'] = 'Hàm xử lý fopen() thất bại đối với tệp tin.';
$lang_global['error_code_10'] = 'Truy vấn HTTP bằng Curl thất bại.';
$lang_global['error_code_11'] = 'Có một lỗi không xác định đã xảy ra.';
$lang_global['error_valid_response'] = 'Dữ liệu trả về không hợp chuẩn.';
$lang_global['phone_note_title'] = 'Quy định khai báo số điện thoại';
$lang_global['phone_note_content'] = '<ul><li>Số điện thoại được chia ra hai phần, phần đầu là bắt buộc và dành cho việc hiển thị trên site, phần hai không bắt buộc và dành cho việc quay số khi click chuột vào nó.</li><li>Phần đầu được viết tự do nhưng không có dấu ngoặc vuông. Phần hai để trong dấu ngoặc vuông ngay sau phần đầu và chỉ được chứa các ký tự sau: chữ số, dấu sao, dấu thăng, dấu phẩy, dấu chấm, dấu chấm phẩy và dấu cộng ([0-9\*\#\.\,\;\+]).</li><li>Ví dụ, nếu bạn khai báo <strong>0438211725 (ext 601)</strong>, thì số <strong>0438211725 (ext 601)</strong> sẽ được hiển thị đơn thuần trên site. Còn nếu bạn khai báo <strong>0438211725 (ext 601)[+84438211725,601]</strong>, hệ thống sẽ cho hiển thị <strong>0438211725 (ext 601)</strong> trên site và url khi click chuột vào số điện thoại trên sẽ là <strong>tel:+84438211725,601</strong></li><li>Bạn có thể khai báo nhiều số điện thoại theo quy tắc trên. Chúng được phân cách bởi dấu |.</li></ul>';
$lang_global['multi_note'] = 'Có thể khai báo hơn 1 giá trị, được phân cách bởi dấu phẩy.';
$lang_global['multi_email_note'] = 'Có thể khai báo hơn 1 giá trị, được phân cách bởi dấu phẩy. Email đầu tiên được coi là email chính, được sử dụng để gửi, nhận thư.';

$lang_global['view_all'] = 'Xem tất cả';
$lang_global['email'] = 'Email';
$lang_global['phonenumber'] = 'Điện thoại';
$lang_global['interface_current_menu'] = 'Đang thao tác';
$lang_global['interface_other_menu'] = 'Các module khác';
$lang_global['login_remember_admin'] = 'Tùy chọn này sẽ cho phép tài khoản quản trị có thể đăng nhập nhiều nơi';

$lang_global['notification'] = 'Thông báo';
$lang_global['do_with_selected'] = 'Với các dòng chọn';

$lang_global['merge_field_author_delete_time'] = 'Thời gian xóa';
$lang_global['merge_field_author_delete_reason'] = 'Lý do xóa';
$lang_global['merge_field_contact_link'] = 'Liên kết gửi liên hệ';
$lang_global['merge_field_is_suspend'] = 'Đình chỉ (1) hay kích hoạt lại (0)';
$lang_global['merge_field_time'] = 'Thời gian thực hiện';
$lang_global['merge_field_reason'] = 'Lý do thực hiện';
$lang_global['merge_field_sys_siteurl'] = 'Đường dẫn site trên url';
$lang_global['merge_field_sys_nv'] = 'Biến module';
$lang_global['merge_field_sys_op'] = 'Biến function các module';
$lang_global['merge_field_sys_langvar'] = 'Biến ngôn ngữ';
$lang_global['merge_field_sys_langdata'] = 'Khóa ngôn ngữ data';
$lang_global['merge_field_sys_langinterface'] = 'Khóa ngôn ngữ giao diện';
$lang_global['merge_field_sys_assetsdir'] = 'Thư mục thumb của hệ thống';
$lang_global['merge_field_sys_filesdir'] = 'Thư mục thumb của các module';
