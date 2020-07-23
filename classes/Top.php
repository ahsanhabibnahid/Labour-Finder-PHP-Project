<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
	
	class Top {
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function topInsert($topName){
			$topName = $this->fm->validation($topName);
			$topName = $this->db->link->real_escape_string($topName);
			if (empty($topName)) {
				$msg = "<span class='error'>Top Category field must not be Empty!!</span>";
				return $msg;
			}
			else {
				$query = "insert into top_category (topName) values('$topName')";
				$topInsert = $this->db->insert($query);
				if ($topInsert) {
					$msg = "<span class='success'>Top Category Inserted Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Top Category not Inserted!!</span>";
					return $msg;
				}
			}
		}

		public function getAllTop(){
			$query = "select * from top_category order by topId desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function getTopById($id){
			$query = "select * from top_category where topId='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function topUpdate($topName,$id){
			$topName = $this->fm->validation($topName);
			$topName = $this->db->link->real_escape_string($topName);
			$id = $this->db->link->real_escape_string($id);
			if (empty($topName)) {
				$msg = "<span class='error'>Top Category field must not be Empty!!</span>";
				return $msg;
			}
			else {
				$query = "update top_category set topName='$topName' where topId='$id' ";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Top Category Updated Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Top Category Not Updated !!</span>";
					return $msg;
				}
			}
		}

		public function delTopById($id){
			$query = "delete from top_category where topId='$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Top Category Deleted Successfully!!</span>";
					return $msg;
			}
			else {
					$msg = "<span class='error'>Category Not Deleted !!</span>";
					return $msg;
			}
		}
	}
?>