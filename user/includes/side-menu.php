<?php
    // include('model/usermodel.php');
    // $obj = new userportal;

    // $category = $obj->fetch_category();
?>

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <li class="dropdown menu-item">

                <?php foreach($category as $row) {?>

                <a href="category.php?cid=<?php echo $row['id'];?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>

                <?php echo $row['category'];?></a>
                <?php }?>           
            </li>
        </ul>
    </nav>
</div>