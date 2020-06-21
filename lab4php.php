<?php

require 'dbclass.php';
$db = new DbLab();
$connection = $db->connectToDatabase();
$result= $db->selectUsers();

?>

<table border="1">
  <tr>
    <th>name</th>
    <th>email</th>
    <th>gender</th>
    <th>receive</th>
  </tr>


<?php

while($row = $result->fetch_assoc()){

?>
<form action="deleteRecord.php" method="get">
	<tr>
  		<td><?php echo $row['name'] ?></td>
  		<td><?php echo $row['email'] ?></td>
  		<td><?php echo $row['gender'] ?></td>
  		<td><?php echo $row['receive'] ?></td>
      <td><input type="submit" value="delete" name="delete"></td>
      <input type="" name= "id" value="<?php echo $row["id"] ?>">

	</tr>
  </form>

<?php
}
?>
 </tr>
</table>

 
