<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <?php
    //   session_start();


    //index method for data show in table 

    include_once './../../vendor/autoload.php';

    use Project\Controller\student;

    $studentObject = new Student();

    $students = $studentObject->index();
    ?>

    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }

    ?>
  
       <button style="margin-left: 80%; margin-bottom:8px;" > <a href="./create.php">Create</a> </button>


    <table id="customers">
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
                    <td>
                       <button style="background-color: #787491; font-size: 20px;"> <a href="show.php?id=<?= $student['id'] ?>">Show</a> </button>
                       <button style="background-color: #1c802d; font-size: 20px;"> <a href="edit.php?id=<?= $student['id'] ?>">Edit</a> </button>
                       <button style="background-color: #9c120b; font-size: 20px;"><a href="delete.php?id=<?= $student['id'] ?>">Delete</a> </button>
                    </td>
                </tr>

            <?php } ?>
    </table>

</body>

</html>
