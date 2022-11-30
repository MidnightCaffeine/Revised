<?php include_once 'lib/connection.php';
session_start();
include 'lib/student/addStudent.php';
$page = "home";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
    <meta name="robots" content="noindex, nofollow">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/img/ascotLogo.png" rel="icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery.validate.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
    <script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
    <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/css/quill.snow.css" rel="stylesheet">
    <link href="assets/css/quill.bubble.css" rel="stylesheet">
    <link href="assets/css/remixicon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'include/navigation.php';
    if ($_SESSION["position"] == "Administrator") {
        include 'include/sideNavigation.php';
    } elseif ($_SESSION["position"] == "Instructor") {
        include 'include/instructorSideNavigation.php';
    } elseif ($_SESSION["position"] == "Student") {
        include 'include/studentSideNavigation.php';
    }

    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Restore</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../backupAndRestore.php">Backup And Restore</a></li>
                    <li class="breadcrumb-item active">Backup</li>
                </ol>
            </nav>
            <a href="../backupAndRestore.php" type="button" class="btn btn-primary mb-2"><i class='bx bx-arrow-back'></i>Back</a>
        </div>
        <section class="section dashboard">
            <div class="row">
                <?php
                /**
                 * This file contains the Restore_Database class wich performs
                 * a partial or complete restoration of any given MySQL database
                 * @author Daniel López Azaña <daniloaz@gmail.com>
                 * @version 1.0
                 */

                /**
                 * Define database parameters here
                 */
                define("DB_USER", 'root');
                define("DB_PASSWORD", '');
                define("DB_NAME", 'rfid_attendance');
                define("DB_HOST", '127.0.0.1:3307');
                define("BACKUP_DIR", 'lib/myphp-backup-files'); // Comment this line to use same script's directory ('.')
                define("BACKUP_FILE", 'myphp-backup-rfid_attendance.sql.gz'); // Script will autodetect if backup file is gzipped based on .gz extension
                define("CHARSET", 'utf8');
                define("DISABLE_FOREIGN_KEY_CHECKS", true); // Set to true if you are having foreign key constraint fails

                /**
                 * The Restore_Database class
                 */
                class Restore_Database
                {
                    /**
                     * Host where the database is located
                     */
                    var $host;

                    /**
                     * Username used to connect to database
                     */
                    var $username;

                    /**
                     * Password used to connect to database
                     */
                    var $passwd;

                    /**
                     * Database to backup
                     */
                    var $dbName;

                    /**
                     * Database charset
                     */
                    var $charset;

                    /**
                     * Database connection
                     */
                    var $conn;

                    /**
                     * Disable foreign key checks
                     */
                    var $disableForeignKeyChecks;

                    /**
                     * Constructor initializes database
                     */
                    function __construct($host, $username, $passwd, $dbName, $charset = 'utf8')
                    {
                        $this->host                    = $host;
                        $this->username                = $username;
                        $this->passwd                  = $passwd;
                        $this->dbName                  = $dbName;
                        $this->charset                 = $charset;
                        $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
                        $this->conn                    = $this->initializeDatabase();
                        $this->backupDir               = defined('BACKUP_DIR') ? BACKUP_DIR : '.';
                        $this->backupFile              = defined('BACKUP_FILE') ? BACKUP_FILE : null;
                    }

                    /**
                     * Destructor re-enables foreign key checks
                     */
                    function __destructor()
                    {
                        /**
                         * Re-enable foreign key checks 
                         */
                        if ($this->disableForeignKeyChecks === true) {
                            mysqli_query($this->conn, 'SET foreign_key_checks = 1');
                        }
                    }

                    protected function initializeDatabase()
                    {
                        try {
                            $conn = mysqli_connect($this->host, $this->username, $this->passwd, $this->dbName);
                            if (mysqli_connect_errno()) {
                                throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
                                die();
                            }
                            if (!mysqli_set_charset($conn, $this->charset)) {
                                mysqli_query($conn, 'SET NAMES ' . $this->charset);
                            }

                            /**
                             * Disable foreign key checks 
                             */
                            if ($this->disableForeignKeyChecks === true) {
                                mysqli_query($conn, 'SET foreign_key_checks = 0');
                            }
                        } catch (Exception $e) {
                            print_r($e->getMessage());
                            die();
                        }

                        return $conn;
                    }

                    /**
                     * Backup the whole database or just some tables
                     * Use '*' for whole database or 'table1 table2 table3...'
                     * @param string $tables
                     */
                    public function restoreDb()
                    {
                        try {
                            $sql = '';
                            $multiLineComment = false;

                            $backupDir = $this->backupDir;
                            $backupFile = $this->backupFile;

                            /**
                             * Gunzip file if gzipped
                             */
                            $backupFileIsGzipped = substr($backupFile, -3, 3) == '.gz' ? true : false;
                            if ($backupFileIsGzipped) {
                                if (!$backupFile = $this->gunzipBackupFile()) {
                                    throw new Exception("ERROR: couldn't gunzip backup file " . $backupDir . '/' . $backupFile);
                                }
                            }

                            /**
                             * Read backup file line by line
                             */
                            $handle = fopen($backupDir . '/' . $backupFile, "r");
                            if ($handle) {
                                while (($line = fgets($handle)) !== false) {
                                    $line = ltrim(rtrim($line));
                                    if (strlen($line) > 1) { // avoid blank lines
                                        $lineIsComment = false;
                                        if (preg_match('/^\/\*/', $line)) {
                                            $multiLineComment = true;
                                            $lineIsComment = true;
                                        }
                                        if ($multiLineComment or preg_match('/^\/\//', $line)) {
                                            $lineIsComment = true;
                                        }
                                        if (!$lineIsComment) {
                                            $sql .= $line;
                                            if (preg_match('/;$/', $line)) {
                                                // execute query
                                                if (mysqli_query($this->conn, $sql)) {
                                                    if (preg_match('/^CREATE TABLE `([^`]+)`/i', $sql, $tableName)) {
                                                        $this->obfPrint("Table succesfully created: `" . $tableName[1] . "`");
                                                    }
                                                    $sql = '';
                                                } else {
                                                    throw new Exception("ERROR: SQL execution error: " . mysqli_error($this->conn));
                                                }
                                            }
                                        } else if (preg_match('/\*\/$/', $line)) {
                                            $multiLineComment = false;
                                        }
                                    }
                                }
                                fclose($handle);
                            } else {
                                throw new Exception("ERROR: couldn't open backup file " . $backupDir . '/' . $backupFile);
                            }
                        } catch (Exception $e) {
                            print_r($e->getMessage());
                            return false;
                        }

                        if ($backupFileIsGzipped) {
                            unlink($backupDir . '/' . $backupFile);
                        }

                        return true;
                    }

                    /*
     * Gunzip backup file
     *
     * @return string New filename (without .gz appended and without backup directory) if success, or false if operation fails
     */
                    protected function gunzipBackupFile()
                    {
                        // Raising this value may increase performance
                        $bufferSize = 4096; // read 4kb at a time
                        $error = false;

                        $source = $this->backupDir . '/' . $this->backupFile;
                        $dest = $this->backupDir . '/' . date("Ymd_His", time()) . '_' . substr($this->backupFile, 0, -3);

                        $this->obfPrint('Gunzipping backup file ' . $source . '... ', 1, 1);

                        // Remove $dest file if exists
                        if (file_exists($dest)) {
                            if (!unlink($dest)) {
                                return false;
                            }
                        }

                        // Open gzipped and destination files in binary mode
                        if (!$srcFile = gzopen($this->backupDir . '/' . $this->backupFile, 'rb')) {
                            return false;
                        }
                        if (!$dstFile = fopen($dest, 'wb')) {
                            return false;
                        }

                        while (!gzeof($srcFile)) {
                            // Read buffer-size bytes
                            // Both fwrite and gzread are binary-safe
                            if (!fwrite($dstFile, gzread($srcFile, $bufferSize))) {
                                return false;
                            }
                        }

                        fclose($dstFile);
                        gzclose($srcFile);

                        // Return backup filename excluding backup directory
                        return str_replace($this->backupDir . '/', '', $dest);
                    }

                    /**
                     * Prints message forcing output buffer flush
                     *
                     */
                    public function obfPrint($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1)
                    {
                        if (!$msg) {
                            return false;
                        }

                        $msg = date("Y-m-d H:i:s") . ' - ' . $msg;
                        $output = '';

                        if (php_sapi_name() != "cli") {
                            $lineBreak = "<br />";
                        } else {
                            $lineBreak = "\n";
                        }

                        if ($lineBreaksBefore > 0) {
                            for ($i = 1; $i <= $lineBreaksBefore; $i++) {
                                $output .= $lineBreak;
                            }
                        }

                        $output .= $msg;

                        if ($lineBreaksAfter > 0) {
                            for ($i = 1; $i <= $lineBreaksAfter; $i++) {
                                $output .= $lineBreak;
                            }
                        }

                        if (php_sapi_name() == "cli") {
                            $output .= "\n";
                        }

                        echo $output;

                        if (php_sapi_name() != "cli") {
                            ob_flush();
                        }

                        flush();
                    }
                }

                /**
                 * Instantiate Restore_Database and perform backup
                 */
                // Report all errors
                error_reporting(E_ALL);
                // Set script max execution time
                set_time_limit(900); // 15 minutes

                if (php_sapi_name() != "cli") {
                    echo '<div style="font-family: monospace;">';
                }

                $restoreDatabase = new Restore_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = $restoreDatabase->restoreDb(BACKUP_DIR, BACKUP_FILE) ? 'OK' : 'KO';
                $restoreDatabase->obfPrint("Restoration result: " . $result, 1);

                if (php_sapi_name() != "cli") {
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>
    <footer id="footer" class="footer">
        <div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <script src="assets/js/apexcharts.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/echarts.min.js"></script>
    <script src="assets/js/quill.min.js"></script>
    <script src="assets/js/tinymce.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>