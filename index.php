<!DOCTYPE html>
<html>

<head>
    <title>My website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: blue;
            margin-top: 30px;
        }
        
        .create {
            text-align: right;
            margin-right: 20px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td img {
            height: 30px;
            width: 30px;
            vertical-align: middle;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style-type: none ;
            margin-top: 20px;
            text-decoration: none;
        }

        .pagination li a{
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1 style='text-align: center; color: blue;'>THÔNG TIN NHÂN VIÊN</h1>
    <?php
        require "connect.php";
        session_start();

        if($_SESSION["role"] == "ADMIN"){
            echo "
            <div class='create'>
                <button><a href='add.php'>THÊM NHÂN VIÊN</a></button>
            </div>";
        }

        if($result->num_rows > 0){
            echo "<table style='display: flex;justify-content: center;'>
                <tr style='color: red;'>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Nơi sinh</th>
                    <th>Tên phòng</th>
                    <th>Lương</th>
                    <th>Action</th>
                    <th>Action</th>";

                    if($_SESSION["role"] == "ADMIN"){
                        echo "<th></th>";
                    }
                    echo"</tr>";
            

            while ($row = $result->fetch_assoc()) {
                echo "<tr'>
                        <td>".$row["Ma_NV"]."</td>
                        <td>".$row["Ten_NV"]."</td>
                        <td>";

                if ($row["Phai"] == "NAM") {
                    echo "<img src='images\man.jpg' alt='Man' style='height: 30px;width: 30px;'>";
                } elseif ($row["Phai"] == "NU") {
                    echo "<img src='images\women.jpg' alt='Women' style='height: 30px;width: 30px;'>";
                }
                echo "  
                        </td>
                        <td>".$row["Noi_Sinh"]."</td>
                        <td>".$row["Ten_Phong"]."</td>
                        <td>".$row["Luong"]."</td>";
                if($_SESSION["role"] == "ADMIN"){
                    echo "
                        <td><a href='edit.php?id=".$row['Ma_NV']."'><img src='images/edit.jpg' style='width: 30px; height: 30px'/></a></td>
                        <td><a href='delete.php?id=".$row['Ma_NV']."'><img src='images/delete.jpg' style='width: 30px; height: 30px'/></a></td>";
                }
                echo "</tr>";
            }

            echo "</table>";
            
            // Hiển thị phân trang
            echo "<div style='text-align: center;'>";
            if ($total_pages > 1) {
                echo "<ul class='pagination'>";
                if ($current_page > 1) {
                    echo "<li><a href='?page=".($current_page - 1)."'>Trước</a></li>";
                }
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<li".($page == $current_page ? " class='active'" : "")."><a href='?page=".$page."'>".$page."</a></li>";
                }
                if ($current_page < $total_pages) {
                    echo "<li><a href='?page=".($current_page + 1)."'>Sau</a></li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }else{
            echo "<p style='text-align: center;'>Không có nhân viên.</p>";
        }
        
    ?>
</body>
</html>