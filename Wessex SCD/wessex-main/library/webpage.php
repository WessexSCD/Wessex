<?php
/**
 * webpage.php provides a basic web page class for our website
 *
 * It defines a class, webpage, which forms a boilerplate html page which we 
 * re-use on every page.
 * 
 * @author Donald Mackay and David Argles <wessex.scd@gmail.com>
 * @version 07-02-2014, 20:40h
 * @copyright 2014 Wessex SCD
 */
$version = "07-02-2014, 20:40h";
  /**
   * webpage provides a basic web page class for our website
   *
   * It defines several page attributes which are loaded from a webpage.ini file. 
   * It also defines two HTMLstream methods, HTMLstreamTop and HTMLstreamBottom, 
   * which output the necessary HTML code to make up our boilerplate page.
   * 
   * @param void
   * @return void
   */
  class webpage
  {
    /**
     * @access protected
     * @var class
     */
    protected $page;
    /**#@+
	 * @access protected
     * @var string
     */
    /**
     * Defines the CSS file to be used 
     */
    protected $cssfile = "webpage.css";
    /**
     * Defines the text to be used in the browser tabs
     */
    protected $title = "Default Page Title";
    /**
     * Defines the image to be used as the page logo 
     */
    protected $heading = "Default Website Heading";
    /**
     * Defines the text to be used as the page tagline
     */
    protected $tagline = "Default website description";
    /**
     * Provides an array for the menu labels and links
     */
    protected $menu = array ("Page 1"=>"page1.php", "Page 2"=>"page2.php");
    /**
     * Defines the copyright text for the bottom of the page 
     */
    protected $copy = "2014 Wessex SCD";
    /**
     * Defines the tartan background for the page 
     */
    protected $tartan = "tarblank.gif";

/**
 * setCSS() allows us to change the css file used for a particular page
 * 
 * @param the filename of the css file (expected to be held in the <library> sub-directory)
 * @return void
 */
    public function setCSS($filename)
    {
      $this->cssfile = $filename;
      return;
    }

/**
 * setTartan() allows us to change the tartan background used for a particular page
 * 
 * @param the filename of the tartan (expected to be held in the <graphics> sub-directory)
 * @return void
 */
    public function setTartan($filename)
    {
      $this->tartan = $filename;
      return;
    }

 /**
 * setTitle() allows us to change the text that goes into the tab above the page display in the browser 
 * 
 * @param the new title
 * @var string
 * @return void
 */
    public function setTitle($newTitle)
    {
      $this->title = $newTitle;
      return;
    }

/**
 * __construct() sets up all the class properties from the webpage ini file
 * 
 * It runs automatically when we first instantiate the class.
 * 
 * @param void
 * @return void
 */
    public function __construct()
    {
      /* First, we'd better check that the ini file is there */
      if(parse_ini_file("webpage.ini",true))
      {
      	/* If it is, read the file in as an object */
        $iniFile = (object) parse_ini_file("webpage.ini",true);
/*echo("<pre>");
print_r($iniFile);
echo("</pre>");*/
		/* Now read in the various settings */
        $this->cssfile = $iniFile->cssfile;
        $this->title = $iniFile->headtitle;
        $this->heading = $iniFile->heading;
        $this->tartan = $iniFile->tartan;
        /*$this->tagline = $iniFile->tagline;*/
        $this->copy = $iniFile->copyright;
        
		/* The entire menu comes in as an object */
		$this->menu = (object) $iniFile->menu;

        /* This bit is a bit clunky.  It would be nice to automagically set up the text in the 
		 * browser tab.  To do this, we...
		 * ...extract the current page name (e.g. index.php) from PHP_SELF... */
        $this->page = substr(strrchr($_SERVER['PHP_SELF'],"/"),1);
		/* ...and then trawl through the menu entries until we find a link specified in the menu 
		 * that matches the current page. */
        foreach($this->menu as $label=>$link)
        {
          if($this->page==$link) $this->title = $label.": ".$this->title;
        }
      }
      return;
    }

/**
 * HTMLstreamTop() streams all the code necessary for the top of our boilerplate HTML page
 * 
 * @param void
 * @return void
 */
    public function HTMLstreamTop()
    {
      global $version;
?>
<html>
  <!-- We're working in HTML5, so this is all very straightforward -->
  <!-- First, the head section -->
  <head>
    <meta charset="UTF-8">
    <!-- The following line is required because we want a responsive site -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Donald Mackay and David Argles" />
    <meta name="generator" content=<?php echo("\"Wessex SCD page generator 2, ".$version."\""); ?> />
    <!-- The next line specifies our css file (in CSS3) -->
    <link rel="stylesheet" type="text/css" <?php echo("href=\"library/".$this->cssfile."\""); ?>>
    <!-- We need a fix for legacy IE browsers.  The next line does this for us. -->
    <!--[if lt IE 9]><script src="library/html5shiv.js"></script><![endif]-->
    <title><?php echo($this->title); ?></title>
  </head>

  <!-- Now we start our displayable page -->
  <body>
    <!-- container doesn't exist (yet?) in CSS3.  It should!  But we can make it work anyway. -->
<?php echo("    <container style=\"background-image: url(graphics/".$this->tartan.")\">\n"); ?>
      <!-- First on the page is the navigation.  Layout is handled by the CSS. -->
      <nav>
<?php
          /* The next bit unpacks our menu object and displays it as a list of links. */
          foreach($this->menu as $label=>$link)
          {
            if($this->page==$link) echo('        <a class="current" href="'.$link.'">'.$label."</a>\n");
             else echo('        <a href="'.$link.'">'.$label."</a>\n");
          }
        ?>
      </nav>
      <!-- Next up comes the header.  For now, this is just a heading. -->
      <header>
        <h1><?php echo($this->heading); ?></h1>
        <img src="graphics/2Couples.png" alt="[Dancers Graphic]">
        <!-- p><?php echo($this->tagline); ?></p -->
      </header>

      <!-- Now we start the main page section... -->
      <section>
      <!-- ...and stream the main page content. -->
<?php 
    }

/**
 * HTMLstreamBottom() streams all the code necessary for the bottom of our boilerplate HTML page
 * 
 * @param void
 * @return void
 */
    public function HTMLstreamBottom()
    {
?>
      <!-- Now we just tidy everything up at the foot of the page. -->
      </section>

      <footer>
        <?php echo("<p>&copy;".$this->copy."</p>\n"); ?>
      </footer>
    </container>
  </body>
</html>
<?php 
    }
  }
/**---------------------------------------------
 *             End of Code
 *----------------------------------------------
 */
?>
