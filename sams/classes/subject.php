
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php"); 
include_once ($filepath."/../helpers/Format.php"); 
?>
<?php
 class Subject{
	private $db;
	private $fm;

	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
		
	}

	public function catInsert($department, $semester, $subName){
		
        $department = mysqli_real_escape_string($this->db->link,$department);
        $semester = mysqli_real_escape_string($this->db->link,$semester);
        $subName = mysqli_real_escape_string($this->db->link,$subName);

         if(empty($department) || empty($semester) || empty($subName)){
                        $msg = "<span class='error'>Field must not be empty !!</span>";
                        return $msg;
                        
                    }else{
                        $query = "INSERT INTO tbl_subject(department, semester, subName) VALUES('$department', '$semester', '$subName')";
                        $addsubject = $this->db->insert($query);
                    
                    if($addsubject){
                        $msg = "<span class='success'>subject inserted sussesfully</span>";
                        return $msg;
                        
                    }else{
                        $msg = "<span class='error'>subject not inserted</span>";
                        return $msg;
                    }

                    }

	}

	public function getAllSub(){
		$query = "SELECT * from tbl_subject order by Id desc";
					$result = $this->db->select($query);
					return $result;

	}

	
	public function getsubById($id){
		$query = "SELECT * from tbl_subject WHERE id = '$id'";
					$result = $this->db->select($query);
					return $result;
	}
	public function updateSubject($subName, $id){
		            $subName = $_POST['subName'];
					$subName = mysqli_real_escape_string($this->db->link,$subName);
					
					if(empty($subName)){
						$msg= "Field must not be empty !!";
						return $msg;
						
					}else{
						$query = "UPDATE tbl_subject
						SET
						subName='$subName'
						where id='$id'";
						$updated_row = $this->db->update($query);
					
					if($updated_row){
						$msg= "subject updated sussesfully";
						return $msg;
						
					}else{
						$msg= "subject not updated";
						return $msg;
					}

					}
	}

	public function getCategoryPro(){
		$query = "SELECT * from tbl_category order by catId desc";
					$result = $this->db->select($query);
					return $result;
	}

	public function getcatProduct($id){
		     $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product
        INNER JOIN tbl_category
        ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand
        ON tbl_product.brandId = tbl_brand.brandId
        WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
	}
 }

?>