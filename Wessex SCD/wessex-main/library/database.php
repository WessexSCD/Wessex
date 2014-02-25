<?php
/**
 * database.php provides a database class for our website
 *
 * It defines a class, database, which allows us to access a MySQL database.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 25-02-2014, 15:23h
 * @copyright 2014 Wessex SCD
 */
$version = "25-02-2014, 15:23h";
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

    public function __construct($path)
    {
      /* First, we'd better check that the ini file is there */
      $inifile = $path."library/database.ini";
	  //echo($path.$inifile);
      if(parse_ini_file($inifile,true))
      {
      	/* If it is, read the file in as an object */
        $iniFile = (object) parse_ini_file($inifile,true);
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
    
    /**
	 * query($query) provides a method for us to make an SQL query to the database
	 * 
	 * It makes a connection to our database, submits the query, and records the 
	 * result, or the error message if it fails, in $database->result.  It then 
	 * closes the connection and returns.
	 * 
	 * @param $query is the query in MySQL syntax
	 * @return There is no return value; the result can be found in $database->result
	 */
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

    /**
	 * displayDances($club) provides a method for us to display dances listed in 
	 * the database for a specific club
	 * 
	 * It makes a connection to our database, submits the relevant query, and then 
	 * streams the necessary HTML to list the dances in a table.  It then closes 
	 * the connection and returns.
	 * 
	 * @param $club is the name of the club (lower case)
	 * @return void
	 */
	public function displayDances($club)
    {
      $this->query("SELECT * FROM dances 
      	    INNER JOIN venues ON dances.venues_idvenues = venues.idvenues
      	    INNER JOIN clubs ON dances.clubs_idclubs = clubs.idclubs
      	    INNER JOIN bands ON dances.bands_idband = bands.idband
      	    WHERE clubs.url = \"".$club."\"
      	    ORDER BY dances.date");
		  /*echo("<pre>");
		  print_r($this->result);
          echo("</pre>");*/  
?>
  	  <table>
	  	<tr><th>Date</th><th>Event</th></tr>
	  	<?php
	  	
	  	  $today = date('l jS M Y');
	  	  while ($row = $this->result->fetch_object()) 
		  {
		  	if(strtotime($row->date) >= strtotime($today)) 
		  	{
		  	  $tidyDate = date_format(date_create($row->date), 'l jS M Y');
			  $tidyStartTime = strftime('%l.%M%P',strtotime($row->dstartTime));
			  $tidyEndTime = strftime('%l.%M%P',strtotime($row->dendTime));

		  /*echo("<pre>");
		  print_r($row);
          echo("</pre>");*/

              if($row->dance) printf("<tr>
		  	    <td class=\"clubDances\">$tidyDate<br />&nbsp;&nbsp;$tidyStartTime - $tidyEndTime</td>
		  	    <td class=\"clubDances\">$row->title<br />at $row->vname<br />
		  	      <a href='$row->flier'>Dance flier</a></td>
		  	  </tr>");
			  else printf("<tr>
		  	    <td class=\"clubDances\">$tidyDate</td>
		  	    <td class=\"clubDances\">$row->title</td>
		  	  </tr>");
			}
		  }
	  	?>
	  </table>
<?php
	}
  }
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
