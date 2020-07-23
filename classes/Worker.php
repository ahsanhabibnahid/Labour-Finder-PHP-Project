<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/Database.php");
	include_once ($filepath."/../helpers/Format.php");
?>
 
<?php
	class Worker{
		
		public $db;
		public $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function workerInsert($data,$file){
			$workerName = $this->fm->validation($data['workerName']);
			$workerName = $this->db->link->real_escape_string($data['workerName']);

			$catId = $this->fm->validation($data['catId']);
			$catId = $this->db->link->real_escape_string($data['catId']);

			$topId = $this->fm->validation($data['topId']);
			$topId = $this->db->link->real_escape_string($data['topId']);

			$body = $this->fm->validation($data['body']);
			$body = $this->db->link->real_escape_string($data['body']);

			$price = $this->fm->validation($data['price']);
			$price = $this->db->link->real_escape_string($data['price']);

			$type = $this->fm->validation($data['type']);
			$type = $this->db->link->real_escape_string($data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

		    if ($workerName=="" || $catId=="" || $topId==""|| $body=="" || $price=="" || $type=="" || $file_name=='') {
		    	$msg = "<span class='error'>Fields must not be Empty!!</span>";
				return $msg;
		    }
		    elseif ($file_size >1048567) {
    			 echo "<span class='error'>Image Size should be less then 1MB!</span>";
    		} 
    		elseif (in_array($file_ext, $permited) === false) {
    	 		echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    		}
    		else{
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "insert into 
		    	worker(workerName,catId,topId,body,price,image,type) 
		    	values('$workerName','$catId','$topId','$body','$price','$uploaded_image','$type') ";
		    	$workerInsert = $this->db->insert($query);
				if ($workerInsert) {
					$msg = "<span class='success'>Worker Inserted Successfully!!</span>";
					return $msg;
				}
				else {
					$msg = "<span class='error'>Worker not Inserted!!</span>";
					return $msg;
				}
		    }
		}

		public function getAllWorker(){
			$query = "select worker.* , tbl_category.catName, top_category.topName
				    from worker
				    inner join tbl_category
				    on worker.catId = tbl_category.catId

				    inner join top_category
				    on worker.topId = top_category.topId

				    order by worker.workerId desc";

			$result = $this->db->select($query);
			return $result;
		}

		public function getWorkerById($id){
			$query = "select * from worker where workerId='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function workerUpdate($data,$file,$id){
			$workerName = $this->fm->validation($data['workerName']);
			$workerName = $this->db->link->real_escape_string($data['workerName']);

			$catId = $this->fm->validation($data['catId']);
			$catId = $this->db->link->real_escape_string($data['catId']);

			$topId = $this->fm->validation($data['topId']);
			$topId = $this->db->link->real_escape_string($data['topId']);

			$body = $this->fm->validation($data['body']);
			$body = $this->db->link->real_escape_string($data['body']);

			$price = $this->fm->validation($data['price']);
			$price = $this->db->link->real_escape_string($data['price']);

			$type = $this->fm->validation($data['type']);
			$type = $this->db->link->real_escape_string($data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

		    if ($workerName=="" || $catId=="" || $topId==""|| $body=="" || $price=="" || $type=="" ) {
		    	$msg = "<span class='error'>Fields must not be Empty!!</span>";
				return $msg;
		    }
		    else {

		    	if (!empty($file_name)) {
			    	
				    if ($file_size >1048567) {
		    			 echo "<span class='error'>Image Size should be less then 1MB!</span>";
		    		} 
		    		elseif (in_array($file_ext, $permited) === false) {
		    	 		echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		    		}
		    		else{
				    	move_uploaded_file($file_temp, $uploaded_image);
				    	$query = "update worker
				    			set 
				    			workerName = '$workerName',	
				    			catId      = '$catId',	
				    			topId      = '$topId',	
				    			body       = '$body',	
				    			price      = '$price',	
				    			image      = '$uploaded_image',	
				    			type       = '$type'
				    			where workerId = '$id'	
				    			";

				    	$workerUpdate = $this->db->update($query);
						if ($workerUpdate) {
							$msg = "<span class='success'>Worker Updated Successfully!!</span>";
							return $msg;
						}
						else {
							$msg = "<span class='error'>Worker not Updated!!</span>";
							return $msg;
						}
				    }
				} 
				else {
				    	$query = "update worker
				    			set 
				    			workerName = '$workerName',	
				    			catId      = '$catId',	
				    			topId      = '$topId',	
				    			body       = '$body',	
				    			price      = '$price',
				    			type       = '$type'
				    			where workerId = '$id'	
				    			";

				    	$workerUpdate = $this->db->update($query);
						if ($workerUpdate) {
							$msg = "<span class='success'>Worker Updated Successfully!!</span>";
							return $msg;
						}
						else {
							$msg = "<span class='error'>Worker not Updated!!</span>";
							return $msg;
						}
				}
			}
		}

		public function delWorkerById($id){
			$query = "select * from worker where workerId = '$id' ";
			$getData = $this->db->select($query);
			if ($getData) {
				while ($delImg = $getData->fetch_assoc()) {
					$dellink = $delImg['image'];
					unlink($dellink);
				}
			}

			$delQuery = "delete from worker where workerId='$id'";
			$deldata = $this->db->delete($delQuery);
			if ($deldata) {
				$msg = "<span class='success'>Worker Deleted Successfully!!</span>";
					return $msg;
			}
			else {
					$msg = "<span class='error'>Worker Not Deleted !!</span>";
					return $msg;
			}
		}

		public function getFeaturedWorker(){
			$query = "select * from worker where type='0' order by workerId desc limit 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewWorker(){
			$query = "select * from worker order by workerId desc limit 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleWorker($id){
			$query = " select w.*, c.catName, t.topName
						from worker as w, tbl_category as c, top_category as t
					where w.catId = c.catId and w.topId = t.topId and w.workerId='$id'
					";

					/*
					"select worker.* , tbl_category.catName, top_category.topName
				    from worker
				    inner join tbl_category
				    on worker.catId = tbl_category.catId

				    inner join top_category
				    on worker.topId = top_category.topId

				    order by worker.workerId desc";
				    */

			$result = $this->db->select($query);
			return $result;
		}

		public function latestFromFridge(){
			$query = "select * from worker where topId='5' order by workerId desc limit 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function latestFromAir (){
			$query = "select * from worker where topId='4' order by workerId desc limit 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function latestFromComputer (){
			$query = "select * from worker where topId='2' order by workerId desc limit 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function latestFromElectrician(){
			$query = "select * from worker where topId='1' order by workerId desc limit 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function workerByCat($id){
			$id = $this->db->link->real_escape_string($id);
			$query = "select * from worker where catId='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function searchData($searchId){
			$searchId = strtolower($searchId);
			if ($searchId=='electrician') {
				$query = "select * from worker where catId='1'";
				$result = $this->db->select($query);
				return $result;
			} elseif ($searchId=='computer') {
				$query = "select * from worker where catId='2'";
				$result = $this->db->select($query);
				return $result;
			}elseif ($searchId=='gas') {
				$query = "select * from worker where catId='3'";
				$result = $this->db->select($query);
				return $result;
			}elseif ($searchId=='ac') {
				$query = "select * from worker where catId='4'";
				$result = $this->db->select($query);
				return $result;
			}elseif ($searchId=='fridge') {
				$query = "select * from worker where catId='5'";
				$result = $this->db->select($query);
				return $result;
			}elseif ($searchId=='mobile') {
				$query = "select * from worker where catId='6'";
				$result = $this->db->select($query);
				return $result;
			}elseif ($searchId=='television') {
				$query = "select * from worker where catId='7'";
				$result = $this->db->select($query);
				return $result;
			}
		}
	}
?>