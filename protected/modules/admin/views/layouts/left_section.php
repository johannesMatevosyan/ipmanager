<nav id="sidebar" class="sidebar nav-collapse collapse">
    <?php $this->widget('zii.widgets.CMenu',array(
        'htmlOptions' => array( 'class' => 'side-nav','id'=>"side-nav"),
        'encodeLabel'=>false,
        'activeCssClass'=>'active',
        'items'=>array(
            array('label'=>'<i ></i><span>Subnets</span>', 'url'=>array('/admin/subnet/getSubnetList')),
            array('label'=>'<i ></i><span>Websites</span>', 'url'=>array('/admin/website/getWebsiteList')),
            array('label'=>'<i ></i><span>Users</span>', 'url'=>array('/admin/users/getUserList')),
         ),
     )); ?>
</nav>