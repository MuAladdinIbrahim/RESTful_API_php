<?php

require 'DBInterface.php';
class DbLab implements DBInterface
{

	protected $con;

	function __construct()
	{
		$this->connectToDatabase();
	}

	function __destruct()
	{
		$this->con->close();
	}

	function connectToDatabase(): mysqli
	{
		$this->con = mysqli_connect("localhost", "root", "271094", "emp");
		return $this->con;
	}

	function disconnect(mysqli $link)
	{
		$this->con->close();
	}

	function selectUsers(): mysqli_result
	{
		$res = $this->con->query("SELECT * FROM employee;");
		return $res;
	}

	function selectUser($id): mysqli_result
	{
		$res = $this->con->query("SELECT * FROM employee WHERE id=$id;");
		return $res;
	}

	function insertUser($firstName, $email, $gender, $receiveEmails)
	{

		$res = $this->con->query(
			"INSERT INTO employee(name,email,gender,receive) VALUES
			('$firstName','$email','$gender','$receiveEmails');"
		);
	}
	function deleteUser($id)
	{
		$res = $this->con->query(
			"DELETE FROM employee WHERE id='$id';"
		);
		return $res;
	}
	function updateUser($id,$name,$email,$gender,$recieve)
	{
		$res = $this->con->query(
			// "UPDATE employee SET name='$name', email='$email', gender = $gender, receive='$recieve' WHERE id='$id';"
			"UPDATE employee SET name='$name', email='$email', gender ='$gender', receive=$recieve WHERE id=$id;"

		);
		return $res;
	}

	/*function deleteUser($name){
		$res = $this->con->query(
			"DELETE FROM employee WHERE name='$name';"
		);
        return $res;
	}*/
}
