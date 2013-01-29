<form name="admin_extension" method="post" action=""> 
    <h2> Post Options:</h2>
    <table class="form-table">

                <tr valign="top">
                        <th scope="row">
                                <label for="post_title">Post Title Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_title" value = "<?php echo $post_tl;  ?>" class="regular-text" />
                        </td>   
                </tr>
                
                <tr valign="top">
                        <th scope="row">
                                <label for="post_description">Post Description Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_description" value = "<?php echo $post_dl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="post_content">Post Content Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="post_content" value = "<?php echo $post_cl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

        </table>
        <p  class='description'> If values are not sett in this boxes, the save feature will not count length for the respective field !!! </p>
                <h2> Page Options:</h2>
      <table class="form-table">

                <tr valign="top">
                        <th scope="row">
                                <label for="page_title">Page Title Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_title" value = "<?php echo $page_tl;  ?>" class="regular-text" />
                        </td>   
                </tr>
                
                <tr valign="top">
                        <th scope="row">
                                <label for="page_description">Page Description Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_description" value = "<?php echo $page_dl;  ?>" class="regular-text" />
                        </td>   
                </tr>

                <tr valign="top">
                        <th scope="row">
                                <label for="page_content">Page Content Max Length :</label>
                        </th>   
                        <td>    
                                <input type="text" name ="page_content" value = "<?php echo $page_cl;  ?>"  class="regular-text" />
                        </td>   
                </tr>

        </table>

        <p  class='description'> If values are not sett in this boxes, the save feature will not count length for the respective field !!! </p>

        <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit">

</form>