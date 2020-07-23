<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>

<?php
	class Customer{
		
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function customerRegistration($data){
			$name = $this->fm->validation($data['name']);
			$name = $this->db->link->real_escape_string($data['name']);

			$address = $this->fm->validation($data['address']);
			$address = $this->db->link->real_escape_string($data['address']);

			$city = $this->fm->validation($data['city']);
			$city = $this->db->link->real_escape_string($data['city']);

			$zip = $this->fm->validation($data['zip']);
			$zip = $this->db->link->real_escape_string($data['zip']);

			$phone = $this->fm->validation($data['phone']);
			$phone = $this->db->link->real_escape_string($data['phone']);

			$email = $this->fm->validation($data['email']);
			$email = $this->db->link->real_escape_string($data['email']);

			$password = $this->fm->validation($data['password']);
			$password = $this->db->link->real_escape_string(md5($data['password']));

			if ($name=="" || $address=="" || $city==""|| $zip=="" || $phone=="" || $email=="" || $password=='') {
		    	$msg = "<span class='error'>Fields must not be Empty!!</span>";
				return $msg;
		    }

		    $mailQuery = "select * from tbl_customer where email='$email' limit 1" ;
		    $mailCheck = $this->db->select($mailQuery);
		    if ($mailCheck != false) {
		    	$msg = "<span class='error'>Email Already Exist!!</span>";
				return $msg;
		    } 
		    else {
		    	$query = "insert into 
		    	tbl_customer(name,address,city,zip,phone,email,password) 
		    	values('$name','$address','$city','$zip','$phone','$email','$password') ";
		    	$workerInsert = $this->db->insert($query);
				if ($workerInsert) {
					$msg = "<span class='success'>Customer Data Inserted Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Customer Data not Inserted!!</span>";
					return $msg;
				}
		    }
		}

		public function customerLogin($data){
			$email = $this->fm->validation($data['email']);
			$email = $this->db->link->real_escape_string($data['email']);

			$password = $this->fm->validation($data['password']);
			$password = $this->db->link->real_escape_string(md5($data['password']));

			if (empty($email) || empty($password)) {
				$msg = "<span class='error'>Fields must not be Empty!!</span>";
				return $msg;
			}
			$query = "select * from tbl_customer where email='$email' and password='$password'";
			$result = $this->db->select($query);
			if ($result!=false) {
				$value = $result->fetch_assoc();
				Session::set("cuslogin", true);
				Session::set("cmrId",$value['id']);
				Session::set("cmrName",$value['name']);
				header("Location:cart.php");
			}
			else {
				$msg = "<span class='error'>Email or Password not Matched!!</span>";
				return $msg;
			}

		}

		public function getCustomerData($id){
			$query = "select * from tbl_customer where id='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function customerUpdate($data,$cmrId){
			$name = $this->fm->validation($data['name']);
			$name = $this->db->link->real_escape_string($data['name']);

			$address = $this->fm->validation($data['address']);
			$address = $this->db->link->real_escape_string($data['address']);

			$city = $this->fm->validation($data['city']);
			$city = $this->db->link->real_escape_string($data['city']);

			$zip = $this->fm->validation($data['zip']);
			$zip = $this->db->link->real_escape_string($data['zip']);

			$phone = $this->fm->validation($data['phone']);
			$phone = $this->db->link->real_escape_string($data['phone']);

			$email = $this->fm->validation($data['email']);
			$email = $this->db->link->real_escape_string($data['email']);

			if ($name=="" || $address=="" || $city==""|| $zip=="" || $phone=="" || $email=="") {
		    	$msg = "<span class='error'>Fields must not be Empty!!</span>";
				return $msg;
		    }
		    else {
		    	$query = "update tbl_customer
		    			 set 
		    			 name    ='$name', 
		    			 address ='$address', 
		    			 city    ='$city', 
		    			 zip     ='$zip', 
		    			 phone   ='$phone', 
		    			 email   ='$email'
		    			 where id='$cmrId' ";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Customer Data Updated Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Customer Data Not Updated !!</span>";
					return $msg;
				}
		    }
		}
	}
?>