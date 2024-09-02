<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        #mybox {
            width: 30%; /* Same width as form */
            border-radius: 4px; /* Same border-radius as form */
            margin: 120px auto; /* Same margin as form */
            padding: 50px; /* Same padding as form */
            box-shadow: 10px 10px 5px rgb(133, 179, 231); /* Same shadow as form */
			background-color: rgb(167, 227, 245);

        }
        @media (max-width: 570px) {
            body { /* Apply to body to adjust form at smaller screens */
                width: 65%;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <form>
        <div class="container home" id="mybox">
            <font face="comic sans ms">
                <h2><center>List of Files that can be Downloaded</center></h2>
            </font>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><u><font face="comic sans ms">NAME</font></u></th>
                        <th><u><font face="comic sans ms">BRANCH</font></u></th>
                        <th><u><font face="comic sans ms">CERTIFICATE</font></u></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Your PHP script for table content -->
                    <?php
                    $link = mysqli_connect("localhost", "root", "", "survey");

                    if (!$link) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $q = "SELECT COUNT(*) AS total FROM registration";
                    $ros = mysqli_query($link, $q);
                    $row = mysqli_fetch_assoc($ros);
                    $total = $row['total'];

                    $dis = 3;  // Records per page
                    $total_page = ceil($total / $dis);
                    $page_cur = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
                    $k = ($page_cur - 1) * $dis;

                    $q = "SELECT * FROM registration ORDER BY year ASC LIMIT ?, ?";
                    $stmt = $link->prepare($q);
                    $stmt->bind_param("ii", $k, $dis);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td align='center'>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td align='center'>" . htmlspecialchars($row['branch']) . "</td>";
                        echo "<td align='center'><a href='download.php?id=" . htmlspecialchars($row['certificate'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['certificate']) . "</a></td>";
                        echo "</tr>";
                    }

                    $stmt->close();
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php
            if ($page_cur > 1) {
                echo "<a href='display.php?page=" . ($page_cur - 1) . "'><input style='cursor:pointer; background-color: orange; border: 1px black solid; border-radius: 5px; width: 120px; height: 30px; color: white; font-size: 15px; font-weight: bold;' type='button' value=' Previous '></a>";
            } else {
                echo "<input style='background-color: gray; border: 1px black solid; border-radius: 5px; width: 120px; height: 30px; color: black; font-size: 15px; font-weight: bold;' type='button' value=' Previous '>";
            }

            for ($i = 1; $i <= $total_page; $i++) {
                if ($page_cur == $i) {
                    echo "<span style='background-color: gray; border: 2px black solid; border-radius: 5px; width: 30px; height: 30px; color: black; font-size: 15px; font-weight: bold;'>$i</span> ";
                } else {
                    echo "<a href='display.php?page=$i'><input style='cursor:pointer; background-color: orange; border: 1px black solid; border-radius: 5px; width: 30px; height: 30px; color: white; font-size: 15px; font-weight: bold;' type='button' value='$i'></a> ";
                }
            }

            if ($page_cur < $total_page) {
                echo "<a href='display.php?page=" . ($page_cur + 1) . "'><input style='cursor:pointer; background-color: orange; border: 1px black solid; border-radius: 5px; width: 90px; height: 30px; color: white; font-size: 15px; font-weight: bold;' type='button' value=' Next '></a>";
            } else {
                echo "<input style='background-color: gray; border: 1px black solid; border-radius: 5px; width: 90px; height: 30px; color: black; font-size: 15px; font-weight: bold;' type='button' value=' Next '>";
            }
            $link->close();
            ?>
        </div>
    </form>
</body>
</html>
