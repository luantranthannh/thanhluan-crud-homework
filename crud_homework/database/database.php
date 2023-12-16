<?php
/**
 * Connect to database
 */
function db()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "web_a";
    try {
        $conn =  new PDO("mysql:host=$host;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}


/**
 * Create new student record
 */
//function createStudent($value)
function createStudent($name,$age,$email,$profile)
{   
    try{
        $conn = db();
        $stmt = $conn ->prepare("INSERT INTO `student` (name, age, email, profile) 
                            VALUES (:name, :age, :email, :profile) " );
        $stmt ->bindParam(':name', $name);
        $stmt ->bindParam(':age', $age);
        $stmt ->bindParam(':email', $email);
        $stmt ->bindParam(':profile', $profile);
        $stmt ->execute();
    }
    catch (PDOException $e) {
        echo "Error Create Student : " . $e->getMessage();
    }

    
}


/**
 * Get all data from table student
 */
function selectAllStudents()
{
    try{
        $conn = db();
        $stmt = $conn->prepare("SELECT * FROM `student`");
        $stmt ->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         return $result;

    }
    catch (PDOException $e) {
        echo "Error select all students: " . $e->getMessage();
    }
    
}

/**
 * Get only one on record by id 
 */
function selectOnestudent($id)
{

    try{
        $conn = db();
        $stmt = $conn->prepare("SELECT * FROM student WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt ->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
 
    }
    catch (PDOException $e) {
        echo "Error select 1 students: " . $e->getMessage();
    }
}

/**
 * Delete student by id
 */
function deleteStudent($id)
{
    try{
        $conn = db();
        $stmt = $conn->prepare("DELETE FROM `student` WHERE id = :id ");
        $stmt->bindParam(':id', $id);
        $stmt ->execute();
      
    }
    catch (PDOException $e) {
        echo "Error delete 1 students: " . $e->getMessage();
    }
}


/**
 * Update students
 * 
 */
function updateStudent($id, $name, $age,$email, $profile)
{
    try {
        $conn = db();
        $stmt = $conn->prepare("UPDATE `student` SET `name` = :name, `age` = :age, 
                                `email` = :email, `profile` = :profile WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profile', $profile);
        $stmt->execute();
        echo "Update student successful";
    } catch (PDOException $e) {
        echo "Error update: " . $e->getMessage();
    }
}


