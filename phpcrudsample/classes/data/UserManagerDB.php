<?php
namespace classes\data;

// include '/../util/DBUtil.php';
include 'password.php';
// include '../business/UserManager.php';
// include '../entity/User.php';
// include '../util/DBUtil.php';

use classes\entity\User;
use classes\util\DBUtil;



class UserManagerDB
{
    public static function fillUser($row){
        $user=new User();
        $user->id=$row["id"];
        $user->firstName=$row["firstname"];
        $user->lastName=$row["lastname"];
        $user->email=$row["email"];
        $user->password=$row["password"];
		$user->account_creation_time = $row["account_creation_time"];
        $user->role = $row["role"];
        $user->subscribe = $row["subscription"];
        return $user;
    }
    public static function getUserIdRoleByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    public static function getUserByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select * from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
	
	public static function getUserById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $id=mysqli_real_escape_string($conn,$id);
        $sql="select * from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
            }
        }
        $conn->close();
        return $user;
    }
    public static function saveUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="INSERT INTO tb_user (id, firstname, lastname, email, password, account_creation_time, role, subscription) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssi", $user->id,$user->firstName, $user->lastName, $user->email,$user->password, $user->account_creation_time, $user->role, $user->subscribe);
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
    public static function updatePassword($email,$password){
        $conn=DBUtil::getConnection();
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql="UPDATE tb_user SET password='$password' WHERE email='$email';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();
    }	
	
    public static function deleteAccount($id){
        $conn=DBUtil::getConnection();
        $sql="DELETE from tb_user WHERE id='$id';";
        $stmt = $conn->prepare($sql);
		if ($conn->query($sql) === TRUE) {
			echo "<script>alert(Record deleted successfully)</script>";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		$conn->close();

    }		
    public static function getAllUsers(){
        $users=[];
        $conn=DBUtil::getConnection();
        $sql="select * from tb_user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                array_push($users, $user);
            }
        }
        $conn->close();
        return $users;
    }
    
    public static function loginPasswordCheck($email,$password){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $result = $conn->query("select password from tb_user where email='$email'");
        $row = $result->fetch_row();
        $storedPassword = $row[0];
        if (password_verify($password, $storedPassword)){
            return true;
        } else {
            return false;
        }
        $conn->close();
    }
    
    public static function getNameByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select firstname, lastname from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                return $row['firstname']." ".$row['lastname'];
            }
        }
        $conn->close();
    }
    
    public static function getIdByEmail($email){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $email=mysqli_real_escape_string($conn,$email);
        $sql="select id from tb_user where Email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                return $row['id'];
            }
        }
        $conn->close();
    }
    
    public static function getEmailById($id){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $sql="select email from tb_user where id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){
                return $row['email'];
            }
        }
        $conn->close();
    }
    
    public static function searchUser($query){
        $user=NULL;
        $conn=DBUtil::getConnection();
        $query = htmlspecialchars($query);
        $query = mysqli_real_escape_string($conn, $query);
        $sql = "SELECT * FROM tb_user WHERE (`firstname` LIKE '%".$query."%') OR (`lastname` LIKE '%".$query."%') OR (`email` LIKE '%".$query."%')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $user=self::fillUser($row);
                $users[]=$user;
            }
            return $users;
        } else {
            return false;
        }
        $conn->close();
        
    }
    
    public static function updateUser(User $user){
        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET firstname = ?, lastname = ?, email = ?, password = ?, subscription = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $user->firstName, $user->lastName, $user->email,$user->password, $user->subscribe, $user->id);
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }

    public static function unsubscribe($id){
        $unsubParam = 0;

        $conn=DBUtil::getConnection();
        $sql="UPDATE tb_user SET subscription = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $unsubParam, $id);
        $stmt->execute();
        if($stmt->errno!=0){
            printf("Error: %s.\n",$stmt->error);
        }
        $stmt->close();
        $conn->close();
    }
}

?>