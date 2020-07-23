<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Top.php' ; ?>
<?php
    $top = new Top();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $topName = $_POST['topName'];
        $insertTop = $top->topInsert($topName);
    }
?>      
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add Top Category</h2>
               <div class="block copyblock"> 
<?php
    if (isset($insertTop)) {
        echo $insertTop;
    }
?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="topName" placeholder="Enter Top Category..." class="medium" />
                            </td>
                        </tr> 
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>