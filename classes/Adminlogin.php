<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Session.php");
	Session::checkLogin();
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
	class Adminlogin{
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function adminLogin($adminUser,$adminPass){
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);

			$adminUser = $this->db->link->real_escape_string($adminUser);
			$adminPass = $this->db->link->real_escape_string($adminPass);

			if (empty($adminUser) || empty($adminPass)) {
				$loginMsg = "Username or Password must not be Empty!!";
				return $loginMsg;
			}
			else {
				$query = "select * from tbl_admin where adminUser='$adminUser' and adminPass='$adminPass' ";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					Session::set("adminlogin", true);
					Session::set("adminId", $value['adminId']);
					Session::set("adminUser", $value['adminUser']);
					Session::set("adminName", $value['adminName']);
					header("Location:dashboard.php");
				}
				else {
					$loginMsg = "Username or Password not match!!";
					return $loginMsg;
				} 
			}
		}
	}
?>