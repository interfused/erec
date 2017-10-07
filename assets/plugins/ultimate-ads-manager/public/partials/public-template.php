<div>

    <?php
        $ad_title =  get_the_title ( $ad_id );

        switch($meta['type']) {
            case 'image_ad': ?>
                <a class="codeneric_uam_link" target="_blank" href="<?php echo $meta['image_ad_referral_url']; ?>" title="<?php echo isset($meta['image_ad_title']) ?  $meta['image_ad_title'] : '' ;?>" data-id="<?php echo $ad_id; ?>" data-ad-title="<?php echo $ad_title; ?>">
                    <img src="<?php echo $meta['image_ad_uri']; ?>" alt="<?php echo isset($meta['image_ad_alt']) ?  $meta['image_ad_alt'] : '' ;?>"/>
                </a>
            <?php break;

            case 'google_adsense': ?>
                <div style="display: block" class="codeneric_uam_link" data-id="<?php echo $ad_id; ?>" data-ad-title="<?php echo $ad_title; ?>">
                    <?php echo $meta['snippet']; ?>
                </div>



                <?php break;

        }
    ?>


</div>