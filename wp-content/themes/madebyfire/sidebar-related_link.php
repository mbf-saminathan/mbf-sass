<div class="col-xs-4 generic sidebar--line">
    <div class="asideBorder"></div>
    <?php
                $relPages = MRP_get_related_posts( $post->ID, true, true, 'page' );
                if($relPages){
                    asort($relPages);/****** sleim *****/
                }
                    if(count ($relPages)){
                    echo '<ul>';
                    foreach ($relPages as $relPage){
                      if($relPage->ID!=4) {
            ?>
                <li><a href="<?php echo get_permalink($relPage->ID); ?>"><?php echo $relPage->post_title; ?></a></li>
            <?php
                    }
                  }
                    echo '</ul>';
                  }
                if($post->ID != 756){
                ?>
                <div class="sidebar-summer">

        <?php $sidebar_title = get_post_meta($post->ID, 'sidebar_title',
                true);
        $sidebar_content = get_post_meta($post->ID,
                'sidebar_content_options_design', true);
        ?>
        <?php
        if (isset($sidebar_content) && $sidebar_content != '') {
            if($sidebar_title!=''){
                echo "<h2>" . $sidebar_title . "</h2>";
            }
            echo "<p>" . $sidebar_content . "</p>";
        } else {
            ?>
            <h2>Send us an enquiry</h2>
            <p>If you’d like to know how we can help you accelerate the design and build of your digital product, then please get in touch with us.</p>
    <?php } ?>
        <p><a href="<?php echo get_bloginfo('url'); ?>/contact-us/" class="btn btn-secondary btn-fluid">Contact us</a></p>
    </div>

    <?php

    $rl_link_text = get_post_meta($post->ID, 'rl_link_text', true);
    $rl_link_url = get_post_meta($post->ID, 'rl_link_url', true);
    $link_heading = get_post_meta($post->ID, 'link_heading', true);
    $rl_link_target = get_post_meta($post->ID, 'rl_link_target', true);
    ?>
        <?php if ($link_heading) { ?>

                <ul class="rl_link_list">
            <?php
            if (count($rl_link_text) != 0) {

                if ($link_heading) {
                    ?>
                    <h2><?php echo $link_heading; ?></h2>
                    <?php }
            }
            ?>
    <?php
    for ($j = 0; $j < count($rl_link_text); $j++) {
        if ($rl_link_text[$j] != "") {
            ?>
                    <li><a href="<?php echo $rl_link_url[$j]; ?>" <?php if ($rl_link_target[$j]
                    == '_blank') { ?> target="_blank"<?php } ?>>
                <?php echo $rl_link_text[$j]; ?>
                        </a></li>

            <?php
        }
    }
    ?>
        </ul>
<?php } ?>

    <?php } ?>
</div>
