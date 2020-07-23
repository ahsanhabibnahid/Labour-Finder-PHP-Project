<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Top.php' ; ?>
<?php
    if (!isset($_GET['topid']) || $_GET['topid'] == NULL) {
        echo "<script>window.location='toplist.php';</script> ";
    }
    else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '' ,  $_GET['topid']);
    }
    $top = new Top();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $topName = $_POST['topName'];
        $updateTop = $top->topUpdate($topName,$id);
    }
?>      
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Top Category</h2>
               <div class="block copyblock"> 
                <?php
                    if (isset($updateTop)) {
                        echo $updateTop;
                    }
                ?>
                <?php
                    $getTop = $top->getTopById($id);
                    if ($getTop) {
                        while ($result = $getTop->fetch_assoc()) {
                   
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="topName" value="<?php echo      $result['topName'];?>" class="medium" />
                            </td>
                        </tr> 
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php

                            }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>