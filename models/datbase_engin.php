<?php

/**
 * Database engine class to manage database actions
 * created date: 2012-18-02
 * @author: HADI HOSEINI
 * @version: 1.0
 */
// $_SESSION['debug'] = 0(disable as default) / 1(enable)









require_once dirname(__FILE__) . '/_cnn/conn_setting.inc.php';

Class DatabaseEngine {

        private $connection;
        private $selfConnection;
        protected $data = array();
        static private $conDBSessionName = 'dbConnection';

        public static function getNewConnection() {
                if (isset($_SESSION[self::$conDBSessionName]) && $_SESSION[self::$conDBSessionName] != 0) {
	    return $_SESSION[self::$conDBSessionName];
                }
                $dbhandle = mysql_connect(dbc_hostname, dbc_username, dbc_password)
	    or die("Unable to connect to MySQL. " . mysql_error());

                mysql_query("SET NAMES utf8", $dbhandle);
                mysql_query("SET SESSION time_zone = '+8:00'", $dbhandle);

                $selected = mysql_select_db(dbc_dbname, $dbhandle)
	    or die("Unable to connect General Database." . mysql_error($dbhandle));
                $_SESSION[self::$conDBSessionName] = $dbhandle;
                return $_SESSION[self::$conDBSessionName];
        }

        /**
         * Close Mysql link
         * @param mysqlConnection $connection 
         */
        public static function closeConnection($connection) {
//        mysql_close($connection);
        }

        /**
         * Close Mysql link
         * @param mysqlConnection $connection 
         */
        public static function closeConnectionSession() {
                mysql_close($_SESSION[self::$conDBSessionName]);
                unset($_SESSION[self::$conDBSessionName]);
        }

        /**
         * TO SELECT MORE THAN 1 ROW
         * @param type $sql QUERY(STRING)
         * @param type $connection OPTIONAL
         * @return Array[][]
         */
        public static function select_all($sql, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }

                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query($sql, $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                else
	    $res = mysql_query($sql, $connection) or die('oops! This function is temprary inactive.');

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else {
	    $result = array();
	    while ($row = mysql_fetch_assoc($res))
	            $result[] = $row;
	    return $result;
                }
        }
/**
 * TO RUN CUSTOMISE QUERIES
 * @param type $sql QUERY(STRING)
 * @param type $connection OPTIONAL
 * @return Array
 */
        public static function execute($sql, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }
                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query($sql, $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                else
	    $res = mysql_query($sql, $connection) or die('oops! This function is temprary inactive.');
                if ($selfConn) {
	    self::closeConnection($connection);
                }
                return ($res) ? true : false;
        }
/**
 * SELECT ONLY 1 ROW
 * @param type $sql QUERY(STRING)
 * @param type $connection OPTIONAL
 * @return type ARRAY[]
 */
        public static function select_row($sql, $connection = null) {

                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }

                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query($sql . ' LIMIT 1', $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                else
	    $res = mysql_query($sql . ' LIMIT 1', $connection) or die('oops! This function is temprary inactive.');



                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else {
	    $result = array();
	    while ($row = mysql_fetch_assoc($res))
	            $result = $row;
	    return $result;
                }
        }

        /**
         * SELECT ONLY 1 VARIABLE FROM 1 ROW
         * @param type $sql QUERY(STRING)
         * @param type $column_name STRING
         * @param type $connection OPTIONAL
         * @return VARIABLE
         */
        public static function select_var($sql, $column_name, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }
                if (@$_SESSION['debug'] == 1) {
	    $res = mysql_query($sql . ' LIMIT 1', $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                } else {
	    $res = mysql_query($sql . ' LIMIT 1', $connection) or die('oops! This function is temprary inactive.');
                }

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res) {
	    return false;
                } else {
	    $row = mysql_fetch_assoc($res);
	    return $row[$column_name];
                }
        }
/**
 * COUNTING ROWS
 * @param type $sql QUERY(STRING)
 * @param type $connection OPTIONAL
 * @return VARAIABLE
 */
        public static function just_count($sql, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }
                $sql = str_replace('SELECT', 'SELECT COUNT(', $sql);
                $sql = str_replace('FROM', ') AS cnt FROM ', $sql);

                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query($sql, $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                else
	    $res = mysql_query($sql, $connection) or die('oops! This function is temprary inactive.');

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                $row = mysql_fetch_assoc($res);
                return $row['cnt'];
        }
/**
 * INSERT RECORDS TO DATABASE
 * @param type $key_val ARRAY[]
 * @param type $table STRING
 * @param type $connection OPTIONAL
 * @return INSERT_ID OR FALSE
 */
        public static function insert($key_val, $table, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }

                $sql = 'INSERT INTO `' . $table . '` SET ';
                foreach ($key_val as $key => $val) {
	    if ($val === 'CURRENT_TIMESTAMP') {
	            $sql.='`' . $key . '`' . " = NOW(),";
	    } elseif ($val === 'UNIX_TIMESTAMP') {
	            $sql.='`' . $key . '`' . " = UNIX_TIMESTAMP(),";
	    } else {
	            $sql.='`' . $key . '`' . "='" . self::dbSafeValue($val) . "',";
	    }
                }
                $sql = substr($sql, 0, -1);

                $res = mysql_query($sql, $connection);
                if ($res !== false) {
	    $insert_id = mysql_insert_id();
                } else {
	    if (@$_SESSION['debug'] == 1) {
	            echo 'error on query: <br><b> ' . $sql . '</b><br>' . mysql_error();
	    }
                }

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else
	    return $insert_id;
        }
/**
 * IF CAN INSERT , WILL INSERT, OTHERWISE UPDATE ON KEY VALUES
 * @param type $key_val ARRAY[]
 * @param type $table STRING
 * @param type $connection OPTIONAL
 * @return INSERTED_ID OR UPDATE_ID OR FALSE 
 */
        public static function insert_update($key_val, $table, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }

                $sql = 'INSERT INTO `' . $table . '` SET ';
                $values = '';
                foreach ($key_val as $key => $val) {
	    if ($val === 'CURRENT_TIMESTAMP') {
	            $values.='`' . $key . '`' . " = NOW(),";
	    } elseif ($val === 'UNIX_TIMESTAMP') {
	            $values.='`' . $key . '`' . " = UNIX_TIMESTAMP(),";
	    } else {
	            $values.='`' . $key . '`' . "='" . self::dbSafeValue($val) . "',";
	    }
                }
                $values = substr($values, 0, -1);
                $sql.=$values . ' ON DUPLICATE KEY UPDATE ' . $values;

                $res = mysql_query($sql, $connection);
                if ($res !== false) {
	    $insert_id = mysql_insert_id();
	    if ($insert_id === 0) {
	            $sql = "SELECT id FROM " . $table . " WHERE " . str_replace("',`", "' AND `", $values);
	            $insert_id = DatabaseEngine::select_var($sql, 'id', $connection);
	    }
                } else {
	    if (@$_SESSION['debug'] == 1) {
	            echo 'error on query: <br><b> ' . $sql . '</b><br>' . mysql_error();
	    }
                }

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else
	    return $insert_id;
        }

        /**
         * UPDATE DATA OF A ROW
         * @param type $key_val ARRAY[]
         * @param type $table STRING
         * @param type $conditional_column_name STRING
         * @param type $connection OPTIONAL
         * @return TRUE OR FALSE
         */
        public static function update($key_val, $table, $conditional_column_name='id', $connection = null) {

                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }
                $sql = '';
                foreach ($key_val as $key => $val) {
	    if ($key == $conditional_column_name) {
	            $condition = '`' . $key . '`' . "='" . $val . "'";
	            continue;
	    }
	    if ($val === 'CURRENT_TIMESTAMP') {
	            $sql.='`' . $key . '`' . " = NOW(),";
	    } elseif ($val === 'UNIX_TIMESTAMP') {
	            $sql.='`' . $key . '`' . " = UNIX_TIMESTAMP(),";
	    } else {
	            $sql.='`' . $key . '`' . "='" . self::dbSafeValue($val) . "',";
	    }
                }
                $sql = substr($sql, 0, -1);
                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query("UPDATE " . $table . " SET " . $sql . ' WHERE ' . $condition) or die('error on query: <br><b> ' . "UPDATE " . $table . " SET " . $sql . ' WHERE ' . $condition . '</b><br>' . mysql_error());
                else
	    $res = mysql_query("UPDATE " . $table . " SET " . $sql . ' WHERE ' . $condition) or die('oops! This function is temprary inactive.');


                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else
	    return true;
        }
/**
 * DELETE ANY ROW BASED ON $conditional_column_name, $conditional_column_value
 * @param type $table STRING
 * @param type $conditional_column_name STRING
 * @param type $conditional_column_value STRING OR INT
 * @param type $connection OPTIONAL
 * @return TRUE OR FALSE
 */
        public static function delete($table, $conditional_column_name, $conditional_column_value, $connection = null) {
                $selfConn = false;
                if (is_null($connection)) {
	    $connection = self::getNewConnection();
	    $selfConn = true;
                }
                if (@$_SESSION['debug'] == 1)
	    $res = mysql_query("DELETE FROM " . $table . " WHERE " . $conditional_column_name . "='" . $conditional_column_value . "'", $connection) or die('error on query: <br><b> ' . $sql . '</b><br>' . mysql_error());
                else
	    $res = mysql_query("DELETE FROM " . $table . " WHERE " . $conditional_column_name . "='" . $conditional_column_value . "'", $connection) or die('oops! This function is temprary inactive.');

                if ($selfConn) {
	    self::closeConnection($connection);
                }
                if (!$res)
	    return false;
                else
	    return true;
        }

        /**
         * Create mysql connection if is not passed in and set object connection
         * @param MySqlConnection $connection mysql connection
         */
        public function __construct($connection = null) {
                if (is_null($connection)) {
	    $this->selfConnection = true;
	    $this->connection = self::getNewConnection();
                } else {
	    $this->connection = $connection;
                }
                $this->data['id'] = 0;
        }

        /**
         * Destructor close connection on self created connection object
         */
        public function __destruct() {
                if ($this->selfConnection) {
	    self::closeConnection($this->connection);
                }
        }

        /**
         * Start Transaction
         * @param type $connection 
         */
        public static function startTransaction($connection) {
                $sql = "START TRANSACTION;";
                self::execute($sql, $connection);
        }

        /**
         * Commit Transaction
         * @param type $connection 
         */
        public static function commitTransaction($connection) {
                $sql = "COMMIT;";
                self::execute($sql, $connection);
        }

        /**
         * Rollback Transaction
         * @param type $connection 
         */
        public static function rollbackTransaction($connection) {
                $sql = "ROLLBACK;";
                self::execute($sql, $connection);
        }

        /**
         * replalace apostroph "'" with \&#39; html safe characters \'
         * @param string $msg
         * @return string 
         */
        private static function dbSafeValue($msg) {
                return preg_replace("/'/", "\&#39;", $msg);
        }

}

?>
