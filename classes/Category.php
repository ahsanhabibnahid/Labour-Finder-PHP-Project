<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
	class Category{
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			$catName = $this->db->link->real_escape_string($catName);
			if (empty($catName)) {
				$msg = "<span class='error'>Category field must not be Empty!!</span>";
				return $msg;
			}
			else {
				$query = "insert into tbl_category(catName) values('$catName')";
				$catInsert = $this->db->insert($query);
				if ($catInsert) {
					$msg = "<span class='success'>Category Inserted Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Category not Inserted!!</span>";
					return $msg;
				}
			}
		}

		public function getAllCat(){
			$query = "select * from tbl_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllCatSingle($id){
			$query = "select catName from tbl_category where catId='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id){
			$query = "select * from tbl_category where catId='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function catUpdate($catName,$id){
			$catName = $this->fm->validation($catName);
			$catName = $this->db->link->real_escape_string($catName);
			
			$id = $this->fm->validation($id);
			$id = $this->db->link->real_escape_string($id);
			if (empty($catName)) {
				$msg = "<span class='error'>Category field must not be Empty!!</span>";
				return $msg;
			}
			else {
				$query = "update tbl_category set catName='$catName' where catId='$id' ";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Category Updated Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Category Not Updated !!</span>";
					return $msg;
				}
			}
		}

		public function delCatById($id){
			$query = "delete from tbl_category where catId='$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Category Deleted Successfully!!</span>";
					return $msg;
			}
			else {
					$msg = "<span class='error'>Category Not Deleted !!</span>";
					return $msg;
			}
		}
	}
?>