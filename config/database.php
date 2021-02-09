<?php
class Database
{
    // Note: specify your own database credentials
    private $host = "localhost";

    private $db_name = "db_movies";

    private $username = "root";

    private $password = "";

    public $conn;


    # 1. add a new private statice variable
    private static $instance=null;


    # 2. add a new function __construct
    //__construct() is the method name for the constructor. The constructor is called on an object after it has been created, and is a good place to put initialisation code, etc.
    private function __construct(){
        $db_dsn = array(
            'host'    => $this->host,
            'dbname'  => $this->db_name,
            'charset' => 'utf8',
        );

        if (getenv('IDP_ENVIRONMENT') === 'docker') {
            $db_dsn['host'] = 'mysql';
            $this->username = 'docker_u';
            $this->password = 'docker_p';
        }

        try {
            $dsn        = 'mysql:' . http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo json_encode(
                array(
                    'error'   => 'Database connection failed',
                    'message' => $exception->getMessage(),
                )
            );
            exit;
        }
    }

    
    # 3. another getInstance function
     //check $instance exist or not, if not , get a new database and return it
    public static function getInstance(){
        if(!self::$instance){ 
            self::$instance = new Database();
        }
        return self::$instance;
    } 


    // get the database connection
    # 4. re-work on the getConnection()
    public function getConnection()
    {
        return $this->conn;
    }
}
