<?php
/*
Plugin Name: CSV Products Importer
Description: Import data from a CSV file. 
Version:1.0
Author: Daniel Andrei - Adrian
*/

class CSVImporterPlugin {
   
    /**
     * Plugin's interface
     *
     * @return void
     */
    function form() {
       // var_dump_pre(unserialize('a:14:{i:0;s:10:"_prod_type";i:1;s:7:"ID_item";i:2;s:5:"price";i:3;s:13:"discount_type";i:4;s:22:"bundle_discount_option";i:5;s:14:"add_attributes";i:6;s:10:"attr_group";i:7;s:11:"pers_single";i:8;s:8:"item_tax";i:9;s:18:"item_attr_Material";i:10;s:15:"item_attr_Color";i:11;s:20:"item_attr_Trim Color";i:12;s:24:"item_attr_Monogram Style";i:13;s:18:"item_pers_single_1";}'));

        if ('POST' == $_SERVER['REQUEST_METHOD']) {
         if (empty($_FILES['csv_import']['tmp_name'])) {
            $this->log['error'][] = 'No file uploaded, aborting.';
            $this->print_messages();
            return;
        }

        require_once 'File_CSV_DataSource/DataSource.php';

        $time_start = microtime(true);
        $csv = new File_CSV_DataSource;
        $file = $_FILES['csv_import']['tmp_name'];
        $this->stripBOM($file);

        if (!$csv->load($file)) {
            $this->log['error'][] = 'Failed to load file, aborting.';
            $this->print_messages();
            return;
        }

        // var_dump_pre($_POST);die;

        $post_status = 'publish';
        if($_POST['post_status'] == 'draft'){

            $post_status = 'draft';
        }

        // pad shorter rows with empty values
        $csv->symmetrize();
        $import = 0;
         // echo '<pre>';var_dump($csv->connect());die;
            foreach ($csv->connect() as $csv_data) {

                    $post  = array(

                        'post_title'     => $csv_data['Product Name'],
                        'post_content'   => $csv_data['Product Descripion'],
                        'post_status'    => $post_status

                        );

                    $post_id = wp_insert_post($post, $wp_error);


                    if(is_wp_error($post_id)){

                        $this->log['error'][] =  $post_id->get_error_message();


                    }else{
                        unset($ecommerce_meta_fields);

                        if($csv_data['Item ID']){

                            add_post_meta($post_id, 'ID_item',$csv_data['Item ID']);
                            $ecommerce_meta_fields[] = 'ID_item';
                        }
                         if($csv_data['Price']){

                            add_post_meta($post_id, 'price',$csv_data['Price']);
                            $ecommerce_meta_fields[] = 'price';
                        }
                         if($csv_data['Categories']){

                            $category = get_term_by('name', $csv_data['Categories'],'category');
                            if(!$category){

                                $category = wp_insert_term($csv_data['category'],'category');
                            }

                            if(!is_wp_error($category)){

                                wp_set_post_terms( $post_id, $category, 'category');

                            }

                        }
                         if($csv_data['Selections']){

                             wp_set_post_terms( $post_id, $csv_data['Selections'], 'selection' );
                         }   
                         if($csv_data['Brands']){

                             wp_set_post_terms( $post_id, $csv_data['Brands'], 'brand' );
                         } 

                         if($csv_data['Option 1 Name']){

                            add_post_meta($post_id,"item_attr_".$csv_data['Option 1 Name'],str_replace(',', '|', $csv_data['Option 1']));
                            $ecommerce_meta_fields[] = "item_attr_".$csv_data['Option 1 Name'];
                            $attr_group[0]['attr_name'] =$csv_data['Option 1 Name']; 
                            $attr_group[0]['attr_options'] =$csv_data['Option 1']; 
                         }
                         if($csv_data['Option 2 Name']){
                            
                            add_post_meta($post_id,"item_attr_".$csv_data['Option 2 Name'],str_replace(',', '|', $csv_data['Option 2']));
                            $ecommerce_meta_fields[] = "item_attr_".$csv_data['Option 2 Name'];
                            $attr_group[1]['attr_name'] =$csv_data['Option 2 Name']; 
                            $attr_group[1]['attr_options'] =$csv_data['Option 2'];                          }
                         if($csv_data['Option 3 Name']){
                            
                            add_post_meta($post_id,"item_attr_".$csv_data['Option 3 Name'],str_replace(',', '|', $csv_data['Option 3']));
                            $ecommerce_meta_fields[] = "item_attr_".$csv_data['Option 3 Name'];
                            $attr_group[2]['attr_name'] =$csv_data['Option 3 Name']; 
                            $attr_group[2]['attr_options'] =$csv_data['Option 3']; 
                         }



                         if($csv_data['Link to']){
                            
                            add_post_meta($post_id,"item_attr_Link To",str_replace(',', '|', $csv_data['Link to']));
                            $ecommerce_meta_fields[] = "item_attr_Link To";

                         }

                         

                         $text_fields = array();
                         if($csv_data['Text Fields']){
                            $parts = explode(',',$csv_data['Text Fields']);

                            foreach($parts as $key => $value){

                                $count = $key+1;
                                add_post_meta($post_id, "item_pers_single_".$count, $value);
                                $ecommerce_meta_fields[] = "item_pers_single_".$count;

                                $text_fields[$key]['item_pers_single'] = $value; 

                            }
                         }

                         if($csv_data['Supplimentary Info URL']){
                            
                            add_post_meta($post_id,"supplementary_info", $csv_data['Supplimentary Info URL']);
                             $ecommerce_meta_fields[] = "supplementary_info";
                         }
                         if($csv_data['Supplementary Info Text']){
                             $ecommerce_meta_fields[] = "supplementary_info_text";
                            add_post_meta($post_id,"supplementary_info_text", $csv_data['Supplementary Info Text']);
                         }
                         if($csv_data['Shipping']){
                            
                            add_post_meta($post_id,"item_shipping", $csv_data['Shipping']);
                             $ecommerce_meta_fields[] = "item_shipping";
                         }
                         // var_dump_pre($csv_data['Image Name'],$post_id);
                         if($csv_data['Image Name']){
                            
                            $parts = explode (',', $csv_data['Image Name']);

                            foreach($parts as $image){

                            $image_name = sanitize_file_name($image);
                           $image_name = str_replace('-', '_', $image_name);
                            $wp_upload_dir = wp_upload_dir();
                            $filename = $wp_upload_dir['basedir'].'/images/'.$image_name.'.jpg';

                            // var_dump_pre(file_get_contents($wp_upload_dir['baseurl'] . '/' .basename( $filename )));

                             if(@file_get_contents($wp_upload_dir['baseurl'] . '/images/' . basename( $filename ))){
                                   
                                 $wp_filetype = wp_check_filetype($filename, null );
                                 // var_dump_pre($wp_filetype); 
                                $attachment = array(
                                 'guid' => $wp_upload_dir['baseurl'] . '/images/' . basename( $filename ), 
                                 'post_mime_type' => $wp_filetype['type'],
                                 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                 'post_content' => '',
                                 'post_status' => 'inherit'
                                 );
                                  // $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
                                  // you must first include the image.php file
                                  // for the function wp_generate_attachment_metadata() to work
                                  //require_once(ABSPATH . 'wp-admin/includes/image.php');
                                  
                                  // wp_update_attachment_metadata( $attach_id, $attach_data );


                                $upload    = wp_handle_upload($filename, array('test_form' => false));
                                // var_dump_pre($upload);
                                $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
                                $attach_data = wp_generate_attachment_metadata( $attach_id, $filename);
                                wp_update_attachment_metadata( $attach_id,  $attach_data ); 
                                //var_dump_pre($image_name);
                              }

                            }
                         }
                          $ecommerce_meta_fields[] = 'attr_group';
                          $ecommerce_meta_fields[] = 'pers_single';
                          $ecommerce_meta_fields[] = '_prod_type';
                          $ecommerce_meta_fields[] = 'item_tax';
                          $ecommerce_meta_fields[] = 'discount_type';
                          $ecommerce_meta_fields[] = 'bundle_discount_option';
                          $ecommerce_meta_fields[] = 'add_attributes';

                         add_post_meta($post_id ,'ecommerce_meta_fields', $ecommerce_meta_fields);
                         add_post_meta($post_id ,'pers_single', $text_fields);
                         add_post_meta($post_id ,'attr_group', $attr_group);
                        $import++;
                    }
                    
                

            }

            if (file_exists($file)) {
                @unlink($file);
            }

            if($import == 0){

                 $this->log['error'][] =  'No products inserted please check if the file is empty';

            }
            else{
                 $this->log['notice'][] =  'The import inserted '.$import.' terms';
            }

         $this->print_messages();
        }


        // form HTML {{{
?>

<div class="wrap">
    <h2>Import CSV</h2>
    <form class="add:the-list: validate" method="post" enctype="multipart/form-data">
        <!-- Import as draft -->
        <p>
        <label><input name="post_status" type="checkbox" value="draft" /> Import posts as drafts</label>
        </p>

        <!-- File input -->
        <p><label for="csv_import">Upload file:</label><br/>
            <input name="csv_import" id="csv_import" type="file" value="" aria-required="true" /></p>
        <p class="submit"><input type="submit" class="button" name="submit" value="Import" /></p>
    </form>
</div><!-- end wrap -->

<?php

        // end form HTML }}}
 
    }

    function print_messages() {
        if (!empty($this->log)) {

        // messages HTML {{{
?>

<div class="wrap">
    <?php if (!empty($this->log['error'])): ?>

    <div class="error">

        <?php foreach ($this->log['error'] as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>

    <?php if (!empty($this->log['notice'])): ?>

    <div class="updated fade">

        <?php foreach ($this->log['notice'] as $notice): ?>
            <p><?php echo $notice; ?></p>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div><!-- end wrap -->

<?php
        // end messages HTML }}}

            $this->log = array();
        }
    }

    /**
     * Handle POST submission
     *
     * @param array $options
     * @return void
     */
   
    /**
     * Try to split lines of text correctly regardless of the platform the text
     * is coming from.
     */
    function split_lines($text) {
        $lines = preg_split("/(\r\n|\n|\r)/", $text);
        return $lines;
    }

  
    /**
     * Convert date in CSV file to 1999-12-31 23:52:00 format
     *
     * @param string $data
     * @return string
     */
    function parse_date($data) {
        $timestamp = strtotime($data);
        if (false === $timestamp) {
            return '';
        } else {
            return date('Y-m-d H:i:s', $timestamp);
        }
    }

    /**
     * Delete BOM from UTF-8 file.
     *
     * @param string $fname
     * @return void
     */
    function stripBOM($fname) {
        $res = fopen($fname, 'rb');
        if (false !== $res) {
            $bytes = fread($res, 3);
            if ($bytes == pack('CCC', 0xef, 0xbb, 0xbf)) {
                $this->log['notice'][] = 'Getting rid of byte order mark...';
                fclose($res);

                $contents = file_get_contents($fname);
                if (false === $contents) {
                    trigger_error('Failed to get file contents.', E_USER_WARNING);
                }
                $contents = substr($contents, 3);
                $success = file_put_contents($fname, $contents);
                if (false === $success) {
                    trigger_error('Failed to put file contents.', E_USER_WARNING);
                }
            } else {
                fclose($res);
            }
        } else {
            $this->log['error'][] = 'Failed to open file, aborting.';
        }
    }
}


function csv_admin_menu() {
    require_once ABSPATH . '/wp-admin/admin.php';
    $plugin = new CSVImporterPlugin;
    add_management_page('edit.php', 'CSV Importer', 'manage_options', 'csv_importer',
        array($plugin, 'form'));
}

add_action('admin_menu', 'csv_admin_menu');

?>
