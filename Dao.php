<?php
class Dao {
    // mysql://bd40f999007b59:bcf273cf@us-cdbr-iron-east-01.cleardb.net/heroku_7794920f48bea27?reconnect=true
    // private $host = "us-cdbr-iron-east-01.cleardb.net";
    // private $db = "heroku_7794920f48bea27";
    // private $user = "bd40f999007b59";
    // private $pass = "bcf273cf";
  private $host = "localhost";
  private $db = "myworkoutspace";
  private $user = "root";
  private $pass = "";
  
  public function getConnection () {
       $conn= new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
    return $conn;
  }


public function getID($username){
    $conn = $this->getConnection();
    return $conn->query("SELECT user_id FROM user WHERE user_name = '$username'")->fetchObject()->user_id;  
}

public function getPrs ($id) {
    $conn = $this->getConnection();
    return $conn->query("select distinct pr_name, pr_value from prs where user_id = '$id' AND pr_value <> 0 order by pr_name", PDO::FETCH_ASSOC);
}

public function getPrExercises ($id) {
    $conn = $this->getConnection();
    return $conn->query("select distinct pr_name from prs where user_id = '$id' order by pr_name", PDO::FETCH_ASSOC);
}

public function getCategories ($id) {
    $conn = $this->getConnection();
    return $conn->query("select distinct exer_category from exercises where user_id = '$id' order by exer_category", PDO::FETCH_ASSOC);
}

public function getTitles ($id) {
    $conn = $this->getConnection();
    return $conn->query("select distinct exer_name from exercises where user_id = '$id' AND exer_name <> '' order by exer_name", PDO::FETCH_ASSOC);
}

public function getExerciseList ($id) {
    $conn = $this->getConnection();
    return $conn->query("select * from exercises where user_id = '$id' AND exer_name <> '' order by exer_category", PDO::FETCH_ASSOC);
}

public function getHistoryList ($id) {
    $conn = $this->getConnection();
    return $conn->query("select * from history where user_id = '$id' order by hist_date DESC", PDO::FETCH_ASSOC);
}

  public function checkUserValidation ($username, $password) {
    $conn = $this->getConnection();
    $query = "SELECT * FROM user WHERE user_name='$username' AND user_password='$password'";

    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function checkRegistrationEmail ($email) {
    $conn = $this->getConnection();
    $query = "SELECT * FROM user WHERE user_email='$email'";

    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function checkRegistrationUsername ($username) {
    $conn = $this->getConnection();
    $query = "SELECT * FROM user WHERE user_name='$username'";

    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function addUser($email, $username, $password){
    $conn = $this->getConnection();
    $saveQuery =
    "INSERT INTO user
    (user_email, user_name, user_password)
    VALUES
    (:email, :username, :password)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":email", $email);
    $q->bindParam(":username", $username);
    $q->bindParam(":password", $password);
    $q->execute();
  }

  public function checkExercise($exercise, $id){
    $conn = $this->getConnection();
    $query = "SELECT * FROM prs WHERE pr_name='$exercise' AND user_id='$id'";
    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function checkTitle($category, $title, $id){
    $conn = $this->getConnection();
    $query = "SELECT * FROM exercises WHERE exer_category='$category' AND exer_name='$title' AND user_id='$id'";
    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function checkCategory($category, $id){
    $conn = $this->getConnection();
    $query = "SELECT * FROM exercises WHERE exer_category='$category' AND user_id='$id'";
    $result = $conn->query($query);
    $count = $result->rowCount();
    if($count > 0){
        return true;
    }
    else{
        return false;
    }
  }

  public function addPr($exercise, $val, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "UPDATE prs
    SET pr_value = :val
    WHERE pr_name = :exercise AND user_id=$id";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(":val", $val);
    $q->bindParam(':exercise', $exercise);

    return $q->execute();
  }

  public function addWorkout($exercise, $set, $rep, $weight, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "INSERT INTO history
    (hist_exercise, hist_set, hist_rep, hist_weight, user_id, hist_date)
    VALUES 
    (:exercise, :set, :rep, :weight, $id, CURDATE())";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':exercise', $exercise);
    $q->bindParam(":set", $set);
    $q->bindParam(":rep", $rep);
    $q->bindParam(":weight", $weight);

    return $q->execute();
  }

  public function addPrExercise($exercise, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "INSERT INTO prs
    (pr_name, pr_value, user_id)
    VALUES
    (:exercise, 0, $id)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':exercise', $exercise);

    return $q->execute();
  }

  public function addExercise($category, $title, $desc, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "INSERT INTO exercises
    (exer_category, exer_name, exer_description, user_id)
    VALUES
    (:category, :title, :desc, $id)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':category', $category);
    $q->bindParam(":title", $title);
    $q->bindParam(":desc", $desc);

    return $q->execute();
  }

  public function editExercise($title, $desc, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "UPDATE exercises
    SET exer_description = :desc
    WHERE exer_name = :title AND user_id=$id";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':title', $title);
    $q->bindParam(":desc", $desc);

    return $q->execute();
  }

  public function deleteExercise($title, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "DELETE FROM exercises
    WHERE exer_name = :title AND user_id=$id";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':title', $title);

    return $q->execute();
  }

  public function deletePrExercise($title, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "DELETE FROM prs
    WHERE pr_name = :title AND user_id=$id";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':title', $title);

    return $q->execute();
  }

  public function addEmptyCategory($category, $id){
    $conn = $this->getConnection();
    $saveQuery =
    "INSERT INTO exercises
    (exer_category, exer_name, exer_description, user_id)
    VALUES
    (:category, '', '', $id)";
    $q = $conn->prepare($saveQuery);
    $q->bindParam(':category', $category);

    return $q->execute();
  }

}