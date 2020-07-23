<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
	class Cart{
		
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addToCart($quantity,$id){
			$quantity = $this->fm->validation($quantity);
			$quantity = $this->db->link->real_escape_string($quantity);
			$workerId = $this->db->link->real_escape_string($id);
			$sId      = session_id();

			$squery = "select * from worker where workerId= '$workerId' ";
			$result = $this->db->select($squery)->fetch_assoc();

			$workerName = $result['workerName'];
			$price = $result['price'];
			$image = $result['image'];

			$chquery = "select * from tbl_cart where workerId= '$workerId' and sId='$sId'";
			$getWorker = $this->db->select($chquery);
			if ($getWorker) {
				$msg = "Worker already added!";
				return $msg;
			}
			else {

			$query = "insert into 
		    	tbl_cart(sId,workerId,workerName,price,quantity,image) 
		    	values('$sId','$workerId','$workerName','$price','$quantity','$image') ";
		    	$workerInsert = $this->db->insert($query);
				if ($workerInsert) {
					header("Location:cart.php");
				}
				else {
					header("Location:404.php");
				}
			}
		}

		public function getCartWorker(){
			$sId      = session_id();
			$query = "select * from tbl_cart where sId='$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCartQuantity($cartId,$quantity){
			$cartId = $this->db->link->real_escape_string($cartId);
			$quantity = $this->db->link->real_escape_string($quantity);

			$query = "update tbl_cart set quantity='$quantity' where cartId='$cartId' ";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				header("Location:cart.php");
			}
			else {
				$msg = "<span style='color:red; font-size:18px;'>Quantity Not Updated !!</span>";
				return $msg;
			}
		}

		public function delWorkerByCart($delId){
			$delId = $this->db->link->real_escape_string($delId);
			$query = "delete from tbl_cart where cartId='$delId' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				echo "<script>window.location='cart.php';</script>";
			}
			else {
					$msg = "<span class='error'>Worker Not Deleted !!</span>";
					return $msg;
			}
		}

		public function checkCartTable(){
			$sId      = session_id();
			$query = "select * from tbl_cart where sId='$sId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCustomerCart(){
			$sId      = session_id();
			$query = "delete from tbl_cart where sId='$sId'";
			$this->db->delete($query);
		}

		public function orderWorker($cmrId){
			$sId      = session_id();
			$query = "select * from tbl_cart where sId='$sId' ";
			$getWorker = $this->db->select($query);
			if ($getWorker) {
				while ($result = $getWorker->fetch_assoc()) {
					$workerId = $result['workerId'];
					$workerName = $result['workerName'];
					$quantity = $result['quantity'];
					$price = $result['price']*$quantity;
					$image = $result['image'];

				$query = "insert into 
		    	tbl_order(cmrId,workerId,workerName,quantity,price,image) 
		    	values('$cmrId','$workerId','$workerName','$quantity','$price','$image') ";
		    	$workerInsert = $this->db->insert($query);
				}
			}
		}

		public function payableAmount($cmrId){
			$query = "select price from tbl_order where cmrId='$cmrId' and date = now() ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderedWorker($cmrId){
			$query = "select * from tbl_order where cmrId='$cmrId' order by date desc ";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cmrId){
			$query = "select * from tbl_order where cmrId='$cmrId' ";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getAllOrderWorker(){
			$query = "select * from tbl_order order by date desc";
			$result = $this->db->select($query);
			return $result;
		}

		public function workerShifted($id,$date,$price){
			$id = $this->fm->validation($id);
			$id = $this->db->link->real_escape_string($id);

			$date = $this->fm->validation($date);
			$date = $this->db->link->real_escape_string($date);

			$price = $this->fm->validation($price);
			$price = $this->db->link->real_escape_string($price);

			$query = "update tbl_order set status='1' where cmrId='$id' and date='$date' and price='$price' ";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Updated Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Not Updated !!</span>";
					return $msg;
				}
		}

		public function delWorkerShifted($id,$date,$price){
			$id = $this->fm->validation($id);
			$id = $this->db->link->real_escape_string($id);

			$date = $this->fm->validation($date);
			$date = $this->db->link->real_escape_string($date);

			$price = $this->fm->validation($price);
			$price = $this->db->link->real_escape_string($price);

			$query = "delete from tbl_order where cmrId='$id' and date='$date' and price='$price' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Deleted Successfully!!</span>";
					return $msg;
			}
			else {
					$msg = "<span class='error'>Not Deleted !!</span>";
					return $msg;
			}
		}

		public function workerShiftConfirm($id,$date,$price){
			$id = $this->fm->validation($id);
			$id = $this->db->link->real_escape_string($id);

			$date = $this->fm->validation($date);
			$date = $this->db->link->real_escape_string($date);

			$price = $this->fm->validation($price);
			$price = $this->db->link->real_escape_string($price);

			$query = "update tbl_order set status='2' where cmrId='$id' and date='$date' and price='$price' ";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Updated Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Not Updated !!</span>";
					return $msg;
				}
		}
	}
?>