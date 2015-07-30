

<style type="text/css">
    .panel-heading span
    {
        margin-top: -21px;
        font-size: 15px;
        margin-right: -9px;
    }
    a.clickable { color: inherit; }
    a.clickable:hover { text-decoration:none; }
    .panel-heading{
        padding:12px 25px;
        -webkit-border-radius: 7px; 
        -moz-border-radius: 7px; 
        border-radius: 7px; 
        background-color: #e1e1e1; 
        border: solid 1px #cacaca;
        color:#1d1d1d;
        font-size:18px;
        font-family: 'OpenSansRegular';
    }

    .panel-body{
        padding:25px;
    }
    .panel-heading i{
        font-size:25px;
        color:#fff;
        text-shadow: 0 0 1px rgba(0,0,0,.45);
    }
    .panel{
        box-shadow:none;
        margin:1px 0;
        border-bottom:none;
    }

    .firstleftlable{
        background:url(<?php echo plugins_url('images/firstaccordingtab.png', __FILE__); ?>) no-repeat #e1e1e1;
        background-size: auto 100%;
    }
    .secoendtleftlable{
        background:url(<?php echo plugins_url('images/secoendaccordingtab.png', __FILE__); ?>) no-repeat #e1e1e1;
        background-size: auto 100%;
    }
    .thirdtleftlable{
        background:url(<?php echo plugins_url('images/thirdaccordingtab.png', __FILE__); ?>) no-repeat #e1e1e1;
        background-size: auto 100%;
    }
    .fourtleftlable{
        background:url(<?php echo plugins_url('images/fouraccordingtab.png', __FILE__); ?>) no-repeat #e1e1e1;
        background-size: auto 100%;
    }

</style>
<div id="container">
    <div id="content">

        <?php $color_fim = array('firstleftlable', 'secoendtleftlable', 'thirdtleftlable', 'fourtleftlable'); ?>

        <?php
        $args = array(
            'posts_per_page' => $limit,
            'offset' => 0,
            'category' => '',
            'category_name' => $cat,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'include' => '',
            'exclude' => '',
            'meta_key' => '',
            'meta_value' => '',
            'post_type' => 'faq_in_minute_cat',
            'post_mime_type' => '',
            'post_parent' => 0,
            'post_status' => 'publish',
        );
        $all_data = get_posts($args);

        $post_data_new = get_post($p_id);
        $i = 0;
        $count = 0;

        foreach ($all_data as $a) {

            if ($count == count($color_fim)) {

                $i = 0;
            }

            $np_id = $a->ID;
            if ($np_id != $post_id) {
                $post_data_new = get_post($np_id);
                ?>

                <div class="col-md-12 no-padding">
                    <div class="panel">
                        <div class="panel-heading clickable <?php echo $color_fim[$i] ?>">
                            <h3 class="panel-title">
        <?php echo get_the_title($np_id); ?>
                            </h3>
                            <span class="pull-right "><i class="fa fa-minus-circle"></i></span>
                        </div>
                        <div class="panel-body">
        <?php echo apply_filters('the_content', $post_data_new->post_content); ?>
                        </div>
                    </div>
                </div>

                <br/>
        <?php
    }
    $i++;
    $count++;
}
?> 


    </div>
</div>