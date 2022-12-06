<?php

namespace Project\Controller;

use PDO;
use PDOException;

class Student
{

  public $id;
  public $name;
  public $conn;


  public function __construct()
  {
    session_start();

    try {
      $this->conn = new PDO("mysql:host=localhost;dbname=crud", 'root', '');
    } catch (PDOException $e) {
      echo 'Database connection failed';
      die();
    }
  }

  public function index()
  {
    $statement = $this->conn->query("SELECT * FROM students ORDER BY id DESC ");
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function store($data)
  {

    $uploaddir = './../../assets/uploads';
    $uploadfile = $uploaddir .($_FILES['picture']['name']);

    $actualImageName = $_FILES['picture']['tmp_name'];

    $formattedImageName = date("y-m-d").time().$actualImageName;


     move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);
     
  
    //  die($formattedImageName);


    //databse  insert 
    $statement = $this->conn->prepare("INSERT INTO students (name, student_id, picture) VALUES (:s_name ,:student_id, 
    :p_picture)");
    $statement->execute([
      's_name' => $data['name'],
      'student_id' => $data['id'],
      'p_picture' => $formattedImageName
    ]);
  }

  public function show($id)
  {
    $statement = $this->conn->query("SELECT * FROM students WHERE id=$id ");
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function update($data, $id)
  {

    $statement = $this->conn->prepare("UPDATE students set name=:s_name , student_id=:s_id 
     where id=:r_id");
    $statement->execute([

      'r_id' => $id,
      's_name' => $data['name'],
      's_id' => $data['id'],
    ]);
  }


  public function destroy($id)
  {
    $statement = $this->conn->prepare("DELETE FROM  students WHERE id=:s_id");
    $statement->execute([
      's_id' => $id,

    ]);

    $_SESSION['message'] = 'successfully deleted';
  }
}
