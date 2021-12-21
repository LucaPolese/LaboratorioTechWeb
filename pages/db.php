<?php
    namespace DB;
    class DBAccess{
        //Nascondiamo i dati relativi al DB
        private const HOST_DB = "127.0.0.1";
        private const DATABASE_NAME = "lpolese";
        private const USERNAME = "lpolese";
        private const PASSWORD = "";

        private $connection;

    public function openDBConnection(){
        $this->connection = mysqli_connect(self::HOST_DB, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
        if(mysqli_errno($this->connection)){
            return false;
        }else{
            return true;
        }
    }

    public function closeDBConnection(){
        mysqli_close($this->connection);
    }

    public function getCharacterList(){
        $query = "SELECT * FROM personaggi ORDER BY ID ASC";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in getCharacterList" . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }else{
            $characterList = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($characterList, $row);
            }
            $queryResult->free();
            return $characterList;
        }
    }

    public insertNewCharacter($nome,$colore,$peso,$potenza,$ab,$abr,$absw,$abs){
        $query = "INSERT INTO personaggi (nome,colore,peso,potenzad,descrizione ,angry_birds,angry_birds_rio,angry_birds_stars,angry_birds_space) VALUES ('$nome','$colore','$peso','$potenza','$ab','$abr','$absw','$abs')";

        $queryResult = mysqli_query($this->connection, $query) or die("Errore di inserimento: " . mysqli_error($this->connection));
        if(mysqli_num_rows($queryResult) == 0){
            return null;
        }else{
            $characterList = array();
            while($row = mysqli_fetch_assoc($queryResult)){
                array_push($characterList, $row);
            }
            $queryResult->free();
            return $characterList;
        }
    }

    }
?>