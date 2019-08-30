<?php 
/**
 * categories
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php'); 
?> 

  <?php $this->need('sidebar.php');?>
            
         <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
   <article>
<div id="post" class="post">
<h1 class="title"> <?php $this->title() ?>
</h1><div class="meta">

</div><div class="content">


<div class="tags"> 
<section> 
                   <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                    <?php while($categorys->next()): ?>
                        <?php if ($categorys->levels === 0): ?>
                            <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                            <?php if (empty($children)) { ?>
                             
                                    <a href="#posts-list-<?php $categorys->slug(); ?>" class=""  data-category="<?php $categorys->name(); ?>" ><?php $categorys->name(); ?>&nbsp;[<?php $categorys->count(); ?>]
                                        </a>
                                
                            <?php } ?>
                        <?php endif; ?>
                    <?php endwhile; ?>

 <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                    <?php while($categorys->next()): ?>
                        <?php if ($categorys->levels === 0): ?>
                            <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                            <?php if (empty($children)) { ?>
                        <?php } else { ?>
                            <br>
 <a class="tag tag--primary tag--small t-link"  data-category="<?php $categorys->name(); ?>"  onclick="var fu = document.getElementById('<?php $categorys->name(); ?>'); if (fu.style.display === 'none') {fu.style.display='inline';} else {fu.style.display='none'}"  target="_blank"><?php $categorys->name(); ?>&nbsp;<span class="icon-you"></span>
                                        </a>
                                 <div id="<?php $categorys->name(); ?>" style="display: none;">
                                        <?php foreach ($children as $mid) { ?>
                                            <?php $child = $categorys->getCategory($mid); ?>
                                           

<a href="#posts-list-<?php echo $child['slug']; ?> " class="tag tag--primary tag--small t-link"  data-category="<?php echo $child['name']; ?>" ><?php echo $child['name']; ?>(<?php echo $child['count']; ?>)</a>
                                         
                                        <?php } ?>
                                   </div>
                            <?php } ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
</section>
</div> 
 
    
   
            <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
<?php while ($categories->next()): ?>
<?php if(count($categories->children) === 0): ?>

<?php $this->widget('Widget_Archive@category-' . $categories->mid, 'pageSize=9999&&type=category', 'mid=' . $categories->mid)->to($posts); ?>  
<div id="posts-list-<?php $categories->name(); ?>" class="archive box" data-category="<?php $categories->name(); ?>">

             
                    <h4 class="archive-title">
                        <a href="<?php $categories->permalink(); ?>" class="guidang" id="posts-list-<?php $categories->slug(); ?>"><?php $categories->name(); ?></a>
                    </h4>
                    <ul class="archive-posts archive-month">
<?php while ($posts->next()): ?> 
                            <li class="archive-day">
                                <a class="guidang" href="<?php $posts->permalink(); ?>"><?php $posts->title(40); ?></a>
                                <span class="date"><?php $posts->date(); ?></span>
                            </li>
                        
                        
                           
<?php endwhile; ?>
                        
                    </ul>
                </div>
<?php else: ?>

<?php endif; ?>
         <?php endwhile; ?>


</div>
</div>
</article> 
 <?php $this->need('footer.php');?>