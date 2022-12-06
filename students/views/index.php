<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
</head>

<body>


    <?php
    //   session_start();


    //index method for data show in table 

    include_once './../../vendor/autoload.php';

    use Project\Controller\Student;

    $studentObject = new Student();

    $students = $studentObject->index();
    ?>

    <a href="./create.php">Create</a>


    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

    ?>


    <table border="1" style="color:blue;text-align:center; width: 500px; margin:10px;">
        <tr>
            <th>SL</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>


        <tbody>
            <?php
            $sl = 0;
            foreach ($students as $student) {  ?>

                <tr>
                    <td> <?= ++$sl ?></td>
                    <td> <?php echo $student['student_id'] ?></td>
                    <td> <?php echo $student['name'] ?></td>
                    <td><a href="show.php?id=<?= $student['id'] ?>">Show</a>
                        <a href="edit.php?id=<?= $student['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $student['id'] ?>">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

</body>

</html>