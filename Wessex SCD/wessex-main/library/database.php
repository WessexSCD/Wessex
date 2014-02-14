<?php
/**
 * database.php provides a database class for our website
 *
 * It defines a class, database, which allows us to access a MySQL database.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 14-02-2014, 21:03h
 * @copyright 2014 Wessex SCD
 */
$version = "14-02-2014, 21:03h";
  /**
   * database provides a basic database class for our website
   *
   * It defines...
   * 
   * @param void
   * @return void
   */
  class database
  {
    /** 
	 * Defines the server to connect to
     */
    protected $server;
    /**
     * Defines the database to be used 
     */
    protected $db;
    /**
     * Defines the username to connect with
     */
    protected $user;
    /**
     * Defines the password
     */
    protected $pwd;
    /**
     * Holds the result of the latest query
     */
    public $result;

    public function __construct()
    {
      /* First, we'd better check that the ini file is there */
      if(parse_ini_file("library/database.ini",true))
      {
      	/* If it is, read the file in as an object */
        $iniFile = (object) parse_ini_file("library/database.ini",true);
/*echo("<pre>");
print_r($iniFile);
echo("</pre>");*/
		/* Now read in the various settings */
        $this->server = $iniFile->server;
        $this->db = $iniFile->db;
        $this->user = $iniFile->user;
        $this->pwd = $iniFile->pwd;
      }
      return;
    }
    
	public function query($query)
    {
      $mysqli = new mysqli($this->server, $this->user, $this->pwd, $this->db);
	  if(mysqli_connect_errno())
	  {
	  	printf("Failed to connect to database: %s\n", mysqli_connect_error());
		exit();
	  }
	  if($this->result = $mysqli->query($query));
	  else($this->result = $mysqli->error/*"Database query failed!\n"*/);
	  $mysqli->close();
	  return;
	}
  }
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
