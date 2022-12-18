<?php include_once 'connection.php';
session_start();
$page = "backup";
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
$action = 'Backup database';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Backup</title>
	<meta name="robots" content="noindex, nofollow">
	<meta content="" name="description">
	<meta content="" name="keywords">
	<link href="../assets/img/ascotLogo.png" rel="icon">
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" charset="utf8" src="../assets/js/jquery-3.4.1.min.js"></script>
	<script src="../assets/js/jquery.validate.js"></script>
	<script type="text/javascript" charset="utf8" src="../assets/js/datatable.js"></script>
	<script type="text/javascript" charset="utf8" src="../assets/js/dataTables.bootstrap5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap5.min.css">
	<link href="../assets/css/bootstrap-icons.css" rel="stylesheet">
	<link href="../assets/css/boxicons.min.css" rel="stylesheet">
	<link href="../assets/css/quill.snow.css" rel="stylesheet">
	<link href="../assets/css/quill.bubble.css" rel="stylesheet">
	<link href="../assets/css/remixicon.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
	<header id="header" class="header fixed-top d-flex align-items-center">
		<div class="d-flex align-items-center justify-content-between"> <a href="index.html" class="logo d-flex align-items-center"> <img src="assets/img/ascotLogo.png" alt=""> <span class="d-none d-lg-block">Aurora State College of Technology</span> </a> <i class="bi bi-list toggle-sidebar-btn"></i></div>
		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">
				<li class="nav-item dropdown pe-3">
					<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"> <img src="assets/img/profile-img.png" alt="Profile" class="rounded-circle"> <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["username"] ?></span> </a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6><?php echo $_SESSION["fullname"] ?></h6>
							<span><?php echo $_SESSION["position"] ?></span>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a class="dropdown-item d-flex align-items-center" href="users-profile.html"> <i class="bi bi-person"></i> <span>My Profile</span> </a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a class="dropdown-item d-flex align-items-center" href="users-profile.html"> <i class="bi bi-gear"></i> <span>Account Settings</span> </a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a class="dropdown-item d-flex align-items-center" href="pages-faq.html"> <i class="bi bi-question-circle"></i> <span>Need Help?</span> </a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li> <a class="dropdown-item d-flex align-items-center" href="../logout.php"> <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span> </a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<aside id="sidebar" class="sidebar">
		<ul class="sidebar-nav" id="sidebar-nav">
			<li class="nav-item">
				<a class="nav-link 
            <?php
			if ($page == "home") {
				echo "";
			} else {
				echo "collapsed";
			}
			?>" href="../home.php">
					<i class='bx bxs-dashboard'></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link
         <?php
			if ($page == "manage_student" || $page == "manage_teacher" || $page == "rfid_card" || $page == "manage_department" || $page == 'edit_student') {
				echo "";
			} else {
				echo " collapsed";
			}
			?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
					<i class="ri-group-line"></i>
					<span>Manage</span>
					<i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="components-nav" class="nav-content<?php
															if ($page == "manage_student" || $page == "manage_teacher" || $page == "rfid_card" || $page == "manage_department" || $page == 'edit_student') {
																echo "";
															} else {
																echo " collapse";
															}
															?> " data-bs-parent="#sidebar-nav">
					<li class="nav-heading">Users</li>
					<li> <a class="<?= $page == 'manage_student' || $page == 'edit_student' ? 'active' : '' ?>" href="../manage_student.php"><i class='bx bxs-right-arrow'></i><span>Students</span> </a></li>
					<li> <a class="<?= $page == 'manage_teacher' ? 'active' : '' ?>" href="../manage_teacher.php"><i class='bx bxs-right-arrow'></i><span>Instructors</span></a></li>
					<li class="nav-heading">Device</li>
					<li> <a class="<?= $page == 'rfid_card' ? 'active' : '' ?>" href="../rfid_cards.php"><i class='bx bxs-right-arrow'></i><span>RFID Card</span> </a></li>

				</ul>
			</li>
			<li class="nav-item">
				<a class="nav-link 
         <?php
			if ($page == "attendance_student" || $page == "attendance_instructor") {
				echo "";
			} else {
				echo " collapsed";
			}
			?>
         " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"><i class='bx bxs-folder-open'></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i> </a>
				<ul id="forms-nav" class="nav-content
         <?php
			if ($page == "attendance_student" || $page == "attendance_instructor") {
				echo "";
			} else {
				echo " collapse";
			}
			?> " data-bs-parent="#sidebar-nav">
					<li> <a class="<?= $page == 'attendance_student' ? 'active' : '' ?>" href="../attendance_student.php"><i class='bx bxs-right-arrow'></i><span>Students</span> </a></li>
					<li> <a class="<?= $page == 'attendance_instructor' ? 'active' : '' ?>" href="../attendance_instructor.php"><i class='bx bxs-right-arrow'></i></i><span>Instructor</span> </a></li>
				</ul>
			</li>
			<li class="nav-item">
				<a class="nav-link 
            <?php
			if ($page == "backup_and_restore" || $page == "backup") {
				echo "";
			} else {
				echo "collapsed";
			}
			?>" href="../backupAndRestore.php">
					<i class='bx bxs-package'></i>
					<span>Backup And Restore</span>
				</a>
			</li>
			<li class="nav-item"> <a class="nav-link collapsed dev" href="pages-blank.html"> <i class="ri-code-s-slash-line"></i> <span>About Developer</span> </a></li>
		</ul>
	</aside>
	<main id="main" class="main">
		<div class="pagetitle">
			<h1>Backup</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="../backupAndRestore.php">Backup And Restore</a></li>
					<li class="breadcrumb-item active">Backup</li>
				</ol>
			</nav>
		</div>
		<a href="../backupAndRestore.php" type="button" class="btn btn-primary mb-2"><i class='bx bx-arrow-back'></i>Back</a>
		<section class="section dashboard">
			<div class="row">
				<?php
				/**
				 * This file contains the Backup_Database class wich performs
				 * a partial or complete backup of any given MySQL database
				 * @author Daniel López Azaña <daniloaz@gmail.com>
				 * @version 1.0
				 */
				/**
				 * Define database parameters here
				 */
				define("DB_USER", 'root');
				define("DB_PASSWORD", '');
				define("DB_NAME", 'rfid_attendance');
				define("DB_HOST", 'localhost');
				define("BACKUP_DIR", 'mybackup'); // Comment this line to use same script's directory ('.')
				define("TABLES", '*'); // Full backup
				//define("TABLES", 'table1 table2 table3'); // Partial backup
				define("CHARSET", 'utf8');
				define("GZIP_BACKUP_FILE", true);  // Set to false if you want plain SQL backup files (not gzipped)
				/**
				 * The Backup_Database class
				 */
				class Backup_Database
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
					 * Backup directory where backup files are stored 
					 */
					var $backupDir;
					/**
					 * Output backup file
					 */
					var $backupFile;
					/**
					 * Use gzip compression on backup file
					 */
					var $gzipBackupFile;
					/**
					 * Constructor initializes database
					 */
					public function __construct($host, $username, $passwd, $dbName, $charset = 'utf8')
					{
						$this->host            = $host;
						$this->username        = $username;
						$this->passwd          = $passwd;
						$this->dbName          = $dbName;
						$this->charset         = $charset;
						$this->conn            = $this->initializeDatabase();
						$this->backupDir       = BACKUP_DIR ? BACKUP_DIR : '.';
						$this->backupFile      = 'backup-' . $this->dbName . '-' . date("Ymd_His", time()) . '.sql';
						$this->gzipBackupFile  = defined('GZIP_BACKUP_FILE') ? GZIP_BACKUP_FILE : true;
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
					public function backupTables($tables = '*')
					{
						try {
							/**
							 * Tables to export
							 */
							if ($tables == '*') {
								$tables = array();
								$result = mysqli_query($this->conn, 'SHOW TABLES');
								while ($row = mysqli_fetch_row($result)) {
									$tables[] = $row[0];
								}
							} else {
								$tables = is_array($tables) ? $tables : explode(',', $tables);
							}
							$sql = 'CREATE DATABASE IF NOT EXISTS `' . $this->dbName . "`;\n\n";
							$sql .= 'USE ' . $this->dbName . ";\n\n";
							/**
							 * Iterate tables
							 */
							$this->obfPrint("Preparing tables to backup...");
							foreach ($tables as $table) {
								$this->obfPrint("Backing up `" . $table . "` table..." . str_repeat('.', 50 - strlen($table)), 0, 0);
								/**
								 * CREATE TABLE
								 */
								$sql .= 'DROP TABLE IF EXISTS `' . $table . '`;';
								$row = mysqli_fetch_row(mysqli_query($this->conn, 'SHOW CREATE TABLE `' . $table . '`'));
								$sql .= "\n\n" . $row[1] . ";\n\n";
								/**
								 * INSERT INTO
								 */
								$row = mysqli_fetch_row(mysqli_query($this->conn, 'SELECT COUNT(*) FROM `' . $table . '`'));
								$numRows = $row[0];
								// Split table in batches in order to not exhaust system memory 
								$batchSize = 1000; // Number of rows per batch
								$numBatches = intval($numRows / $batchSize) + 1; // Number of while-loop calls to perform
								for ($b = 1; $b <= $numBatches; $b++) {

									$query = 'SELECT * FROM `' . $table . '` LIMIT ' . ($b * $batchSize - $batchSize) . ',' . $batchSize;
									$result = mysqli_query($this->conn, $query);
									$numFields = mysqli_num_fields($result);
									for ($i = 0; $i < $numFields; $i++) {
										$rowCount = 0;
										while ($row = mysqli_fetch_row($result)) {
											$sql .= 'INSERT INTO `' . $table . '` VALUES(';
											for ($j = 0; $j < $numFields; $j++) {
												if (isset($row[$j])) {
													$row[$j] = addslashes($row[$j]);
													$row[$j] = str_replace("\n", "\\n", $row[$j]);
													$sql .= '"' . $row[$j] . '"';
												} else {
													$sql .= 'NULL';
												}
												if ($j < ($numFields - 1)) {
													$sql .= ',';
												}
											}
											$sql .= ");\n";
										}
									}
									$this->saveFile($sql);
									$sql = '';
								}
								$sql .= "\n\n\n";
								$this->obfPrint(" OK");
							}
							if ($this->gzipBackupFile) {
								$this->gzipBackupFile();
							} else {
								$this->obfPrint('Backup file succesfully saved to ' . $this->backupDir . '/' . $this->backupFile, 1, 1);
							}
						} catch (Exception $e) {
							print_r($e->getMessage());
							return false;
						}
						return true;
					}
					/**
					 * Save SQL to file
					 * @param string $sql
					 */
					protected function saveFile(&$sql)
					{
						if (!$sql) return false;
						try {
							if (!file_exists($this->backupDir)) {
								mkdir($this->backupDir, 0777, true);
							}
							file_put_contents($this->backupDir . '/' . $this->backupFile, $sql, FILE_APPEND | LOCK_EX);
						} catch (Exception $e) {
							print_r($e->getMessage());
							return false;
						}
						return true;
					}
					/*
                             * Gzip backup file
                             *
                             * @param integer $level GZIP compression level (default: 9)
                             * @return string New filename (with .gz appended) if success, or false if operation fails
                             */
					protected function gzipBackupFile($level = 9)
					{
						if (!$this->gzipBackupFile) {
							return true;
						}
						$source = $this->backupDir . '/' . $this->backupFile;
						$dest =  $source . '.gz';
						$this->obfPrint('Compressing backup file to ' . $dest . '... ', 1, 0);
						$mode = 'wb' . $level;
						if ($fpOut = gzopen($dest, $mode)) {
							if ($fpIn = fopen($source, 'rb')) {
								while (!feof($fpIn)) {
									gzwrite($fpOut, fread($fpIn, 1024 * 256));
								}
								fclose($fpIn);
							} else {
								return false;
							}
							gzclose($fpOut);
							if (!unlink($source)) {
								return false;
							}
						} else {
							return false;
						}

						$this->obfPrint('OK');
						return $dest;
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
						echo $output;
						if (php_sapi_name() != "cli") {
							ob_flush();
						}
						flush();
					}
				}
				/**
				 * Instantiate Backup_Database and perform backup
				 */
				// Report all errors
				error_reporting(E_ALL);
				// Set script max execution time
				set_time_limit(900); // 15 minutes
				if (php_sapi_name() != "cli") {
					echo '<div style="font-family: monospace;">';
				}

				$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				$result = $backupDatabase->backupTables(TABLES, BACKUP_DIR) ? '<b>DB Backup successfully created!</b>' : '<b>DB Backup unsuccessful!</b>';
				$backupDatabase->obfPrint('<b>Backup result: </b>' . $result, 1);
				if (php_sapi_name() != "cli") {
					echo '</div>';
				}

				if (strcmp($result, '<b>DB Backup successfully created!</b>') == 0) {
					$pdo = new PDO('mysql:host=localhost;dbname=rfid_attendance', 'root', '');
					//echo'Connection Successful!';

					$action = 'Backup the database named backup-' . DB_NAME . '-' . date("Ymd_His", time()) . '.sql.gz';
					$insertLog = $pdo->prepare("INSERT INTO user_log(user_id, user, action, log_date, log_time) values(:id, :user, :action, :logDate, :logTime)");

					$insertLog->bindParam(':id', $_SESSION['myid']);
					$insertLog->bindParam(':user', $_SESSION['username']);
					$insertLog->bindParam(':action', $action);
					$insertLog->bindParam(':logDate', $d);
					$insertLog->bindParam(':logTime', $t);
					$insertLog->execute();
				}
				?>
			</div>
		</section>
	</main>
	<footer id="footer" class="footer">
		<div class="copyright"> &copy; Copyright <strong><span>Midnight Coffee</span></strong>. All Rights Reserved</div>
	</footer>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<script>
		$(document).ready(function() {
			$('#studentTable').DataTable({
				pagingType: 'full_numbers',
				responsive: true,

			});
		});
	</script>

	<script src="../assets/js/apexcharts.min.js"></script>
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/echarts.min.js"></script>
	<script src="../assets/js/quill.min.js"></script>
	<script src="../assets/js/tinymce.min.js"></script>
	<script src="../assets/js/main.js"></script>

</body>

</html>