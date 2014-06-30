<script>
    $(document).ready(function(){
        $('.bxslider').bxSlider({
          minSlides: 2,
          maxSlides: 6,
          slideWidth: 170,
          //slideMargin: 10,
//          auto: true,
          moveSlides: 1,
          pager: false,
          controls: false,
          auto: true,
          infiniteLoop: true
        });
    });
</script>
<div class="borderBanner">
    <ul class="bxslider">
        <?php
            foreach ($model_slider as $value)
            {
        ?>
                <li> 
                    <a class="boxContent" <?php echo !empty($value->link)?'href="'.$value->link.'" target="_blank"':''; ?>>
                        <img src="<?php echo $this->assets."/upload_logo/".$value->path; ?>" />
                    </a> 
                </li>
        <?php
            }
        ?>
    </ul>
</div>