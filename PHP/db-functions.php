<?php
    function setConnectionInfo($connString, $user, $password){
        $pdo = new PDO($connString, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    function runQuery($connection, $sql, $parameters=array()){
        if(!is_array($parameters)){
            $parameters = array($parameters);
        }

        $statement = null;
        if(count($parameters) >0 ){           
            $statement = $connection->prepare($sql);
            $executedOK = $statement->execute($parameters);
            if (! $executedOK){
                throw new PDOException;
            }
        } else{
            $statement = $connection->query($sql);
            if(! $statement){
                throw new Exception;
            }
        }

        return $statement;
    }


    function getUserSQL(){
        $sql = 'SELECT * FROM Users';
        return  $sql;
    }


    function getSingleUser($connection, $email){
        $sql = getUserSQL();
        $sql .= " WHERE email = ?";

        $statement = runQuery($connection, $sql, array($email));

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    function getAllMoviesSQL(){
        $sql = 'SELECT * FROM movie';
        return $sql;
    }


    function getMovies($connection){
        $sql = getAllMoviesSQL();
        $statement = runQuery($connection, $sql, null);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function getSingleMovie($connection, $id){
       $sql = 'SELECT * FROM movie WHERE id = ?';
       $statement = runQuery($connection, $sql, array($id));

       $row = $statement->fetch(PDO::FETCH_ASSOC);
       
       return $row;
    }


?>


