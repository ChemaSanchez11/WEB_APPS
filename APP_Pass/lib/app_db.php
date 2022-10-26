<?php

require_once __DIR__ . '/config.php';

class app_db
{


    private $db;

    public function __construct()
    {
        global $CFG;

        $this->db = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass, $CFG->dbname);

        return $this->db;

    }

    public function scape_string($param)
    {
        return mysqli_real_escape_string($this->db, $param);
    }

    public function get_records($query)
    {

        $DB = $this->db;

        $result = $DB->query($query);
        if (!empty(mysqli_error($DB))) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">';
            echo '<div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh">
                <div class="alert alert-danger" role="alert"> ' . mysqli_error($DB) . ' </div>
              </div>';
            die();
        } else if (!empty($result)) {
            $std = new stdClass();

            for ($i = 1; $row = $result->fetch_assoc(); $i++) {
                $newobj = new stdClass();
                foreach ($row as $key => $object) {
                    $newobj->$key = $row["$key"];
                }
                $std->$i = $newobj;
            }

            return $std;
        }
    }


    public function get_record($query)
    {
        $DB = $this->db;

        $result = $DB->query($query);
        if (!empty(mysqli_error($DB))) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">';
            echo '<div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh">
                <div class="alert alert-danger" role="alert"> ' . mysqli_error($DB) . ' </div>
              </div>';
            die();
        } else if (!empty($result)) {
            $std = new stdClass();

            if ($result->num_rows == 1 && $result->num_rows != 0) {

                $row = $result->fetch_assoc();
                foreach ($row as $key => $object) {
                    $std->$key = $row["$key"];
                }
            } else if($result->num_rows != 0) {
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">';
                echo '<div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh">
                <div class="alert alert-danger" role="alert"> Retorno mas de un resultado, debe utilizar get_records </div>
              </div>';
            }else if($result->num_rows == 0){
                $std = null;
            }


            return $std;
        }
    }

    /**
     * @param $query
     * @return stdClass|string|void
     */
    public function exist_record($query)
    {

        $DB = $this->db;

        $result = mysqli_query($DB, $query);
        $results = mysqli_fetch_assoc($result);

        if (empty($results)) {
            return '';
        } else {
            return $results['id'];
        }

    }

    /**
     * @param $query
     * @return stdClass|string|void
     */
    public function db_insert($query)
    {

        $DB = $this->db;

        $result = mysqli_query($DB, $query);
        if (!empty(mysqli_error($DB))) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">';
            echo '<div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh">
                <div class="alert alert-danger" role="alert"> ' . mysqli_error($DB) . ' </div>
              </div>';
            die();
        } else {
            return $DB->insert_id;
        }
    }

    /**
     * @param $query
     * @return stdClass|string|void
     */
    public function db_update($query)
    {

        $DB = $this->db;

        $result = mysqli_query($DB, $query);
        if (!empty(mysqli_error($DB))) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">';
            echo '<div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh">
                <div class="alert alert-danger" role="alert"> ' . mysqli_error($DB) . ' </div>
              </div>';
            die();
        } else {
            return $result;
        }
    }
}