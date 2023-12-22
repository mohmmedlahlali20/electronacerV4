<?php 
require_once 'categoryDAO.php';
 $category = new categoryDAO();
 $categorys= $category->get_categorys();
 require_once 'HEAD.php';
?>

    <h1>Liste des category</h1>
    <div class="container "><a  class="btn btn-primary " href="ajout_category.php">ajout category</a></div>
    <table class="table table-bordred">
    <tr class="table ">
               
               <th class="p-3  border-black" scope="col">category_id</th>
               <th class="p-3  border-black" scope="col">category_name</th>
               <th class="p-3 border-black" scope="col">category_imag</th>
               <th class="p-3  border-black" scope="col">delete/modify</th>
           </tr>
        <?php
            foreach( $categorys as $cat1){?>
                   <tr> 
                    <td><?=$cat1->getCategoryId()?></td>
                    <td><?=$cat1->getCategoryName()?></td>
                    <td><img  src="images/<?=$cat1->getImageCategory()?>" alt='category img' width="100px" ></td>
                    <td>
                        <div class="d-flex mx-1">
                         <form method="post" action="disayble_category.php"> 
                          <input type="hidden" name="category_id" value="<?=$cat1->getCategoryId()?>" />
                            <button type="submit" class="btn btn-danger" name="delete_category">Delete</button>
                         </form>
                         

                         
                         <form method="post" action="modify_cat.php"> 
                          <input type="hidden" name="category_id" value="<?=$cat1->getCategoryId()?>" />
                            <button type="submit" class="btn btn-primary" name="modify_category">modify</button></td>
                         </form>
                         </div>
                    </td>
                </tr>
          <?php  }
        ?>
            
    </table>
</body>
</html>


