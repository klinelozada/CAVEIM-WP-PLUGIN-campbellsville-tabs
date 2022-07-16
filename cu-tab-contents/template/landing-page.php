<?php get_header(); ?>

<style>
    .main-col {
        width:100%;
        padding-left:0;
        padding-right:0;
    }
    .main-col h1,
    .side-col,
    .breadcrumb {
        display:none;   
    }
    .content-wrapper {
        padding-top:0;
    }
    .tab {
        padding: 0px 20vw;
        overflow: hidden;
        background-color: #860D20;
    }
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
    /*  padding: 24px 26px; Original */
        padding:14px 16px;
        transition: 0.3s;
    /*  font-size: 20px; Original */
        font-size:15px;
        text-transform:uppercase;
        font-weight:600;
        color:#fff;
    }
    .tab button:hover {
        background-color: #680917;
    }
    .tab button.active {
        color:#860D20;
        background-color: #fff;
    }
    .tabcontent {
        display: none;
        padding: 40px 20vw;
        border:none;
    }

    /* Header and Buttons */
    .tab-header {
        background-size: cover;
        padding: 26vh;
    }
    .tab-buttons a {
        position:relative;
        background-color:#f1970d;
        background-repeat:no-repeat;
        border:solid 4px #f29d1c;
        color:#fff;
        padding:15px 30px;
        border-radius:30px;
        display:inline-block;
        margin:5px;
        text-decoration:none;
        text-transform:uppercase;
        font-weight:700;
        font-size:20px;
        letter-spacing:0.5px;
        text-indent:25px;
        text-shadow: 0px 1px 0px rgba(251, 126, 16, 1);
        -webkit-box-shadow: 0px 3px 4px 0px rgba(0,0,0,0.2);
        -moz-box-shadow: 0px 3px 4px 0px rgba(0,0,0,0.2);
        box-shadow: 0px 3px 4px 0px rgba(0,0,0,0.2);
        transition:all .5s ease-in-out !important;
        -webkit-transition:all .5s ease-in-out !important;
        -o-transition:all .5s ease-in-out !important;
        -moz-transition:all .5s ease-in-out !important;
    }
    .tab-buttons a.tab-link-logo {
        background-image:url('https://www.campbellsville.edu/wp-content/uploads/2020/08/landing-page-3.jpg');
        background-position:8px 0;
    }
    .tab-buttons a.tab-link-covid {
        background-image:url('https://www.campbellsville.edu/wp-content/uploads/2020/08/landing-page-4.jpg');
        background-position:2px 0;
    }
    .tab-buttons a:hover {
    top:-2px;
    }
    /* Tablet */
    @media only screen and (min-width:720px) and (max-width:820px) {
        .tab-header {
            background-position:-10px;
        }
        .tab-buttons a {
            font-size:16px;
        }
        .tab-header{
            padding:10vh 5vw;
        }
        .tab {
            padding:0px 5vw;
        }
        .tab button {
            font-size:16px;
            padding:20px 25px;
        }
        .tabcontent {
            padding:30px 8vw;
        }
    }
    /* Mobile */
    @media only screen and (min-width:350px) and (max-width:470px) {
        .tab-header {
            background-position:-295px;
        }
        .tab-buttons a {
            font-size:14px;
        }
        .tab-header{
            padding:10vh 5vw;
        }
        .tab {
            padding:0px 0vw;
        }
        .tab button {
            font-size:14px;
            padding:15px 18px;
        }
        .tabcontent {
            padding:40px 5vw;
        }
    }
</style>

    <div class="page-section default-interior">

        <?php
            $cu_meta_boxes = rwmb_meta( 'tab_items' );

            $cu_template_override = rwmb_meta( 'tab_template' );
            if ( empty( $cu_template_override ) ){
                $cu_template_override = 0;
            }
            
            $cu_header_img = rwmb_meta( 'tab_header_banner' );
            if ( empty( $cu_meta_boxes ) ){
                $cu_header_img = 'https://www.campbellsville.edu/wp-content/uploads/2020/08/landing-page-2.jpg';
            }
        ?>

        <div class="tab-header" style="background-image: url('<?php print_r($cu_header_img); ?>');"></div>

        <?php if ( ! empty( $cu_meta_boxes ) ): ?>
            <div class="tab">
                <?php $i = 0;?>
                <?php foreach($cu_meta_boxes as $cu_box): ?>
                    <?php $i++; ?>
                    <button <?php echo ( $i == 1 ? 'id="defaultOpen"' : '' ); ?> class="tablinks" onclick="openTab(event, '<?php print_r($cu_box['tab_id']); ?>')"><?php print_r($cu_box['tab_title']); ?></button>
                <?php endforeach; ?>
            </div>

            <div class="tab-content-cu">
                <?php foreach($cu_meta_boxes as $cu_box): ?>
                    <div id="<?php print_r($cu_box['tab_id']); ?>" class="tabcontent"><?php echo do_shortcode(wpautop($cu_box['tab_contents'])); ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

<script type="text/javascript">

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    $('.tab-display').removeClass("tab-display");

</script>

<?php get_footer(); ?>