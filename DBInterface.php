<?php

/**
 *
 * @author Muhammad
 */
interface DBInterface {

    function connectToDatabase(): mysqli;

    function disconnect(mysqli $link);

    function selectUsers(): mysqli_result;

    function insertUser($firstName, $email, $gender, $receiveEmails);

    function deleteUser($id);
}
