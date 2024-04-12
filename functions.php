<!-- Andy Estevez -->
<!-- BMCC Tech Innovation Hub Internship -->
<!-- Spring Semester 2024 -->
<!-- BMCC Resolve Project -->
<!-- PHP Functions Holder -->

<?php
    // Verify Student Account Login Status
    function check_student_login($conn) {
        if (isset($_SESSION["studentID"])) {
            $id = $_SESSION["studentID"];
            $query = "select * from students where studentID = '$id' limit 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }

        header("Location: login.php");
        die;
    }

    // Verify Faculty Account Login Status
    function check_faculty_login($conn) {
        if (isset($_SESSION["facultyID"])) {
            $id = $_SESSION["facultyID"];
            $query = "select * from faculty where facultyID = '$id' limit 1";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }

        header("Location: login.php");
        die;
    }

    // Generate Random Num (ID)
    function random_num($len) {
        $text = "";
        
        for ($i = 0; $i < $len; $i++) {
            $text .= rand(0, 9);
        }

        return $text;
    }
?>