<?php
/**
* 
*/
class User {
	protected $pdo;
	function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function checkInput($var){ #only to make valid email and pass
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;
	}

	public function login($email, $password){ 
		$stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `email` = :email AND `password` = :password");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $password, PDO::PARAM_STR); #md5 secure 
		$stmt->execute();

		#this is changes that i have made.
		$user = $stmt->fetch(PDO::FETCH_OBJ);


		if($count > 0) {
			$_SESSSION['user_id'] = $user->user_id;
			header('Location: home.php');
		}else {
			
			return false;
		}
	}

	public function userData($user_id){

		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
		
	}

}


 ?>