<?php
/**
 * Plugin Name: Ba TEST
 * Plugin URI: http://igiuk.com/babylon-3d-wordpress/
 * Description: sdfsdf <a href="admin.php?page=batest/includes/mfp-first-acp-page.php">sdf</a>
 * Version: 0.1
 * Text Domain: batest
 * Author: Andrei Stepanov
 * Author URI: http://igiuk.com/babylon-3d-wordpress/
 */

// SECURITY: to ensure PHP execution is only allowed when it is included as part of the core system.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Adding Babylon Viewer into header
function babylonjs_call() {
wp_enqueue_script( 'babylon-js', esc_url_raw( 'https://preview.babylonjs.com/babylon.js' ), array(), null, false);

wp_enqueue_script( 'babylon-loaders', esc_url_raw( 'https://preview.babylonjs.com/loaders/babylonjs.loaders.js' ), array(), null, false);

wp_enqueue_script( 'babylon-ammo', esc_url_raw( 'https://preview.babylonjs.com/ammo.js' ), array(), null, false);
wp_enqueue_script( 'babylon-procedural', esc_url_raw( 'https://preview.babylonjs.com/proceduralTexturesLibrary/babylonjs.proceduralTextures.min.js' ), array(), null, false);
wp_enqueue_script( 'babylon-gui', esc_url_raw( 'https://preview.babylonjs.com/gui/babylon.gui.min.js' ), array(), null, false);
wp_enqueue_script( 'babylon-materials', esc_url_raw( 'https://preview.babylonjs.com/materialsLibrary/babylonjs.materials.min.js' ), array(), null, false);
wp_enqueue_script( 'babylon-pep', esc_url_raw( 'https://code.jquery.com/pep/0.4.2/pep.min.js' ), array(), null, false);

}

add_action( 'wp_enqueue_scripts', 'babylonjs_call' );

function diwp_metabox_mutiple_fields(){
 
    add_meta_box(
            'diwp-metabox-multiple-fields',
            'BabylonJS PlayGround in Wordpress',
            'diwp_add_multiple_fields',
            array('post', 'page')
        );
}
 
add_action('add_meta_boxes', 'diwp_metabox_mutiple_fields');
 

/**
 * Enqueue a script in the WordPress admin on edit.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function wpdocs_selectively_enqueue_admin_script( $hook ) {

wp_enqueue_script( 'babylon-js', esc_url_raw( 'https://preview.babylonjs.com/babylon.js' ), array(), null, false);
wp_enqueue_script( 'babylon-materials', esc_url_raw( 'https://preview.babylonjs.com/materialsLibrary/babylonjs.materials.min.js' ), array(), null, false);
wp_enqueue_script( 'babylon-loaders', esc_url_raw( 'https://preview.babylonjs.com/loaders/babylonjs.loaders.js' ), array(), null, false);
wp_enqueue_script( 'babylon-procedural', esc_url_raw( 'https://preview.babylonjs.com/proceduralTexturesLibrary/babylonjs.proceduralTextures.min.js' ), array(), null, false);
wp_enqueue_script( 'babylon-gui', esc_url_raw( 'https://preview.babylonjs.com/gui/babylon.gui.min.js' ), array(), null, false);


}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );



function diwp_add_multiple_fields(){
 
    global $post;
 
    // Get Value of Fields From Database
    $diwp_textfield = get_post_meta( $post->ID, '_diwp_text_field', true);
    $diwp_radiofield = get_post_meta( $post->ID, '_diwp_radio_field', true);
    $diwp_checkboxfield = get_post_meta( $post->ID, '_diwp_checkbox_field', true);
    $diwp_selectfield = get_post_meta( $post->ID, '_diwp_select_field', true);
    $diwp_textareafield = get_post_meta( $post->ID, '_diwp_textarea_field', true);
    $diwp_textauthor = get_post_meta( $post->ID, '_diwp_textauthor', true);
    $diwp_imageauthor = get_post_meta( $post->ID, '_diwp_imageauthor', true);
    $diwp_linkauthor = get_post_meta( $post->ID, '_diwp_linkauthor', true);
     
?>
     



<section>
    <style>
#diwp-metabox-multiple-fields {background: ; width: 100%;height: 100%;}

input,textarea{width:100%;display:block}
            canvas {
                outline: none; outline-width: 0px;
            }
.pglogo {width: 50px;height: 50px;}

/*
body {touch-action:auto !important;

}
*/
    </style>


<div class="row">
    <div class="label">Select Dropdown</div>
    <div class="fields" <?php if($diwp_selectfield == '1') echo 'style="background: green"'; 
    if($diwp_selectfield == '2') echo 'style="background: red"';
    if($diwp_selectfield == '') echo 'style="background: orange"';
     ?>  >
        <select name="_diwp_select_field">
            <option value="">Select Option</option>
            <option value="1" <?php if($diwp_selectfield == '1') echo 'selected'; ?>>Enable Canvas</option>
            <option value="2" <?php if($diwp_selectfield == '2') echo 'selected'; ?>>Disable Canvas</option>
        </select>
    </div>
</div>
 
<br/>



<div class="row">
    <div class="label">Choose Babylon JS source (Local / CDN / Preview)</div>
    <div class="fields">
        <label><input type="radio" name="_diwp_radio_field" value="R1" <?php if($diwp_radiofield == 'R1') echo 'checked'; ?> /> Use local version </label>
        <label><input type="radio" name="_diwp_radio_field" value="R2"  <?php if($diwp_radiofield == 'R2') echo 'checked'; ?> /> Use CDN version</label>
        <label><input type="radio" name="_diwp_radio_field" value="R3"  <?php if($diwp_radiofield == 'R3') echo 'checked'; ?>/> Use preview version</label> 
    </div>
</div>
 
<br/>

<div class="row">
    <div class="label">Check what do you need</div>
    <div class="fields">
        <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C1" <?php if($diwp_checkboxfield[0] == 'C1') echo 'checked'; ?> /> Use Loaders</label>
        <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C2" <?php if($diwp_checkboxfield[1] == 'C2') echo 'checked'; ?>/> Use GUI</label>
        <label><input type="checkbox" name="_diwp_checkbox_field[]" value="C3" <?php if($diwp_checkboxfield[2] == 'C3') echo 'checked'; ?>/> Use Procedural Textures</label>
    </div>
</div>




 


<?php 
// var_dump($diwp_checkboxfield);

?>


<br/>
 




<div class="row"> 
    <div class="label">Put PlayGround content here</div>
    <div class="fields">
        <textarea rows="15" name="_diwp_textarea_field" style="width: 100%; max-width: 100%;"><?php echo $diwp_textareafield; ?></textarea>
    </div>
</div>

<br/>


<div class="row">
    <div class="label">Source link</div>
    <div class="fields"><input type="text" size="50" name="_diwp_text_field" value="<?php echo $diwp_textfield; ?>"</div>
</div>
 
<br/>



<div class="row">
    <div class="label">Author</div>
    <div class="fields"><input type="text" size="50" name="_diwp_textauthor" value="<?php echo $diwp_textauthor; ?>"</div>
</div>
 
<br/>


<div class="row">
    <div class="label">Author's Image Link</div>
    <div class="fields"><input type="text" size="50" name="_diwp_imageauthor" value="<?php echo $diwp_imageauthor; ?>"</div>
</div>
 
<br/>

<div class="row">
    <div class="label">Author's Profile Link</div>
    <div class="fields"><input type="text" size="50" name="_diwp_linkauthor" value="<?php echo $diwp_linkauthor; ?>"</div>
</div>
 
<br/>



 
<?php    
}

// Now Save these multiple fields value in the Database
 
function diwp_save_multiple_fields_metabox(){
 
    global $post;
 
 
    if(isset($_POST["_diwp_text_field"])) :
    update_post_meta($post->ID, '_diwp_text_field', $_POST["_diwp_text_field"]);
    endif;
 
    if(isset($_POST["_diwp_textauthor"])) :
    update_post_meta($post->ID, '_diwp_textauthor', $_POST["_diwp_textauthor"]);
    endif;

    if(isset($_POST["_diwp_imageauthor"])) :
    update_post_meta($post->ID, '_diwp_imageauthor', $_POST["_diwp_imageauthor"]);
    endif;
 
    if(isset($_POST["_diwp_linkauthor"])) :
    update_post_meta($post->ID, '_diwp_linkauthor', $_POST["_diwp_linkauthor"]);
    endif;

    if(isset($_POST["_diwp_radio_field"])) :
    update_post_meta($post->ID, '_diwp_radio_field', $_POST["_diwp_radio_field"]);
    endif;
 
    if(isset($_POST["_diwp_checkbox_field"])) :
    update_post_meta($post->ID, '_diwp_checkbox_field', $_POST["_diwp_checkbox_field"]);
    endif;
 
    if(isset($_POST["_diwp_select_field"])) :
    update_post_meta($post->ID, '_diwp_select_field', $_POST["_diwp_select_field"]);
    endif;
 
    if(isset($_POST["_diwp_textarea_field"])) :
    update_post_meta($post->ID, '_diwp_textarea_field', $_POST["_diwp_textarea_field"]);
    endif;
 
}
 
add_action('save_post', 'diwp_save_multiple_fields_metabox');


add_filter( 'the_content', 'filter_the_content_in_the_main_loop', -1 );
 
function filter_the_content_in_the_main_loop( $content ) {
   
    // Check if we're inside the main loop in a post or page.
    if ( ( is_single() || is_page() ) && in_the_loop() && is_main_query() ) {
 
$enablecanvas = get_post_meta( get_the_ID(), '_diwp_select_field', true);

//#######################################################################
if ($enablecanvas == 1) {

 $playground_link = get_post_meta( get_the_ID(), '_diwp_text_field', true);
 $playground_author = get_post_meta( get_the_ID(), '_diwp_textauthor', true);
 $image_author =  get_post_meta( get_the_ID(), '_diwp_imageauthor', true);
 $link_author =  get_post_meta( get_the_ID(), '_diwp_linkauthor', true);

 $baplayground = get_post_meta( get_the_ID(), '_diwp_textarea_field', true);

$createscene = 'createScene';

$checkscene = strpos($baplayground, $createscene);

if (!$checkscene === false) {
  // echo "The string '$createscene' was found in the string "; echo " and exists at position $pos";
} else {
        $createscene ='delayCreateScene';
   // echo "The string '$createscene' was not found in the string ";
}



$canvasid = get_the_ID();
// var_dump($canvasid);
 $bacanvas = '<canvas id="renderCanvas-'.$canvasid. '" class="stopscroll" ></canvas>'.'<style>canvas { width:100%;height:100%;touch-action:none;outline: none;}</style>';
 $babegin = '<script>
        var canvas = document.getElementById("renderCanvas-'.$canvasid.'");

        var engine = null;
        var scene = null;
        var sceneToRender = null;
        var createDefaultEngine = function() { return new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true }); };



        // Resize
        window.addEventListener("resize", function () {
            engine.resize();
        });
';

$baend = ' 
var engine;

    try {
    engine = createDefaultEngine();
    } catch(e) {
    console.log("the available createEngine function failed. Creating the default engine instead");
    engine = createDefaultEngine();
    }

        if (!engine) throw "engine should not be null.";



    //    scene = delayCreateScene ();

        scene = ' . $createscene . '();

        sceneToRender = scene;
                engine.runRenderLoop(function () {
            if (sceneToRender) 
            	if (sceneToRender.activeCamera){

            {
                sceneToRender.render();
            }
        }
        });

// renderCanvas.addEventListener("wheel", evt => evt.preventDefault());

    </script>';



  $canvasresize = '<canvas id="renderCanvas-'.$canvasid; 


if($playground_link) {

$pglogo = 'https://raw.githubusercontent.com/BabylonJS/Brand-Toolkit/master/babylon_logo/fullColor/babylon_logo_color.png';
$pglogo = '<img class="pglogo" style="width: 90px;height: 90px;margin-left:-15px;" src="'. $pglogo . '">';
$playground_link = '<div class="playground_link"><a href="'.$playground_link. '" rel="nofollow" target="_blank">'. $pglogo . '<strong>Source Code:</strong> ' . $playground_link . '</a></div>';
} // playground_link condition

if($image_author) {

$image_author = '<img src="' . $image_author . '" style="width:60px; margin-top:10px; margin-right:10px; border-radius: 50%;border-top-left-radius: 50%;
    border-top-right-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;"/>';
} // // image_author  condition

if($playground_author) {
$playground_author = '<strong>Made by</strong> ' . $playground_author;
}


return  $bacanvas . $babegin . $baplayground . $baend . $content . $playground_link  . $image_author . '<a href="'. $link_author . '" target="_blank" rel="nofollow">' . $playground_author . '</a>';

    }
    return $content;
}


    } // END ENABLED CONDITION


/*
add_action('wp_footer',function(){
        global $wp_filter;
        printf('<pre>%s</pre>',print_r( $wp_filter['the_content'],true));
});
*/
add_action('init','custom_init');
function custom_init() {
    remove_filter('the_content', 'wpautop');
    remove_filter('the_content', 'wptexturize');
    remove_filter('the_content', 'convert_chars');
    remove_filter('the_content', 'convert_smilies');
}

add_action( 'wp_footer', function () { ?>

    <script language="javascript" type="text/javascript">

    </script>

<?php } );