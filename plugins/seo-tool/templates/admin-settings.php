<form name="admin_extension" method="post" action=""> 
    <h2> Post Options:</h2>
    <table class="form-table">

                <tr valign="top">
                        <th scope="row">
                                <label for="post_title">Post Meta Title Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_title" value = "<?php echo $post_mtl;  ?>" class="regular-text" />
                        </td>   
                </tr>
                
                <tr valign="top">
                        <th scope="row">
                                <label for="post_description">Post Meta Description Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_description" value = "<?php echo $post_mdl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="post_keywords">Post Meta Keywords Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_keywords" value = "<?php echo $post_mkl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

        </table>
        <p  class='description'> If values are not sett in this boxes, the save feature will not count length for the respective field !!! </p>
                <h2> Page Options:</h2>
      <table class="form-table">

                <tr valign="top">
                        <th scope="row">
                                <label for="page_title">Page Meta Title Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_title" value = "<?php echo $page_mtl;  ?>" class="regular-text" />
                        </td>   
                </tr>
                
                <tr valign="top">
                        <th scope="row">
                                <label for="page_description">Page Meta Description Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_description" value = "<?php echo $page_mdl;  ?>" class="regular-text" />
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="page_keywords">Page Meta Keywords Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_keywords" value = "<?php echo $page_mkl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

        </table>

        <p  class='description'> If values are not sett in this boxes, the save feature will not count length for the respective field !!! </p>

        <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit">

</form>