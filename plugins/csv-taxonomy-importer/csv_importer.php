<?php
/*
Plugin Name: CSV Taxonomy Importer
Description: Import data as terms taxonomy from a CSV file. 
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

        // pad shorter rows with empty values
        $csv->symmetrize();
        $import = 0;
         // echo '<pre>';var_dump($csv->connect());die;
            foreach ($csv->connect() as $csv_data) {

                if( $csv_data['term']){

                    if($_POST['term_slug']){
                        $term_slug = str_replace('%term_slug%',sanitize_title($csv_data['term']),$_POST['term_slug']);
                    }else{
                        $term_slug=sanitize_title($csv_data['term']);
                    }

                    $term= wp_insert_term(
                            $csv_data['term'], // the term 
                            $_POST['taxonomy'], // the taxonomy
                            array(
                                'description'=> $csv_data['term'],
                                'slug' => $term_slug
                                 )
                            );
                    if(is_wp_error($term)){

                        $this->log['error'][] =  $term->get_error_message();


                    }else{

                        $import++;
                    }
                    
                }

            }

            if (file_exists($file)) {
                @unlink($file);
            }

            if($import == 0){

                 $this->log['error'][] =  'No terms inserted please check if the file is empty or if you have "term" column!';

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
       

        
        <label for"taxonomy">Taxonomy : </label>
       <select name="taxonomy">
        <!-- Parent category -->
        <?php 
        $args=array(
            'public'   => true  
            ); 
        $output = 'names';

        $taxonomies = get_taxonomies($args,$output);

        foreach($taxonomies as $taxonomy){

            echo "<option value='$taxonomy'>$taxonomy</option>";

        }

        ?>
        </select>
<br/>
        <label for="term_slug"> Term Slug:
            <input type="text" value="<?php echo $_POST['term_slug']; ?>" name="term_slug" />
            <p class="description"> Use a place holder %term_slug% for creating the slug and add what ever text you want for extending slug. </p>
            <p class="description"> You should always have %term_slug% in this field .</p>
            <p class="description"> EG: coupon_%term_slug%_store </p>
            <p class="description"> If this field remain empty he will create the default slug. </p>

        </label> 
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
    add_management_page('edit.php', 'CSV Importer', 'manage_options', __FILE__,
        array($plugin, 'form'));
}

add_action('admin_menu', 'csv_admin_menu');

?>
