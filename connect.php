<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ql_nhansu";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check connection
    if($conn->connect_error){
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Trang hiện tại
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Số bản ghi trên mỗi trang
    $records_per_page = 5;

    // Truy vấn để lấy tổng số nhân viên
    $total_records_query = "SELECT COUNT(*) AS total FROM nhanvien";
    $total_records_result = $conn->query($total_records_query);
    $total_records_row = $total_records_result->fetch_assoc();
    $total_records = $total_records_row['total'];

    // Tổng số trang
    $total_pages = ceil($total_records / $records_per_page);

    // Chỉ mục bắt đầu và kết thúc của bản ghi trên trang hiện tại
    $start_index = ($current_page - 1) * $records_per_page;

    $sql = "SELECT nv.*, p.Ten_Phong FROM nhanvien nv INNER JOIN phongban p ON nv.Ma_Phong = p.Ma_Phong LIMIT $start_index, $records_per_page";
    $result = $conn->query($sql);

    

    
?>
