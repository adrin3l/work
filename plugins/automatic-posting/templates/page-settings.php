<h2>Automatic Posting</h2>


<form name="automatic_posting" method="post" action=""> 

	<h3>Post Options :</h3>
<table class="form-table">

                <tr valign="top">
                        <th scope="row">
                                <label for="post_title">Title :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_title" value = "<?php echo $post_title;  ?>" style="width:75em" class="regular-text" />
                                <p class="description"> This will be your posts title, this field can't be empty .<p>
                        </td>   
                </tr>
                 <tr valign="top">
                        <th scope="row">
                                <label for="post_tagline">Tagline :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_tagline" value = "<?php echo $post_tagline;  ?>" style="width:75em" class="regular-text" />
                                <p class = "description"> Please add tagline . </p>
                        </td>   
                </tr>
                
                <tr valign="top">
                        <th scope="row">
                                <label for="post_description">Description :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_description" value = "<?php echo $post_description;  ?>" style="width:75em" class="regular-text" />
                                <p class="description"> This will be  your posts description, this field can't be empty .<p>
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="post_content">Content :</label>
                        </th>   
                        <td>    

                        	<textarea name ="post_content"  rows="10" cols="100" ><?php echo $post_content;  ?></textarea>
                        	<p class="description"> This will be your posts content, this field can't be empty .<p>

                        </td>   
                </tr>

                 <tr valign="top">
                        <th scope="row">
                                <label for="post_tags">Tags :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_tags" value = "<?php echo $post_tags;  ?>" style="width:75em" class="regular-text" />
                                <p class = "description"> Please add tags comma separated . </p>
                        </td>   
                </tr>

                 <tr valign="top">
                        <th scope="row">
                                <label for="post_link">Affiliate Link :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_link" value = "<?php echo $post_link;  ?>" style="width:75em" class="regular-text" />
                                <p class = "description"> Please add Affiliate Link . </p>
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="post_url">Website URL :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_url" value = "<?php echo $post_url;  ?>" style="width:75em" class="regular-text" />
                                <p class = "description"> Please add Website URL . </p>
                        </td>   
                </tr>

              
                <tr valign="top">
                        <th scope="row">
                          
                        </th>   
                        <td>    
                        		<p class="description"> For each of this upper fields you can use a placeholder '%category%' which will be replaced with category name .</p>
                        </td>   
                </tr>


                  <tr valign="top">
                        <th scope="row">
                                <label for="post_taxonomy">Taxonomy :</label>
                        </th>   
                        <td>    
                                <select name= "post_taxonomy">

                                    <?php foreach ($taxonomies as $tax){

                                        if($tax==$taxonomy) $checked= "checked=checked"; else $checked = '';

                                        echo "<option value='$tax'  $checked  >$tax</option>";
                                    }
                                        ?>
                                </select>
                                <p class = "description"> Please choose taxonomy where posts will be inserted. </p>
                        </td>   
                </tr>


                <tr valign="top">
                        <th scope="row">
                                <label for="post_categories">Exclude Terms :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_categories" value = "<?php echo $post_categories;  ?>" style="width:75em" class="regular-text" />
                                <p class = "description"> Please add exclude terms ids comma separated for example :  "2,5,6". </p>
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="post_status">Post Status :</label>
                        </th>   
                        <td>    
                                <label for="post_status" ><input type = 'radio' name ="post_status" value="publish" checked="checked"> Publish </label>
                                <label for="post_status" ><input type = 'radio' name ="post_status" value="draft"> Draft </label>
                        </td>   
                </tr>

        </table>

 <input id="generate_posts" class="button button-primary" type="submit" value="Generate Posts" width="40" name="generate_posts">


</form>
	