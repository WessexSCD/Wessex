<?php
/**
 * database.php provides a database class for our website
 *
 * It defines a class, database, which allows us to access a MySQL database.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 27-02-2014, 19:33h
 * @copyright 2014 Wessex SCD
 */
$version = "27-02-2014, 19:33h";
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

    /**
     * Holds any error message from the latest query
     */
    public $error;
    /**
     * Lists the tables and structures in the database
     */
    protected $tables = array (
      "bands" => "`idband` INT(11) NOT NULL AUTO_INCREMENT,
  `bname` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idband`)",
   
      "venues" => "`idvenues` INT(11) NOT NULL AUTO_INCREMENT,
  `vname` VARCHAR(45) NOT NULL,
  `vaddress` VARCHAR(60) NULL DEFAULT NULL,
  PRIMARY KEY (`idvenues`)",
   
      "contacts" => "  `idcontacts` INT(11) NOT NULL AUTO_INCREMENT,
  `cname` VARCHAR(45) NULL DEFAULT NULL,
  `telephone` VARCHAR(15) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(45) NULL DEFAULT NULL,
  `role` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`idcontacts`)",
   
      "clubs" => "  `idclubs` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `url` VARCHAR(15) NOT NULL,
  `location` VARCHAR(30) NOT NULL,
  `day` VARCHAR(10) NULL DEFAULT NULL,
  `startTime` TIME NULL DEFAULT NULL,
  `endTime` TIME NULL DEFAULT NULL,
  `proviso` VARCHAR(45) NULL DEFAULT NULL,
  `activity` VARCHAR(45) NULL DEFAULT NULL COMMENT 'List of clubs in the Wessex region',
  `venues_idvenues` INT(11) NOT NULL,
  `contacts_idcontacts` INT(11) NOT NULL,
  PRIMARY KEY (`idclubs`, `venues_idvenues`, `contacts_idcontacts`),
  INDEX `id` (`idclubs` ASC),
  INDEX `fk_clubs_venues_idx` (`venues_idvenues` ASC),
  INDEX `fk_clubs_contacts1_idx` (`contacts_idcontacts` ASC),
  CONSTRAINT `fk_clubs_contacts1`
    FOREIGN KEY (`contacts_idcontacts`)
    REFERENCES `spiffino_test`.`contacts` (`idcontacts`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clubs_venues`
    FOREIGN KEY (`venues_idvenues`)
    REFERENCES `spiffino_test`.`venues` (`idvenues`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION", 
    
      "dances" => "  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATE NULL DEFAULT NULL,
  `dstartTime` TIME NULL DEFAULT NULL,
  `dendTime` TIME NULL DEFAULT NULL,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  `dance` TINYINT(1) NOT NULL DEFAULT TRUE,
  `cost` DECIMAL(10,0) NULL DEFAULT NULL,
  `flier` VARCHAR(60) NULL DEFAULT NULL,
  `note` VARCHAR(45) NULL DEFAULT NULL COMMENT 'List of dances in the Wessex region',
  `bands_idband` INT(11) NOT NULL,
  `venues_idvenues` INT(11) NOT NULL,
  `contacts_idcontacts` INT(11) NOT NULL,
  `clubs_idclubs` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `bands_idband`, `venues_idvenues`, `contacts_idcontacts`, `clubs_idclubs`),
  UNIQUE INDEX `id` (`id` ASC),
  UNIQUE INDEX `date` (`date` ASC),
  INDEX `fk_dances_bands1_idx` (`bands_idband` ASC),
  INDEX `fk_dances_venues1_idx` (`venues_idvenues` ASC),
  INDEX `fk_dances_contacts1_idx` (`contacts_idcontacts` ASC),
  INDEX `fk_dances_clubs1_idx` (`clubs_idclubs` ASC),
  CONSTRAINT `fk_dances_bands1`
    FOREIGN KEY (`bands_idband`)
    REFERENCES `spiffino_test`.`bands` (`idband`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dances_clubs1`
    FOREIGN KEY (`clubs_idclubs`)
    REFERENCES `spiffino_test`.`clubs` (`idclubs`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dances_contacts1`
    FOREIGN KEY (`contacts_idcontacts`)
    REFERENCES `spiffino_test`.`contacts` (`idcontacts`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dances_venues1`
    FOREIGN KEY (`venues_idvenues`)
    REFERENCES `spiffino_test`.`venues` (`idvenues`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION"
	  );
    /**
     * Lists the tables and fields in the database
     */
    protected $tableFields = array (
      "bands" => "`idband`, `bname`", 
      "venues" => "", 
      "contacts" => "", 
      "clubs" => "", 
      "dances" => ""
	  );
	
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
	 * @return database->result contains the result of the query
	 * @return database->error contains any error message 
	 */
	public function query($query)
    {
      $mysqli = new mysqli($this->server, $this->user, $this->pwd, $this->db);
	  if(mysqli_connect_errno())
	  {
	  	printf("Failed to connect to database: %s\n", mysqli_connect_error());
		exit();
	  }
	  $this->result = $mysqli->query($query);
	  $this->error = $mysqli->error; /*"Database query failed!\n"*/
	  $mysqli->close();
	  return;
	}

    /**
	 * dumpCSV() provides a method for us to dump the contents of our database as a CSV
	 * 
	 * It gets the content of our database and saves it as a set of CSVs, one for each table.
	 * 
	 * @param void
	 * @return void
	 */
	public function dumpCSV()
    {
      /* For each table, let's write the csv file */
	  foreach($this->tables as $tableName=>$structure)
	  {
		/* We need to get the contents of the table */
        $this->query("SELECT * FROM $tableName");
	    if($this->error) echo($this->error);
		/* Now we need to try and open the relevant csv file */
        @$file_handle = fopen("db_files/$tableName.csv", "w");
        if(!$file_handle) echo("<p>Failed to open $tableName.csv</p>");
        else
        {
          /* If it worked, write each row of the table to disc */
          while ($row = $this->result->fetch_object())
	      {
	  	  /*echo("<pre>");
		  print_r($row);
          echo("</pre>");*/
	      if(!fputcsv($file_handle, (array) $row)) echo "Failed to write line ($row)";
		  }
	    }
  	    /* Don't forget to close the file again afterwards */
  	    fclose($file_handle);
		echo("<p>File: $tableName.csv written to disc</p>");
      }
	  return;
	}

    /**
	 * rebuild() provides a method for us to recreate the contents of our database from CSVs
	 * 
	 * It reads a set of CSVs, one for each table, and uses them to recreate the content of 
	 * our database.
	 * 
	 * @param void
	 * @return void
	 */
	public function rebuild()
    {
      /* For each table, ; then we do need to populate the 
	   * table from the csv file */
	  foreach($this->tables as $tableName=>$fields)
	  {
        /* We may need to create the table first */
        $query = "CREATE TABLE IF NOT EXISTS $tableName ($fields)";
		//echo("<p>".$query."</p>");
        $this->query($query);
	    /* We'd better know if there was a problem */
	    if($this->error) echo($this->error);
	    /* Now we need to try and open the relevant csv file */
        @$file_handle = fopen("db_files/$tableName.csv", "r");
        if(!$file_handle) echo("<p>Failed to open $tableName.csv</p>");
        else
        {
          echo("<p>File $tableName.csv opened</p>\n");
		  //* If it worked, get each row of the table from the CSV... */
          while ($row=fgetcsv($file_handle))
		  {           
		  /*echo("<pre>");
		  print_r($row);
          echo("</pre>");*/
			$line = "";
			foreach($row as $num=>$value)$line = $line.'"'.$value.'", ';
			$line = chop($line, ", ");
			//echo("<p>$line</p>");
			//* ...and write it to the database */
            $query = "INSERT INTO $tableName VALUES ($line)";
			//echo("<p>$query</p>");
            $this->query($query);
			if($this->error) echo($this->error."<br />");			            
		  }
		  fclose($file_handle);
		  echo("<p>File $tableName.csv closed</p>\n");
        }
	  }
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
