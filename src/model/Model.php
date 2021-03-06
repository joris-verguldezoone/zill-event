<?php

namespace App\model;

class Model
{
    protected $pdo;
    public function __construct() // PDO
    {
		//joris-verguldezoone_zill-event
        // $pdo = new \PDO('mysql:host=localhost;dbname=joris-verguldezoone_zill-event;charset=utf8', 'joris', 'huong-may');
        $pdo = new \PDO('mysql:host=localhost;dbname=zill-event;charset=utf8', 'root', '');

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->pdo = $pdo;

        return $pdo;
    }
    // SELECT
    public function alreadyExist($table, $column, $value)
    {
        $query = $this->pdo->prepare('SELECT ' . $column . ' FROM ' . $table . ' WHERE ' . $column . ' = ?');
        $query->execute([$value]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }
    public function alreadyTakenCheck($nomTable, $colonne, $value) // Est ce que l'utilisateur existe ? 
    {                              // si oui alors on need un new pseudo
        $sql = "SELECT $colonne FROM $nomTable WHERE $colonne = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([$value]);
        $fetch = $result->fetch(\PDO::FETCH_ASSOC);
        return $fetch;
    }

    public function selectPostById($table, $id)
    {
        $query = $this->pdo->prepare('SELECT *, DATE_FORMAT(date, "%d %m %Y") as date FROM ' . $table . ' WHERE id = ' . $id);
        $query->execute();
        return $query->fetch();
    }
    public function selectRandLimit3($table)
    {
        $sql = "SELECT * FROM $table ORDER BY RAND() LIMIT 3";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $fetch = $result->fetchAll();
        return $fetch;
    }


    public function selectAllByOrder($table, $value, $order)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' ORDER BY ' . $value . " " . $order);
        $query->execute();
        return $query->fetchAll();
    }

    public function selectAll($table, $column, $value)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $column . ' = ?');
        $query->execute([$value]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    public function countOneValue($id, $value, $col)
    {
        $sql = "SELECT $value WHERE $col = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute($id);

        $tab = array();
        $i = 0;

        while ($fetch = $result->fetch(\PDO::FETCH_ASSOC)) {
            $tab[$i][] = $fetch;
            $i++;
        }
    }
    public function checkOneValue($table, $column, $login)
    {
        $query = $this->pdo->prepare('SELECT ' . $column . ' FROM ' . $table . ' WHERE user_name = :login');
        $query->bindValue(':login', $login);
        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            echo 'Ce compte n\'existe pas.';
            return false;
        }
    }
    public function selectAllWhere($nomTable, $colonne, $value)
    { // select * where value = value
        $sql = "SELECT * FROM $nomTable WHERE $colonne= ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([$value]);
        $fetch = $result->fetch(\PDO::FETCH_ASSOC);

        return $fetch;
    }
    public function passwordVerifySql($login)
    {
        $sql = "SELECT password FROM admin WHERE user_name = '$login'"; // on repere le mdp crypt?? a comparer avec celui entr?? par l'utilisateur
        $result = $this->pdo->prepare($sql);
        $result->bindvalue(':login', $login, \PDO::PARAM_STR);
        $result->execute();
        $fetch = $result->fetch(\PDO::FETCH_ASSOC);

        return $fetch;
    }
    public function updateOneValue($table, $column1, $column2, $value1, $value2)
    {
        $query = $this->pdo->prepare('UPDATE ' . $table . ' SET ' . $column1 . ' = :value1 WHERE ' . $column2 . ' = :value2');
        $query->bindValue(':value1', $value1);
        $query->bindValue(':value2', $value2);

        $query->execute();
    }
    public function updateTwoValue($table, $column1, $column2, $column3, $value1, $value2, $value3)
    {
        $query = $this->pdo->prepare('UPDATE ' . $table . ' SET ' . $column1 . ' = :value1 , ' . $column2 . ' = :value2 WHERE ' . $column3 . ' = :value3');
        $query->bindValue(':value1', $value1);
        $query->bindValue(':value2', $value2);
        $query->bindValue(':value3', $value3);

        $query->execute();
    }
    // UNRELEATED

    // INSERT
    // SELECT
    // UPDATE 
    // DELETE 
    public function deleteWhere($table, $col, $value)
    {
        $sql = "DELETE FROM $table WHERE $col = :value";
        $result = $this->pdo->prepare($sql);
        $result->bindValue(":value", $value, \PDO::PARAM_INT);
        $result->execute();
    }
}
//$model = new Model();
//var_dump($model);