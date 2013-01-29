<div class="form-field">

<label for='seo_settings["meta_title"]'>
Meta title :
</label>
<input type = "text"  name='meta_title' size="40"  value = "<?php echo $seo_setts['meta_title']?>" />
<p class="description" > eco jere eror </p>

<label for='seo_settings["meta_description"]'>
Meta Description :
</label>
<input type = "text"  name='meta_description' size="40"  value = "<?php echo $seo_setts['meta_description']?>" />
<p class="description" > <span id="meta_description_count"><?php echo count($seo_setts['meta_description'];) ?> </span><?php if($meta_desc_length) echo "/$meta_desc_length"; ?></p>

<label for='seo_settings["meta_keywords"]'>
Meta Keywords :
</label>
<input type = "text"  name='meta_keywords' size="40" value = "<?php echo $seo_setts['meta_keywords']?>"  />
<p class="description" > eco jere eror </p>

</div>